<?php

namespace App\Models\MasterAdmin\GlobalSetting;

use App\Models\Record;

class UserMapModule extends Record
{
    protected $table = "user_module";
    protected $fillable = [
        'school_id',
        'branches_id',
        'role_id',
        'ac_user_id',
        'web_app_module',
        'mobile_app_module'
    ];
}
