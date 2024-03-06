<?php

namespace App\Models\MasterAdmin\Finance;

use App\Models\Record;

class ChequeBounceRecord extends Record
{
    protected $table = "finance_receipt_cheque_bounce_entry";
    protected $fillable = [
        'financial_id',
        'receipt_id',
        'student_id',
        'reason',
        'fee_head_id',
        'fee_amount',
        'attach_file',
        'user_id'
    ];
}
