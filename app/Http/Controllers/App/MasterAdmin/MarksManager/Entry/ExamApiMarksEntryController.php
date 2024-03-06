<?php

namespace App\Http\Controllers\MasterAdmin\MarksManager\Entry;

use App\Http\Controllers\Controller;
use App\Repositories\MasterAdmin\GlobalSetting\CommanDataRepository;
use App\Repositories\MasterAdmin\MarksManager\MarksManagerRepositories;
use App\Repositories\MasterAdmin\StudentInformation\StudentRepository;
use Illuminate\Http\Request;

class ExamApiMarksEntryController extends Controller
{
    public function apiindex(Request $request)
    {
        $coursedata = (new CommanDataRepository())->courseselectlist();
        $courselist = [];
        foreach ($coursedata as $data) {
            foreach ($data->sections as $data1) {
                $courselist[] = ['key' => $data->id . "@" . $data1->id, 'value' => $data->course . " - " . $data1->section];
            }
        }
        $examterm = (new MarksManagerRepositories())->examtermlist()->map(function ($item) {
            return ['key' => $item->id, 'value' => $item->exam_term];
        });

        return response()->json([
            'result' => 1,
            'message' => 'data found',
            'success' => [
                [
                    'classlist' => $courselist,
                    'examtermlist' => $examterm
                ]
            ]
        ], 200);
    }


    public function apiindexsearch(Request $request)
    {
        $data=[];
        if($request->getdata=="examtypelist"){
            if(($request->course_section_id)&&($request->exam_term_id)){
                $coursesection=explode("@",$request->course_section_id);
                $examtypeconfig=(new MarksManagerRepositories())->examconfigexamtypelist(['course_id'=>$coursesection[0],'section_id'=>$coursesection[1],'exam_term_id'=>$request->exam_term_id]);
                if($examtypeconfig) {
                    $data['examtypelist']=$examtypeconfig->map(function ($item){ return ['key'=>$item->id,'value'=>$item->exam_type];})->toArray();
                }
            }
        }
        if($request->getdata=="examassessmentlist"){
            if(($request->course_section_id)&&($request->exam_term_id)&&($request->exam_type_id)){
                $coursesection=explode("@",$request->course_section_id);
                $examassessmentconfig=(new MarksManagerRepositories())->examassessmentconfig(['course_id'=>$coursesection[0],'section_id'=>$coursesection[1],'exam_term_id'=>$request->exam_term_id,'exam_type_id'=>$request->exam_type_id]);
                if($examassessmentconfig){
                    $data['examassessmentlist']=$examassessmentconfig->map(function ($item){ return ['key'=>$item->id,'value'=>$item->exam_assessment];})->toArray();
                }
            }
        }
        if($request->getdata=="examsubjectlist"){
            if(($request->course_section_id)&&($request->exam_term_id)&&($request->exam_type_id)&&($request->exam_assessment_id)){
                $coursesection=explode("@",$request->course_section_id);
                $examsubjectconfig=(new MarksManagerRepositories())->examsubjectconfig(['course_id'=>$coursesection[0],'section_id'=>$coursesection[1],'exam_term_id'=>$request->exam_term_id,'exam_type_id'=>$request->exam_type_id,'exam_assessment_id'=>$request->exam_assessment_id]);
                if($examsubjectconfig&&(count($examsubjectconfig)>0)){
                    $data['examsubjectlist']=$examsubjectconfig->map(function ($item){ return ['key'=>$item->id,'value'=>$item->subject_name];})->toArray();
                }
            }
        }

        if($request->getdata=="examsubjectskilllist"){
            $data['examsubjectskilllist']=[];
        }

        return response()->json([
            'result'=>1,
            'message'=>'data found',
            'success'=>[
                $data
            ]
        ],200);
    }

    public function apistudentlistmarksentry(Request $request)
    {
        if (isset($request->course_section_id)) {

            $course=explode("@",$request->course_section_id);
            $student = (new StudentRepository())->studentshortlist(['course_id'=>$course[0],'section_id'=>$course[1]])->map(function ($data) use($request){
                try {
                    $examresult=(new MarksManagerRepositories())->examstudentmarksrecord(['course_id'=>$data->course_id,'section_id'=>$data->section_id,'student_id'=>$data->student_id,'exam_term_id'=>$request->exam_term_id,'exam_type_id'=>$request->exam_type_id,'exam_assessment_id'=>$request->exam_assessment_id,'subject_id'=>$request->subject_id])->first();
                }catch (\Exception $e){}
                 return [
                    'db_id' => $data->id,
                    'student_id' => $data->student_id,
                    'admission_no' => $data->admission_no,
                    'roll_no' => $data->roll_no,
                    'student_name' => $data->fullName(),
                    'gender' => $data->student->gender ? $data->student->gender : "male",
                    'father_name' => $data->FatherName(),
                    'contact_no' => $data->student->contact_no,
                    'mother_name' => $data->student->mother_name,
                    'profile_img' => $data->ProfileImage(),
                    'marks' => $examresult ? $examresult->marks : "",
                    'attend_status' => $examresult ? $examresult->attend_status : "p",
                    'marking_type' => $examresult ? $examresult->marking_type : "m"
                ];
            });
            $grade[] = ['key' => 'A', 'value' => 'A'];
            $grade[] = ['key' => 'B', 'value' => 'B'];
            $grade[] = ['key' => 'C', 'value' => 'C'];
            $grade[] = ['key' => 'D', 'value' => 'D'];
            $attend_status = [['key' => 'p', 'value' => 'P'], ['key' => 'ab', 'value' => 'AB'], ['key' => 'lv', 'value' => 'LV'], ['key' => 'ml', 'value' => 'ML']];
            return response()->json([
                'result' => 1,
                'message' => 'data found',
                'success' => [
                    [
                        'studentlist' => $student,
                        'gradelist' => $grade,
                        'attend_status' => $attend_status
                    ]
                ]
            ], 200);
        }
        return response()->json([
            'result'=>0,
            'success'=>[]
        ],200);
    }
}
