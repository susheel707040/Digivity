<?php

namespace App\Models\MasterAdmin\Finance;

use Illuminate\Database\Eloquent\Model;

class StudentFeeCollectionInstalmentRecord extends Model
{
    public $timestamps = false;
    protected $table="finance_fee_collection_instalment_record";
    protected $fillable=[
        'fee_collection_id',
        'receipt_group_token_id',
        'student_id',
        'fee_collection_fee_head_id',
        'fee_structure_id',
        'fee_head_id',
        'custom_fee_id',
        'fee_head_priority',
        'instalment_id',
        'instalment_unique_id',
        'instalment_priority',
        'instalment_print_name',
        'instalment_amount',
        'instalment_concession',
        'instalment_fine',
        'instalment_total_amount',
        'instalment_paid',
        'instalment_bal',
        'paid_status',
        'user_id'
    ];

    public function feecollectionrecord()
    {
        return $this->belongsTo(StudentFeeCollection::class,'fee_collection_id','id')->select(array('id','receipt_date','receipt_status'))->where('receipt_status','paid')->orderBy('id','desc');
    }

}
