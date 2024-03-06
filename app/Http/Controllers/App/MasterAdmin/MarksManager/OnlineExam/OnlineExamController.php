<?php

namespace App\Http\Controllers\App\MasterAdmin\MarksManager\OnlineExam;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterAdmin\MarksManager\OnlineExam\OnlineExamSetting\OnlineExamRequest;
use App\Models\MasterAdmin\MarksManager\OnlineExam;
use App\Repositories\MasterAdmin\MarksManager\MarksManagerRepositories;
use Illuminate\Http\Request;

class OnlineExamController extends Controller
{
    public function index()
    {
        $onlineexam=(new MarksManagerRepositories())->onlineexamlist();
        return view('app.erpmodule.MasterAdmin.MarksManager.OnlineExam.OnlineExamSetting.define-online-exam',compact(['onlineexam']));
    }

    public function store(OnlineExamRequest $request)
    {
        try {
            $data=$request->validated();
            if(isset($request->start_date)) {
                $data = array_merge($data, ['start_date' => nowdate($request->start_date, 'Y-m-d')]);
            }
            if(isset($request->end_date)){
                $data=array_merge($data,['end_date'=>nowdate($request->end_date,'Y-m-d')]);
            }
            session(['keyid' => 'addModels','url'=>'0']);
            $onlineexam=OnlineExam::create($data);
            if($onlineexam){
                return back()->with('success','Record save Successful Complete.');
            }
            return back()->with('danger','Sorry, Request failed, Please try again.');
        }catch (\Exception $e){

        }
    }

    public function editview(OnlineExam $onlineexam)
    {
        return view('app.erpmodule.MasterAdmin.MarksManager.OnlineExam.OnlineExamSetting.Edit.edit-online-exam',compact(['onlineexam']));
    }

    public function modify(OnlineExam $onlineexam,OnlineExamRequest $request)
    {
        try {
            $data=$request->validated();
            if(isset($request->start_date)) {
                $data = array_merge($data, ['start_date' => nowdate($request->start_date, 'Y-m-d')]);
            }
            if(isset($request->end_date)){
                $data=array_merge($data,['end_date'=>nowdate($request->end_date,'Y-m-d')]);
            }
            $onlineexam->update($data);
            if($onlineexam){
                return back()->with('success','Record Update Successful Complete.');
            }
            return back()->with('danger','Sorry, Request failed, Please try again.');
        }catch (\Exception $e){

        }
    }


}
