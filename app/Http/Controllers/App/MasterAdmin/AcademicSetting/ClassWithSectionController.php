<?php

namespace App\Http\Controllers\App\MasterAdmin\AcademicSetting;

use App\Http\Controllers\Controller;
use App\Models\MasterAdmin\AcademicSetting\Course;
use App\Models\MasterAdmin\AcademicSetting\CourseWithSection;
use App\Models\MasterAdmin\AcademicSetting\Section;
use App\Repositories\MasterAdmin\Communication\CommunicationRepository;
use App\Repositories\MasterAdmin\GlobalSetting\CommanDataRepository;
use Illuminate\Http\Request;

class ClassWithSectionController extends Controller
{
    public function index()
    {
        $course = Course::query()->record()->orderBy('sequence')->get();
        $section = Section::query()->record()->get();
        $coursewithsection=CourseWithSection::query()->record()->get();

        $cwsarr=[];
        if($coursewithsection->count())
            foreach($coursewithsection as $coursewithsectionarr)
                $cwsarr[]=$coursewithsectionarr->course_id."@".$coursewithsectionarr->section_id;

        return view('app.erpmodule.MasterAdmin.GlobalSetting.AcademicSetting.map-class-with-section', compact(['course', 'section','cwsarr','coursewithsection']));
    }

    public function store(Request $request)
    {
        if(isset($request['course_id'])) {
            /**
             * previous record delete
             */
            CourseWithSection::query()->record()->forceDelete();
            foreach ($request['course_id'] as $class_id) {
                if (isset($request["section_" . $class_id . "_id"])) {
                    foreach ($request["section_" . $class_id . "_id"] as $section_id) {
                        try{
                        /**
                         * create custom request for entry
                         */

                        $classwithsection = [
                            'course_id' => $class_id,
                            'section_id' => $section_id
                        ];
                        CourseWithSection::create($classwithsection);
                    }
                    catch (\Exception $e) {
                    }
                }
            }
        }
    }
        return back()->with('success', 'Record Update Successful Complete');
    }

}
