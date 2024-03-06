<?php

namespace App\Models\MasterAdmin\Finance;

use App\Models\Record;

class ReceiptModifyRecord extends Record
{
    protected $table = "finance_receipt_modify_record";
    protected $fillable = [
        'id',
        'receipt_id',
        'modify_date',
        'old_receipt_record',
        'receipt_update_record',
        'modify_reason',
        'user_id'
    ];
}
