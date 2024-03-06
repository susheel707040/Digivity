<?php

namespace App\Http\Controllers\App\MasterAdmin\Transport\MasterSetting;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterAdmin\Transport\MasterSetting\RouteStopRequest;
use App\Models\MasterAdmin\Transport\MasterSetting\RouteStop;
use Illuminate\Http\Request;

class RouteStopController extends Controller
{
    public function index()
    {
        $routestop = RouteStop::query()->record()->get();
        return view('app.erpmodule.MasterAdmin.transport.mastersetting.define-route-stop', compact('routestop'));
    }

    public function store(RouteStopRequest $request)
    {
        session(['keyid' => 'addModels', 'url' => '0']);
        RouteStop::create($request->validated());
        return back()->with('success', 'Record Save Successful Complete');
    }

    public function editview(RouteStop $routestop)
    {
        return view('app.erpmodule.MasterAdmin.transport.mastersetting.edit.edit-route-stop', compact('routestop'));
    }

    public function modify(RouteStop $routestop,RouteStopRequest $request)
    {
        $routestop->update($request->validated());
        session(['keyid' => 'editModels', 'url' => 'MasterAdmin/Transport/EditViewRouteStop/' . $routestop->id . '/edit']);
        return back()->with('success', 'Record Update Successful Complete');
    }
}
