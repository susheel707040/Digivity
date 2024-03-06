<?php

namespace App\Http\Controllers\Auth;

use App\Helper\MyHelp;
use App\Helper\SMSTemplate;
use App\Http\Requests\Auth\TwoFaRequest;
use App\Http\Requests\Auth\UserEditRequest;
use App\Http\Requests\Auth\UserPasswordResetRequest;
use App\Models\MasterAdmin\GlobalSetting\AcademicSession;
use App\Models\MasterAdmin\GlobalSetting\FinancialSession;
use App\Models\MasterAdmin\GlobalSetting\SchoolBranch;
use App\Models\MasterAdmin\GlobalSetting\SchoolInformation;
use App\Repositories\MasterAdmin\GlobalSetting\CommanDataRepository;
use App\Models\User;
use Extsalt\Otp\Facades\SMS as OtpSMS;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AuthTwoController extends Controller
{
    /**
     * Two Factor Authanticate Show
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function twofashow()
    {
        return view('app.auth.two-fa-authentication');
    }

    public function userprofileshow()
    {
        $school = 0;
        return view('app.auth.profile', compact('school'));
    }

    public function edituserprofileshow(SchoolBranch $schoolbranch, AcademicSession $academic, FinancialSession $financial, User $user)
    {
        $school = SchoolInformation::query()->record()->get();
        $schoolbranch = $schoolbranch->get();
        $academic = $academic->get();
        $financial = $financial->get();
        return view('app.auth.edit-profile', compact(['school', 'schoolbranch', 'academic', 'financial', 'user']));
    }

    public function edituserprofilepost(UserEditRequest $request, User $user)
    {
        if ($request->hasFile('profile_img')) {
            // Get the file from the request
            $profileImage = $request->file('profile_img');

            // Generate a unique name for the file
            $fileName = uniqid().'.'.$profileImage->getClientOriginalExtension();

            // Move the file to the desired location
            $profileImage->move(public_path('uploads/'), $fileName);

            // Update the user's profile_img attribute with the file name
            $user->profile_img = $fileName;
        }
        $user->update($request->validated());
        return back()->with('success', 'Record Update Successful Complete');
    }

    public function changepasswordshow()
    {
        return view('app.auth.change-password');
    }

    public function loginhistoryshow(Request $request)
    {

        $user=Auth::user();
        // return $user;
        $loginhistory=(new CommanDataRepository())->useractivitylogs(['user_id'=>$user->id])->sortByDesc('created_at');
        // return $loginhistory;
        return view('app.auth.log-in-history',compact(['loginhistory','user']));
    }

    /**
     * Change Password
     */

    public function changepasswordpost(User $user, UserPasswordResetRequest $passwordResetRequest)
    {
        if (Hash::check($passwordResetRequest->get('old_password'), $user->password)) {
            $user->update(['password' => Hash::make($passwordResetRequest->get('password'))]);

            $smsdata =array("--name--" => $user->first_name);
            if (class_exists(OtpSMS::class)) {
                OtpSMS::message($user->contact_no, MyHelp::str_replace($smsdata, SMSTemplate::getsmstemplate('pwd-change')[0]));
            }

            return redirect('/logout')->with('success', 'New password change successful complete.');
        }
        return back()->with('danger', 'Please enter valid old password');
    }

    public function twofastatuspost(User $user, TwoFaRequest $twoFaRequest)
    {
        if (Hash::check($twoFaRequest->get('current_password'), $user->password)) {
            $user->update(['two_fa_at' => $twoFaRequest->get('two_fa_at')]);

            $two_fa_status="Disable"; if($twoFaRequest->get('two_fa_at')=="yes"){$two_fa_status="Enable";}
            $smsdata =array("--name--" => $user->first_name,"--status--"=>$two_fa_status);
            if (class_exists(OtpSMS::class)) {
                OtpSMS::message($user->contact_no, MyHelp::str_replace($smsdata, SMSTemplate::getsmstemplate('2fa-change')[0]));
            }
            return back()->with('success', 'Changing successful your two-factor authentication method');
        }
        return back()->with('danger', 'Please enter valid password');
    }

    /*
     * Mobile Application Controller
     */
    public function apitwofastatus($userid,Request $request)
    {
        return response()->json([
            'result'=>1,
            'message'=>'2FA Enable Successful Complete',
            'success'=>null
        ],200);
    }


}
