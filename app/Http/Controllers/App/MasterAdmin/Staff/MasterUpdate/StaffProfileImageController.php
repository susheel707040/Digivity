<?php

namespace App\Http\Controllers\App\MasterAdmin\Staff\MasterUpdate;

use App\Http\Controllers\Controller;
use App\Repositories\MasterAdmin\Staff\StaffRepositories;
use Illuminate\Http\Request;

class StaffProfileImageController extends Controller
{
    public function staffprofileupdateindex(Request $request)
{
    $staff = (new StaffRepositories())->staffshortlist($request->all());
    return view('app.erpmodule.MasterAdmin.Staff.MasterUpdate.bulk-staff-profile-image-update', compact('staff'));
}

}
