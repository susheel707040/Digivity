<?php

namespace App\Http\Controllers\App\MasterAdmin\Finance\MasterSetting;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterAdmin\Finance\ConcessionTypeRequest;
use App\Models\MasterAdmin\Finance\FeeSetting\ConcessionType;
use App\Repositories\MasterAdmin\Finance\FinanceRepository;
use Illuminate\Http\Request;

class ConcessionTypeController extends Controller
{
    public function index()
    {
     $concessiontype=(new FinanceRepository())->concessiontypelist([]);
     return view('app.erpmodule.MasterAdmin.Finance.MasterSetting.FeeSetting.define-concession-type',compact(['concessiontype']));
    }

    public function store(ConcessionTypeRequest $request)
    {
        ConcessionType::create($request->validated());
        session(['keyid' => 'addModels','url'=>'0']);
        return back()->with('success','Record Create Successful Complete');
    }

    public function editview(ConcessionType $concessiontype)
    {
        return view('app.erpmodule.MasterAdmin.Finance.MasterSetting.FeeSetting.Edit.edit-concession-type',compact(['concessiontype']));
    }

    public function modify(ConcessionType $concessiontype,ConcessionTypeRequest $request)
    {
        $concessiontype->update($request->validated());
        session(['keyid' => 'editModels','url'=>'/MasterAdmin/Finance/EditViewConcessionType/'.$concessiontype->id.'/view']);
        return back()->with('success','Record Update Successful Complete');

    }
}
