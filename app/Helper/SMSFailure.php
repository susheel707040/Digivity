<?php


namespace App\Helper;


use App\Models\MasterAdmin\GlobalSetting\SchoolBranch;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

class SMSFailure
{
    public static function smsfailreport($communicationtokenid,$reportname)
    {
        $school=SchoolBranch::query()->first();

        $body=['communication_id'=>$communicationtokenid,'report_name'=>$reportname,'url'=>url('Web/CommunicationFailure'),'school_name'=>$school->school_name];

        $client = new Client();
        $url="https://digishikshaapp.digishiksha.in/api/SMSFailure";
        $promise = $client->postAsync($url, [
            'json' => $body,
        ]);
         $promise->wait(true);
    }

    //ExceptionHandlerEmail
    public static function ExceptionHandlerEmail($html)
    {
        $school=SchoolBranch::query()->first();
        if(isset($school)&&($school)) {
            $body = ['school_name' => $school->school_name, 'message' => $html];

            $client = new Client();
            $url = "https://digishikshaapp.digishiksha.in/api/SendMailNotification/digishikshaerror";
            $promise = $client->postAsync($url, [
                'json' => $body,
            ]);
            $promise->wait(true);
        }
    }
}
