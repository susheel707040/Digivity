<?php

namespace App\Models\MasterAdmin\Finance;

use App\Models\MasterAdmin\Finance\FeeSetting\FeeHead;
use App\Models\Record;

class StudentFeeCollectionFeeHeadRecord extends Record
{
    protected $table="finance_fee_collection_fee_head_record";
    protected $fillable=[
        'fee_collection_id',
        'fee_structure_id',
        'fee_head_id',
        'custom_fee_id',
        'priority',
        'sub_total',
        'concession_total',
        'fine_total',
        'total',
        'user_id'
    ];

    public function feehead()
    {
       return $this->belongsTo(FeeHead::class,'fee_head_id','id')->withTrashed();
    }
}
