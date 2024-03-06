<?php

namespace App\Http\Controllers\App\MasterAdmin\Transport\Report;

use App\Http\Controllers\Controller;
use App\Repositories\MasterAdmin\GlobalSetting\CommanDataRepository;
use App\Repositories\MasterAdmin\StudentInformation\StudentRepository;
use App\Repositories\MasterAdmin\Transport\TransportRepository;
use Illuminate\Http\Request;

class TransportReportController extends Controller
{
    public function studenttransportreport(Request $request)
    {
        $student=(new StudentRepository())->studentshortlist($request->all(),['transport']);
        return view('app.erpmodule.MasterAdmin.transport.Reports.student-transport-report',compact(['student']));
    }

    public function studentselftransportreport(Request $request)
    {
        $student=(new StudentRepository())->studentshortlist(['customsearch'=>['where'=>$request->only(['course_id','section_id','is_new']),'wherelike'=>$request->only('residence_address')]],['student']);
        return view('app.erpmodule.MasterAdmin.transport.Reports.student-self-transport-report',compact(['student']));
    }

    public function rousewisemisreport(Request $request)
    {
        $route=(new TransportRepository())->routelist();
        $course=(new CommanDataRepository())->courseselectlist([]);
        return view('app.erpmodule.MasterAdmin.transport.Reports.route-wise-transport-mis-report',compact(['route','course']));
    }

    public function routestopwisemisreport(Request $request)
    {
        $route=(new TransportRepository())->routelist();
        $routestop=(new TransportRepository())->routestoplist();
        return view('app.erpmodule.MasterAdmin.transport.Reports.route-stop-transport-mis-report',compact(['route','routestop']));
    }

    public function classwisetransportmisreport(Request $request)
    {
        $course=(new CommanDataRepository())->courseselectlist([]);
        $section=(new CommanDataRepository())->sectionlist([]);
        return view('app.erpmodule.MasterAdmin.transport.Reports.class-wise-transport-mis-report',compact(['course','section']));
    }

    public function driverwisetransportmisreport(Request $request)
    {
        $driver=[];
        $routestop=(new TransportRepository())->routestoplist();
        return view('app.erpmodule.MasterAdmin.transport.Reports.driver-wise-transport-mis-report',compact(['driver','routestop']));
    }

    public function classandroutewisemisreport(Request $request)
    {
        $course=(new CommanDataRepository())->courseselectlist([]);
        $routestop=(new TransportRepository())->routestoplist();
        return view('app.erpmodule.MasterAdmin.transport.Reports.class-wise-and-route-transport-mis-report',compact(['course','routestop']));
    }

    public function studenttransportfeedefaulter(Request $request)
    {
        return view('app.erpmodule.MasterAdmin.transport.Reports.student-transport-fee-defaulter');
    }

}
