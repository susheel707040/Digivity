<ul class="nav digishiksha-navbar-header nav-line tx-12" id="myTab5" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" href="{{url('/MasterAdmin/User/index')}}"><i class="fa fa-chart-line"></i> User Management Analytics</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{url('/MasterAdmin/User/CreateUser')}}"><i class="fa fa-user-plus"></i> Create User</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{url('/MasterAdmin/User/UserPermission')}}"><i class="fa fa-user-plus"></i> User Permission</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{url('/MasterAdmin/User/UserRole')}}"><i class="fa fa-user-plus"></i> User Role</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="contact-tab5" data-toggle="dropdown" href="#contact5"> <i class="fa fa-cogs"></i> Reports <i class="fa fa-angle-down"></i></a>
        <div class="dropdown-menu navbar-menu-sub tx-11 pd-0 pd-t-5">
            <a href="{{url('MasterAdmin/User/UserList')}}" class="dropdown-item">User List</a>
            <a href="{{url('MasterAdmin/User/AppUseReport')}}" class="dropdown-item">App User Report</a>
            <a href="{{url('MasterAdmin/User/UserLogHistory')}}" class="dropdown-item">User Log History Report</a>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="contact-tab5" data-toggle="dropdown" href="#contact5"> <i class="fa fa-cogs"></i> Master Setting <i class="fa fa-angle-down"></i></a>
        <div class="dropdown-menu navbar-menu-sub tx-11 pd-0 pd-t-5">
            <a href="{{url('MasterAdmin/User/DefineRole')}}" class="dropdown-item">Define Role</a>
            <a href="{{url('MasterAdmin/User/UserSetting')}}" class="dropdown-item">User Setting</a>
            <a href="{{url('MasterAdmin/User/CreateRole')}}" class="dropdown-item">Add Role</a>

        </div>
    </li>
</ul>
