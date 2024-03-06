<?php

namespace App\Models\MasterAdmin\InApp;

use Illuminate\Database\Eloquent\Model;

class CalendarAttachmentFile extends Model
{
    protected $table = "inapp_calendar_attachment_file_record";
    protected $fillable = [
        'id',
        'calendar_id',
        'file_name',
        'file_path',
        'extension',
        'user_id',
        ''
    ];
}
