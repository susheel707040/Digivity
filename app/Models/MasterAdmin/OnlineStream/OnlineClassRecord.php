<?php

namespace App\Models\MasterAdmin\OnlineStream;

use App\Models\MasterAdmin\AcademicSetting\Course;
use App\Models\MasterAdmin\AcademicSetting\Section;
use App\Models\Record;

class OnlineClassRecord extends Record
{
    protected $table = "online_class_record";
    protected $fillable = [
        'id',
        'school_id',
        'branches_id',
        'academic_id',
        'join_group_id',
        'password',
        'member_id',
        'online_for_id',
        'course_id',
        'section_id',
        'online_period_id',
        'expire_date',
        'online_minute',
        'joins',
        'online_status',
        'third_party',
        'video_store_id',
        'user_id'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id', 'id');
    }

    public function onlinefor()
    {
        return $this->belongsTo(OnlineFor::class, 'online_for_id', 'id');
    }

    public function onlineperiod()
    {
        return $this->belongsTo(OnlinePeriod::class, 'online_period_id', 'id');
    }

    /*
     * Table Relation Columan String
     */

    public function OnlineForName()
    {
        try {
            return $this->onlinefor->online_for;
        } catch (\Exception $e) {
        }
        return null;
    }

    public function OnlinePeriodName()
    {
        try {
            return $this->onlineperiod->online_period;
        } catch (\Exception $e) {
        }
        return null;
    }

    public function CourseName()
    {

    }

    public function SectionName()
    {

    }
}
