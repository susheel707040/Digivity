<ul class="nav digishiksha-navbar-header nav-line tx-12" id="myTab5" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" href="{{url('/MasterAdmin/Timetable/index')}}"><i class="fa fa-chart-line"></i> Timetable Analytics</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="profile-tab5" data-toggle="dropdown" href="#profile5" ><i class="fa fa-thumb"></i> Timetable <i class="fa fa-angle-down"></i></a>
        <div class="dropdown-menu navbar-menu-sub tx-11 pd-0 pd-t-5">
            <a href="{{url('MasterAdmin/Timetable/UploadClassTimetable')}}" class="dropdown-item">Upload Class Wise Timetable</a>
            <a hidden href="#" class="dropdown-item">Active Class Wise Timetable</a>
            <a hidden href="#" class="dropdown-item">Upload Staff Timetable</a>
            <a hidden href="#" class="dropdown-item">Active Staff Timetable</a>
        </div>

    </li>

    <li class="nav-item">
        <a class="nav-link" id="profile-tab5" data-toggle="dropdown" href="#profile5" ><i class="fa fa-file"></i> Reports <i class="fa fa-angle-down"></i></a>
        <div class="dropdown-menu navbar-menu-sub tx-11 pd-0 pd-t-5">
            <a href="#" class="dropdown-item">Class Wise Timetable Report</a>
        </div>

    </li>


    <li class="nav-item">
        <a class="nav-link" id="profile-tab5" data-toggle="dropdown" href="#profile5" ><i class="fa fa-thumb"></i> Master Setting <i class="fa fa-angle-down"></i></a>
        <div class="dropdown-menu navbar-menu-sub tx-11 pd-0 pd-t-5">
            <a href="{{url('MasterAdmin/Timetable/DefineTimetable')}}" class="dropdown-item">Define Timetable</a>
        </div>

    </li>

</ul>
