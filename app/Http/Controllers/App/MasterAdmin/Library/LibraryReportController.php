<?php

namespace App\Http\Controllers\App\MasterAdmin\Library;

use App\Http\Controllers\Controller;
use App\Repositories\MasterAdmin\Library\LibraryRepositories;
use Illuminate\Http\Request;

class LibraryReportController extends Controller
{
    public function dailyentryreport(Request $request)
    {
        // dd($request->all());
        $search=[];
        if($request->all()){
            $search=[
                'search'=>$request->except(['from_date','_token','to_date'])
            ];
            $search=array_merge($search,['customsearch'=>['whereBetween'=>['entry_date'=>[nowdate($request->from_date,'Y-m-d'),nowdate($request->to_date,'Y-m-d')]]]]);
        }
        $dailyrecord=(new LibraryRepositories())->bookentrylist($search,['book']);
        return view('app.erpmodule.MasterAdmin.Library.Reports.daily-entry-report',compact(['dailyrecord']));
    }

    public function outdatedreport(Request $request)
    {

    }
}
