<ul class="nav digishiksha-navbar-header nav-line tx-12" id="myTab5" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" href="{{url('/MasterAdmin/MobileApp/index')}}"><i class="fa fa-chart-line"></i> MOBILE APP ANALYTICS</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="profile-tab5" data-toggle="dropdown" href="#profile5" ><i class="fa fa-thumb"></i> ATTENDANCE <i class="fa fa-angle-down"></i></a>
        <div class="dropdown-menu navbar-menu-sub tx-11 pd-0 pd-t-5">
            <a href="{{url('MasterAdmin/Attendance/StudentMarkAttendance')}}" class="dropdown-item">CLASS WISE STUDENT MARK ATTENDANCE</a>
            <a href="{{url('MasterAdmin/Attendance/StaffMarkAttendance')}}" class="dropdown-item">STAFF MARK ATTENDANCE</a>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link active" href="{{url('/MasterAdmin/MobileApp/AboutSchool')}}"><i class="fa fa-info-circle"></i> ABOUT SCHOOL</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="contact-tab5" data-toggle="dropdown" href="#contact5"> <i class="fa fa-cogs"></i> MASTER SETTING <i class="fa fa-angle-down"></i></a>
        <div class="dropdown-menu navbar-menu-sub tx-11 pd-0 pd-t-5">
            {{-- <a href="{{url('MasterAdmin/Attendance/DefineAttendanceSetting')}}" class="dropdown-item">MOBILE APP CONFIGURATION</a> --}}
              <a href="#" class="dropdown-item">MOBILE APP CONFIGURATION</a>
        </div>
    </li>
</ul>
