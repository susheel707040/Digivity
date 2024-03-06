<?php

namespace App\Models\MasterAdmin\Certificate;

use App\Models\MasterAdmin\Admission\StudentRecord;
use App\Model\MasterAdmin\GlobalSetting\Certificate;
use App\Model\Record;

class CertificateRecord extends Record
{
    protected $table = "certificate_record";
    protected $fillable = [
        'id',
        'school_id',
        'branches_id',
        'academic_id',
        'certificate_no',
        'issue_date',
        'student_id',
        'staff_id',
        'certificate_id',
        'certificate_for',
        'integrate',
        'request_data',
        'certificate_content',
        'status',
        'update_times',
        'print_times',
        'user_id'
    ];

    public function student()
    {
        try {
            return $this->belongsTo(StudentRecord::class,'student_id','student_id');
        }catch (\Exception $e){
            return null;
        }
    }

    public function certificate()
    {
        try {
            return $this->belongsTo(Certificate::class,'certificate_id','id');
        }catch (\Exception $e){
            return null;
        }
    }

    /*
     * Relation Tables
     */

    public function CertificateName()
    {
        try {
            return $this->certificate->certificate_name;
        }catch (\Exception $e){
            return null;
        }
    }
}
