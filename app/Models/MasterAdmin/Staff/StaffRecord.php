<?php

namespace App\Models\MasterAdmin\Staff;

use App\Helper\DateFormat;
use App\Helper\MobileNumberValidate;
use App\Models\Record;

class StaffRecord extends Record
{
    protected $table = "staff_record";
    protected $fillable = [
        'id',
        'school_id',
        'branches_id',
        'financial_id',
        'ac_user_id',
        'joining_date',
        'staff_no',
        'date_of_retire',
        'date_of_extend',
        'profession_type_id',
        'staff_type_id',
        'department_id',
        'designation_id',
        'show_in_transport',
        'transport_id',
        'hostel_id',
        'shift_id',
        'integrated_id',
        'title',
        'first_name',
        'middle_name',
        'last_name',
        'gender',
        'blood_group',
        'dob',
        'doa',
        'nationality_id',
        'religion_id',
        'category_id',
        'caste_id',
        'parish_id',
        'aadhaar_no',
        'pan_no',
        'license_no',
        'passport_no',
        'contact_no',
        'alt_mobile_no',
        'email',
        'father_name',
        'mother_name',
        'father_mobile_no',
        'marital_status',
        'spouse_name',
        'spouse_mobile_no',
        'residence_address',
        'permanent_address',
        'landmark',
        'city',
        'pincode',
        'state',
        'ex_year',
        'ex_month',
        'ex_day',
        'ex_description',
        'paymode_id',
        'account_number',
        'ifsc_code',
        'bank_name',
        'bank_location',
        'generate_salary',
        'salary_to_bank',
        'gratuity_code',
        'emp_status',
        'pf_no',
        'esi_no',
        'uan_no',
        'dispensary',
        'nominee_name',
        'nominee_relation',
        'pension',
        'machine_no',
        'rfid_no',
        'gps_no',
        'attendance',
        'profile_img',
        'username',
        'psw',
        'user_id'
    ];


    public function department()
    {
        return $this->belongsTo(StaffDepartment::class, 'department_id', 'id');
    }

    public function staffid(){
        return $this->belongsTo(StaffRecord::class,'id', 'id');
    }

    public function designation()
    {
        return $this->belongsTo(StaffDesignation::class, 'designation_id', 'id');
    }

    public function stafftype()
    {
        return $this->belongsTo(StaffType::class, 'staff_type_id', 'id');
    }

    public function professiontype()
    {
        return $this->belongsTo(ProfessionType::class, 'profession_type_id', 'id');
    }

    public function staffskillandknowledge()
    {
        return $this->hasMany(StaffRecordSkillKnowledge::class,'id','staff_id');
    }

    public function staffqualification()
    {
        return $this->hasMany(StaffRecordQualification::class,'id','staff_id');
    }


    /*
     * function define return values
     */
    public function fullName()
    {
        try {
            return preg_replace('/(\s\s+|\t|\n)/', ' ',ucwords($this->title).' '.$this->first_name.' '.$this->middle_name.' '.$this->last_name);
        }catch (\Exception $e){
            return null;
        }
    }

    public function FatherName()
    {
        try {
            return ucwords($this->father_name);
        }catch (\Exception $e){
            return null;
        }
    }



    public function ContactNo()
    {
        try {
            return ucwords($this->contact_no);
        }catch (\Exception $e){
            return null;
        }
    }



    public function SpouseName()
    {
        try {
            return ucwords($this->spouse_name);
        }catch (\Exception $e){
            return null;
        }
    }

    public function Address()
    {
        try {
            return ucwords($this->residence_address);
        }catch (\Exception $e){
            return null;
        }
    }

    public function DesignationName()
    {
        try {
            return $this->designation->designation;
        }catch (\Exception $e){
            return null;
        }
    }

    public function staffName()
    {
        try{
            return $this->staffid->staffid;
        }catch(\Exception $e){
        return null;
    }
}

    public function DepartmentName()
    {
        try {
            return $this->department->department;
        }catch (\Exception $e){
            return null;
        }
    }

    public function StaffTypeName()
    {
        try {
            return $this->stafftype->staff_type;
        }catch (\Exception $e){
            return null;
        }
    }

    public function ProfessionTypeName()
    {
        try {
            return $this->professiontype->profession_type;
        }catch (\Exception $e){
            return null;
        }
    }

    public function TransportName()
    {
        return null;
    }

    public function HostelName()
    {
        return null;
    }

    public function ShiftName()
    {
        return null;
    }

    public function NationalityName()
    {
        return null;
    }

    public function ReligionName()
    {
        return null;
    }

    public function CategoryName()
    {
        return null;
    }

    public function ProfileImage()
    {
        try {
            return FileUrl($this->profile_img);
        }catch (\Exception $e){
            return null;
        }

    }

    public function contactnoid()
    {
        return $this->contact_no."_staff_".$this->id;
    }

    /**
     * parameter define to dynamic replace text sms and email value
     * @return array
     */
    public function parameters()
    {
        /*$dateinwords="";
        try{
            $dateinwords=DateFormat::dateinwords($this->dob());
        }catch(\Exception $e){}*/
        return [
            '---id---' => $this->contactnoid(),
            '{JoiningDate}' => nowdate($this->joining_date, 'd-M-Y'),
            '{StaffNo}' => $this->staff_no,
            '{FullName}' => $this->fullName(),
            '{Gender}'=>ucwords($this->gender),
            '{NowDate}' => nowdate('', 'd-M-Y'),
            '{NowDateTime}' => nowdate('', 'd-M-Y H:i:s'),
            '{Username}'=>$this->username,
            '{Psw}'=>$this->psw
        ];
    }

}
