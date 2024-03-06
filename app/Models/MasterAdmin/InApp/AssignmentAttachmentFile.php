<?php

namespace App\Models\MasterAdmin\InApp;

use Illuminate\Database\Eloquent\Model;

class AssignmentAttachmentFile extends Model
{
    protected $table = "inapp_assignment_attachment_file_record";
    protected $fillable = [
        'id',
        'assignment_id',
        'file_name',
        'file_path',
        'extension',
        'user_id'
    ];
}
