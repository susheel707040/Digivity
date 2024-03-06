<?php

namespace App\Http\Controllers\App\MasterAdmin\AcademicSetting;

use App\Http\Controllers\Controller;
use App\Models\MasterAdmin\AcademicSetting\SubjectMapWithCourse;
use App\Repositories\MasterAdmin\GlobalSetting\CommanDataRepository;
use Illuminate\Http\Request;

class SubjectMapWithCourseController extends Controller
{
    public function index()
    {
        $coursesection = (new CommanDataRepository())->coursesectionlist([]);
        $subject = (new CommanDataRepository())->subjectlist([]);
        $subjectwithcourse=(new CommanDataRepository())->subjectmapwithcourselist([]);
        return view('app.erpmodule.MasterAdmin.GlobalSetting.AcademicSetting.subject-map-with-course', compact(['coursesection', 'subject','subjectwithcourse']));
    }

    public function store(Request $request)
    {
        SubjectMapWithCourse::query()->record()->forceDelete();
        if ($request->has('course') && is_array($request->course)) {
        foreach ($request->course as $course) {
            $coursearr = explode("@", $course);
            $courseid = $coursearr[0];
            $sectionid = $coursearr[1];
            if (($courseid) && $sectionid) {
                if ($request["subject_" . $courseid . "_" . $sectionid . "_id"]) {
                    foreach ($request["subject_" . $courseid . "_" . $sectionid . "_id"] as $subjectid) {
                        if ($subjectid) {
                            $data = [
                                'course_id' => $courseid,
                                'section_id' => $sectionid,
                                'subject_id' => $subjectid
                            ];
                            SubjectMapWithCourse::create($data);
                        }
                    }
                }
            }
        }
    }
        return back()->with('success', 'Record Save Successful Complete');
    }

    public function remove()
    {
        SubjectMapWithCourse::query()->record()->forceDelete();
        return back()->with('success', 'Record Remove Successful Complete');
    }
}
