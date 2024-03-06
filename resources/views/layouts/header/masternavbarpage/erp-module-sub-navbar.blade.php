<div class="navbar-menu-sub">
    <div class="d-lg-flex">
        <ul class="mx-wd-200">

            @if(array_key_exists("student-information",$module))
                <a href="{{url('/MasterAdmin/StudentInformation/index')}}">
                    <li class="nav-sub-item pd-t-2 pd-b-5 erp-table">
                        <table >
                            <tr>
                                <td rowspan="2"  class="pd-r-10">
                                    <img height="50x" class="erp-module-nav-img" src="{{url('assets/MIcon/admission.png')}}" >
                                </td>
                                <td>Student Management </td>
                            </tr>
                            <tr>
                                <td><p class="mg-t-0 tx-9 text-gray mg-b-1">Simplifies admission tracking, document submission, batch allotment, and more.</p></td>
                            </tr>
                        </table>
                    </li>
                </a>
            @endif
            @if(array_key_exists("time-table",$module))
                <a href="{{url('/MasterAdmin/Timetable/index')}}">
                    <li class="nav-sub-item erp-table pd-t-5 pd-b-5 mg-t-10 ">
                        <table >
                            <tr>
                                <td rowspan="2" class="pd-r-10">
                                    <img height="45x" class="erp-module-nav-img" src="{{url('/assets/MIcon/timetable.png')}}">
                                </td>
                                <td>Timetable </td>
                            </tr>
                            <tr>
                                <td><p class="mg-t-0 tx-9 text-gray mg-b-1">Student Admission and Enquiry Information</p></td>
                            </tr>
                        </table>
                    </li>
                </a>
                @endif

                @if(array_key_exists("library",$module))
                    <a href="{{url('/MasterAdmin/Library/index')}}">
                        <li class="nav-sub-item erp-table pd-t-5 pd-b-5 mg-t-10">
                            <table >
                                <tr>
                                    <td rowspan="2" class="pd-r-10"><img height="45x" class="erp-module-nav-img"
                                                                         src="{{url('/assets/MIcon/books.png')}}">
                                    </td>
                                    <td>Library </td>
                                </tr>
                                <tr>
                                    <td><p class="mg-t-0 tx-9 text-gray mg-b-1">Collection of sources of information and similar resources</p>
                                    </td>
                                </tr>
                            </table>
                        </li>
                    </a>
                @endif

                @if(array_key_exists("employee/hr",$module))
                    <a href="{{url('/MasterAdmin/Staff/index')}}">
                        <li class="nav-sub-item erp-table pd-t-5 pd-b-5 mg-t-10">
                            <table >
                                <tr>
                                    <td rowspan="2" class="pd-r-10"><img height="45x" class="erp-module-nav-img"
                                                                         src="{{url('/assets/MIcon/employee.png')}}">
                                    </td>
                                    <td>Employee/HR </td>
                                </tr>
                                <tr>
                                    <td><p class="mg-t-0 tx-9 text-gray mg-b-1">Organise employees details, Manage Payroll of employees</p>
                                    </td>
                                </tr>
                            </table>
                        </li>
                    </a>
                @endif

                @if(array_key_exists("reports",$module))
                    <a href="{{url('/MasterAdmin/FrontOffice/index')}}">
                        <li class="nav-sub-item erp-table pd-t-5 pd-b-5 mg-t-10">
                            <table>
                                <tr>
                                    <td rowspan="2" class="pd-r-10"><img height="45x" class="erp-module-nav-img"
                                                                         src="{{url('/assets/MIcon/front_office.png')}}">
                                    </td>
                                    <td>Front Office </td>
                                </tr>
                                <tr>
                                    <td><p class="mg-t-0 tx-9 text-gray mg-b-1">Student Admission and Enquiry Information</p>
                                    </td>
                                </tr>
                            </table>
                        </li>
                    </a>
                    @endif

                @if(array_key_exists("global-setting",$module))
                    <a href="{{url('/MasterAdmin/Website/index')}}">
                        <li class="nav-sub-item erp-table pd-t-5 pd-b-5 mg-t-10">
                            <table  >
                                <tr>
                                    <td rowspan="2" class="pd-r-10"><img height="45x" class="erp-module-nav-img"
                                                                         src="{{url('/assets/MIcon/website.png')}}">
                                    </td>
                                    <td>Website </td>
                                </tr>
                                <tr>
                                    <td><p class="mg-t-0 tx-9 text-gray mg-b-1">Student Admission and Enquiry Information</p></td>
                                </tr>
                            </table>
                        </li>
                    </a>
                @endif

        </ul>


        <ul class="mx-wd-250">
            @if(array_key_exists("transport",$module))
            <a href="{{url('/MasterAdmin/Transport/index')}}">
                <li class="nav-sub-item erp-table pd-t-5 pd-b-5">
                    <table  >
                        <tr>
                            <td rowspan="2" class="pd-r-10"><img height="45x" class="erp-module-nav-img"
                                                                 src="{{url('/assets/MIcon/transport.png')}}"></td>
                            <td>Transport Management</td>
                        </tr>
                        <tr>
                            <td><p class="mg-t-0 tx-9 text-gray mg-b-1">Enhance student safety, Tracking vehicle status.</p></td>
                        </tr>
                    </table>
                </li>
            </a>
            @endif

                @if(array_key_exists("communication",$module))
            <a href="{{url('/MasterAdmin/Communication/index')}}">
                <li class="nav-sub-item erp-table pd-t-5 pd-b-5 mg-t-10">
                    <table  >
                        <tr>
                            <td rowspan="2" class="pd-r-10"><img height="45x" class="erp-module-nav-img"
                                                                 src="{{url('/assets/MIcon/communication.png')}}">
                            </td>
                            <td>Communication </td>
                        </tr>
                        <tr>
                            <td><p class="mg-t-0 tx-9 text-gray mg-b-1">Send Instant Alerts, Enhance Communication and Reduce Workload</p></td>
                        </tr>
                    </table>
                </li>
            </a>
                @endif

                @if(array_key_exists("stock-manager",$module))
            <a href="{{url('/MasterAdmin/StockManager/index')}}">
                <li class="nav-sub-item erp-table pd-t-5 pd-b-5 mg-t-10">
                    <table  >
                        <tr>
                            <td rowspan="2" class="pd-r-10"><img height="45x" class="erp-module-nav-img"
                                                                 src="{{url('/assets/MIcon/stock1.png')}}"></td>
                            <td>Stock Manager </td>
                        </tr>
                        <tr>
                            <td><p class="mg-t-0 tx-9 text-gray mg-b-1">Student Admission and Enquiry Information</p></td>
                        </tr>
                    </table>
                </li>
            </a>
                @endif

                @if(array_key_exists("finance/account",$module))
            <a href="{{url('/MasterAdmin/Finance/index')}}">
                <li class="nav-sub-item erp-table pd-t-5 pd-b-5 mg-t-10">
                    <table  >
                        <tr>
                            <td rowspan="2" class="pd-r-10"><img height="45x" class="erp-module-nav-img"
                                                                 src="{{url('/assets/MIcon/account.png')}}"></td>
                            <td>Finance/Account </td>
                        </tr>
                        <tr>
                            <td><p class="mg-t-0 tx-9 text-gray mg-b-1">Automatic fee collection, Imply fine on late fees, add instant discounts, and monitor fee defaulters.</p></td>
                        </tr>
                    </table>
                </li>
            </a>
                @endif

                @if(array_key_exists("reports",$module))
                    <a href="{{url('/MasterAdmin/reports/index')}}">
                        <li class="nav-sub-item erp-table pd-t-5 pd-b-5 mg-t-10">
                            <table  >
                                <tr>
                                    <td rowspan="2" class="pd-r-10"><img height="45x" class="erp-module-nav-img"
                                                                         src="{{url('/assets/MIcon/reports.png')}}">
                                    </td>
                                    <td>Reports </td>
                                </tr>
                                <tr>
                                    <td><p class="mg-t-0 tx-9 text-gray mg-b-1">Student Admission and Enquiry Information</p>
                                    </td>
                                </tr>
                            </table>
                        </li>
                    </a>
                @endif

                @if(array_key_exists("global-setting",$module))
                    <a href="{{url('/MasterAdmin/User/index')}}">
                        <li class="nav-sub-item erp-table pd-t-5 pd-b-5 mg-t-10">
                            <table  >
                                <tr>
                                    <td rowspan="2" class="pd-r-10"><img height="45x" class="erp-module-nav-img" src="{{url('/assets/MIcon/user.png')}}">
                                    </td>
                                    <td>User Management </td>
                                </tr>
                                <tr>
                                    <td><p class="mg-t-0 tx-9 text-gray mg-b-1">Edit User Details, Reset the password and Manage Privileges</p></td>
                                </tr>
                            </table>
                        </li>
                    </a>
                @endif
        </ul>


        <ul class="mx-wd-250">
            @if(array_key_exists("attendance",$module))
            <a href="{{url('/MasterAdmin/Attendance/index')}}">
                <li class="nav-sub-item line erp-table pd-t-5 pd-b-5">
                    <table  >
                        <tr>
                            <td rowspan="2" class="pd-r-10"><img height="45x" class="erp-module-nav-img"
                                                                 src="{{url('/assets/MIcon/attandance.png')}}"></td>
                            <td>Attendance </td>
                        </tr>
                        <tr>
                            <td><p class="mg-t-0 tx-9 text-gray mg-b-1">Save time and effort, Easily mark the attendance.</p></td>
                        </tr>
                    </table>
                </li>
            </a>
            @endif

                @if(array_key_exists("app",$module))
            <a href="{{url('/MasterAdmin/App/index')}}">
                <li class="nav-sub-item erp-table pd-t-5 pd-b-5 mg-t-10">
                    <table  >
                        <tr>
                            <td rowspan="2" class="pd-r-10"><img height="45x" class="erp-module-nav-img" src="{{url('/assets/MIcon/app.png')}}">
                            </td>
                            <td>In App Admin </td>
                        </tr>
                        <tr>
                            <td><p class="mg-t-0 tx-9 text-gray mg-b-1">Apps in your brand for parents, teachers & students.</p></td>
                        </tr>
                    </table>
                </li>
            </a>
                @endif

                @if(array_key_exists("marks-manager",$module))
            <a href="{{url('/MasterAdmin/MarksManager/index')}}">
                <li class="nav-sub-item erp-table pd-t-5 pd-b-5 mg-t-10">
                    <table  >
                        <tr>
                            <td rowspan="2" class="pd-r-10"><img height="45x" class="erp-module-nav-img" src="{{url('/assets/MIcon/exam.png')}}">
                            </td>
                            <td>Marks Manager </td>
                        </tr>
                        <tr>
                            <td><p class="mg-t-0 tx-9 text-gray mg-b-1">Student Admission and Enquiry Information</p></td>
                        </tr>
                    </table>
                </li>
            </a>
                @endif

                @if(array_key_exists("payroll",$module))
            <a href="#">
                <li class="nav-sub-item erp-table pd-t-5 pd-b-5 mg-t-10">
                    <table  >
                        <tr>
                            <td rowspan="2" class="pd-r-10"><img height="45x" class="erp-module-nav-img"
                                                                 src="{{url('/assets/MIcon/payroll.png')}}"></td>
                            <td>Payroll </td>
                        </tr>
                        <tr>
                            <td><p class="mg-t-0 tx-9 text-gray mg-b-1">Student Admission and Enquiry Information</p></td>
                        </tr>
                    </table>
                </li>
            </a>
                @endif


                @if(array_key_exists("mobile-app",$module))
                    <a href="{{url('/MasterAdmin/MobileApp/index')}}">
                        <li class="nav-sub-item erp-table pd-t-5 pd-b-5 mg-t-10">
                            <table  >
                                <tr>
                                    <td rowspan="2" class="pd-r-10"><img height="45x" class="erp-module-nav-img"
                                                                         src="{{url('/assets/MIcon/mobile_app.png')}}"></td>
                                    <td>Mobile App </td>
                                </tr>
                                <tr>
                                    <td><p class="mg-t-0 tx-9 text-gray mg-b-1">Student Admission and Enquiry Information</p></td>
                                </tr>
                            </table>
                        </li>
                    </a>
                @endif

                @if(array_key_exists("global-setting",$module))
            <a href="{{url('/MasterAdmin/GlobalSetting/index')}}">
                <li class="nav-sub-item erp-table pd-t-5 pd-b-5 mg-t-10">
                    <table  >
                        <tr>
                            <td rowspan="2" class="pd-r-10"><img height="45x" class="erp-module-nav-img"
                                                                 src="{{url('/assets/MIcon/global_setting.png')}}">
                            </td>
                            <td>Global Setting </td>
                        </tr>
                        <tr>
                            <td><p class="mg-t-0 tx-9 text-gray mg-b-1">Setting for the Administration action</p></td>
                        </tr>
                    </table>
                </li>
            </a>
                    @endif

        </ul>

    </div>
</div>
