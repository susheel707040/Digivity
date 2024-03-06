<?php

namespace App\Models\MasterAdmin\Admission;

use App\Models\MasterAdmin\AcademicSetting\Caste;
use App\Models\MasterAdmin\AcademicSetting\Nationality;
use App\Models\MasterAdmin\AcademicSetting\Religion;
use App\Models\Record;

class StudentAdmission extends Record
{
    protected $table = "student_record";
    protected $fillable = [
        'admission_date',
        'first_name',
        'middle_name',
        'last_name',
        'gender',
        'dob',
        'age',
        'blood_group',
        'nationality',
        'religion',
        'caste',
        'parish',
        'aadhar_card_no',
        'birth_certificate_no',
        'rfid_no',
        'gps_tracking_no',
        'contact_no',
        'email',
        'residence_address',
        'permanent_address',
        'landmark',
        'city',
        'pin_code',
        'father_name',
        'father_mobile_no',
        'father_email_id',
        'father_qualification',
        'father_annual_income',
        'father_annual_income',
        'father_profession',
        'father_designation',
        'father_organization_name',
        'father_organization_address',
        'father_organization_phone',
        'parent_status',
        'mother_name',
        'mother_mobile_no',
        'mother_email_id',
        'mother_qualification',
        'mother_annual_income',
        'mother_aadhar_card_no',
        'mother_profession',
        'mother_designation',
        'mother_organization_name',
        'mother_organization_address',
        'mother_organization_phone',
        'anniversary_date',
        'local_guardian_relation',
        'local_guardian_name',
        'local_guardian_mobile_no',
        'local_guardian_email_id',
        'local_guardian_qualification',
        'local_guardian_annual_income',
        'local_guardian_aadhar_card_no',
        'local_guardian_profession',
        'local_guardian_designation',
        'local_guardian_org_name',
        'local_guardian_org_address',
        'local_guardian_org_phone',
        'emergency_person_name',
        'emergency_mobile_no',
        'emergency_email_id',
        'emg_address',
        'emg_relation',
        'state',
        'medical_history',
        'allergie',
        'family_doctor_name',
        'family_doctor_phone',
        'family_doctor_address',
        'other_medical_info',
        'staff_designation',
        'staff_id',
        'user_id'
    ];

    public function casteRel()
    {
        return $this->belongsTo(Caste::class,'caste','id')->withTrashed();
    }

    public function nationalityRel()
    {
        return $this->belongsTo(Nationality::class,'nationality','id')->withTrashed();
    }

    public function religionRel()
    {
        return $this->belongsTo(Religion::class,'religion','id')->withTrashed();
    }


    /*
     * Relationship Table
     */
    public function CasteName()
    {
        try {
            return $this->casteRel->caste;
        }catch (\Exception $e){
            return null;
        }
    }
}
