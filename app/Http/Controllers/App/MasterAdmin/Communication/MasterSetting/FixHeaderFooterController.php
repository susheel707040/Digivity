<?php

namespace App\Http\Controllers\App\MasterAdmin\Communication\MasterSetting;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterAdmin\Communication\FixHeaderFooterRequest;
use App\Models\MasterAdmin\Communication\FixHeaderFooter;
use App\Repositories\MasterAdmin\Communication\CommunicationRepository;
use Illuminate\Http\Request;

class FixHeaderFooterController extends Controller
{
    public function index()
    {
        $fixheaderfooter=(new CommunicationRepository())->fixheaderfooterlist();
        return view('app.erpmodule.MasterAdmin.Communication.MasterSetting.define-fix-header-footer',compact('fixheaderfooter'));
    }

    public function store(FixHeaderFooterRequest $request)
    {
        FixHeaderFooter::create($request->validated());
        session(['keyid' => 'addModels','url'=>'0']);
        return back()->with('success','Record Save Successful Complete');
    }

    public function editview(FixHeaderFooter $fixheaderfooter)
    {
        return view('app.erpmodule.MasterAdmin.Communication.MasterSetting.edit.edit-fix-header-footer',compact('fixheaderfooter'));
    }

    public function modify(FixHeaderFooter $fixheaderfooter,FixHeaderFooterRequest $request)
    {
        $fixheaderfooter->update($request->validated());
        session(['keyid' => 'editModels','url'=>'/MasterAdmin/Communication/EditViewFixHeaderFooter/'.$fixheaderfooter->id.'/view']);
        return back()->with('success','Record Update Successful Complete');
    }
}
