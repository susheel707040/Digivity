<ul class="nav digishiksha-navbar-header nav-line tx-12" id="myTab5" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" href="{{url('/MasterAdmin/Staff/index')}}"><i
                class="fa fa-chart-line"></i> Employee/Staff Analytics</a>
    </li>


    <li class="nav-item">
        <a class="nav-link" id="profile-tab5" href="#" data-toggle="dropdown"><i class="fa fa-user-plus"></i> Employee Entry
            <i class="fa fa-angle-down"></i></a>
        <div class="dropdown-menu navbar-menu-sub tx-11 pd-0 pd-t-5">
            <a href="{{url('MasterAdmin/Staff/StaffRegistration')}}" class="dropdown-item">Employee/Staff Registration</a>
            <a  href="{{url('MasterAdmin/Staff/StaffImport')}}" class="dropdown-item">Import Employee/Staff Data</a>
            {{-- <a href="{{url('MasterAdmin/Staff/AssignTransportToStaff')}}" class="dropdown-item">Assign Transport to Employee/Staff</a> --}}
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link" id="contact-tab5" href="#" data-toggle="dropdown"> <i class="fa fa-file-export"></i> Master Update
            <i class="fa fa-angle-down"></i></a>
        <div class="dropdown-menu navbar-menu-sub tx-11 pd-0 pd-t-5">
            <a href="{{url('MasterAdmin/Staff/StaffProfileImageUpdate')}}" class="dropdown-item">Update Staff/Employee Profile Image</a>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link" id="contact-tab5" href="#" data-toggle="dropdown"> <i class="fa fa-file-export"></i> Reports
            <i class="fa fa-angle-down"></i></a>
        <div class="dropdown-menu navbar-menu-sub tx-11 pd-0 pd-t-5">
            <a href="{{url('MasterAdmin/Staff/StaffList')}}" class="dropdown-item">Staff/Employee Report</a>
            <a href="{{url('MasterAdmin/Staff/StaffCredentialsReport')}}" class="dropdown-item">Staff/Employee Credentials Report</a>
        </div>
    </li>


    <li class="nav-item">
        <a class="nav-link" id="contact-tab5" href="#" data-toggle="dropdown"> <i class="fa fa-cogs"></i> Master Setting
            <i class="fa fa-angle-down"></i></a>
        <div class="dropdown-menu navbar-menu-sub tx-11 pd-0 pd-t-5">
            <a href="{{url('MasterAdmin/Staff/DefineProfessionType')}}" class="dropdown-item">Define Profession Type</a>
            <a href="{{url('MasterAdmin/Staff/DefineStaffType')}}" class="dropdown-item">Define Staff Type</a>
            <a href="{{url('MasterAdmin/Staff/DefineDepartment')}}" class="dropdown-item">Define Department</a>
            <a href="{{url('MasterAdmin/Staff/DefineDesignation')}}" class="dropdown-item">Define Designation</a>
            <a href="{{url('MasterAdmin/Staff/DefineQualification')}}" class="dropdown-item">Define Staff Qualification</a>
            <a href="{{url('MasterAdmin/Staff/DefineDocument')}}" class="dropdown-item">Define Upload Document</a>
            <a href="{{url('MasterAdmin/Staff/DefineSkillAndKnowledge')}}" class="dropdown-item">Define Staff Skill & Knowledge</a>
            {{-- <a href="#" class="dropdown-item">Staff/Employee Setting</a> --}}
        </div>
    </li>
</ul>
