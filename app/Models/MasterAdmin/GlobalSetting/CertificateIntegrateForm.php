<?php

namespace App\Models\MasterAdmin\GlobalSetting;

use App\Models\Record;

class CertificateIntegrateForm extends Record
{
    protected $table = "certificate_integrate_form_fields";
    protected $fillable = [
        'id',
        'school_id',
        'branches_id',
        'academic_id',
        'certificate_id',
        'certificate_for',
        'input',
        'user_id'
    ];
}
