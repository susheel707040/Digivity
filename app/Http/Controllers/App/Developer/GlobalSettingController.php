<?php

namespace App\Http\Controllers\Developer;

use App\Http\Controllers\Controller;
use App\Model\MasterAdmin\GlobalSetting\AcademicSession;
use App\Model\MasterAdmin\GlobalSetting\FinancialSession;
use App\Model\MasterAdmin\GlobalSetting\SchoolBranch;
use App\Model\MasterAdmin\GlobalSetting\SchoolInformation;
use App\Models\User;
use Illuminate\Http\Request;

class GlobalSettingController extends Controller
{
    public function schoolinfo($tokenid)
    {
        $schooldetail = [];
        $school = SchoolInformation::query()->get();
        foreach ($school as $data) {
            $schooldetail[] = ['id' => $data->id, 'school' => $data->school_name];
        }
        return response()->json([
            'result' => 1,
            'message' => 'data available',
            'success' => $schooldetail
        ]);
    }

    public function schoolbranchinfo($tokenid)
    {
        $schoolbranchdetail = [];
        $schoolbranch = SchoolBranch::query()->get();
        foreach ($schoolbranch as $data) {
            $schoolbranchdetail[] = ['id' => $data->id, 'school_branch' => $data->school_name, 'school_address' => $data->address];
        }
        return response()->json([
            'result' => 1,
            'message' => 'data available',
            'success' => $schoolbranchdetail
        ]);

    }

    public function academicinfo($tokenid)
    {
        $academicdetail = [];
        $academic = AcademicSession::query()->get();
        foreach ($academic as $data) {
            $academicdetail[] = ['id' => $data->id, 'academic' => $data->academic_session];
        }
        return response()->json([
            'result' => 1,
            'message' => 'data available',
            'success' => $academicdetail
        ]);
    }

    public function financialinfo($tokenid)
    {
        $financialdetail = [];
        $financial = FinancialSession::query()->get();
        foreach ($financial as $data) {
            $financialdetail[] = ['id' => $data->id, 'financial' => $data->financial_session];
        }
        return response()->json([
            'result' => 1,
            'message' => 'data available',
            'success' => $financialdetail
        ]);
    }

    public function userinfo($tokenid)
    {
        $userdetail = [];
        $user = User::query()->where(['role_id' => 1])->get();
        foreach ($user as $data) {
            $userdetail[] = ['id' => $data->id, 'name' => $data->fullName(), 'role' => $data->RoleName()];
        }
        return response()->json([
            'result' => 1,
            'message' => 'data available',
            'success' => $userdetail
        ]);
    }
}
