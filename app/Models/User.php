<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\MasterAdmin\Admission\StudentRecord;
use App\Models\MasterAdmin\GlobalSetting\SchoolBranch;
use App\Models\MasterAdmin\GlobalSetting\AcademicSession;
use App\Models\MasterAdmin\GlobalSetting\FinancialSession;
use App\Models\MasterAdmin\GlobalSetting\UIDisplay;
use App\Models\MasterAdmin\GlobalSetting\UserMapModule;
use App\Models\MasterAdmin\Staff\StaffRecord;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ["id","name","role_id","school_id", "branches_id", "academic_id", "financial_id",
    "student_id",'staff_id',"first_name", "last_name", "gender", "dob", "contact_no", "email", "username",
    "password", "profile_img", "two_fa_at", "active_at", "otp", "token"];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public function academicyear()
    {
        return $this->belongsTo(AcademicSession::class,'academic_id','id');

    }

    public function modules()
    {
        return $this->belongsTo(UserMapModule::class,'role_id','role_id')->where(function ($query){
            $query->where('ac_user_id',$this->id)->orWhereNull('ac_user_id');
    });
    }
    public function branches()
    {
        return $this->belongsTo(SchoolBranch::class,'branches_id','id');
    }

    public function financialyear()
    {
        return $this->belongsTo(FinancialSession::class,'financial_id','id');
    }

    public function uidisplay()
    {
        return $this->belongsTo(UIDisplay::class,'id','user_id');
    }

    public function student()
    {
        return $this->belongsTo(StudentRecord::class,'student_id','student_id');
    }

    public function staff()
    {
        return $this->belongsTo(StaffRecord::class,'staff_id','id');
    }
    /**
     * Get full name of user
     *
     * @return string
     */
    public function fullName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function ProfileImage()
    {
        $data = User::join('file_storage', 'users.profile_img', '=', 'file_storage.id')
        ->first();

    if ($data) {
        return $data->file_name;
    } else {
        return "No matching record found"; // or handle the case where no record is found
    }
    }

    public function RoleName()
    {
        try {
            return $this->roles[0]->name;
        }catch (\Exception $e){}
        return null;
    }

    public function info()
    {
        try {
            return $this->student->course->course."-".$this->student->section->section;
        }catch (\Exception $e){}
        return null;
    }

    public function SessionName()
    {
        try {
            return $this->academicyear->academic_session;
        }catch (\Exception $e){}
        return null;
    }

    public function SchoolWebsiteUrl()
    {
        try {
            return $this->branches->website;
        }catch (\Exception $e){
            return null;
        }
    }

    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }

    public function LastLoginAt($status = null, $skipdays = null)
    {
        // Set default values using the null coalescing operator
        $skip = $skipdays ?? 1;

        $searchStatus = "login";
        if ($status) {
            $searchStatus = $status;
        }

        try {
            $lastLoginAt = $this->activitylog()->where(['activity_status' => $searchStatus])->latest()->skip($skip)->first();

            if ($lastLoginAt) {
                // Use the optional chaining operator (PHP 7.4+) to avoid errors if created_at is null
                return nowdate($lastLoginAt->created_at, 'd-M-Y h:i:sA') ?? "";
            }

            return "";
        } catch (\Exception $e) {
            // Log or handle the exception appropriately
            return null;
        }
    }


}
