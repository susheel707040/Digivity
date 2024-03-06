<?php

namespace App\Models\MasterAdmin\Transport\MasterSetting;

use App\Models\Record;

class TransportRouteFeeCharge extends Record
{
    protected $table="transport_route_fee_charge";
    protected $fillable=[
        'financial_id',
        'route_relation_id',
        'instalment_id',
        'fee_amount',
        'user_id'
    ];
}
