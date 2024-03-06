<?php

namespace App\Models\MasterAdmin\InApp;

use Illuminate\Database\Eloquent\Model;

class HomeworkAttachmentFile extends Model
{
    protected $table = "inapp_homework_attachment_file_record";
    protected $fillable = [
        'homework_id',
        'file_name',
        'attachment_files',
        'extension',
        'user_id'
    ];
}
