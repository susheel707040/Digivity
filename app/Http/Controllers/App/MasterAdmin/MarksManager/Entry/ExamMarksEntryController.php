<?php

namespace App\Http\Controllers\App\MasterAdmin\MarksManager\Entry;

use App\Http\Controllers\Controller;
use App\Models\MasterAdmin\MarksManager\ExamMarksRecord;
use App\Repositories\MasterAdmin\GlobalSetting\CommanDataRepository;
use App\Repositories\MasterAdmin\MarksManager\MarksManagerRepositories;
use App\Repositories\MasterAdmin\StudentInformation\StudentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExamMarksEntryController extends Controller
{
    public function subjectmarksentryindex(Request $request)
    {
        $examtypesearch = [0];
        $examassessmentsearch = [0];
        $examsubjectsearch = [0];
        $student = [];
        $subject= [];
        $coursedata = [];
        $sectiondata =[];
        $examterm =[];
        $examtype =[];
        $examassessment =[];
        $exammarksrecord =[];

        if ($request->all() && (is_array($request->all())) && (count($request->all()) > 0)) {
            $course = explode('@', $request->course_section_id);

            $subjectarr = explode(",", $request->subject_id);
            $student = (new StudentRepository())->studentshortlist(['course_id' => $course[0], 'section_id' => $course[1]]);
            $subject = (new MarksManagerRepositories())->examcoursemaponlysubjectlist(['customsearch' => ['whereIn' => ['subject_id' => $subjectarr]]]);

            $examtypeconfig = (new MarksManagerRepositories())->examconfigexamtypelist(['course_id' => $course[0], 'section_id' => $course[1], 'exam_term_id' => $request->exam_term_id]);
            if ($examtypeconfig) {
                $examtypesearch = $examtypeconfig->pluck('id')->toArray();
            }

            $examassessmentconfig = (new MarksManagerRepositories())->examassessmentconfig(['course_id' => $course[0], 'section_id' => $course[1], 'exam_term_id' => $request->exam_term_id, 'exam_type_id' => $request->exam_type_id]);
            if ($examassessmentconfig) {
                $examassessmentsearch = $examassessmentconfig->pluck('id')->toArray();
            }

            $examsubjectconfig = (new MarksManagerRepositories())->examsubjectconfig(['course_id' => $course[0], 'section_id' => $course[1], 'exam_term_id' => $request->exam_term_id, 'exam_type_id' => $request->exam_type_id, 'exam_assessment_id' => $request->exam_assessment_id]);
            if ($examsubjectconfig) {
                $examsubjectsearch = $examsubjectconfig->pluck('id')->toArray();
            }

            //get model
            $coursedata = (new CommanDataRepository())->courseselectlist(['id' => $course[0]])->first();
            $sectiondata = (new CommanDataRepository())->sectiongetlist(['id' => $course[1]])->first();
            $examterm = (new MarksManagerRepositories())->examtermlist(['id' => $request->exam_term_id])->first();
            $examtype = (new MarksManagerRepositories())->examtypelist(['id' => $request->exam_type_id])->first();
            $examassessment = (new MarksManagerRepositories())->examassessmentlist(['id' => $request->exam_assessment_id])->first();

            //entry record exist
            $exammarksrecord=ExamMarksRecord::query()->where(['course_id'=>$course[0],'section_id'=>$course[1],'exam_term_id'=>$request->exam_term_id,'exam_type_id'=>$request->exam_type_id,'exam_assessment_id'=>$request->exam_assessment_id])->record()->get();
        }
        return view('app.erpmodule.MasterAdmin.MarksManager.Entry.exam-subject-wise-marks-entry', compact(['student', 'subject', 'examtypesearch', 'examassessmentsearch', 'examsubjectsearch', 'coursedata', 'sectiondata', 'examterm', 'examtype', 'examassessment','exammarksrecord']));
    }
    /*
     * Store Exam Marks Entry
     */
    public function subjectmarkentry(Request $request)
    {
        //student validate is available
        if (isset($request->student_id) && (count($request->student_id) > 0)) {
            //subject validate is availabel
            if (isset($request->subject_id) && (count($request->subject_id) > 0)) {
                $entrycount = 0;

                //multiple student
                foreach ($request->student_id as $studentid) {

                    //multiple subject
                    foreach ($request->subject_id as $subjectid) {
                        $groupid=$studentid."_".$subjectid;

                        //if old record available then delete first
                        ExamMarksRecord::query()->where(['course_id'=>$request->course_id,'section_id'=>$request->section_id,'student_id'=>$studentid,'exam_term_id'=>$request->exam_term_id,'exam_type_id'=>$request->exam_type_id,'exam_assessment_id'=>$request->exam_assessment_id,'subject_id'=>$subjectid])->record()->forceDelete();

                        $datainsert = [
                          'course_id' =>$request->course_id,
                          'section_id' =>$request->section_id,
                          'student_id' =>$studentid,
                          'exam_term_id' =>$request->exam_term_id,
                          'exam_type_id' =>$request->exam_type_id,
                          'integrate' =>'subject',
                          'exam_assessment_id' =>$request->exam_assessment_id,
                          'subject_id' =>$subjectid,
                          'skill_id' =>null,
                          'remark' =>'',
                          'marks' =>$request["mark_".$groupid] ? $request["mark_".$groupid] : 0,
                          'marking_type' =>'m',
                          'attend_status' =>$request["exam_attend_".$groupid] ? $request["exam_attend_".$groupid] : null,
                      ];
                     $examrecordentry=ExamMarksRecord::create($datainsert);
                     if($examrecordentry){
                         $entrycount++;
                     }
                    }
                }

                if($entrycount>0){
                    return back()->with('success', 'Student marks record save successfully.');
                }
                return back()->with('danger', 'sorry, do not permission to create this record.');
            }
            return back()->with('danger', 'Please select atleast one subject/activities.');
        }
        return back()->with('danger', 'Please select atleast one student.');
    }

    /*
     * Mobile App Exam Marks Entry
     */
    public function apimarkentry($userid,Request $request)
    {
        $entrycount=0;
       // DB::table('testapi')->insert(['data'=>serialize($request->all())]);
        if(isset($request->course_section_id)){
            $course=explode("@",$request->course_section_id);
            if(isset($request['updatedatalist'])){
                foreach ($request['updatedatalist'] as $entrydata){

                    //if old record available then delete first
                    ExamMarksRecord::query()->where(['course_id'=>$course[0],'section_id'=>$course[1],'student_id'=>$entrydata['student_id'],'exam_term_id'=>$request->exam_term_id,'exam_type_id'=>$request->exam_type_id,'exam_assessment_id'=>$request->exam_assessment_id,'subject_id'=>$request->subject_id])->record()->forceDelete();
                    $datainsert = [
                        'course_id' =>$course[0],
                        'section_id' =>$course[1],
                        'student_id' =>$entrydata['student_id'],
                        'exam_term_id' =>$request->exam_term_id,
                        'exam_type_id' =>$request->exam_type_id,
                        'integrate' =>'subject',
                        'exam_assessment_id' =>$request->exam_assessment_id,
                        'subject_id' =>$request->subject_id,
                        'skill_id' =>null,
                        'remark' =>'',
                        'marks' =>$entrydata['marks'] ? $entrydata['marks'] : 0,
                        'marking_type' =>$entrydata['marking_type'],
                        'attend_status' =>$entrydata['attendance_status'] ? $entrydata['attendance_status'] : null,
                    ];
                    $examrecordentry=ExamMarksRecord::create($datainsert);
                    if($examrecordentry){
                        $entrycount++;
                    }
                }
            }
        }
        if($entrycount>0) {
            return response()->json(1,200);
        }else{
            return response()->json(0,200);
        }
    }

    public function studentmarksentryindex()
    {
        return view('app.erpmodule.MasterAdmin.MarksManager.Entry.student-exam-subject-marks-entry');
    }
}
