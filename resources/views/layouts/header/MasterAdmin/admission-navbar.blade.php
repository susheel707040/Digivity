<ul class="nav digishiksha-navbar-header nav-line tx-12" id="myTab5" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" href="{{route('admission.analytics')}}"><i
                class="fa fa-chart-line"></i> Admission Analytics</a>
    </li>

    <li class="nav-item">
        <a class="nav-link" id="profile-tab5" href="#"  data-toggle="dropdown"><i class="fa fa-user-plus"></i> Admission Entry
            <i class="fa fa-angle-down"></i></a>
        <div class="dropdown-menu navbar-menu-sub tx-11 pd-0 pd-t-5">
            <a href="{{url('MasterAdmin/StudentInformation/StudentRegistration')}}" class="dropdown-item">Student
                Admission</a>
            <a href="{{url('MasterAdmin/StudentInformation/ProspectusEntry')}}" class="dropdown-item">Prospectus
                Entry</a>
            <a href="{{url('MasterAdmin/StudentInformation/ImportStudentData')}}" class="dropdown-item">Import Student
                Data</a>

                {{-- Will work on future --}}
            {{-- <a href="{{url('MasterAdmin/StudentInformation/ModifyStudentDetails')}}" class="dropdown-item">Modify Student Details</a> --}}
        </div>

    </li>



    <li class="nav-item" hidden>
        <a class="nav-link" id="profile-tab5" href="#" data-toggle="dropdown"><i class="fa fa-user-plus"></i> STUDENT MERIT
            <i class="fa fa-angle-down"></i></a>
        <div class="dropdown-menu navbar-menu-sub tx-11 pd-0 pd-t-5">
            <a href="{{url('MasterAdmin/StudentInformation/StudentRegistration')}}" class="dropdown-item">STUDENT
                MERIT ENTRY</a>
            <a href="{{url('MasterAdmin/StudentInformation/ProspectusEntry')}}" class="dropdown-item">GENERATE MERIT LIST</a>
        </div>

    </li>

{{--will create new module in future for Student ID card --}}

    {{-- <li class="nav-item"> --}}
        {{-- <a class="nav-link" id="contact-tab5" href="#" data-toggle="dropdown"> <i class="fa fa-id-card"></i> --}}
            {{-- Student ID Card <i class="fa fa-angle-down"></i></a> --}}
        {{-- <div class="dropdown-menu navbar-menu-sub tx-11 pd-0 pd-t-5"> --}}
            {{-- <a href="{{url('MasterAdmin/StudentInformation/StudentIDCard')}}" class="dropdown-item">Generate Student Identity Card (ID Card) </a> --}}
        {{-- </div> --}}
    {{-- </li> --}}


    {{-- will create new module in future for Certificate --}}

    {{-- <li class="nav-item"> --}}
        {{-- <a class="nav-link" id="contact-tab5" href="#" data-toggle="dropdown" role="button" > <i class="fa fa-certificate"></i> --}}
            {{-- Certificate <i class="fa fa-angle-down"></i></a> --}}
        {{-- <div class="dropdown-menu dropright dropdown dropdown-submenu navbar-menu-sub tx-11 pd-0 pd-t-5"> --}}
            {{-- <a href="{{url('MasterAdmin/StudentInformation/GenerateCertificate')}}" class="dropdown-item">Generate --}}
                {{-- Certificate</a> --}}
            {{-- <a href="#" data-toggle="dropdown" class="dropdown-item dropdown-submenu">Transfer Certificate --}}
                {{-- <i class="fa fa-angle-right"></i> --}}
            {{-- </a> --}}
            {{-- <div class="dropdown-menu tx-11 pd-0 pd-t-5"> --}}
                {{-- @foreach(tccertificatelist() as $data) --}}
                {{-- <a href="{{url('MasterAdmin/StudentInformation/GenerateStudentTC/'.$data->id.'/index')}}" class="dropdown-item">{{ucwords($data->certificate_name)}}</a> --}}
                {{-- @endforeach --}}
            {{-- </div> --}}
            {{-- <a href="{{url('MasterAdmin/StudentInformation/CertificateReports')}}" class="dropdown-item">Certificate Report</a> --}}
        {{-- </div> --}}
    {{-- </li> --}}



    <li class="nav-item">
        <a class="nav-link" id="contact-tab5" href="#" data-toggle="dropdown"> <i class="fa fa-file-export"></i> Master Update
            <i class="fa fa-angle-down"></i></a>
        <div class="dropdown-menu navbar-menu-sub tx-11 pd-0 pd-t-5">
            <a href="{{url('MasterAdmin/StudentInformation/BulkUpdateStudent')}}" class="dropdown-item">Bulk Update Student Detail</a>
            <a hidden href="{{url('MasterAdmin/StudentInformation/StudentPossibleSiblings')}}" class="dropdown-item">Possible Siblings</a>
            <a hidden href="{{url('MasterAdmin/StudentInformation/BulkStudentClassPromotion')}}" class="dropdown-item">Bulk Student Class Promotion</a>
            <a href="{{url('MasterAdmin/StudentInformation/BulkUpdateStudentProfile')}}" class="dropdown-item">Show Student Profile Images</a>
            <a href="{{url('MasterAdmin/StudentInformation/BulkUpdateParentProfile')}}" class="dropdown-item">Show Parent/Guardian Profile Image</a>
            <a hidden href="{{url('MasterAdmin/StudentInformation/StudentChangeStatus')}}" class="dropdown-item">Student Active/Inactive Status</a>
            <a hidden href="{{url('MasterAdmin/StudentInformation/SessionTransfer')}}" class="dropdown-item">Session Transfer</a>
            <a href="{{url('MasterAdmin/StudentInformation/StudentDocumentUpdate')}}" class="dropdown-item">Student Document Attachment Update</a>
        </div>

    </li>


    <li class="nav-item">
        <a class="nav-link" id="contact-tab5" href="#" data-toggle="dropdown"> <i class="fa fa-file-export"></i> Reports
            <i class="fa fa-angle-down"></i></a>
        <div class="dropdown-menu navbar-menu-sub tx-11 pd-0 pd-t-5">
            <a href="{{url('MasterAdmin/StudentInformation/ClassWiseStudentList')}}" class="dropdown-item">Class Wise Student Detail</a>
            <a href="{{url('MasterAdmin/StudentInformation/StudentCredentials')}}" class="dropdown-item">Student Credentials Detail</a>
            <a hidden href="{{url('MasterAdmin/StudentInformation/SiblingWiseList')}}" class="dropdown-item">SIBLING WISE DETAILS</a>
            <a href="{{url('MasterAdmin/StudentInformation/InactiveStudentList')}}" class="dropdown-item">Inactive Student Details</a>
            <a hidden href="#" class="dropdown-item">STUDENT STRENGTH REPORTS <i class="fa fa-angle-right"></i></a>
            <a href="{{url('MasterAdmin/StudentInformation/ClassWiseStrength')}}" class="dropdown-item">Class-Section Wise Strength</a>
            <a href="{{url('MasterAdmin/StudentInformation/GenderWiseStrength')}}" class="dropdown-item">Gender Wise Strength</a>
            <a hidden href="{{url('MasterAdmin/StudentInformation/DateWiseAdmissionReport')}}" class="dropdown-item">Date Wise Admission Detail</a>
            <a hidden href="{{url('MasterAdmin/StudentInformation/StudentHouseWiseReport')}}" class="dropdown-item">Student House Wise Detail</a>
            <a href="{{url('MasterAdmin/StudentInformation/ProspectusReport')}}" class="dropdown-item">Prospectus Detail</a>
            <a hidden href="{{url('MasterAdmin/StudentInformation/')}}" class="dropdown-item">STUDENT REGISTER DATE WISE REPORT</a>
            <a hidden href="{{url('MasterAdmin/StudentInformation/ReligionWiseReport')}}" class="dropdown-item">STUDENT RELIGION WISE REPORT</a>
            <a hidden href="{{url('MasterAdmin/StudentInformation/AdmissionTypeWiseReport')}}" class="dropdown-item">ADMISSION TYPE WISE STUDENT REPORT</a>
            <a hidden href="{{url('MasterAdmin/StudentInformation/CategoryWiseReport')}}" class="dropdown-item">CATEGORY WISE STUDENT REPORT</a>
            <a hidden href="{{url('MasterAdmin/StudentInformation/SurnameWiseReport')}}" class="dropdown-item">SURNAME WISE STUDENT REPORT</a>
            <a hidden href="{{url('MasterAdmin/StudentInformation/ActiveStudentReport')}}" class="dropdown-item">ACTIVE/INACTIVE STUDENT REPORT</a>
            <a hidden href="{{url('MasterAdmin/StudentInformation/StaffWardReport')}}" class="dropdown-item">STAFF WARD LIST REPORT</a>
            <a hidden href="{{url('MasterAdmin/StudentInformation/DateWiseAdmissionMisReport')}}" class="dropdown-item">DATE WISE ADMISSION MIS REPORT</a>
            <a href="{{url('MasterAdmin/StudentInformation/StudentDocumentReport')}}" class="dropdown-item">Student Document Submitted Report</a>
            <a href="{{url('MasterAdmin/StudentInformation/StudentBirthdayList')}}" class="dropdown-item">Student Birthday Details</a>
        </div>
    </li>



    <li class="nav-item">
        <a class="nav-link" id="contact-tab5" href="#" data-toggle="dropdown"> <i class="fa fa-cogs"></i> Master Setting
            <i class="fa fa-angle-down"></i></a>
        <div class="dropdown-menu navbar-menu-sub tx-11 pd-0 pd-t-5">
            <a href="{{url('MasterAdmin/StudentInformation/DefineDocumentType')}}" class="dropdown-item">Define Document Type</a>
            <a hidden href="{{url('MasterAdmin/StudentInformation/DefineMeritCriteria')}}"class="dropdown-item">Define Merit Criteria</a>
        </div>
    </li>
</ul>
