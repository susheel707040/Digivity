<?php

namespace App\Http\Controllers\MobileApp\MasterAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SMSController extends Controller
{
    public function index()
    {
        $designation = [];
        $course = [];
        $phonegroup = [];
        $usercopy=[];
        foreach (satffdesignationlist([]) as $data) {
            $designation[] = ['id' => $data->id, 'value' => $data->designation];
        }
        foreach (coursesectionlist([]) as $data) {
            foreach ($data->sections as $data1) {
                $course[] = ['id' => $data->id."@".$data1->id, 'value' => $data->course . " - " . $data1->section];
            }
        }
        foreach (phonebookgrouplist() as $data){
            $phonegroup[]=['id'=>$data->id,'value'=>$data->phonebook_group];
        }
        $usercopy[]=['id' => 'usercopy', 'Duplicate SMS Copy For Administration'];
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
}
