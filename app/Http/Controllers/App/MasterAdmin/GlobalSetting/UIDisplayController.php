<?php

namespace App\Http\Controllers\App\MasterAdmin\GlobalSetting;

use App\Http\Controllers\Controller;
use App\Models\MasterAdmin\GlobalSetting\UIDisplay;
use Illuminate\Http\Request;

class UIDisplayController extends Controller
{
    public function index()
    {
        $uidisplay=UIDisplay::query()->record()->first();
        return view('app.erpmodule.MasterAdmin.GlobalSetting.schoolsetting.ui-display-setting',compact(['uidisplay']));
    }

    public function store(Request $request)
    {
        /**
         * Delete UI/Display
         */
        UIDisplay::query()->record()->forceDelete();
        /**
         * Insert UI/Display
         */
        UIDisplay::create($request->all());
        return back()->with('success','Record Update Successful Complete');
    }

    public function resetui()
    {
        /**
         * Delete UI/Display
         */
        UIDisplay::query()->record()->forceDelete();
        return back()->with('success','UI/Display Reset Successful Complete');
    }
}
