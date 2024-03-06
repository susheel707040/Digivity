<?php

namespace App\Http\Controllers\App\MasterAdmin\User;

use App\Http\Controllers\Controller;
use App\Repositories\MasterAdmin\StudentInformation\StudentRepository;
use App\Repositories\MasterAdmin\User\UserRepository;
use App\Models\User;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function userlist()
    {
        $user=User::query()->with(['roles'])->get();
        return view('app.erpmodule.MasterAdmin.User.Report.user-list',compact('user'));
    }

    public function rolelist()
    {
        $role=(new UserRepository())->rolelist();
        return view('app.erpmodule.MasterAdmin.User.Report.role-list',compact('role'));
    }

    public function appuserreport(Request $request)
    {
        $student=(new StudentRepository())->studentshortlist($request->all());
        return view('app.erpmodule.MasterAdmin.User.Report.user-app-report',compact(['student']));
    }
}
