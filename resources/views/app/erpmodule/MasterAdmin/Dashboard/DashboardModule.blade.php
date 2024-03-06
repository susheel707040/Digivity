<div class="row tx-14 p-0 m-0">
    @php
        $height="45px";
    @endphp


    @if(array_key_exists("student-information",$module))
        <a href="{{url('/MasterAdmin/StudentInformation/index')}}">
            <div class="col-sm-2 pl-2 pb-2 pr-2">
                <div class="bg-white bd pd-10 pd-lg-10 mg-t-10 ht-sm-160 d-flex flex-column justify-content-end">
                    <div class="mg-t-5">
                        <img height="{{$height}}" src="{{url('/assets/MIcon/admission.png')}}">
                    </div>
                    <h5 class="tx-inverse mg-t-8 mg-b-5">Student Management</h5>
                    <p class="mg-t-0 tx-10 mg-b-1">Simplifies admission tracking, document submission and more.</p>
                    <a class="tx-medium">View Elements <i
                            class="icon ion-md-arrow-forward mg-l-5"></i></a>
                </div>
            </div>
        </a>
    @endif
    @if(array_key_exists("transport",$module))
        <a href="{{url('/MasterAdmin/Transport/index')}}">
            <div class="col-sm-2 pl-2 pb-2 pr-2">
                <div class="bg-white bd pd-10 pd-lg-10 mg-t-10 ht-sm-160 d-flex flex-column justify-content-end">
                    <div class="mg-t-5">
                        <img height="{{$height}}" src="{{url('/assets/MIcon/transport.png')}}">
                    </div>
                    <h5 class="tx-inverse mg-t-8 mg-b-5">Transport Management</h5>
                    <p class="mg-t-0 tx-10 mg-b-1">Enhance student safety, Tracking vehicle status.</p>
                    <a class="tx-medium">View Elements <i class="icon ion-md-arrow-forward mg-l-5"></i></a>
                </div>
            </div>
        </a>
    @endif
    @if(array_key_exists("attendance",$module))
        <a href="{{url('/MasterAdmin/Attendance/index')}}">
            <div class="col-sm-2 pl-2 pb-2 pr-2">
                <div class="bg-white bd pd-10 pd-lg-10 mg-t-10 ht-sm-160 d-flex flex-column justify-content-end">
                    <div class="mg-t-5">
                        <img height="{{$height}}" src="{{url('/assets/MIcon/attandance.png')}}">
                    </div>
                    <h5 class="tx-inverse mg-t-8 mg-b-5">Attendance</h5>
                    <p class="mg-t-0 tx-10 mg-b-1">Save time and effort, Easily mark the attendance.</p>
                    <a class="tx-medium">View Elements <i class="icon ion-md-arrow-forward mg-l-5"></i></a>
                </div>
            </div>
        </a>
    @endif

    @if(array_key_exists("time-table",$module))
        <a href="{{url('/MasterAdmin/Timetable/index')}}">
            <div class="col-sm-2 pl-2 pb-2 pr-2">
                <div class="bg-white bd pd-10 pd-lg-10 mg-t-10 ht-sm-160 d-flex flex-column justify-content-end">
                    <div class="mg-t-5">
                        <img height="{{$height}}" src="{{url('/assets/MIcon/timetable.png')}}">
                    </div>
                    <h5 class="tx-inverse mg-t-8 mg-b-5">Time Table</h5>
                    <p class="mg-t-0 tx-10 mg-b-1">Student Admission and Enquiry Information</p>
                    <a class="tx-medium">View Elements <i class="icon ion-md-arrow-forward mg-l-5"></i></a>
                </div>
            </div>
        </a>
    @endif

    @if(array_key_exists("communication",$module))
        <a href="{{url('/MasterAdmin/Communication/index')}}">
            <div class="col-sm-2 pl-2 pb-2 pr-2">
                <div class="bg-white bd pd-10 pd-lg-10 mg-t-10 ht-sm-160 d-flex flex-column justify-content-end">
                    <div class="mg-t-5">
                        <img height="{{$height}}" src="{{url('/assets/MIcon/communication.png')}}">
                    </div>
                    <h5 class="tx-inverse mg-t-8 mg-b-5">Communication</h5>
                    <p class="mg-t-0 tx-11 mg-b-1">Student Admission and Enquiry Information</p>
                    <a class="tx-medium">View Elements <i class="icon ion-md-arrow-forward mg-l-5"></i></a>
                </div>
            </div>
        </a>
    @endif

    @if(array_key_exists("app",$module))
        <a href="{{url('/MasterAdmin/App/index')}}">
            <div class="col-sm-2 pl-2 pb-2 pr-2">
                <div class="bg-white bd pd-10 pd-lg-10 mg-t-10 ht-sm-160 d-flex flex-column justify-content-end">
                    <div class="mg-t-5">
                        <img height="{{$height}}" src="{{url('/assets/MIcon/app.png')}}">
                    </div>
                    <h5 class="tx-inverse mg-t-8 mg-b-5">Homework</h5>
                    <p class="mg-t-0 tx-11 mg-b-1">Student Admission and Enquiry Information</p>
                    <a href="el-accordion.html" class="tx-medium">View Elements <i
                            class="icon ion-md-arrow-forward mg-l-5"></i></a>
                </div>
            </div>
        </a>
    @endif

    @if(array_key_exists("library",$module))
        <a href="{{url('/MasterAdmin/Library/index')}}">
            <div class="col-sm-2 pl-2 pb-2 pr-2">
                <div class="bg-white bd pd-10 pd-lg-10 mg-t-10 ht-sm-160 d-flex flex-column justify-content-end">
                    <div class="mg-t-5">
                        <img height="{{$height}}" src="{{url('/assets/MIcon/books.png')}}">
                    </div>
                    <h5 class="tx-inverse mg-t-8 mg-b-5">Library</h5>
                    <p class="mg-t-0 tx-11 mg-b-1">Student Admission and Enquiry Information</p>
                    <a href="el-accordion.html" class="tx-medium">View Elements <i
                            class="icon ion-md-arrow-forward mg-l-5"></i></a>
                </div>
            </div>
        </a>
    @endif

    @if(array_key_exists("stock-manager",$module))
        <a href="{{url('/MasterAdmin/StockManager/index')}}">
            <div class="col-sm-2 pl-2 pb-2 pr-2">
                <div class="bg-white bd pd-10 pd-lg-10 mg-t-10 ht-sm-160 d-flex flex-column justify-content-end">
                    <div class="mg-t-5">
                        <img height="{{$height}}" src="{{url('/assets/MIcon/stock1.png')}}">
                    </div>
                    <h5 class="tx-inverse mg-t-8 mg-b-5">Stock Manager</h5>
                    <p class="mg-t-0 tx-11 mg-b-1">Student Admission and Enquiry Information</p>
                    <a href="el-accordion.html" class="tx-medium">View Elements <i
                            class="icon ion-md-arrow-forward mg-l-5"></i></a>
                </div>
            </div>
        </a>
    @endif

    @if(array_key_exists("marks-manager",$module))
        <a href="{{url('/MasterAdmin/MarksManager/index')}}">
            <div class="col-sm-2 pl-2 pb-2 pr-2">
                <div class="bg-white bd pd-10 pd-lg-10 mg-t-10 ht-sm-160 d-flex flex-column justify-content-end">
                    <div class="mg-t-5">
                        <img height="{{$height}}" src="{{url('/assets/MIcon/exam.png')}}">
                    </div>
                    <h5 class="tx-inverse mg-t-8 mg-b-5">Marks Manager</h5>
                    <p class="mg-t-0 tx-11 mg-b-1">Student Admission and Enquiry Information</p>
                    <a href="el-accordion.html" class="tx-medium">View Elements <i
                            class="icon ion-md-arrow-forward mg-l-5"></i></a>
                </div>
            </div>
        </a>
    @endif


    @if(array_key_exists("employee/hr",$module))
        <a href="{{url('/MasterAdmin/Staff/index')}}">
            <div class="col-sm-2 pl-2 pb-2 pr-2">
                <div class="bg-white bd pd-10 pd-lg-10 mg-t-10 ht-sm-160 d-flex flex-column justify-content-end">
                    <div class="mg-t-5">
                        <img height="{{$height}}" src="{{url('/assets/MIcon/employee.png')}}">
                    </div>
                    <h5 class="tx-inverse mg-t-8 mg-b-5">Employee/Staff</h5>
                    <p class="mg-t-0 tx-11 mg-b-1">Student Admission and Enquiry Information</p>
                    <a href="el-accordion.html" class="tx-medium">View Elements <i
                            class="icon ion-md-arrow-forward mg-l-5"></i></a>
                </div>
            </div>
        </a>
    @endif

    @if(array_key_exists("finance/account",$module))
        <a href="{{url('/MasterAdmin/Finance/index')}}">
            <div class="col-sm-2 pl-2 pb-2 pr-2">
                <div class="bg-white bd pd-10 pd-lg-10 mg-t-10 ht-sm-160 d-flex flex-column justify-content-end">
                    <div class="mg-t-5">
                        <img height="{{$height}}" src="{{url('/assets/MIcon/account.png')}}">
                    </div>
                    <h5 class="tx-inverse mg-t-8 mg-b-5">Finance/Account</h5>
                    <p class="mg-t-0 tx-11 mg-b-1">Student Admission and Enquiry Information</p>
                    <a href="el-accordion.html" class="tx-medium">View Elements <i
                            class="icon ion-md-arrow-forward mg-l-5"></i></a>
                </div>
            </div>
        </a>
    @endif

    @if(array_key_exists("",$module))
        <a href="{{url('/MasterAdmin/Payroll/index')}}">
            <div class="col-sm-2 pl-2 pb-2 pr-2">
                <div class="bg-white bd pd-10 pd-lg-10 mg-t-10 ht-sm-160 d-flex flex-column justify-content-end">
                    <div class="mg-t-5">
                        <img height="{{$height}}" src="{{asset('/assets/MIcon/payroll.png')}}">
                    </div>
                    <h5 class="tx-inverse mg-t-8 mg-b-5">Payroll</h5>
                    <p class="mg-t-0 tx-11 mg-b-1">Student Admission and Enquiry Information</p>
                    <a href="el-accordion.html" class="tx-medium">View Elements <i
                            class="icon ion-md-arrow-forward mg-l-5"></i></a>
                </div>
            </div>
        </a>
    @endif

    @if(array_key_exists("front-office",$module))
        <a href="{{url('/MasterAdmin/FrontOffice/index')}}">
            <div class="col-sm-2 pl-2 pb-2 pr-2">
                <div class="bg-white bd pd-10 pd-lg-10 mg-t-10 ht-sm-160 d-flex flex-column justify-content-end">
                    <div class="mg-t-5">
                        <img height="{{$height}}" src="{{url('/assets/MIcon/front_office.png')}}">
                    </div>
                    <h5 class="tx-inverse mg-t-8 mg-b-5">Front Office</h5>
                    <p class="mg-t-0 tx-11 mg-b-1">Student Admission and Enquiry Information</p>
                    <a href="el-accordion.html" class="tx-medium">View Elements <i
                            class="icon ion-md-arrow-forward mg-l-5"></i></a>
                </div>
            </div>
        </a>
    @endif

    @if(array_key_exists("reports",$module))
        <a href="{{url('/MasterAdmin/Reports/index')}}">
            <div class="col-sm-2 pl-2 pb-2 pr-2">
                <div class="bg-white bd pd-10 pd-lg-10 mg-t-10 ht-sm-160 d-flex flex-column justify-content-end">
                    <div class="mg-t-5">
                        <img height="{{$height}}" src="{{url('/assets/MIcon/reports.png')}}">
                    </div>
                    <h5 class="tx-inverse mg-t-8 mg-b-5">Reports</h5>
                    <p class="mg-t-0 tx-11 mg-b-1">Student Admission and Enquiry Information</p>
                    <a href="el-accordion.html" class="tx-medium">View Elements <i
                            class="icon ion-md-arrow-forward mg-l-5"></i></a>
                </div>
            </div>
        </a>
    @endif

    @if(array_key_exists("mobile-app",$module))
        <a href="{{url('/MasterAdmin/MobileApp/index')}}">
            <div class="col-sm-2 pl-2 pb-2 pr-2">
                <div class="bg-white bd pd-10 pd-lg-10 mg-t-10 ht-sm-160 d-flex flex-column justify-content-end">
                    <div class="mg-t-5">
                        <img height="{{$height}}" src="{{url('/assets/MIcon/mobile_app.png')}}">
                    </div>
                    <h5 class="tx-inverse mg-t-8 mg-b-5">Mobile App</h5>
                    <p class="mg-t-0 tx-11 mg-b-1">Student Admission and Enquiry Information</p>
                    <a href="el-accordion.html" class="tx-medium">View Elements <i
                            class="icon ion-md-arrow-forward mg-l-5"></i></a>
                </div>
            </div>
        </a>
    @endif

    @if(array_key_exists("website",$module))
        <a href="{{url('/MasterAdmin/Website/index')}}">
            <div class="col-sm-2 pl-2 pb-2 pr-2">
                <div class="bg-white bd pd-10 pd-lg-10 mg-t-10 ht-sm-160 d-flex flex-column justify-content-end">
                    <div class="mg-t-5">
                        <img height="{{$height}}" src="{{url('/assets/MIcon/website.png')}}">
                    </div>
                    <h5 class="tx-inverse mg-t-8 mg-b-5">Website</h5>
                    <p class="mg-t-0 tx-11 mg-b-1">Student Admission and Enquiry Information</p>
                    <a href="el-accordion.html" class="tx-medium">View Elements <i
                            class="icon ion-md-arrow-forward mg-l-5"></i></a>
                </div>
            </div>
        </a>
    @endif

    @if(array_key_exists("user-management",$module))
        <a href="{{url('/MasterAdmin/User/index')}}">
            <div class="col-sm-2 pl-2 pb-2 pr-2">
                <div class="bg-white bd pd-10 pd-lg-10 mg-t-10 ht-sm-160 d-flex flex-column justify-content-end">
                    <div class="mg-t-5">
                        <img height="{{$height}}" src="{{url('/assets/MIcon/user.png')}}">
                    </div>
                    <h5 class="tx-inverse mg-t-8 mg-b-5">User Management</h5>
                    <p class="mg-t-0 tx-11 mg-b-1">Student Admission and Enquiry Information</p>
                    <a href="el-accordion.html" class="tx-medium">View Elements <i
                            class="icon ion-md-arrow-forward mg-l-5"></i></a>
                </div>
            </div>
        </a>
    @endif

    @if(array_key_exists("global-setting",$module))
        <a href="{{url('/MasterAdmin/GlobalSetting/index')}}">
            <div class="col-sm-2 pl-2 pb-2 pr-2">
                <div class="bg-white bd pd-10 pd-lg-10 mg-t-10 ht-sm-160 d-flex flex-column justify-content-end">
                    <div class="mg-t-5">
                        <img height="{{$height}}" src="{{url('/assets/MIcon/global_setting.png')}}">
                    </div>
                    <h5 class="tx-inverse mg-t-8 mg-b-5">Global Setting</h5>
                    <p class="mg-t-0 tx-11 mg-b-1">Student Admission and Enquiry Information</p>
                    <a href="el-accordion.html" class="tx-medium">View Elements <i
                            class="icon ion-md-arrow-forward mg-l-5"></i></a>
                </div>
            </div>
        </a>
    @endif

</div>
