<?php


namespace App\Helper;


use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Request;

class UserActivityLogs
{
    public static function log($user=null,$status=null,$logs=null)
    {
        try {
            $logsdata=null;
            if(!$logs) {
                //get details logins ip,location,city,machine address
            }
            if(!isset($user)&&(!$user)){
                $user=Auth::user();
            }
            $user->activitylog()->create(['user_id'=>$user->id,'logs'=>$logsdata,'activity_status'=>$status,'created_at'=>Carbon::now()]);
        }catch (\Exception $e){}
    }
}
