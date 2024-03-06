<?php


namespace App\Helper;


use Illuminate\Support\Facades\DB;

class DBGetLastId
{
    public static function getlastid($table)
    {
        $tableid=DB::table('finance_fee_collection_record')->latest()->first();
        if($tableid){
            return $tableid->id;
        }
        return 0;
    }
}
