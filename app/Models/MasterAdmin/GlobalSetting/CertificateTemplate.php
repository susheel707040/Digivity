<?php

namespace App\Models\MasterAdmin\GlobalSetting;

use App\Models\Record;

class CertificateTemplate extends Record
{
    protected $table="certificate_template";
    protected $fillable=[
        'id',
        'school_id',
        'branches_id',
        'academic_id',
        'certificate_id',
        'certificate_title',
        'certificate_title_slug',
        'template',
        'editable',
        'default_at',
        'status',
        'user_id'
    ];

    public function certificate()
    {
        return $this->belongsTo(Certificate::class,'certificate_id','id');
    }

}
