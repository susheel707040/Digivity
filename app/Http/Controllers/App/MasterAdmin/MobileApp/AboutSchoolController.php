<?php

namespace App\Http\Controllers\App\MasterAdmin\MobileApp;

use App\Http\Controllers\Controller;
use App\Models\MasterAdmin\MobileApp\AboutSchool;
use Illuminate\Http\Request;

class AboutSchoolController extends Controller
{
    public function index()
    {
      return view('app.erpmodule.MasterAdmin.MobileApp.AboutSchool.about-school');
    }

    public function indexsearch($pageid)
    {
        $pagedata=AboutSchool::query()->where('page_id',$pageid)->record()->first();
       return view('app.erpmodule.MasterAdmin.MobileApp.AboutSchool.about-school',compact('pagedata'));
    }

    public function store(Request $request)
    {
        AboutSchool::query()->where('page_id',$request->page_id)->record()->forceDelete();
        AboutSchool::create($request->all());
        return back()->with('success','Record Save Successful Complete');
    }

    /**
     * mobile application api get record
     */
    public function apiindexsearch($pageid)
    {
        $pagedata=AboutSchool::query()->where('page_id',$pageid)->record()->first();
        return response()->json([
            'result'=>1,
            'success'=>[
                [
                    'data'=>$pagedata ? $pagedata->body_data : ""
                ]
            ]
        ],200);
    }
}
