<?php

namespace App\Http\Controllers\App\MasterAdmin\GlobalSetting;

use App\Http\Requests\MasterAdmin\GlobalSetting\SchoolBoardRequest;
use App\Models\MasterAdmin\GlobalSetting\SchoolBoard;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;


class SchoolBoardController extends Controller
{
    public function index()
    {
        $schoolboard = SchoolBoard::query()->record()->get();
        return view('app.erpmodule.MasterAdmin.GlobalSetting.schoolsetting.define-school-board', compact('schoolboard'));
    }

    public function store(SchoolBoardRequest $request)
    {
        SchoolBoard::create($request->validated());
        session(['keyid' => 'addModels', 'url' => '0']);
        return back()->with('success', 'Record Create Successful Complete');
    }

    public function editview(SchoolBoard $schlbrd)
    {
        return view('erpmodule.MasterAdmin.GlobalSetting.schoolsetting.Edit.edit-school-board', compact('schlbrd'));
    }

    public function edit(SchoolBoard $schoolboard, SchoolBoardRequest $request)
    {
        $schoolboard->update($request->validated());
        session(['keyid' => 'editModels', 'url' => '/MasterAdmin/GlobalSetting/EditViewSchoolBoard/' . $schoolboard->id . '/editview']);
        return back()->with('success', 'Record Update Successful Complete');

    }

}
