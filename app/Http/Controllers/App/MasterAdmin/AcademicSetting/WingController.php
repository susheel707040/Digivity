<?php

namespace App\Http\Controllers\App\MasterAdmin\AcademicSetting;

use App\Http\Requests\MasterAdmin\AcademicSetting\WingRequest;
use Illuminate\Support\Facades\Redirect;
use App\Models\MasterAdmin\AcademicSetting\Wing;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WingController extends Controller
{
    public function index()
    {
       $wing=Wing::query()->record()->get();
       return view('app.erpmodule.MasterAdmin.GlobalSetting.AcademicSetting.define-wing',compact('wing'));
    }

    public function store(WingRequest $request)
    {
       Wing::create($request->validated());
       session(['keyid'=>'addModels','url'=>0]);
       return Redirect::route('define.wing')->with('success', 'Wing saved successfully');
    }

    public function editview(Wing $wing)
    {
        return view('app.erpmodule.MasterAdmin.GlobalSetting.AcademicSetting.Edit.edit-wing',compact('wing'));
    }

    public function modify(Wing $wing,WingRequest $request)
    {
       $wing->update($request->validated());
       session(['keyid' => 'editModels','url'=>'MasterAdmin/GlobalSetting/EditViewWing/'.$wing->id.'/edit']);
       return back()->with('success','Record Update Successful Complete');
    }


}
