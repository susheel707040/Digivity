<?php

namespace App\Models\MasterAdmin\Staff;

use Illuminate\Database\Eloquent\Model;

class StaffRecordQualification extends Model
{
    public $timestamps = false;
    protected $table="staff_record_qualification";
    protected $fillable=[
      'id',
      'staff_id',
      'qualification_id'
    ];
}
