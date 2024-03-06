<?php


namespace App\Helper;

class MobileAppModule
{
    public static function mobileappusermodule()
    {
        $modulearr = array();
        if (isset(auth()->user()->modules->mobile_app_module)) {
            $module = collect(unserialize(auth()->user()->modules->mobile_app_module))->sortBy('module_sequence')->toArray();

            foreach ($module as $key=>$value){
                $nevalue=array();
               foreach ($value as $newvalue){
                   $newvalue['category']=$key;
                   $nevalue[]=$newvalue;
               }
                $modulearr[$key]=$nevalue;
            }

        }
        return $modulearr;
    }
}
