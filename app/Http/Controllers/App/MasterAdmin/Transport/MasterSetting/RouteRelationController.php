<?php

namespace App\Http\Controllers\App\MasterAdmin\Transport\MasterSetting;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterAdmin\Transport\MasterSetting\RouteRelationRequest;
use App\Models\MasterAdmin\Transport\MasterSetting\Route;
use App\Models\MasterAdmin\Transport\MasterSetting\RouteRelation;
use App\Models\MasterAdmin\Transport\MasterSetting\TransportRouteFeeCharge;
use App\Repositories\MasterAdmin\Finance\FinanceRepository;
use Illuminate\Http\Request;

class RouteRelationController extends Controller
{
    public function index()
    {
        $route = Route::query()->record()->get();
        return view('app.erpmodule.MasterAdmin.transport.mastersetting.route-relation', compact('route'));
    }

    public function search($routeid)
    {
        $routerelation = RouteRelation::query()->where('route_id', $routeid)->with(['route', 'routestop', 'vehicle','routefeecharge'])->record()->get();
        $route = Route::query()->record()->get();
        $feeheadinstalment=collect((new FinanceRepository())->feeheadwithinstalmentlist(['type'=>'transport']))->first();
        return view('app.erpmodule.MasterAdmin.transport.mastersetting.route-relation', compact(['route', 'routerelation','feeheadinstalment']));
    }


    public function store(RouteRelationRequest $request)
{
    $routerelation = RouteRelation::create($request->validated());
    // Check if instalment_id exists and is an array
    if ($request->has('instalment_id') && is_array($request->instalment_id)) {
        //create transport charge
        foreach ($request->instalment_id as $fee_tem_id) {
            $data = [
                'route_relation_id' => $routerelation->id,
                'instalment_id' => $fee_tem_id,
                'fee_amount' => $request["fee_amt_".$fee_tem_id."_id"][0]
            ];
            TransportRouteFeeCharge::create($data);
        }
    } else {
        // Handle the case where instalment_id is null or not an array
        // For example, you might want to log an error or return a response indicating the issue.
    }

    session(['keyid' => 'addRouteRelation', 'url' => '0']);
    return back()->with('success', 'Record Create Successful Complete');
}


    /**
     * Edit view return
     * @param RouteRelation $routerelation
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function editview(RouteRelation $routerelation)
    {
        $feeheadinstalment=collect((new FinanceRepository())->feeheadwithinstalmentlist(['type'=>'transport']))->first();
        $feeheadinstalmentamt=RouteRelation::query()->where('id',$routerelation->id)->with(['routefeecharge'])->first();
        return view('app.erpmodule.MasterAdmin.transport.mastersetting.edit.edit-route-relation', compact(['routerelation','feeheadinstalment','feeheadinstalmentamt']));
    }

    /**
     * modify transport fee charge
     * @param RouteRelation $routerelation
     * @param RouteRelationRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function modify(RouteRelation $routerelation,RouteRelationRequest $request)
    {
        $routerelation->update($request->validated());
        TransportRouteFeeCharge::query()->where('route_relation_id',$routerelation->id)->record()->forceDelete();
        //create transport charge
        if ($request->instalment_id !== null) {
        foreach ($request->instalment_id as $fee_tem_id) {
            $data = [
                'route_relation_id' => $routerelation->id,
                'instalment_id' => $fee_tem_id,
                'fee_amount' => $request["fee_amt_".$fee_tem_id."_id"][0]
            ];
            TransportRouteFeeCharge::create($data);
        }
    }
        session(['keyid' => 'editModels','url'=>'MasterAdmin/Transport/EditViewRouteRelation/'.$routerelation->id.'/edit']);
        return back()->with('success', 'Record Update Successful Complete');
    }

}
