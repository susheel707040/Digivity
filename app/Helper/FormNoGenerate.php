<?php


namespace App\Helper;


use App\Models\MasterAdmin\GlobalSetting\FormNoAuto;

class FormNoGenerate
{
    public static function generate($keyid)
    {
        $formno=FormNoAuto::query()->where('key_id',$keyid)->record()->first();
        if($formno) {
            return $formno;
        }
        return null;
    }
}
