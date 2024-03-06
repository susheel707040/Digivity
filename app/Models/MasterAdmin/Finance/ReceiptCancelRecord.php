<?php

namespace App\Models\MasterAdmin\Finance;

use App\Models\Record;

class ReceiptCancelRecord extends Record
{
    protected $table="finance_receipt_cancel_record";
    protected $fillable=[
        'id',
        'receipt_id',
        'cancel_date',
        'reason',
        'receipt_status',
        'user_id'
    ];
}
