<?php

namespace App\Models\MasterAdmin\Communication;

use App\Models\Record;
use App\Models\User;

class CommunicationSMSRecord extends Record
{
    protected $table = "communication_notification_record";
    protected $fillable = [
        'id',
        'school_id',
        'branches_id',
        'academic_id',
        'communication_token_id',
        'platform',
        'communication_date',
        'communication_type_id',
        'send_to',
        'send_to_id',
        'contact_no',
        'total_receiver',
        'unicode',
        'text_message',
        'sms_count',
        'sms_balance',
        'delivery_status',
        'campaign_name',
        'phone_text',
        'mobile_app',
        'website',
        'schedule_date',
        'schedule_date_time',
        'schedule_status',
        'status',
        'user_id'
    ];

    public function communicationtype()
    {
        return $this->belongsTo(CommunicationType::class,'communication_type_id','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    /*
     * Relation Table
     */
    public function CommunicationTypeName()
    {
        try {
            return $this->communicationtype->communication_type;
        }catch (\Exception $e){
            return null;
        }
    }

}
