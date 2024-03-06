<?php

namespace App\Http\Controllers\MasterAdmin\MarksManager\OnlineExam;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterAdmin\MarksManager\OnlineExam\OnlineExamSetting\OnlineExamQuestionCategoryRequest;
use App\Model\MasterAdmin\MarksManager\OnlineExamQuestionCategory;
use Illuminate\Http\Request;

class QuestionCategoryController extends Controller
{
    public function index($examid)
    {
        return view('erpmodule.MasterAdmin.MarksManager.OnlineExam.OnlineExamSetting.add-online-exam-question-category',compact(['examid']));
    }

    public function store(OnlineExamQuestionCategoryRequest $request)
    {
        if(isset($request->default)&&($request->default==1)){
            OnlineExamQuestionCategory::where(['exam_id'=>$request->exam_id])->update(['default'=>'0']);
        }
        OnlineExamQuestionCategory::create($request->all());
        return back()->with('success','Record Save Successfully Complete');
    }

    public function defaultset($examid,$questioncategoryid)
    {
       OnlineExamQuestionCategory::where(['exam_id'=>$examid])->update(['default'=>'0']);
       $onlineexamquestioncategory=OnlineExamQuestionCategory::find($questioncategoryid);
       if($onlineexamquestioncategory){
           $onlineexamquestioncategory->update(['default'=>'1']);
           return response()->json([
              'result'=>$examid,
              'message'=>'Default Set Successfully.'
           ]);
       }
        return response()->json([
            'result'=>0,
            'message'=>'Sorry, Request failed, Please try again.'
        ]);
    }

}
