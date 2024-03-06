<?php

namespace App\Http\Controllers\MasterAdmin;

use App\Helper\MyHelp;
use App\Helper\Otp;
use App\Helper\SMSTemplate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AcademicSessionRequest;
use App\Http\Requests\Admin\SchoolBranchRequest;
use App\Http\Requests\Admin\SchoolRequest;
use App\Http\Requests\MasterAdmin\GlobalSetting\FinancialYearRequest;
use App\Models\MasterAdmin\GlobalSetting\AcademicSession;
use App\Models\MasterAdmin\GlobalSetting\FinancialSession;
use App\Models\MasterAdmin\GlobalSetting\SchoolBranch;
use App\Models\MasterAdmin\GlobalSetting\SchoolInformation;
use Carbon\Carbon;
use Extsalt\Otp\Facades\SMS;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

class SchoolController extends Controller
{
    /**
     * Create School
     *
     * @param SchoolRequest $request
     * @return RedirectResponse|Redirector
     */
    public function store(SchoolRequest $request)
    {
        $data = $request->validated();
       // $data['otp'] = Otp::generate();
        /**
         * SMS Send
         */
      //  $smsdata = array("--otp--" => $data['otp']);
       // SMS::message($request->contact_number, MyHelp::str_replace($smsdata, SMSTemplate::getsmstemplate('school-verify')[0]));
        /**
         *image upload in storage
         */
        if (request()->hasFile('school_logo')) {
            $image = time() . '_' . $request->file('school_logo')->getClientOriginalName();
            $path = 'assets/storage/logo/';
            $request->file('school_logo')->move(base_path('/public/') . $path, $image);
            $data['school_logo'] = $path . $image;
        }
        SchoolInformation::create($data);
        return redirect('/setup');
    }

    public function verifySchool(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'otp' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $data = SchoolInformation::where('otp', $request['otp'])->latest()->first();

        if ($data) {
            $data->update(['verified_at' => 'yes']);
            return back();
        }

        $request->session()->flash('danger', 'The one time password (OTP) you entered is incorrect.');
        return redirect('/setup');
    }

    /**
     * @param SchoolBranchRequest $request
     * @return RedirectResponse
     */

    public function storebranch(SchoolBranchRequest $request)
    {
        SchoolBranch::flushEventListeners();
        SchoolBranch::create($request->all());
        return back();
    }


    public function storeacademic(AcademicSessionRequest $request)
    {
        AcademicSession::flushEventListeners();
        $request->merge(['start_date'=>Carbon::createFromDate($request->start_date)->format('Y-m-d')]);
        $request->merge(['end_date'=>Carbon::createFromDate($request->end_date)->format('Y-m-d')]);
        AcademicSession::create($request->all());
        return back();
    }

    public function storefinancialyear(FinancialYearRequest $request)
    {
        FinancialSession::flushEventListeners();
        $request->merge(['start_date'=>Carbon::createFromDate($request->start_date)->format('Y-m-d')]);
        $request->merge(['end_date'=>Carbon::createFromDate($request->end_date)->format('Y-m-d')]);
        FinancialSession::create($request->all());
        return back();
    }


}
