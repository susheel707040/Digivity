<?php

namespace App\Http\Controllers\MobileApp\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\View\GlobalComposer;

class AddStaffController extends Controller
{
    public function index()
    {
        $professiontype = [];
        $stafftype = [];
        $department = [];
        $designation = [];
        $maritalstatusarr = [];
        $titlelist=[];
        foreach (professtiontypelist([]) as $data){
            $professiontype[]=['id'=>$data->id,'value'=>$data->profession_type];
        }
        foreach (stafftypelist([]) as $data){
            $stafftype[]=['id'=>$data->id,'value'=>$data->staff_type];
        }
        foreach (staffdepartmentlist([]) as $data){
            $department[]=['id'=>$data->id,'value'=>$data->department];
        }
        foreach (satffdesignationlist([]) as $data){
            $designation[]=['id'=>$data->id,'value'=>$data->designation];
        }
        foreach (maritalstatus() as $data){
            $maritalstatusarr[]=['id'=>$data,'value'=>ucfirst($data)];
        }
        $title_name = array('mr.', 'ms.', 'mrs.', 'miss.', 'dr.', 'fr.', 'sr.');
        foreach ($title_name as $value){
            $titlelist[]=['id'=>$value,'value'=>$value];
        }

        return response()->json([
            'result' => 1,
            'success' => [
                [
                    'professiontype' => $professiontype,
                    'stafftype' => $stafftype,
                    'department' => $department,
                    'designation' => $designation,
                    'maritalstatus' => $maritalstatusarr,
                    'title'=>$titlelist
                ]
            ]
        ]);
    }
}
