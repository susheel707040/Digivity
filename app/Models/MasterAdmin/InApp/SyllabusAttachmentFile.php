<?php

namespace App\Models\MasterAdmin\InApp;

use Illuminate\Database\Eloquent\Model;

class SyllabusAttachmentFile extends Model
{
    protected $table="inapp_syllabus_attachment_file_record";
    protected $fillable=[
        'id',
        'syllabus_id',
        'file_name',
        'file_path',
        'extension',
        'user_id'
    ];
}
