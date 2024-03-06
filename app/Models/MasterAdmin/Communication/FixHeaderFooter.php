<?php

namespace App\Models\MasterAdmin\Communication;

use App\Models\Record;

class FixHeaderFooter extends Record
{
    protected $table="communication_fix_header_footer";
    protected $fillable=[
        'school_id',
        'branches_id',
        'title',
        'header_text',
        'footer_text',
        'unicode',
        'default_at',
        'user_id'
    ];
}
