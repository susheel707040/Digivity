<?php

namespace App\Models\MasterAdmin\Staff;

use Illuminate\Database\Eloquent\Model;

class StaffRecordSkillKnowledge extends Model
{
    public $timestamps = false;
    protected $table="staff_record_skill_knowledge";
    protected $fillable=[
        'id',
        'staff_id',
        'skill_knowledge_id'
    ];
}
