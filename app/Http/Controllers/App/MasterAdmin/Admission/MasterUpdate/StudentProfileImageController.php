<?php

namespace App\Http\Controllers\App\MasterAdmin\Admission\MasterUpdate;

use App\Helper\FileUpload;
use App\Http\Controllers\Controller;
use App\Repositories\MasterAdmin\StudentInformation\StudentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudentProfileImageController extends Controller
{
    public function index(Request $request)
    {
        $student=(new StudentRepository())->studentshortlist($request->all());
        return view('app.erpmodule.MasterAdmin.StudentInformation.MasterUpdate.bulk-student-profile-image-update',compact(['student']));
    }

    public function parentprofileindex(Request $request)
    {
        $student=(new StudentRepository())->studentshortlist($request->all());
        return view('app.erpmodule.MasterAdmin.StudentInformation.MasterUpdate.bulk-parent-profile-image-update',compact(['student']));
    }
}
