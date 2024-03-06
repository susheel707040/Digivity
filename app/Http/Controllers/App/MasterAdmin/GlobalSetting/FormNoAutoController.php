<?php

namespace App\Http\Controllers\App\MasterAdmin\GlobalSetting;

use App\Http\Controllers\Controller;
use App\Models\MasterAdmin\GlobalSetting\FormNoAuto;
use Illuminate\Http\Request;

class FormNoAutoController extends Controller
{
    public function index()
    {
        $formnoauto = FormNoAuto::query()->record()->get();
        return view('app.erpmodule.MasterAdmin.GlobalSetting.schoolsetting.form-no-auto-configuration',compact('formnoauto'));
    }

    public function store(Request $request)
    {

        if (isset($request['key_id'])) {
            if (count($request['key_id'])) {
                foreach ($request['key_id'] as $keyid) {
                    /**
                     * delete old form no configuration
                     */
                    FormNoAuto::query()->where('key_id',$keyid)->record()->forceDelete();
                    /**
                     * load array for insert new entry
                     */
                    $data = [
                        'key_id' => $keyid,
                        'should_be' => $request["should_be_" . $keyid . ""],
                        'p_s_support_date' => $request["p_s_support_date_" . $keyid . ""],
                        'prefix' => $request["prefix_" . $keyid . ""],
                        'prefix_date' => $request["prefix_with_date_" . $keyid . ""],
                        'start_from' => $request["start_no_" . $keyid . ""],
                        'suffix' => $request["suffix_" . $keyid . ""],
                        'suffix_date' => $request["suffix_with_date_" . $keyid . ""],
                        'status' => $request["status_" . $keyid . ""]
                    ];
                    FormNoAuto::create($data);
                }
                return back()->with('success', 'Record Update Successful Complete');
            }
        }

        return back()->with('danger', 'Choose any one for update form configuration');
    }
}
