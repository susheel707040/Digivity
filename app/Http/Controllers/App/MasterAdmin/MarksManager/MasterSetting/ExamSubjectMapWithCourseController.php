<?php

namespace App\Http\Controllers\App\MasterAdmin\MarksManager\MasterSetting;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterAdmin\MarksManager\ExamSubjectMapCourseRequest;
use App\Models\MasterAdmin\MarksManager\ExamSubjectMapWithCourse;
use App\Repositories\MasterAdmin\MarksManager\MarksManagerRepositories;
use Illuminate\Http\Request;

class ExamSubjectMapWithCourseController extends Controller
{
    public function index()
    {
        return view('app.erpmodule.MasterAdmin.MarksManager.MasterSetting.class-with-map-subject');
    }

    public function indexsearch($course)
    {
        $course=explode("@",$course);
        $courseid=$course[0]; $sectionid=$course[1];
        $subjectmapclass = (new MarksManagerRepositories())->examsubjectmapwithcourselist(['course_id'=>$courseid,'section_id'=>$sectionid]);
        return view('app.erpmodule.MasterAdmin.MarksManager.MasterSetting.class-with-map-subject', compact(['subjectmapclass','courseid','sectionid']));
    }

    public function importsubjecttablerow($rowid)
    {
        return view('app.erpmodule.MasterAdmin.MarksManager.MasterSetting.Config.subject-map-with-course-import-subject', compact(['rowid']));
    }

    public function importsubjectskilltablerow($subjectid, $rowid)
    {
        return view('app.erpmodule.MasterAdmin.MarksManager.MasterSetting.Config.subject-map-with-course-skill-table-row-import', compact(['subjectid', 'rowid']));
    }

    public function store(ExamSubjectMapCourseRequest $request)
    {
        $data = $request->validated();
        if (count($request->subject_id) > 0) {
            $entrycount=0;

            //delete old class map with subject record
            ExamSubjectMapWithCourse::query()->where(['course_id'=>$request->course_id,'section_id'=>$request->section_id])->record()->forceDelete();

            foreach ($request->subject_id as $key => $subject_id) {
                foreach ($request['position_'.$subject_id.'_id'] as $key1=>$skillposition) {
                    $datainsert = [
                        'course_id' => $request->course_id,
                        'section_id' => $request->section_id,
                        'position' => $request->position[$key] ? $request->position[$key] : 0,
                        'subject_id' => $subject_id,
                        'skill_group_id' => $request["skill_group_" . $subject_id . "_id"][$key1] ? $request["skill_group_" . $subject_id . "_id"][$key1] : null,
                        'skill_id' => $request["skill_" . $subject_id . "_id"][$key1] ? $request["skill_" . $subject_id . "_id"][$key1] : null,
                        'skill_position' => $skillposition,
                        'marking_type' => $request["marking_type_" . $subject_id . "_id"][$key1] ? $request["marking_type_" . $subject_id . "_id"][$key1] : null,
                        'subject_applicable' => $request["subject_applicable_" . $subject_id] ? $request["subject_applicable_" . $subject_id] : "0"
                    ];
                    $result=ExamSubjectMapWithCourse::create($datainsert);
                    if($result){
                        $entrycount++;
                    }
                }
            }

            if($entrycount>0){
                if($request->ajax()){
                 return response()->json([
                     'result'=>1,
                     'message'=>'Record save successful complete',
                     'status'=>'success'
                 ],200);
                }
            return back()->with('success','Record save successful complete');
            }

            if($request->ajax()){
                return response()->json([
                    'result'=>1,
                    'message'=>'Sorry, Request failed. Please try again',
                    'status'=>'danger'
                ],200);
            }
            return back()->with('danger','Sorry, Request failed. Please try again');
        }
    }
}
