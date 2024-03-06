<?php

namespace App\Models\MasterAdmin\Admission;

use App\Helper\DateFormat;
use App\Models\MasterAdmin\AcademicSetting\Caste;
use App\Models\MasterAdmin\AcademicSetting\Category;
use App\Models\MasterAdmin\AcademicSetting\Course;
use App\Models\MasterAdmin\AcademicSetting\Nationality;
use App\Models\MasterAdmin\AcademicSetting\Religion;
use App\Models\MasterAdmin\AcademicSetting\Section;
use App\Models\MasterAdmin\Attendance\StudentAttendance;
use App\Models\MasterAdmin\Finance\FeeSetting\ConcessionType;
use App\Models\MasterAdmin\Finance\FeeSetting\FeeGroupWithMapCourse;
use App\Models\MasterAdmin\Finance\StudentFeeCollection;
use App\Models\MasterAdmin\GlobalSetting\AcademicSession;
use App\Models\MasterAdmin\Transport\MasterSetting\RouteRelation;
use App\Models\Record;
use App\Models\User as ModelsUser;
use App\Repositories\MasterAdmin\GlobalSetting\CommanDataRepository;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class StudentRecord extends Record
{
    protected $table = "student_admission_class_record";
    protected $fillable = [
        'id',
        'school_id',
        'branches_id',
        'academic_id',
        'financial_id',
        'student_id',
        'admission_no',
        'ac_ledger_no',
        'admission_type_id',
        'category_id',
        'form_no',
        'roll_no',
        'course_id',
        'section_id',
        'board_id',
        'house_id',
        'stream_id',
        'subject_id',
        'fee_concession_id',
        'fee_head_id_avoid',
        'transport_start_date',
        'transport_id',
        'transport_status',
        'transport_stop_date',
        'hostel_id',
        'ac_user_id',
        'user_id',
        'is_ewa',
        'is_new',
        'is_sibling',
        'status',
        'inactive_date',
        'father_photo',
        'mother_photo',
        'local_guardian_photo',
        'profile_img',
        'username',
        'pwd'
    ];



    public function student()
    {
        return $this->belongsTo(StudentAdmission::class, 'student_id', 'id')->withTrashed();
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id')->select(array('id', 'course'))->withTrashed();
    }

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id', 'id')->select(array('id', 'section'))->withTrashed();
    }

    public function feegroup()
    {
        return $this->belongsTo(FeeGroupWithMapCourse::class, 'course_id', 'course_id')->record();

    }

    public function session()
    {
        return $this->belongsTo(AcademicSession::class, 'academic_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id','id')->withTrashed();
    }


    public function concession()
    {
        return $this->belongsTo(ConcessionType::class, 'fee_concession_id', 'id');
    }

    public function transport()
    {
        return $this->belongsTo(RouteRelation::class,'transport_id','id');
    }

    public function subject()
    {
        return (new CommanDataRepository())->subjectlist(['customsearch'=>['whereIn'=>['id'=>explode(",",$this->subject_id)]]]);
    }

    public function studentattendance($attendancedate=null)
    {
        return $this->belongsTo(StudentAttendance::class,'student_id','student_id')->where(['attendance_date'=>$attendancedate]);
    }

    public function documentsubmit()
    {
        return $this->hasMany(StudentDocumentRecord::class,'student_id','student_id');
    }

    public function user()
    {
        return $this->belongsTo(ModelsUser::class,'ac_user_id','id');
    }

    /**
     * @return string
     * student name function
     */
    public function ProfileImage()
    {
        return FileUrl($this->profile_img);
    }
    public function FatherProfileImage()
    {
        return FileUrl($this->father_photo);
    }
    public function MotherProfileImage()
    {
        return FileUrl($this->mother_photo);
    }
    public function LocalGuardianProfileImage()
    {
        return FileUrl($this->local_guardian_photo);
    }

    public function fullName()
    {
        return preg_replace('/(\s\s+|\t|\n)/', ' ',$this->student->first_name.' '.$this->student->middle_name.' '.$this->student->last_name);
    }

    public function dob()
    {
        try {
            if(isset($this->student->dob)){return nowdate($this->student->dob,'d-M-Y');}
            return null;
        }catch (\Exception $e){return null;}
    }

    public function CourseSection()
    {
        return $this->course->course . ' - ' . $this->section->section;
    }

    public function FatherName()
    {
        return $this->student->father_name;
    }

    public function MotherName()
    {
        return $this->student->mother_name;
    }

    public function Address()
    {
        return $this->student->residence_address;
    }

    public function SessionName()
    {
        return $this->session->academic_session;
    }

    public function ReligionName()
    {
        try {
            return $this->student->religionRel->religion;
        }catch (\Exception $e){ return null;}
    }
    public function CategoryName()
    {
        try {
            return $this->category->category;
        }catch (\Exception $e){ return null;}
    }

    public function CasteName()
    {
        if(isset($this->student->caste)){
            return $this->student->caste;
        }else{
            return "N/A";
        }
    }


    public function aadhar_card_no()
    {
        if(isset($this->student->aadhar_card_no)){
            return $this->aadhar_card_no;
        }
        // else{
            // return "N/A";
        // }
    }

    public function NationalityName()
    {
        try {
            return $this->student->nationalityRel->nationality;
        }catch (\Exception $e){ return null;}
    }

    public function TransportName()
    {
        if($this->transport_id){
            return $this->transport_status;
        }else{
            return "N/A";
        }
    }

    public function StudentSubjectName()
    {
        try {
            $subjectname=$this->subject()->map(function ($data){return $data['subject_name'];})->toArray();
         return implode(",",$subjectname);
        }catch (\Exception $e){}
        return null;
    }

    public function ConcessionName()
    {
        if(isset($this->concession->concession_type)) {
            return $this->concession->concession_type;
        }
        return "N/A";
    }

    public function LastFeePaidDate()
    {
        $feecollect=StudentFeeCollection::query()->where(['student_id'=>$this->student_id])->record()->latest()->first();
        if(isset($feecollect)){
            return $feecollect->receipt_date;
        }
        return null;
    }

    public function contactnoid()
    {
        return $this->student->contact_no."_student_".$this->student_id;
    }

    public function ContactNo()
    {
        return $this->student->contact_no;
    }


    public function AttendanceStatus($attendancedate=null)
    {
        try {
            $studentattendance=$this->studentattendance($attendancedate)->first();
            return $studentattendance->attendance;
        }catch (\Exception $e) {
            return "p";
        }
    }

    public function TotalFeePaid()
    {
        try {
            $feecollect=StudentFeeCollection::query()->where(['student_id'=>$this->student_id,'receipt_status'=>'paid'])->record()->sum('paid_amount');
            return $feecollect;
        }catch (\Exception $e){
            return 0;
        }
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
            '{AdmissionDate}' => nowdate($this->student->admission_date, 'd-M-Y'),
            '{AdmissionNo}' => $this->admission_no,
            '{FullName}' => $this->fullName(),
            '{Gender}'=>$this->student->gender,
            '{Dob}'=>$this->dob(),
            '{DobinWords}'=>$dateinwords,
            '{Course}' => $this->course->course,
            '{Section}' => $this->section->section,
            '{Session}' => $this->SessionName(),
            '{ProfileImage}' =>$this->ProfileImage(),
            '{CourseSection}' => $this->CourseSection(),
            '{Category}'=>$this->CategoryName(),
            '{Caste}'=>$this->CasteName(),
            '{Nationality}'=>$this->NationalityName(),
            '{Relation}'=>$this->student->gender=="female" ? "D/O" : "S/O",
            '{FatherName}' => $this->FatherName(),
            '{ContactNo}' => $this->student->contact_no,
            '{MotherName}' => $this->MotherName(),
            '{Address}' => $this->student->residence_address,
            '{NowDate}' => nowdate('', 'd-M-Y'),
            '{NowDateTime}' => nowdate('', 'd-M-Y H:i:s'),
            '{Username}'=>$this->username,
            '{Psw}'=>$this->pwd,
            '{TotalFeePaid}'=>$this->TotalFeePaid()
        ];
    }

}
