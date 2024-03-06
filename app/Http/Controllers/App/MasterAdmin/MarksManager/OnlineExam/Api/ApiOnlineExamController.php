<?php

namespace App\Http\Controllers\MasterAdmin\MarksManager\OnlineExam\Api;

use App\Http\Controllers\Controller;
use App\Model\MasterAdmin\MarksManager\OnlineExam;
use App\Repositories\MasterAdmin\MarksManager\MarksManagerRepositories;
use Illuminate\Http\Request;

class ApiOnlineExamController extends Controller
{
    public function onlineexamlist($userid, $studentid)
    {
        $onlineexam = (new MarksManagerRepositories())->onlineexamlist();
        $onlineexam = $onlineexam->map(function ($data) {
            return
                [
                    'id' => $data->id,
                    'exam_name' => $data->exam_name,
                    'description' => '',
                    'exam_type' => $data->exam_type,
                    'start_date' => nowdate($data->start_date, 'd-M-Y'),
                    'end_date' => nowdate($data->end_date, 'd-M-Y'),
                    'duration' => $data->duration,
                    'subject' => $data->SubjectName(),
                    'course' => $data->CourseName(),
                    'marks' => $data->marks,
                    'pass_marks' => $data->pass_marks,
                    'exam_format' => $data->exam_format,
                    'status' => 'yes',
                    'submitted_by' => $data->user->fullName(),
                    'submitted_by_profile' => $data->user->ProfileImage()
                ];
        })->toArray();
        return response()->json([
            'result' => 1,
            'message' => 'data found',
            'success' => $onlineexam
        ], 200);
    }


    public function onlineexamstartindex($userid, $studentid, $onlineexamid)
    {
        $onlineexam = OnlineExam::find($onlineexamid);
        /*
         * Online Exam Question
         */
        $onlineexamquestion = (new MarksManagerRepositories())->onlineexamquestionlist(['exam_id' => $onlineexamid, 'is_active' => 0]);
        $onlineexamquestionlist = $onlineexamquestion->map(function ($data) {
            return
                [
                    'id' => $data->id,
                    'question' => $data->question,
                    'marks' => $data->marks,
                    'question_type' => $data->question_type,
                    'attachment' => '',
                    'submitted' => 0,
                ];
        });
        $onlineexamanswer = $onlineexamquestion->map(function ($data) {
            $result = [];
            if (isset($data->question_input) && ($data->question_input)) {
                $questioninput = unserialize($data->question_input);
                if (is_array($questioninput)) {

                    if ($data->question_type == "objective") {
                        foreach ($questioninput['option'] as $key => $value) {
                            $result[] = [
                                'q_id' => $data->id,
                                'key' => $questioninput['sl_no'][$key],
                                'option' => $value,
                                'tree_1'=>'',
                                'tree_2'=>'',
                                'words'=>'',
                                'filesupport'=>'0'
                            ];
                        }
                    } elseif ($data->question_type == "match_tree") {
                        foreach ($questioninput['mt_tree_1'] as $key => $value) {
                            $result[] = [
                                'q_id' => $data->id,
                                'key' => $questioninput['mt_sl_no'][$key],
                                'option'=>'',
                                'tree_1' => $value,
                                'tree_2' => $questioninput['mt_tree_2'][$key],
                                'words'=>'',
                                'filesupport'=>'0'
                            ];
                        }
                    }elseif ($data->question_type == "text_answer") {
                        foreach ($questioninput['ta_words'] as $key => $value) {
                            $result[] = [
                                'q_id' => $data->id,
                                'key'=>$key,
                                'option'=>'',
                                'tree_1' =>'',
                                'tree_2' =>'',
                                'words'=>$value,
                                'filesupport'=>'0'
                                ];
                        }
                    }elseif ($data->question_type == "text_answer_with_file") {
                        foreach ($questioninput['taf_words'] as $key => $value) {
                            $result[] = [
                                'q_id' => $data->id,
                                'key'=>$key,
                                'option'=>'',
                                'tree_1' =>'',
                                'tree_2' =>'',
                                'words'=>$value,
                                'filesupport'=>'1'
                            ];
                        }
                    }

                }
            }
            return $result;
        })->toArray();
        return response()->json([
            'result' => 1,
            'message' => 'data found',
            'success' => [
                [
                    'exam_name' => $onlineexam->exam_name,
                    'duration' => $onlineexam->duration,
                    'start_date_time' => '',
                    'questions' => $onlineexamquestionlist,
                    'answers' => call_user_func_array('array_merge', $onlineexamanswer)
                ]
            ]
        ], 200);
    }
}
