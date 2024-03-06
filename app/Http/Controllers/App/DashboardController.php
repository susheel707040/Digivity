<?php

namespace App\Http\Controllers\App;
use App\Helper\CommunicationBalance;
use App\Models\MasterAdmin\AcademicSetting\Course;
use App\Models\MasterAdmin\Admission\StudentRecord;
use App\Repositories\MasterAdmin\GlobalSetting\CommanDataRepository;
use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Tenant;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
   public function __construct()
   {
       $this->middleware('web');
   }
   public function dashboard()
   {
      $communicationbalance=CommunicationBalance::Balance();
      $coursesection=(new CommanDataRepository())->coursesectionlist([]);
      $section=(new CommanDataRepository())->sectionlist([]);

    return view('app.dashboard',compact('communicationbalance','coursesection','section'));
   }

}
