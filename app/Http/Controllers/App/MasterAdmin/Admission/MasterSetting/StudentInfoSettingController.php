<?php

namespace App\Http\Controllers\App\MasterAdmin\Admission\MasterSetting;

use App\Http\Controllers\Controller;
use App\Models\MasterAdmin\Admission\StudentInfoSetting;
use Illuminate\Http\Request;

class StudentInfoSettingController extends Controller
{
    public function index()
    {
        $studentinfosetting = StudentInfoSetting::query()->first();
        return view('erpmodule.MasterAdmin.StudentInformation.MasterSetting.student-information-setting', compact('studentinfosetting'));
    }

    public function store(Request $request, $id)
    {
        //StudentInfoSetting::find($id)->delete();

        StudentInfoSetting::create($request->all());
        return back()->with('success', 'Record Update Successfully Complete');
    }
}
