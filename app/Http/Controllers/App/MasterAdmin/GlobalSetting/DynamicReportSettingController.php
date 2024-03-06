<?php

namespace App\Http\Controllers\App\MasterAdmin\GlobalSetting;

use App\Helper\FileUpload;
use App\Http\Controllers\Controller;
use App\Http\Requests\MasterAdmin\GlobalSetting\DynamicReportSettingRequest;
use App\Models\MasterAdmin\GlobalSetting\DynamicReportSetting;
use App\Repositories\MasterAdmin\GlobalSetting\CommanDataRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DynamicReportSettingController extends Controller
{

    use FileUpload;

    public function index()
    {
        return view('app.erpmodule.MasterAdmin.GlobalSetting.schoolsetting.dynamic-report-setting');
    }

    public function indexsearch($pagename)
    {
        $data=(new CommanDataRepository())->dynamicreport(['page_name'=>$pagename]);
        // return $data;
        return view('app.erpmodule.MasterAdmin.GlobalSetting.schoolsetting.dynamic-report-setting',compact(['data']));
    }

    public function store(DynamicReportSettingRequest $request)
    {
        $data = $request->validated();

        if ($request->page_name == "new") {
            $data['page_name'] = Str::slug($request->report_name);
        }

        // Check if dynamic report setting already exists
        $dynamicreport = DynamicReportSetting::where('page_name', $request->page_name)->first();

        // If it exists, unlink old images before updating
        if ($dynamicreport) {
            // Unlink old school logo
            if ($dynamicreport->school_logo && $request->hasFile('school_logo')) {
                $oldSchoolLogoPath = public_path('uploads/report_school_logo_image/' . $dynamicreport->school_logo);
                if (file_exists($oldSchoolLogoPath)) {
                    unlink($oldSchoolLogoPath);
                }
            }

            // Unlink old watermark logo
            if ($dynamicreport->watermark_file && $request->hasFile('watermark_file')) {
                $oldWatermarkPath = public_path('uploads/report_water_mark_logo_image/' . $dynamicreport->watermark_file);
                if (file_exists($oldWatermarkPath)) {
                    unlink($oldWatermarkPath);
                }
            }
        }

        // Store new school logo
        if ($request->hasFile('school_logo')) {
            $schoolLogoImage = $request->file('school_logo');
            $schoolLogoFileName = $schoolLogoImage->getClientOriginalName();
            $schoolLogoImage->move(public_path('uploads/report_school_logo_image'), $schoolLogoFileName);
            $data['school_logo'] = $schoolLogoFileName;
        }

        // Store new watermark logo
        if ($request->hasFile('watermark_file')) {
            $watermarkImage = $request->file('watermark_file');
            $watermarkFileName = $watermarkImage->getClientOriginalName();
            $watermarkImage->move(public_path('uploads/report_water_mark_logo_image'), $watermarkFileName);
            $data['watermark_file'] = $watermarkFileName;
        }

        // If dynamic report setting exists, update; otherwise, create new
        if ($dynamicreport) {
            $dynamicreport->update($data);
        } else {
            DynamicReportSetting::create($data);
        }

        return back()->with('success', 'Record Update Successful Complete');
    }
    }
