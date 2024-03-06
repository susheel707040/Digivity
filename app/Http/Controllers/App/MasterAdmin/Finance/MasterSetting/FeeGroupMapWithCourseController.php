<?php

namespace App\Http\Controllers\App\MasterAdmin\Finance\MasterSetting;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterAdmin\Finance\FeeGroupMapWithCourseRequest;
use App\Models\MasterAdmin\Finance\FeeSetting\FeeGroupWithMapCourse;
use Illuminate\Http\Request;

class FeeGroupMapWithCourseController extends Controller
{
    public function index()
    {
        $feegroupwithcourse=[];
        return view('app.erpmodule.MasterAdmin.Finance.MasterSetting.FeeSetting.define-fee-group-map-with-course',compact(['feegroupwithcourse']));
    }

    public function indexsearch($feegroupid)
    {

        $feegroupcourse=collect(FeeGroupWithMapCourse::query()->where(['fee_group_id'=>$feegroupid])->record()->get())->toArray();
        return view('app.erpmodule.MasterAdmin.Finance.MasterSetting.FeeSetting.define-fee-group-map-with-course',compact(['feegroupcourse']));
    }

    public function store(FeeGroupMapWithCourseRequest $request)
    {
        $data = $request->validated();
        FeeGroupWithMapCourse::query()->where(['fee_group_id'=>$request->fee_group_id])->record()->forceDelete();
        foreach ($request->course_id as $course_id) {
            $datainsert = [
                'fee_group_id' =>$request->fee_group_id,
                'course_id' => $course_id
            ];
            FeeGroupWithMapCourse::create($datainsert);
        }
        return back()->with('success','Record Save Successful Complete');
    }
}
