<?php

namespace App\Models\MasterAdmin\InApp;

use Illuminate\Database\Eloquent\Model;

class NoticeAttachmentFile extends Model
{
    protected $table = "inapp_notice_attachment_file_record";
    protected $fillable = [
        'id',
        'notice_id',
        'file_name',
        'file_path',
        'extension',
        'user_id'
    ];
}
