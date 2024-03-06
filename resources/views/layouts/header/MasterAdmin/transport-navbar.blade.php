<ul class="nav digishiksha-navbar-header nav-line tx-12" id="myTab5" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" href="{{url('/MasterAdmin/Transport/index')}}"><i class="fa fa-chart-line"></i> Transport Analytics</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="profile-tab5" data-toggle="dropdown" href="#profile5" ><i class="fa fa-bus"></i> Transport Entry <i class="fa fa-angle-down"></i></a>
        <div class="dropdown-menu navbar-menu-sub tx-11 pd-0 pd-t-5">
            <a href="{{url('MasterAdmin/Transport/AssignTransportToStudent')}}" class="dropdown-item">Assign Student Transport</a>
            {{-- new added --}}
            <a href="{{url('MasterAdmin/Transport/BulkAssignTransportToStudent ')}}" class="dropdown-item"> Bulk Assign Transport</a>

            {{-- <a href="{{url('MasterAdmin/Transport/CourseWiseAssignTransport')}}" class="dropdown-item">Class/Course Wise Assign Transport</a> --}}
            {{-- <a href="{{url('MasterAdmin/Transport/AssignTransportToStaff')}}" class="dropdown-item">Assign Staff Transport</a> --}}
            <a href="{{url('MasterAdmin/Transport/ImportAssignTransportToStudent')}}" class="dropdown-item">Import Student Transport</a>
            {{-- <a href="{{url('MasterAdmin/Transport/ImportAssignTransportToStaff')}}" class="dropdown-item">Import Staff Transport</a> --}}
        </div>

    </li>
    <li class="nav-item">
        <a class="nav-link" id="contact-tab5" data-toggle="dropdown" href="#contact5"> <i class="fa fa-id-card"></i> Transport ID Card <i class="fa fa-angle-down"></i></a>
        <div class="dropdown-menu navbar-menu-sub tx-11 pd-0 pd-t-5">
            <a href="{{url('MasterAdmin/StudentInformation/StudentIDCard')}}" class="dropdown-item">Generate Student ID Card</a>
            <a href="#" class="dropdown-item">Generate Staff ID Card</a>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link" id="contact-tab5" data-toggle="dropdown" href="#contact5"> <i class="fa fa-file-export"></i> Reports <i class="fa fa-angle-down"></i></a>
        <div class="dropdown-menu navbar-menu-sub tx-11 pd-0 pd-t-5">
            <a href="{{url('MasterAdmin/Transport/StudentTransportReport')}}" class="dropdown-item">Student Transport Report</a>
            <a href="{{url('MasterAdmin/Transport/StudentSelfTransportReport')}}" class="dropdown-item">Student Self/Without Transport Report</a>
            <a href="{{url('MasterAdmin/Transport/ClassWiseTransportMisReport')}}" class="dropdown-item">Class/Course Wise Transport Mis Report</a>
            <a href="{{url('MasterAdmin/Transport/RouteWiseTransportMisReport')}}" class="dropdown-item">Route Wise Transport Mis Report</a>
            <a href="{{url('MasterAdmin/Transport/RouteStopWiseTransportMisReport')}}" class="dropdown-item">Route Stop Wise Transport Mis Report</a>
            <a href="{{url('MasterAdmin/Transport/DriverWiseTransportMisReport')}}" class="dropdown-item">Driver Wise Transport Mis Report</a>
            <a href="{{url('MasterAdmin/Transport/ClassAndRoundWiseTransportMisReport')}}" class="dropdown-item">Class/Course & Route Wise Transport Mis Report</a>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="contact-tab5" data-toggle="dropdown" href="#contact5"> <i class="fa fa-cogs"></i> Master Setting <i class="fa fa-angle-down"></i></a>
        <div class="dropdown-menu navbar-menu-sub tx-11 pd-0 pd-t-5">
            <a href="{{url('MasterAdmin/Transport/DefineVehicleType')}}" class="dropdown-item">Define Vehicle Type</a>
            <a href="{{url('MasterAdmin/Transport/DefineVehicle')}}" class="dropdown-item">Define Vehicle Details</a>
            <a href="{{url('MasterAdmin/Transport/DefineRoute')}}" class="dropdown-item">Define Route</a>
            <a href="{{url('MasterAdmin/Transport/DefineRouteStop')}}" class="dropdown-item">Define Route Stop</a>
            <a href="{{url('MasterAdmin/Transport/DefineTravelAgency')}}" class="dropdown-item">Define Travel Agency</a>
            <a href="{{url('MasterAdmin/Transport/DefineRouteRelation')}}" class="dropdown-item">Relations Route</a>
        </div>
    </li>
</ul>
