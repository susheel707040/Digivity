<?php

namespace App\Http\Controllers\App\MasterAdmin\Transport\MasterSetting;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterAdmin\Transport\MasterSetting\RouteRequest;
use App\Models\MasterAdmin\Transport\MasterSetting\Route;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    public function index()
    {
        $route = Route::query()->record()->get();
        return view('app.erpmodule.MasterAdmin.transport.mastersetting.define-route', compact('route'));
    }

    public function store(RouteRequest $request)
    {
        session(['keyid' => 'addModels', 'url' => '0']);
        Route::create($request->validated());
        return back()->with('success', 'Record Save Successful Complete');
    }

    public function editview(Route $route)
    {
        return view('app.erpmodule.MasterAdmin.transport.mastersetting.edit.edit-route', compact('route'));
    }

    public function modify(Route $route, RouteRequest $request)
    {
        $route->update($request->validated());
        session(['keyid' => 'editModels', 'url' => 'MasterAdmin/Transport/EditViewRoute/' . $route->id . '/edit']);
        return back()->with('success', 'Record Update Successful Complete');
    }
}
