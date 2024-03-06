<?php

namespace App\Models\MasterAdmin\InApp;

use App\Models\Record;
use App\Models\User;

class Calendar extends Record
{
    protected $table = "inapp_calendar_record";
    protected $fillable = [
        'id',
        'school_id',
        'branches_id',
        'calendar_type_id',
        'type',
        'reminder_text_sms',
        'reminder_email',
        'reminder_app',
        'start_date',
        'start_time',
        'start_date_time',
        'end_date',
        'end_time',
        'end_date_time',
        'calendar_title',
        'calendar_details',
        'show_app',
        'show_website',
        'status',
        'user_id'
    ];

    public function calendartype()
    {
        return $this->belongsTo(CalendarType::class,'calendar_type_id','id');
    }
    public function attachment()
    {
        return $this->hasMany(CalendarAttachmentFile::class,'calendar_id','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
