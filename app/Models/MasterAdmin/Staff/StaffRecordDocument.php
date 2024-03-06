<?php

namespace App\Models\MasterAdmin\Staff;

use Illuminate\Database\Eloquent\Model;

class StaffRecordDocument extends Model
{
    public $timestamps = false;
    protected $table="staff_record_document";
    protected $fillable=[
        'id',
        'staff_id',
        'document_id',
        'document_name',
        'extension',
        'document_file'
    ];
}
