<?php

namespace App\Http\Controllers\MasterAdmin\MasterReport;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class ApiWebViewMasterReportController extends Controller
{
    public function index($userid, Request $request)
    {
       // DB::table("testapi")->insert(['data' => serialize($request->all())]);
        if (isset($request->report_name) && ($request->report_name == "DailyFeeCollectionReport")) {

            return \App::call('App\Http\Controllers\MasterAdmin\Finance\Reports\ApiFinanceReportController@apifeecollectionreport');

        } elseif (isset($request->report_name) && ($request->report_name == "StudentFeeDefaulter")) {

            return \App::call('App\Http\Controllers\MasterAdmin\Finance\Reports\ApiFinanceReportController@apistudentdefaulter');

        } elseif (isset($request->report_name) && ($request->report_name == "DailyBookReport")) {

            return \App::call('App\Http\Controllers\MasterAdmin\Finance\Reports\ApiFinanceReportController@apidailybookreport');

        } elseif (isset($request->report_name) && ($request->report_name == "PaymentModeWiseFeeColloectionReport")) {

            return \App::call('App\Http\Controllers\MasterAdmin\Finance\Reports\ApiFinanceReportController@apipaymodereport');

        } elseif (isset($request->report_name) && ($request->report_name == "FeeHeadWiseCollectionReport")) {

            return \App::call('App\Http\Controllers\MasterAdmin\Finance\Reports\ApiFinanceReportController@apifeeheadcollectionreport');

        } elseif (isset($request->report_name) && ($request->report_name == "ClassSectionWiseFeeColloectionReport")) {

            return \App::call('App\Http\Controllers\MasterAdmin\Finance\Reports\ApiFinanceReportController@apiclasssectioncollectionreport');

        } elseif (isset($request->report_name) && ($request->report_name == "MonthlyFeeCollectionReport")) {

            return \App::call('App\Http\Controllers\MasterAdmin\Finance\Reports\ApiFinanceReportController@apimonthmisreport');

        } elseif (isset($request->report_name) && ($request->report_name == "DailyConcessionReport")) {

            return \App::call('App\Http\Controllers\MasterAdmin\Finance\Reports\ApiFinanceReportController@apidaywiseconcessionreport');

        } elseif (isset($request->report_name) && ($request->report_name == "LedgerWiseFeeDefaulterReport")) {

            return \App::call('App\Http\Controllers\MasterAdmin\Finance\Reports\ApiFinanceReportController@acledgerfeedefaulter');

        } elseif (isset($request->report_name) && ($request->report_name == "ConsolidatePaymentSummaryReport")) {

            return \App::call('App\Http\Controllers\MasterAdmin\Finance\Reports\ApiFinanceReportController@classconsolidatepayment');

        } elseif (isset($request->report_name) && ($request->report_name == "DayWiseAttendanceReport")) {

            return \App::call('App\Http\Controllers\MasterAdmin\Attendance\Report\ApiAttendanceReportController@daywiseattendancereport');

        } elseif (isset($request->report_name) && ($request->report_name == "ClassWiseAttendanceReport")) {

            return \App::call('App\Http\Controllers\MasterAdmin\Attendance\Report\ApiAttendanceReportController@classwiseattendancereport');

        } elseif (isset($request->report_name) && ($request->report_name == "StudentMISAttendanceReport")) {

            return \App::call('App\Http\Controllers\MasterAdmin\Attendance\Report\ApiAttendanceReportController@studentmisattendancereport');

        }

    }
}
