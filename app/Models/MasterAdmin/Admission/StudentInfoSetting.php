<?php

namespace App\Models\MasterAdmin\Admission;

use App\Models\Record;

class StudentInfoSetting extends Record
{

    protected $table = "student_information_setting";
    protected $fillable = [
        'school_id',
        'branches_id',
        'academic_id',
        'admission_prefix',
        'admission_no_start',
        'admission_suffix',
        'prospectus_prefix',
        'prospectus_no_start',
        'prospectus_suffix',
    ];

}
