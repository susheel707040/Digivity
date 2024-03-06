<?php

namespace App\Models\MasterAdmin\Admission;

use App\Helper\DateFormat;
use App\Models\MasterAdmin\AcademicSetting\AdmissionType;
use App\Models\MasterAdmin\AcademicSetting\Course;
use App\Models\MasterAdmin\GlobalSetting\AcademicSession;
use App\Models\MasterAdmin\GlobalSetting\SchoolBoard;
use App\Models\Record;
use App\Models\User as ModelsUser;
use App\Models\User;

class StudentProspectus extends Record
{
    protected $table="student_prospectus";
    protected $fillable=[
        'id',
        'school_id',
        'branches_id',
        'academic_id',
        'financial_id',
        'pros_no',
        'admission_date',
        'reference',
        'admission_type_id',
        'course_id',
        'board_id',
        'transport_id',
        'first_name',
        'middle_name',
        'last_name',
        'gender',
        'dob',
        'aadhar_no',
        'father_name',
        'f_qualification',
        'f_annual_income',
        'mother_name',
        'm_qualification',
        'm_annual_income',
        'person_name',
        'mobile_no',
        'email_id',
        'residence_address',
        'permanent_address',
        'landmark',
        'city',
        'pincode',
        'state',
        'student_photo',
        'status',
        'pay_status',
        'payable_amt',
        'paid_amt',
        'user_id'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class,'course_id','id');
    }

    public function board()
    {
        return $this->belongsTo(SchoolBoard::class,'board_id','id');
    }

    public function admisisontype()
    {
        return $this->belongsTo(AdmissionType::class,'admission_type_id','id');
    }

    public function academic()
    {
        return $this->belongsTo(AcademicSession::class,'academic_id','id');
    }

    /*
     * Create Temp Function For Admission Get Value
     */
    public function student()
    {
        return $this->belongsTo(StudentProspectus::class,'id','id');
    }

    public function user()
    {
        return $this->belongsTo(ModelsUser::class,'user_id','id');
    }

    /*
     * Relation table get columan data return
     */
    public function fullName()
    {
        try {
            return $this->first_name." ".$this->middle_name." ".$this->last_name;
        }catch (\Exception $e){}
        return null;

    }
    public function CourseName()
    {
        try {
            return $this->course->course;
        }catch (\Exception $e){}
        return null;
    }

    public function SessionName()
    {
        return $this->session->academic_session;
    }

    public function dob()
    {
        if(isset($this->dob)){
            return nowdate($this->dob,'d-M-Y');
        }
        return null;
    }

    public function FatherName()
    {
        try {
            return $this->father_name;
        }catch (\Exception $e){}
        return null;
    }

    public function AcademicName()
    {
        if(isset($this->academic->academic_session)){
            return $this->academic->academic_session;
        }
        return null;
    }
    public function AdmissionTypeName()
    {
       if(isset($this->admisisontype->admission_type)){
           return $this->admisisontype->admission_type;
       }
       return null;
    }

    public function AcademicYearName()
    {
        if(isset($this->academic->academic_session)){
            return $this->academic->academic_session;
        }
        return null;
    }

    public function Address()
    {
       return $this->residence_address;
    }

    public function contactnoid()
    {

    }

    public function ContactNo()
    {
        try {
            return $this->mobile_no;
        }catch (\Exception $e){}
        return null;
    }

    /**
     * parameter define to dynamic replace text sms and email value
     * @return array
     */
    public function parameters()
    {
        $dateinwords="";
        try{
            $dateinwords=DateFormat::dateinwords($this->dob());
        }catch(\Exception $e){}
        return [
            '---id---' => $this->contactnoid(),
            '{AdmissionDate}' => nowdate($this->admission_date, 'd-M-Y'),
            '{ProspectusNo}' => $this->pros_no,
            '{FullName}' => $this->fullName(),
            '{Gender}'=>$this->gender,
            '{Dob}'=>$this->dob(),
            '{DobinWords}'=>$dateinwords,
            '{Course}' => $this->course->course,
            '{Session}' => $this->AcademicName(),
            '{Relation}'=>$this->gender=="female" ? "D/O" : "S/O",
            '{FatherName}' => $this->FatherName(),
            '{ContactNo}' => $this->mobile_no,
            '{Address}' => $this->residence_addresss,
            '{NowDate}' => nowdate('', 'd-M-Y'),
            '{NowDateTime}' => nowdate('', 'd-M-Y H:i:s'),
        ];
    }

}
