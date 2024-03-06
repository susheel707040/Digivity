<?php

namespace App\Models\MasterAdmin\Staff;

use App\Models\Record;

class SkillAndKnowledge extends Record
{
    protected $table="staff_skill_and_knowledge";
    protected $fillable=[
        'school_id',
        'branches_id',
        'skill_name',
        'status',
        'user_id'
    ];
}
