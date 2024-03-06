<?php

namespace App\Http\Controllers\App\MasterAdmin\Timetable;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterAdmin\Timetable\TimetableRequest;
use App\Models\MasterAdmin\Timetable\Timetable;
use App\Repositories\MasterAdmin\Timetable\TimetableRepository;
use Illuminate\Http\Request;

class TimetableController extends Controller
{
    public function index()
    {
        $timetable=(new TimetableRepository())->timetablelist([]);
        return view('app.erpmodule.MasterAdmin.Timetable.MasterSetting.define-timetable',compact(['timetable']));
    }

    public function store(TimetableRequest $request)
    {
        Timetable::create($request->validated());
        session(['keyid' => 'addModels','url'=>'0']);
        return back()->with('success','Record Save Successful Complete');
    }

    public function editview(Timetable $timetable)
    {
        return view('app.erpmodule.MasterAdmin.Timetable.MasterSetting.Edit.edit-timetable',compact(['timetable']));
    }

    public function modify(Timetable $timetable,TimetableRequest $request)
    {
        $timetable->update($request->validated());
        session(['keyid' => 'editModels','url'=>'/MasterAdmin/Timetable/EditViewTimetable/'.$timetable->id.'/editview']);
        return back()->with('success','Record Update Successful Complete');
    }
}
