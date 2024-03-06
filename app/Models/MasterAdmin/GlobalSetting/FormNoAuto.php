<?php

namespace App\Models\MasterAdmin\GlobalSetting;

use App\Models\Record;
use Illuminate\Database\Eloquent\Model;

class FormNoAuto extends Record
{
    protected $table = "form_auto_increment_configuration";
    protected $fillable = [
        'id',
        'school_id',
        'branches_id',
        'academic_id',
        'key_id',
        'should_be',
        'p_s_support_date',
        'prefix',
        'prefix_date',
        'start_from',
        'suffix',
        'suffix_date',
        'status',
        'user_id',
    ];

    public function GetNo()
    {
        $prefixdate = "";
        if ($this->prefix_date) {
            $prefixdate = nowdate('', $this->prefix_date);
        }
        $suffix_date = "";
        if ($this->suffix_date) {
            $suffix_date = nowdate('', $this->suffix_date);
        }
        return $this->prefix . "" . $prefixdate . "" . $this->start_from . "" . $this->suffix . "" . $suffix_date;
    }
}
