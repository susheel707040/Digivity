<?php

namespace App\Helper;

class CommunicationBalance
{
    public static function Balance()
    {
        $nowdate = date('Y-m-d');
        return \App\Models\MasterAdmin\Communication\CommunicationBalance::query()
            ->where('start_date', '<=', $nowdate)
            ->where('end_date', '>=', $nowdate)
            ->first();
    }
}
