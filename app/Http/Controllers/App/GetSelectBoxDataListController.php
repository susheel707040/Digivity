<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\MasterAdmin\MarksManager\ExamType;
use App\Repositories\MasterAdmin\GlobalSetting\CommanDataRepository;
use App\Repositories\MasterAdmin\MarksManager\MarksManagerRepositories;
use Illuminate\Http\Request;

class GetSelectBoxDataListController extends Controller
{
    public function datalist($datawith,Request $request)
    {
        $data=[];
        if($datawith=="sectionlist"){
            $data=collect((new CommanDataRepository())->courseselectlist(['id'=>$request->course_id]))->map(function ($item){
               return $item->sections->pluck('section','id');
            });
            $data=$data[0];
        }
        /*
         * Examination Get List
         */
        if($datawith=="examtypelist"){
            if(($request->course_section_id)&&($request->exam_term_id)){
                $coursesection=explode("@",$request->course_section_id);
                $examtypeconfig=(new MarksManagerRepositories())->examconfigexamtypelist(['course_id'=>$coursesection[0],'section_id'=>$coursesection[1],'exam_term_id'=>$request->exam_term_id]);
                if($examtypeconfig) {
                    $data=$examtypeconfig->pluck('exam_type','id');
                }
            }
        }
        if($datawith=="examassessmentlist"){
            if(($request->course_section_id)&&($request->exam_term_id)&&($request->exam_type_id)){
                $coursesection=explode("@",$request->course_section_id);
                $examassessmentconfig=(new MarksManagerRepositories())->examassessmentconfig(['course_id'=>$coursesection[0],'section_id'=>$coursesection[1],'exam_term_id'=>$request->exam_term_id,'exam_type_id'=>$request->exam_type_id]);
                if($examassessmentconfig){
                    $data=$examassessmentconfig->pluck('exam_assessment','id');
                }
            }
        }
        if($datawith=="examsubjectlist"){
            if(($request->course_section_id)&&($request->exam_term_id)&&($request->exam_type_id)&&($request->exam_assessment_id)){
                $coursesection=explode("@",$request->course_section_id);
                $examtype=ExamType::find($request->exam_type_id);
                    $examsubjectconfig = (new MarksManagerRepositories())->examsubjectconfig(['course_id' => $coursesection[0], 'section_id' => $coursesection[1], 'exam_term_id' => $request->exam_term_id, 'exam_type_id' => $request->exam_type_id, 'exam_assessment_id' => $request->exam_assessment_id]);
                    if ($examsubjectconfig && (count($examsubjectconfig) > 0)) {
                        $data = $examsubjectconfig->pluck('subject_name','id');
                    }
            }
        }


        return response()->json($data);
    }
}
