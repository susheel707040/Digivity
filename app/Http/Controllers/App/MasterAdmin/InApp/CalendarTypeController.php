<?php

namespace App\Http\Controllers\App\MasterAdmin\InApp;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterAdmin\InApp\CalendarTypeRequest;
use App\Models\MasterAdmin\InApp\CalendarType;
use App\Repositories\MasterAdmin\InApp\InAppDataRepository;
use Illuminate\Http\Request;

class CalendarTypeController extends Controller
{
    public function index()
    {
        $calendartype = (new InAppDataRepository())->calendartypelist([]);
        return view('app.erpmodule.MasterAdmin.InApp.MasterSetting.define-calendar-type', compact(['calendartype']));
    }

    public function store(CalendarTypeRequest $request)
    {
        session(['keyid' => 'addModels', 'url' => '0']);
        CalendarType::create($request->validated());
        return back()->with('success', 'Record Save Successful Complete');

    }

    public function editview(CalendarType $calendartype)
    {
        return view('app.erpmodule.MasterAdmin.InApp.MasterSetting.Edit.edit-calendar-type', compact(['calendartype']));
    }

    public function modify(CalendarType $calendartype, CalendarTypeRequest $request)
    {
        $calendartype->update($request->validated());
        session(['keyid' => 'editModels','url'=>'/MasterAdmin/App/EditViewCalendarType/'.$calendartype->id.'/editview']);
        return back()->with('success','Record Update Successful Complete');
    }

    /*
     * Mobile Application Controller
     */
    public function apicalandertypelist()
    {
        $calendartypedata=[];
        $calendartype = (new InAppDataRepository())->calendartypelist([]);
        $calendartypedata=collect($calendartype)->toArray();
        return response()->json([
           'result'=>1,
           'message'=>'data found',
           'success'=>$calendartypedata
        ]);
    }
}
