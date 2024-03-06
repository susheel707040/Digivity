<ul class="nav digishiksha-navbar-header nav-line tx-12" id="myTab5" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" href="{{url('/MasterAdmin/FrontOffice/index')}}"><i class="fa fa-chart-line"></i>Front Office Analytics</a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{url('MasterAdmin/FrontOffice/EntryEnquiry')}}" > <i class="fa fa-info"></i>Enquiry</a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{url('MasterAdmin/FrontOffice/EntryGatePass')}}" > <i class="fa fa-id-card"></i>Gate Pass</a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{url('MasterAdmin/FrontOffice/EntryVisitor')}}" ><i class="fa fa-id-badge"></i> Visitor Management </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" id="profile-tab5" data-toggle="dropdown" href="#profile5"><i class="fa fa-handshake"></i>Appointment Management <i class="fa fa-angle-down"></i></a>
        <div class="dropdown-menu navbar-menu-sub tx-11 pd-0 pd-t-5">
            <a href="{{url('MasterAdmin/FrontOffice/EntryAppointment')}}" class="dropdown-item">Entry Appointment</a>
            {{-- <a href="{{url('MasterAdmin/FrontOffice/ApproveOnlineAppointment')}}" class="dropdown-item">Approve Online Appointment</a> --}}
        </div>
    </li>

    {{-- <li class="nav-item">
        <a class="nav-link" href="{{url('MasterAdmin/FrontOffice/EntryComplaint')}}" ><i class="fa fa-pencil-alt"></i>Complaint </a>
    </li> --}}

    {{-- <li class="nav-item">
        <a class="nav-link" href="{{url('MasterAdmin/FrontOffice/EntryServiceRequest')}}" ><i class="fa fa-edit"></i>Service Request </a>
    </li> --}}

</ul>
