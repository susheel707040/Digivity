<?php

namespace App\Http\Controllers;

use App\BootUp\BootUp;
use App\Model\MasterAdmin\GlobalSetting\AcademicSession;
use App\Model\MasterAdmin\GlobalSetting\FinancialSession;
use App\Model\MasterAdmin\GlobalSetting\SchoolBranch;
use App\Model\MasterAdmin\GlobalSetting\SchoolInformation;
use App\Role;
use App\Models\User;

class SetupCheckController extends Controller
{
    public function index()
    {
        /**
         * Ready Steady Go
         */
        BootUp::boot();

        /**
         * school table record get
         */
        $school = SchoolInformation::where('verified_at', 'yes')->get(['id', 'school_name']);

        /**
         * School Branch Table get Record
         */

        $schoolbranch = SchoolBranch::query()->get(['id', 'school_name']);

        /**
         * School Verify Not get Table Data
         */

        $schoolno = SchoolInformation::where('verified_at', 'no')->first();

        /**
         * Academic Session
         */

        $academic = AcademicSession::query()->get(['id', 'academic_session', 'default_at']);

        /**
         * Financial Year
         */

        $financial=FinancialSession::query()->get(['id', 'financial_session', 'default_at']);

        /**
         * Role Details
         */

        $role = Role::query()->get(['id', 'name']);

        if (!SchoolInformation::query()->count()) {

            return view('setup.CreateSchool');

        } else
            /**
             * school verify check
             */
            if ($schoolno) {

                return view('setup.SchoolVerifyOtp', ['mobile_no' => $schoolno->contact_number, 'email_address' => $schoolno->email_address]);

            } else
                /**
                 * School branch check
                 */
                if (!SchoolBranch::query()->count()) {

                    return view('setup.CreateSchoolBranch', compact('school'));

                } else
                    /**
                     * Academic Session check
                     */
                    if (!AcademicSession::query()->count()) {

                        return view('setup.CreateAcademicSession', compact('school', 'schoolbranch'));

                    } else
                        /**
                         * Financial Year Check
                         */
                        if(!FinancialSession::query()->count()){
                            return view('setup.create-financial-year', compact('school', 'schoolbranch'));
                        }else
                        /**     $schoolno =      $schoolno = SchoolInformation::where('verified_at', 'no')->first();SchoolInformation::where('verified_at', 'no')->first();
                         * login check
                         */
                        if (!User::query()->count()) {
                            return view('setup.CreateAdmin', compact(['school', 'schoolbranch', 'academic','financial', 'role']));
                        }

        return redirect('/');
    }
}
