<?php

namespace App\Http\Controllers\App\MasterAdmin\MarksManager\OnlineExam;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterAdmin\MarksManager\OnlineExam\OnlineExamSetting\OnlineExamQuestionRequest;
use App\Models\MasterAdmin\MarksManager\OnlineExam;
use App\Models\MasterAdmin\MarksManager\OnlineExamQuestion;
use App\Repositories\MasterAdmin\MarksManager\MarksManagerRepositories;
use Illuminate\Http\Request;

class SetOnlineExamQuestionController extends Controller
{
    public function index()
    {
        $onlineexam=(new MarksManagerRepositories())->onlineexamlist();
        return view('app.erpmodule.MasterAdmin.MarksManager.OnlineExam.OnlineExamSetting.set-online-exam-question',compact(['onlineexam']));
    }

    public function addqoutationindex(OnlineExam $onlineexam,$courseid,$sectionid)
    {
        return view('app.erpmodule.MasterAdmin.MarksManager.OnlineExam.OnlineExamSetting.add-online-exam-question-paper',compact(['onlineexam','courseid','sectionid']));
    }

    public function storeonlineexam(OnlineExamQuestionRequest $request)
    {
        $data=$request->all();

        if($request->question_type=="objective"){
            $requestinput=$request->only(['sl_no','sequence','option','correct_answer']);
        }elseif($request->question_type=="match_tree"){
            $requestinput=$request->only(['mt_sl_no','mt_tree_1','mt_tree_2']);
        }elseif($request->question_type=="text_answer"){
            $requestinput=$request->only(['ta_words']);
        }elseif($request->question_type=="text_answer_with_file"){
            $requestinput=$request->only(['taf_words','taf_file']);
        }

        $data=array_merge($data,['question_input'=>serialize($requestinput)]);
        OnlineExamQuestion::create($data);
        return back()->with('success','Question Save Successful Complete');
    }

    public function viewquestionpaper($examid,$courseid)
    {
        $question=(new MarksManagerRepositories())->onlineexamquestionlist(['exam_id'=>$examid,'course_id'=>$courseid]);
        return view('app.erpmodule.MasterAdmin.MarksManager.OnlineExam.view-online-exam-question-paper',compact(['question']));
    }

}
