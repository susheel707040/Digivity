<?php

namespace App\Http\Controllers\App\MasterAdmin\Admission\Reports;

use App\Http\Controllers\Controller;
use App\Repositories\MasterAdmin\GlobalSetting\CommanDataRepository;
use Illuminate\Http\Request;

class StudentStrengthController extends Controller
{
    public function classwisestrength(Request $request)
    {
        $course=(new CommanDataRepository())->courseselectlist();
        $section=(new CommanDataRepository())->sectionlist();
        return view('app.erpmodule.MasterAdmin.StudentInformation.Reports.class-wise-strength-report',compact(['course','section']));
    }

    public function genderwisestrength(Request $request)
    {
        $course=(new CommanDataRepository())->courseselectlist();
        $section=(new CommanDataRepository())->sectionlist();
        $gender=['male'=>'Male','female'=>'Female'];
        return view('app.erpmodule.MasterAdmin.StudentInformation.Reports.gender-wise-strength-report',compact(['course','section','gender']));
    }
}
