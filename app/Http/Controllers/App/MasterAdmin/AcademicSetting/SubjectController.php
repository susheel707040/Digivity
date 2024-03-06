<?php

namespace App\Http\Controllers\App\MasterAdmin\AcademicSetting;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterAdmin\AcademicSetting\SubjectRequest;
use App\Models\MasterAdmin\AcademicSetting\Subject;
use App\Repositories\MasterAdmin\GlobalSetting\CommanDataRepository;
use App\Repositories\MasterAdmin\StudentInformation\StudentRepository;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index()
    {
        $subject=(new CommanDataRepository())->subjectlist([]);
        return view('app.erpmodule.MasterAdmin.GlobalSetting.AcademicSetting.define-subject',compact('subject'));
    }

    public function store(SubjectRequest $request)
    {
        Subject::create($request->validated());
        session(['keyid' => 'addModels', 'url' => 0]);
        return back()->with('success','Record Save Successful Complete');
    }

    public function editview(Subject $subject)
    {
        return view('app.erpmodule.MasterAdmin.GlobalSetting.AcademicSetting.Edit.edit-subject',compact('subject'));
    }

    public function modify(Subject $subject,SubjectRequest $request)
    {
        $subject->update($request->validated());
        session(['keyid' => 'editModels', 'url' => 'MasterAdmin/GlobalSetting/EditViewSubject/' . $subject->id . '/edit']);
        return back()->with('')->with('success','Record Update Successful Complete');
    }


    //Api Controller Function
    //master-admin and admin subject list api
    public function apisubjectlist($userid,$course)
    {
        $courselist=array();
        try {
            $search=[];
            if(isset($course)&&($course)) {
                $course = explode("@", $course);
                $search=array_merge($search,['course_id'=>$course[0],'section_id'=>$course[1]]);
            }
            $subject=(new CommanDataRepository())->subjectmapwithcourselist($search);
            foreach ($subject as $data){
                $courselist[]=['id'=>$data->subject_id,'subject'=>$data->subject->subject_name];
            }
        }catch (\Exception $e){}
        return response()->json([
            'result'=>1,
            'message'=>'data found',
            'success'=>$courselist
        ]);
    }
    //student subject list api
    public function apistudentsubjectlist($userid,$studentid)
    {
        $courselist=array();
        try {
            $student=(new StudentRepository())->studentshortlist(['student_id'=>$studentid])->first();
            $course_id=$student->course_id;
            $section_id=$student->section_id;
            $subject=(new CommanDataRepository())->subjectmapwithcourselist(['course_id'=>$course_id,'section_id'=>$section_id]);
            foreach ($subject as $data){
                $courselist[]=['id'=>$data->subject_id,'subject'=>$data->subject->subject_name];
            }
        }catch (\Exception $e){}
        return response()->json([
            'result'=>1,
            'message'=>'data found',
            'success'=>$courselist
        ]);
    }
}
