<?php

namespace App\Http\Controllers\App\MasterAdmin\AcademicSetting;

use App\Http\Requests\MasterAdmin\AcademicSetting\CourseRequest;
use App\Models\MasterAdmin\AcademicSetting\Course;
use App\Models\MasterAdmin\AcademicSetting\Wing;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CourseController extends Controller
{
    public function index()
    {
        $course = Course::query()->orderBy('sequence','ASC')->with('wing')->record()->get();
        $wing = Wing::query()->record()->get();
        return view('app.erpmodule.MasterAdmin.GlobalSetting.AcademicSetting.define-class', compact(['course', 'wing']));
    }

    public function store(CourseRequest $request)
    {
        Course::create($request->validated());
        session(['keyid' => 'addModels', 'url' => 0]);
        return back()->with('success', 'Record Save Successful Complete');
    }

    public function editview(Course $course)
    {
        $wing = Wing::query()->record()->get();
        return view('erpmodule.MasterAdmin.GlobalSetting.AcademicSetting.Edit.edit-course', compact(['course', 'wing']));
    }

    public function modify(Course $course, CourseRequest $request)
    {
        $course->update($request->validated());
        session(['keyid' => 'editModels', 'url' => 'MasterAdmin/GlobalSetting/EditViewClass/' . $course->id . '/edit']);
        return back()->with('success', 'Record Update Successfully Complete');
    }


}
