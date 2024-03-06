<?php

namespace App\Models\MasterAdmin\AcademicSetting;

use App\Models\Record;

class Parish extends Record
{
    protected $table="parishs";
    protected $fillable=[
        'school_id',
        'branches_id',
        'religion_id',
        'parish',
        'user_id',
        'user_id'
    ];

    /** relationship religion table
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function religions()
    {
        return $this->belongsTo(Religion::class,'religion_id','id');
    }

}
