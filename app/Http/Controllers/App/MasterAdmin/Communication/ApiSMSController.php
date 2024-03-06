<?php

namespace App\Http\Controllers\MasterAdmin\Communication;

use App\Helper\CommunicationBalance;
use App\Helper\GetContactNumber;
use App\Http\Controllers\Controller;
use App\Repositories\MasterAdmin\Communication\CommunicationRepository;
use App\Repositories\MasterAdmin\GlobalSetting\CommanDataRepository;
use App\Repositories\MasterAdmin\Staff\StaffRepositories;
use Illuminate\Http\Request;

class ApiSMSController extends Controller
{
    public function apiindex($userid)
    {
        $designation = []; $course = []; $phonegroup = []; $usercopy=[];
        try {
            /*
             * Staff Designation List
             */
            $staffdesignation=(new StaffRepositories())->satffdesignationlist([]);
            foreach ($staffdesignation as $data) {
                $designation[] = ['id' => $data->id, 'value' => $data->designation];
            }
            /*
             * Course and Section List
             */
            $courselist=(new CommanDataRepository())->coursesectionlist([]);
            foreach ($courselist as $data) {
                foreach ($data->sections as $data1) {
                    $course[] = ['id' => $data->id."@".$data1->id, 'value' => $data->course . " - " . $data1->section];
                }
            }
            /*
             * Phone Book Group
             */
            $phonebook=(new CommunicationRepository())->phonebookgrouplist();
            foreach ($phonebook as $data){
                $phonegroup[]=['id'=>$data->id,'value'=>$data->phonebook_group];
            }
            /*
             * User Duplicate SMS Copy
             */
            $usercopy=(new CommunicationRepository())->usersmscopylist(['status'=>'active'])->map(function ($data){
                return [
                    'id'=>$data->id,
                    'role'=>$data->designation,
                    'name'=>$data->name,
                    'contact_no'=>$data->mobile_no
                ];
            });
        }catch (\Exception $e){}

        return response()->json([
            'result' => 1,
            'success' => [
                [
                    'course' => $course,
                    'designation' => $designation,
                    'phonegroup' => $phonegroup,
                    'usercopy' =>$usercopy
                ]
            ]
        ],200);
    }

    public function apiindexpreview($userid,Request $request)
    {
        $receiver=0; $receiver_info="";  $commtypelist=array();
        $headertext=""; $footertext=""; $unicode="";
        $headerfooterlist=array(); $templatelist=array();
        $balance=0;
        try {
            /*
             * Communication Type List
             */
            $commtype=(new CommunicationRepository())->comunicationtypelist();
            foreach ($commtype as $data){
             $commtypelist[]=['id'=>$data->id,'value'=>$data->communication_type,'default_at'=>$data->default_at];
            }
            /*
             * Header and Footer
             */
            $headerfooter=(new CommunicationRepository())->fixheaderfooterlist();
            $headerfooterdefault=$headerfooter->where('default_at','yes')->first();
            $headertext=$headerfooterdefault->header_text;
            $footertext=$headerfooterdefault->footer_text;
            $unicode=$headerfooterdefault->unicode;
            /*
             * Header and Footer Array List
             */
            foreach ($headerfooter as $data){
                $headerfooterlist[]=['id'=>$data->id,'header_text'=>$data->header_text,'footer_text'=>$data->footer_text,'unicode'=>$data->unicode];
            }
            /*
             * Template List
             */
            $template=(new CommunicationRepository())->smstemplatelist()->where('sms_type','');
            foreach ($template as $data){
                $templatelist[]=['id'=>$data->id,'template_name'=>$data->template_name,'unicode'=>$data->unicode,'template'=>$data->template];
            }

            //total receiver count
            if(isset($request->studentORStaff)&&($request->studentORStaff)){
                $search=[];
                if($request->studentORStaff=="student"&&(isset($request->receiverids)&&($request->receiverids))){
                    $search=array_merge($search,['coursesectionid'=>explode(",",$request->receiverids)]);
                }
                if(isset($request->duplicate)&&($request->duplicate=="yes")){
                    $search=array_merge($search,['usercopyid'=>'1']);
                }

                $receiver_info=(new CommanDataRepository())->courseandsectionname(['coursesectionid'=>explode(",",$request->receiverids)]);

                $getcontact=GetContactNumber::getcontactnumber($search);
                if(isset($getcontact['contactno'])&&(count($getcontact['contactno'])>0)){$receiver=count($getcontact['contactno']);}
            }

            /*
             * Communication Balance
             */
            $communication=CommunicationBalance::Balance();
            if(isset($communication)&&($communication)){$balance=$communication->text_balance;}

        }catch (\Exception $e){}

        return response()->json([
           'result'=>1,
           'message'=>'data found',
           'success'=>[
               [
               'comm_type'=>$commtypelist,
               'header_text'=>$headertext,
               'footer_text'=>$footertext,
               'unicode'=>$unicode,
               'headerlist'=>$headerfooterlist,
               'templatelist'=>$templatelist,
               'receiver'=>$receiver,
               'receiver_info'=>'NUR(A,B,C)-1ST(A,B)-2ND(A,B,C)',
               'balance'=>$balance
               ]
           ]
        ]);
    }


}
