<?php

namespace App\Http\Controllers\App\MasterAdmin\Staff\MasterSetting;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterAdmin\Staff\ProfessionTypeRequest;
use App\Models\MasterAdmin\Staff\ProfessionType;
use App\Repositories\MasterAdmin\Staff\StaffRepositories;
use Illuminate\Http\Request;

class ProfessionTypeController extends Controller
{
    public function index()
    {
        $professiontype=(new StaffRepositories())->professtiontypelist();
        return view('app.erpmodule.MasterAdmin.Staff.MasterSetting.define-profession-type',compact(['professiontype']));
    }

    public function store(ProfessionTypeRequest $request)
    {
        ProfessionType::create($request->validated());
        session(['keyid' => 'addModels', 'url' => 0]);
        return back()->with('success', 'Record Create Successful Complete');
    }

    public function editview(ProfessionType $professiontype)
    {
        return view('app.erpmodule.MasterAdmin.Staff.MasterSetting.edit.edit-profession-type',compact(['professiontype']));
    }

    public function modify(ProfessionType $professiontype,ProfessionTypeRequest $request)
    {
        $professiontype->update($request->validated());
        session(['keyid' => 'editModels', 'url' => 'MasterAdmin/Staff/EditViewProfessionType/' . $professiontype->id . '/editview']);
        return back()->with('success', 'Record Update Successful Complete');
    }
}
