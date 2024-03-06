<?php

namespace App\Http\Controllers\App\MasterAdmin\Admission\Reports;

use App\Http\Controllers\Controller;
use App\Model\MasterAdmin\Admission\StudentProspectus;
use App\Repositories\MasterAdmin\StudentInformation\StudentRepository;
use Illuminate\Http\Request;

class StudentProspectusReportController extends Controller
{
    public function prospectussalereport(Request $request)
    {
        $search=$request->all();
        $prospectus=(new StudentRepository())->prospectuslist($search);
        return view('app.erpmodule.MasterAdmin.StudentInformation.Reports.prospectus-sale-report',compact(['prospectus']));
    }

    public function prospectussearchindex()
    {
        return view('app.erpmodule.MasterAdmin.StudentInformation.MasterUpdate.prospectus-search');
    }

    public function prospectusautosearch(Request $request)
    {
        $search=['status'=>'pending'];
        $search=array_merge($search,$request->all());
        $prospectus=(new StudentRepository())->prospectuslist($search);
        return view('app.erpmodule.MasterAdmin.StudentInformation.MasterUpdate.prospectus-search-autocomplete-ui',compact(['prospectus']));
    }

}
