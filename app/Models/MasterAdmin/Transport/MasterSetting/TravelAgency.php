<?php

namespace App\Models\MasterAdmin\Transport\MasterSetting;

use App\Models\Record;

class TravelAgency extends Record
{
    protected $table = "transport_travel_agency";
    protected $fillable = [
        'school_id',
        'branches_id',
        'travel_agency',
        'person_name',
        'mobile_no',
        'email',
        'office_address',
        'user_id'
    ];
}
