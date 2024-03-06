<?php

namespace App\Models\MasterAdmin\GlobalSetting;

use App\Models\Record;

class SchoolBranch extends Record
{
    protected $table="school_branches";
    protected $fillable = [
        'school_id',
        'school_name',
        'color',
        'address',
        'ads_color',
        'about',
        'contact_no',
        'email',
        'website',
        'logo',
        'banner_logo',
        'city',
        'currency',
        'language',
        'timezone',
        'location',
        'latitude',
        'longitude'
        ];

    public function SchoolLogo()
    {
        return FileUrl($this->logo);
    }

}
