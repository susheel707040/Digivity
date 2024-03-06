<?php

namespace App\Http\Controllers\App\MasterAdmin\GlobalSetting;

use App\Http\Requests\MasterAdmin\GlobalSetting\FinancialYearRequest;
use App\Models\MasterAdmin\GlobalSetting\FinancialSession;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FinancialYearController extends Controller
{

    public function index()
    {
        $financial = FinancialSession::query()->record()->get();
        return view('app.erpmodule.MasterAdmin.GlobalSetting.schoolsetting.define-financial-year', compact(['financial']));
    }

    public function store(FinancialYearRequest $request)
    {
        session(['keyid' => 'addModels', 'url' => '0']);
        FinancialSession::create($request->validated());
        return back()->with('success', 'Record Save Successful Complete');
    }

    public function editview(FinancialSession $financial)
    {
        return view('erpmodule.MasterAdmin.GlobalSetting.schoolsetting.Edit.edit-financial-year', compact(['financial']));
    }

    public function modify(FinancialSession $financial,FinancialYearRequest $request)
    {
        $financial->update($request->validated());
        session(['keyid'=>'editModels','url'=>'/MasterAdmin/GlobalSetting/EditViewFinancialYear/'.$financial->id.'/edit']);
        return back()->with('success','Record Update Successful Complete');
    }


}
