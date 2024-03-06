<?php

namespace App\Models\MasterAdmin\Admission;

use Illuminate\Database\Eloquent\Model;

class StudentPreviousSchool extends Model
{
    protected $table="student_previous_school_record";
    protected $fillable=[
        'student_id',
        'school_name',
        'board',
        'class',
        'year',
        'percentage'
    ];
}
