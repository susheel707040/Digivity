<ul class="nav digishiksha-navbar-header nav-line tx-12" id="myTab5" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" href="{{url('/MasterAdmin/Library/index')}}"><i class="fa fa-chart-line"></i> Library Analytics</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="profile-tab5" data-toggle="dropdown" href="#profile5" ><i class="fa fa-plus"></i> Library Entry <i class="fa fa-angle-down"></i></a>
        <div class="dropdown-menu navbar-menu-sub tx-11 pd-0 pd-t-5">
            <a href="{{url('MasterAdmin/Library/IssueBook')}}" class="dropdown-item"> Issue Book/Item Entry</a>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link" id="profile-tab5" data-toggle="dropdown" href="#profile5" ><i class="fa fa-file-pdf"></i> Reports <i class="fa fa-angle-down"></i></a>
        <div class="dropdown-menu navbar-menu-sub tx-11 pd-0 pd-t-5">
            <a href="{{route('daily.entry.report')}}" class="dropdown-item"> Daily Entry Report</a>
            <a href="{{url('MasterAdmin/Attendance/StaffMarkAttendance')}}" class="dropdown-item" fhidden> Books/Item Report</a>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="profile-tab5" data-toggle="dropdown" href="#profile5" ><i class="fa fa-book"></i> Manage Books/Items <i class="fa fa-angle-down"></i></a>
        <div class="dropdown-menu navbar-menu-sub tx-11 pd-0 pd-t-5">
            <a href="{{url('MasterAdmin/Library/DefineBooks')}}" class="dropdown-item"> Define Books</a>
            <a href="{{url('MasterAdmin/Library/CreateNewBook')}}" class="dropdown-item"> Add New Book/Item</a>
            <a href="{{url('MasterAdmin/Library/ImportBulkBook')}}" class="dropdown-item"> Import Book/Item</a>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="contact-tab5" data-toggle="dropdown" href="#contact5"> <i class="fa fa-cogs"></i> Master Setting <i class="fa fa-angle-down"></i></a>
        <div class="dropdown-menu navbar-menu-sub tx-11 pd-0 pd-t-5">
            <a href="{{url('MasterAdmin/Library/DefineLibrary')}}" class="dropdown-item"> Define Library</a>
            <a href="{{url('MasterAdmin/Library/DefineItemCategory')}}" class="dropdown-item"> Define Item Category</a>
            <a href="{{url('MasterAdmin/Library/DefineRacks')}}" class="dropdown-item"> Define Racks</a>
            <a href="{{url('MasterAdmin/Library/DefineAuthor')}}" class="dropdown-item"> Define Author</a>
            <a href="{{url('MasterAdmin/Library/DefineTag')}}" class="dropdown-item"> Define Tag</a>
            <a href="{{url('MasterAdmin/Library/DefineGenres')}}" class="dropdown-item"> Define Genres</a>
            <a hidden href="{{url('MasterAdmin/Library/LibraryConfiguration')}}" class="dropdown-item"> Library Configuration</a>
        </div>
    </li>
</ul>
