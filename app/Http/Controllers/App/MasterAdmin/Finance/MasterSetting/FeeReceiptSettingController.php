<?php

namespace App\Http\Controllers\App\MasterAdmin\Finance\MasterSetting;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterAdmin\Finance\MasterSetting\FeeReceiptSettingRequest;
use Illuminate\Http\Request;
use App\Models\MasterAdmin\Finance\MasterSetting\FeeReceiptSetting;

class FeeReceiptSettingController extends Controller
{
    public function index()
    {
        $data=FeeReceiptSetting::query()->record()->first();
        return view('app.erpmodule.MasterAdmin.Finance.MasterSetting.fee-receipt-setting',compact(['data']));
    }

    public function store(FeeReceiptSettingRequest $request)
    {
        // dd($request->all());
        $data=$request->validated();

        if ($request->hasFile('school_logo')) {
            $schoollogoImage = $request->file('school_logo');

            $fileName = $schoollogoImage->getClientOriginalName();

            $schoollogoImage->move(public_path('uploads/school_logo_image'), $fileName);

            $data['school_logo'] = $fileName;
        }


        if ($request->hasFile('watermark_logo')) {
            $watermarklogoImage = $request->file('watermark_logo');

            $fileName = $watermarklogoImage->getClientOriginalName();

            $watermarklogoImage->move(public_path('uploads/watermark_logo_image'), $fileName);

            $data['watermark_logo'] = $fileName;
        }


        if ($request->hasFile('clb_school_logo')) {
            $clbschoollogoImage = $request->file('clb_school_logo');

            $fileName = $clbschoollogoImage->getClientOriginalName();

            $clbschoollogoImage->move(public_path('uploads/clb_school_logo_image'), $fileName);

            $data['clb_school_logo'] = $fileName;
        }


        if ($request->hasFile('clb_watermark_logo')) {
            $clbwatermarklogoImage = $request->file('clb_watermark_logo');

            $fileName = $clbwatermarklogoImage->getClientOriginalName();

            $clbwatermarklogoImage->move(public_path('uploads/clb_watermark_logo_image'), $fileName);

            $data['clb_watermark_logo'] = $fileName;
        }
        FeeReceiptSetting::create($data);
        return back()->with('success','Record Store Successful Complete');
    }

    public function modify(FeeReceiptSetting $feereceiptsetting,FeeReceiptSettingRequest $request)
    {
        $data=$request->validated();
        if ($request->hasFile('school_logo')) {
            $oldSchoolLogoFileName = $feereceiptsetting->school_logo;

            $NewSchoolLogoFile = $request->file('school_logo');

            $NewOldSchoolLogoFileName =$NewSchoolLogoFile->getClientOriginalName();

            $NewSchoolLogoFile->move(public_path("uploads/school_logo_image"), $NewOldSchoolLogoFileName);

            $data['school_logo'] = $NewOldSchoolLogoFileName;

            if($oldSchoolLogoFileName && file_exists(public_path("uploads/school_logo_image/{$oldSchoolLogoFileName}"))){
                unlink(public_path("uploads/school_logo_image/{$oldSchoolLogoFileName}"));
            }
        }
        if ($request->hasFile('watermark_logo')) {
            $oldWaterMarkFileName = $feereceiptsetting->watermark_logo;

            $NewWaterLogoFile = $request->file('watermark_logo');

            $NewWaterLogoFileName = $NewWaterLogoFile->getClientOriginalName();

            $NewWaterLogoFile->move(public_path("uploads/watermark_logo_image"), $NewWaterLogoFileName);

            $data['watermark_logo'] = $NewWaterLogoFileName;

            if ($oldWaterMarkFileName && file_exists(public_path("uploads/watermark_logo_image/{$oldWaterMarkFileName}"))) {
                unlink(public_path("uploads/watermark_logo_image/{$oldWaterMarkFileName}"));
            }
        }
        if ($request->hasFile('clb_school_logo')) {
            $oldClbSchoolLogoPath = $feereceiptsetting->clb_school_logo;

            $NewClbSchoolLogoFile = $request->file('clb_school_logo');

            $NewClbSchoolLogoFileName = $NewClbSchoolLogoFile->getClientOriginalName();

            $NewClbSchoolLogoFile->move(public_path("uploads/clb_school_logo_image"), $NewClbSchoolLogoFileName);

            $data['clb_school_logo'] = $NewClbSchoolLogoFileName;

            if ($oldClbSchoolLogoPath && file_exists(public_path("uploads/clb_school_logo_image/{$oldClbSchoolLogoPath}"))) {
                unlink(public_path("uploads/clb_school_logo_image/{$oldClbSchoolLogoPath}"));
            }
        }

        if ($request->hasFile('clb_watermark_logo')) {
            $oldClbWaterMarkLogoPath = $feereceiptsetting->clb_watermark_logo;

            $NewClbWaterMarkLogoFile = $request->file('clb_watermark_logo');

            $NewClbWaterMarkLogoFileName = $NewClbWaterMarkLogoFile->getClientOriginalName();

            $NewClbWaterMarkLogoFile->move(public_path("uploads/clb_watermark_logo_image"), $NewClbWaterMarkLogoFileName);

            $data['clb_watermark_logo'] = $NewClbWaterMarkLogoFileName;
            if ($oldClbWaterMarkLogoPath && file_exists(public_path("uploads/clb_watermark_logo_image/{$oldClbWaterMarkLogoPath}"))) {
                unlink(public_path("uploads/clb_watermark_logo_image/{$oldClbWaterMarkLogoPath}"));
            }
        }
        $feereceiptsetting->update($data);
        return back()->with('success','Record Update Successful Complete');
    }
}
