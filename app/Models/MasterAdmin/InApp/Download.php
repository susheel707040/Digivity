<?php

namespace App\Models\MasterAdmin\InApp;

use App\Models\Record;
use App\Models\User;

class Download extends Record
{
    protected $table = "inapp_download_record";
    protected $fillable = [
        'id',
        'school_id',
        'branches_id',
        'academic_id',
        'type',
        'course_id',
        'section_id',
        'student_id',
        'department_id',
        'designation_id',
        'staff_id',
        'upload_date',
        'download_title',
        'download_details',
        'file_name',
        'extension',
        'file_path',
        'show_app',
        'show_website',
        'status',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
