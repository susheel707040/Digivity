<ul class="nav digishiksha-navbar-header nav-line tx-12" id="myTab5" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" href="{{url('MasterAdmin/Attendance/StudentMarkAttendance')}}"><i class="fa fa-chart-line"></i> Attendance Analytics</a>
    </li>


    <li class="nav-item">
        <a class="nav-link" id="contact-tab5" data-toggle="dropdown" href="#contact5"> <i class="fa fa-file-export"></i>Student Attendance Reports <i class="fa fa-angle-down"></i></a>
        <div class="dropdown-menu navbar-menu-sub tx-11 pd-0 pd-t-5">
            <a href="{{url('MasterAdmin/Attendance/DayWiseStudentAttendanceReport')}}" class="dropdown-item">Day Wise Student Attendance Report</a>
            <a href="{{url('MasterAdmin/Attendance/ClassWiseMisReport')}}" class="dropdown-item">Class/Course Wise Mis Attendance Report</a>
            <a href="{{url('MasterAdmin/Attendance/StudentAttendanceMisReport')}}" class="dropdown-item">Student Attendance Mis Report</a>
           <a href="{{url('MasterAdmin/Attendance/StudentMonthlyMisReport')}}" class="dropdown-item">Student Monthly Attendance Report</a>
        </div>
    </li>


    <li class="nav-item">
        <a class="nav-link" id="contact-tab5" data-toggle="dropdown" href="#contact5"> <i class="fa fa-file-export"></i>Staff Attendance Reports <i class="fa fa-angle-down"></i></a>
        <div class="dropdown-menu navbar-menu-sub tx-11 pd-0 pd-t-5">
            <a href="{{url('#')}}" class="dropdown-item">Day Wise Staff Attendance Report</a>
            <a href="{{url('#')}}" class="dropdown-item">Designation Wise Attendance Report</a>
            <a href="{{url('#')}}" class="dropdown-item">Staff Attendance Mis Report</a>
            <a href="{{url('#')}}" class="dropdown-item">Staff Monthly Report</a>
        </div>
    </li>


    <li class="nav-item">
        <a class="nav-link" id="contact-tab5" data-toggle="dropdown" href="#contact5"> <i class="fa fa-cogs"></i> Master Setting <i class="fa fa-angle-down"></i></a>
        <div class="dropdown-menu navbar-menu-sub tx-11 pd-0 pd-t-5">
            <a href="{{url('MasterAdmin/Attendance/DefineHoliday')}}" class="dropdown-item">Define Holiday</a>
            <a href="{{route('leavetype.index')}}" class="dropdown-item">Define Leave Type</a>
            {{-- <a href="{{url('#')}}" class="dropdown-item">Define Attendance Type</a> --}}
            {{-- <a href="{{url('MasterAdmin/Attendance/BiometricConfiguration')}}" class="dropdown-item">Biometric Configuration</a> --}}
            {{-- <a href="{{url('MasterAdmin/Attendance/DefineShiftMaster')}}" class="dropdown-item">Define Shift Master</a> --}}
        </div>
    </li>
</ul>
