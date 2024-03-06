<header class="navbar navbar-header navbar-header-fixed">
    <a href="#" id="mainMenuOpen" class="burger-menu"><i data-feather="menu"></i></a>
    <div class="navbar-brand">
        <a href="../../dashboard" class="df-logo">
        <img src="{{url('assets/image/logo.jpeg')}}" alt="" height="50px" width="50px"></a>
        @if(isset(Auth::user()->branches))
        <table>
            <tr>
                <td class="align-middle pd-l-5"><div class="tx-14 wd-200 overflow-hidden" style="color:{{Auth::user()->branches->color}}; line-height:1;  "><b>{{Auth::user()->branches->school_name}}</b></div>
                    <div class="tx-9 wd-200 overflow-hidden" style="color:{{Auth::user()->branches->ads_color}}; ">{{Auth::user()->branches->address}}</div>
                </td>
            </tr>
        </table>
        @endif
    </div>
    <div id="navbarMenu" class="navbar-menu-wrapper">
        <div class="navbar-menu-header">
        <a href="../../index.html" class="df-logo">
        <img src="{{url('assets/image/logo.jpeg')}}" alt="" height="50px" width="50px"></a>
       <a id="mainMenuClose" href=""><i data-feather="x"></i></a>
        </div>

        <ul class="nav navbar-menu">
            <li class="nav-label pd-l-20 pd-lg-l-25 d-lg-none">Main Navigation</li>

            <div class="vl mx-3"></div>

            <li class="nav-item with-sub">
                <a href="#" class="nav-link"><i class="fa fa-cubes mg-r-2" style="font-size:15px"></i> ERP MODULE</a>
                @include('layouts.header.masternavbarpage.erp-module-sub-navbar')
            </li>
            <div class="vl mx-3"></div>

            @if(auth()->user()->role_id==1)
                <li class="nav-item with-sub ">
                    <a href="#" class="nav-link"><i class="fa fa-cog mg-r-2"></i>SCHOOL SETTING</a>
                    <div class="navbar-menu-sub">
                        <div class="d-lg-flex">
                            <ul>
                            <li class="nav-label mg-t-10">School Setting</li>
                                <li class="nav-sub-item"><a href="{{url('/MasterAdmin/GlobalSetting/SchoolInfo')}}" class="a nav-sub-link"><i class="fa fa-cog"></i> School Information</a></li>
                                <li class="nav-sub-item"><a href="{{url('/MasterAdmin/GlobalSetting/FormAutoIncrementConfiguration')}}" class="a nav-sub-link"><i class="fa fa-cog"></i> All Form No. Auto Increment Configuration</a></li>
                                <li class="nav-sub-item"><a href="{{url('/MasterAdmin/GlobalSetting/SchoolBoard')}}" class="a nav-sub-link"><i class="fa fa-cog"></i> Define School Board</a></li>
                                <li class="nav-sub-item"><a href="{{url('/MasterAdmin/GlobalSetting/AcademicYear')}}" class="a nav-sub-link"><i class="fa fa-cog"></i> Define Academic Year</a></li>
                                <li class="nav-sub-item"><a href="{{url('/MasterAdmin/GlobalSetting/FinancialYear')}}" class="a nav-sub-link"><i class="fa fa-cog"></i> Define Financial Year</a></li>
                                <li class="nav-sub-item"><a href="{{url('/MasterAdmin/GlobalSetting/AdmissionIsNewStatus')}}" class="a nav-sub-link"><i class="fa fa-cog"></i> Define Admission Is New Status</a></li>
                                <li class="nav-sub-item"><a href="{{url('/MasterAdmin/GlobalSetting/UserMapWithModule')}}" class="a nav-sub-link"><i class="fa fa-cog"></i> Administration Map with Module</a></li>
                                <li class="nav-sub-item"><a href="{{url('/MasterAdmin/GlobalSetting/SessionTransfer')}}" class="nav-sub-link"><i class="fa fa-cog"></i> Session Transfer</a></li>
                                <li class="nav-label mg-t-10">Academic Setting</li>
                                <li class="nav-sub-item"><a href="{{url('/MasterAdmin/GlobalSetting/DefineWing')}}" class="nav-sub-link"><i data-feather="user"></i> Define Wing</a></li>
                                <li class="nav-sub-item"><a href="{{url('/MasterAdmin/GlobalSetting/DefineClass')}}" class="nav-sub-link"><i data-feather="users"></i> Define Class/Course</a></li>
                                <li class="nav-sub-item"><a href="{{url('/MasterAdmin/GlobalSetting/DefineSection')}}" class="nav-sub-link"><i data-feather="users"></i> Define Section</a></li>

                            </ul>

                            <ul class="wd-250">
                                <li class="nav-sub-item mg-t-20"><a href="{{url('/MasterAdmin/GlobalSetting/MapClassWithSection')}}" class="nav-sub-link"><i data-feather="calendar"></i> Map Class with Section</a></li>
                                <li class="nav-sub-item"><a href="{{url('/MasterAdmin/GlobalSetting/DefineStream')}}" class="nav-sub-link"><i data-feather="users"></i> Define Stream</a></li>
                                <li class="nav-sub-item"><a href="{{url('/MasterAdmin/GlobalSetting/DefineNationality')}}" class="nav-sub-link"><i data-feather="calendar"></i> Define Nationality</a></li>
                                <li class="nav-sub-item"><a href="{{url('/MasterAdmin/GlobalSetting/DefineReligion')}}" class="nav-sub-link"><i data-feather="calendar"></i> Define Religion</a></li>
                                <li class="nav-sub-item"><a href="{{url('/MasterAdmin/GlobalSetting/DefineCategory')}}" class="nav-sub-link"><i data-feather="calendar"></i> Define Category</a></li>
                                <li class="nav-sub-item"><a href="{{url('/MasterAdmin/GlobalSetting/DefineCaste')}}" class="nav-sub-link"><i data-feather="calendar"></i> Define Caste</a></li>
                                <li class="nav-sub-item"><a href="{{url('/MasterAdmin/GlobalSetting/DefineParish')}}" class="nav-sub-link"><i data-feather="calendar"></i> Define Parish</a></li>
                                <li class="nav-sub-item"><a href="{{url('/MasterAdmin/GlobalSetting/DefineAdmissionType')}}" class="nav-sub-link"><i data-feather="calendar"></i> Define Admission Type</a></li>
                                <li class="nav-sub-item"><a href="{{url('/MasterAdmin/GlobalSetting/DefineHouse')}}" class="nav-sub-link"><i data-feather="calendar"></i> Define House</a></li>
                                <li class="nav-sub-item"><a href="{{url('/MasterAdmin/GlobalSetting/DefineParentStatus')}}" class="nav-sub-link"><i data-feather="calendar"></i> Define Parents Status</a></li>
                                <li class="nav-sub-item"><a href="{{url('/MasterAdmin/GlobalSetting/DefineSubject')}}" class="nav-sub-link"><i data-feather="calendar"></i> Define Subject</a></li>
                                <li class="nav-sub-item"><a href="{{url('/MasterAdmin/GlobalSetting/SubjectMapWithCourse')}}" class="nav-sub-link"><i data-feather="calendar"></i> Subject Map With Course</a></li>
                                <li class="nav-sub-item"><a href="{{url('/MasterAdmin/GlobalSetting/TeacherClassMap')}}" class="nav-sub-link"><i data-feather="calendar"></i> Teacher Class Mapping/Allocate</a></li>
                             </ul>

                        </div>
                    </div><!-- nav-sub -->
                </li>
            @endif

            @if(auth()->user()->role_id==1)
            <div class="vl mx-3"></div>

                <li class="nav-item with-sub ">
                    <a href="#" class="nav-link"><i class="fa fa-cog mg-r-2"></i>OTHER SETTING</a>
                    <div class="navbar-menu-sub">
                        <div class="d-lg-flex">
                            <ul>

                                <li class="nav-label mg-t-10">Certificate Configuration</li>
                                <li class="nav-sub-item"><a href="{{url('/MasterAdmin/GlobalSetting/DefineCertificate')}}" class="nav-sub-link"><i class="fa fa-certificate"></i> Define Certificate</a></li>
                                <li class="nav-sub-item"><a href="{{url('/MasterAdmin/GlobalSetting/CertificateTemplate')}}" class="nav-sub-link"><i class="fa fa-file"></i> Certificate Template</a></li>
                                <li class="nav-sub-item"><a href="{{url('/MasterAdmin/GlobalSetting/CertificateIntegrateFormFields')}}" class="nav-sub-link"><i class="fa fa-edit"></i> Certificate Integrate Form Fields</a></li>
                                <li class="nav-sub-item"><a href="{{url('/MasterAdmin/GlobalSetting/CertificateSetting')}}" class="nav-sub-link"><i class="fa fa-cog"></i> Certificate Configuration</a></li>

                                <li class="nav-label mg-t-10">SMS & Email Configuration</li>
                                <li class="nav-sub-item"><a href="{{url('/MasterAdmin/GlobalSetting/SmsConfiguration')}}" class="nav-sub-link"><i class="fa fa-envelope"></i> SMS Configuration</a></li>
                                <li class="nav-sub-item"><a href="{{url('/MasterAdmin/GlobalSetting/EmailConfiguration')}}" class="nav-sub-link"><i class="fa fa-at"></i> Email Configuration</a></li>

                            </ul>

                            <ul class="wd-250">
                                <li class="nav-label mg-t-10">Dynamic Report Configuration</li>
                                <li class="nav-sub-item"><a href="{{url('/MasterAdmin/GlobalSetting/DynamicReportSetting')}}" class="nav-sub-link"><i class="fa fa-cog"></i> Dynamic Report Setting</a></li>
                                <li class="nav-sub-item"><a href="{{url('/MasterAdmin/GlobalSetting/IDCardTemplate')}}" class="nav-sub-link"><i class="fa fa-cog"></i> Identity(ID) Card Setting</a></li>
                                <li class="nav-label mg-t-20">About School Configuration</li>
                                <li class="nav-sub-item"><a href="{{url('/MasterAdmin/MobileApp/AboutSchool')}}" class="nav-sub-link"><i class="fa fa-info-circle"></i> About School</a></li>

                                <li class="nav-label mg-t-10">UI/Display Configuration</li>
                                <li class="nav-sub-item"><a href="{{url('/MasterAdmin/GlobalSetting/UIDisplay')}}" class="nav-sub-link"><i class="fa fa-desktop"></i> UI/Display Setting</a></li>
                            </ul>
                        </div>
                    </div><!-- nav-sub -->
                </li>
            @endif

            <li>
                <div class="col-lg-12 pd-l-20 m-0">
                    <table style="cursor: pointer;" id="yearModelsTable" data-toggle="modal" class="p-0 m-0 mg-t-3 tx-10 bd-l bd-r bd-2 pd-l-10 cursor-pointer">
                        <tbody  style=" line-height:.8rem; ">
                        <tr>
                            <td class="pd-l-10"><b><i class="fa fa-calendar-check pd-r-0"></i> Academic Year</b></td><td class="pd-l-3 pd-r-3"><b>:</b></td><td>{{auth()->user()->academicyear()->first()->academic_session ?? ''}}</td>
                            <td rowspan="2" class="pd-r-10 tx-13 text-danger  valign-middle"><u><i  class="fa fa-pen tx-10 p-0"></i> Change</u></td>
                        </tr>
                        <tr>
                            <td class="pd-l-10"><b><i class="fa fa-calendar-check pd-r-0"></i> Financial Year</b></td><td class="pd-l-3 pd-r-3"><b>:</b></td><td>{{auth()->user()->financialyear()->first()->financial_session ?? ''}}</td>
                        </tr>
                        <tr>
                            <td class="pd-l-10"><b><i class="fa fa-clock pd-r-0"></i> Today Date</b></td><td class="pd-l-3 pd-r-3"><b>:</b></td><td colspan="2" class="pd-r-10"><span id="date-time"></span></td>
                        </tr>
                        </tbody>
                    </table>
                </div>



            </li>
        </ul>
    </div><!-- navbar-menu-wrapper -->


    <div class="navbar-right">
        <div class="dropdown dropdown-notification">
        <a href="#" class="dropdown-link new-indicator fa-lg" data-toggle="dropdown"><i class="fa fa-bookmark" style="margin-top:4px"></i></a>
        <div class="dropdown-menu shadow-lg bd-t dropdown-menu-right" style="width:400px !important; ">
          <div class="dropdown-header pd-b-0 m-0 tx-12">Bookmarks Link <span url="{{url('BookmarksLink?url='.url()->full().'')}}" model-title="Create Bookmarks Link" model-class="" model-title-info="Create New Bookmarks Links"  class="float-right text-primary cursor-pointer custom-model-btn"><u><i class="fa fa-plus"></i> Add New</u></span></div>
           <div class="row bg-light tx-13 m-0 p-0">

               @if(bookmarkslinklist())
                   @foreach(bookmarkslinklist(['ac_user_id'=>Auth::user()->id]) as $bookmarklinkcategory=>$bookmarksdata)
                       <div class="col-lg-12 bd-b bg-dark text-white bd-t bd-1"><b>{{$bookmarklinkcategory}}</b></div>
                   @foreach($bookmarksdata as $data)
                       <div class="col-6 pd-l-0 pd-r-0 pd-t-5 pd-b-5 m-0 bd-l bd-b bd-1">
                           <a href="{{$data->url}}" target="{{$data->open_window}}" class="pd-l-10"><u><span><i class="fa fa-{{$data->icon}}"></i>{{$data->title}}</span></u></a>
                       </div>
                    @endforeach
                   @endforeach
               @endif
           </div>
            <div class="dropdown-footer bd-t-0 m-0"><span class="float-left cursor-pointer fa-lg"><i class="fa fa-cog"></i></span><span><a href="#">View all Bookmarks Link</a></span></div>
        </div>
        </div>

        <a id="navbarSearch" href="#" class="search-link pd-l-10"><i data-feather="search"></i></a>
        <div class="dropdown dropdown-notification">
            <a href="#" class="dropdown-link new-indicator" data-toggle="dropdown">
                <i data-feather="bell"></i>
                <span>10</span>
            </a>

        <div class="dropdown-menu shadow-lg bd-t dropdown-menu-right">
                <div class="dropdown-header tx-11">Notifications (<span>0</span>)</div>
                <a href="#" class="dropdown-item" hidden>
                    <div class="media">
                        <div class="avatar avatar-sm avatar-online"><img src="../../assets/img/img8.jpg" class="rounded-circle" alt=""></div>
                        <div class="media-body mg-l-15">
                            <p>Congratulate <strong>Socrates Itumay</strong> for work anniversaries</p>
                            <span>Mar 15 12:32pm</span>
                        </div><!-- media-body -->
                    </div><!-- media -->
                </a>
                <a href="#" class="dropdown-item" hidden>
                    <div class="media">
                        <div class="avatar avatar-sm avatar-online"><img src="../../assets/img/img8.jpg" class="rounded-circle" alt=""></div>
                        <div class="media-body mg-l-15">
                            <p><strong>Joyce Chua</strong> just created a new blog post</p>
                            <span>Mar 13 04:16am</span>
                        </div><!-- media-body -->
                    </div><!-- media -->
                </a>
                <a href="#" class="dropdown-item" hidden>
                    <div class="media">
                        @if(isset(Auth::user()->profile_img))
                            <div class="avatar avatar-sm avatar-online"><img src="{{ asset(Auth::user()->profile_img) }}" class="rounded-circle" alt=""></div>
                        @else
                            <div class="avatar avatar-sm avatar-online"><img src="{{ asset('/assets/images/no-image-available') }}" class="rounded-circle" alt=""></div>
                        @endif
                        <div class="media-body mg-l-15">
                            <p><strong>Adrian Monino</strong> added new comment on your photo</p>
                            <span>Mar 12 10:40pm</span>
                        </div><!-- media-body -->
                    </div><!-- media -->
                </a>

                <div class="media text-center"><div class="media-body text-danger mg-l-15"><b>0</b> pending notifications</div></div>
                <div class="dropdown-footer"><a href="#">View all Notifications</a></div>
            </div>
        </div>



    @auth()
            <div class="dropdown dropdown-profile">
                <a href="#" class="dropdown-link" data-toggle="dropdown" data-display="static">
                    <div class="avatar avatar-sm"><img src="{{ url('profile_image/' . Auth::user()->ProfileImage()) }}" class="rounded-circle bd-2 bd" alt=""></div>
                    <span class="tx-16 pd-lg-l-5 text-uppercase tx-color-03">{{ Auth::user()->first_name }} <i></i></span>
                </a><!-- dropdown-link -->

                <div class="dropdown-menu shadow-lg dropdown-menu-right tx-13">
                    <div class="avatar avatar-lg mg-b-15"><img src="{{ url('profile_image/' .Auth::user()->ProfileImage()) }}" class="rounded-circle bd-3 bd" alt=""></div>
                    <h6 class="tx-semibold mg-b-5 text-uppercase tx-color-03"> {{ Auth::user()->FullName()}}</h6>
                    <p class="mg-b-25 tx-12 tx-color-03">{{ Auth::user()->name ?? '' }}</p>

                    <a href="{{url('/EditUserProfile/'.auth()->id().'/edit')}}" class="dropdown-item bd-0 bd-b"><i data-feather="edit-3"></i> Edit Profile</a>
                    <a href="{{url('/UserProfile/'.auth()->id().'/view')}}" class="dropdown-item  bd-0 bd-b"><i data-feather="user"></i> View Profile</a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item bd-0 bd-b"><i data-feather="help-circle"></i> Help Center</a>
                    <a href="{{url('/LogInHistory')}}" class="dropdown-item  bd-0 bd-b"><i data-feather="life-buoy"></i> Sign In Log History</a>
                    <a href="{{url('/TwoFaAuthentication')}}" class="dropdown-item  bd-0 bd-b"><i data-feather="settings"></i>2FA Authentication</a>
                    <a href="{{url('/ChangePassword')}}" class="dropdown-item  bd-0 bd-b"><i data-feather="settings"></i>Change Password</a>
                    <a href="{{url('/logout')}}" class="dropdown-item text-danger bd-0 bd-b"><b><i data-feather="log-out"></i>Sign Out</b></a>
                    <a class="dropdown-item tx-10  bd-0 bd-b pd-lg-t-20">Last login at {{Auth::user()->LastLoginAt('login')}}</a>
                </div><!-- dropdown-menu -->
            </div><!-- dropdown -->
        @endauth
    </div><!-- navbar-right -->





    <div class="navbar-search">
        <div class="navbar-search-header">
            <input type="search" class="form-control" placeholder="Type and hit enter to search...">
            <button class="btn"><i data-feather="search"></i></button>
            <a id="navbarSearchClose" href="#" class="link-03 mg-l-5 mg-lg-l-10"><i data-feather="x"></i></a>
        </div><!-- navbar-search-header -->
        <div class="navbar-search-body">
            <label class="tx-10 tx-medium tx-uppercase tx-spacing-1 tx-color-03 mg-b-10 d-flex align-items-center">Recent Searches</label>
            <ul class="list-unstyled">
                <li><a href="dashboard-one.html">modern dashboard</a></li>
                <li><a href="app-calendar.html">calendar app</a></li>
                <li><a href="../../collections/modal.html">modal examples</a></li>
                <li><a href="../../components/el-avatar.html">avatar</a></li>
            </ul>
            <hr class="mg-y-30 bd-0">
            <label class="tx-10 tx-medium tx-uppercase tx-spacing-1 tx-color-03 mg-b-10 d-flex align-items-center">Search Suggestions ERP Module</label>
            <ul class="list-unstyled">
                <li><a href="{{url('/MasterAdmin/StudentInformation/index')}}">Student Management</a></li>
                <li><a href="{{url('/MasterAdmin/Transport/index')}}">Transport Management</a></li>
                <li><a href="{{url('/MasterAdmin/Attendance/index')}}">Attendance</a></li>
                <li><a href="{{url('/MasterAdmin/Timetable/index')}}">Timetable</a></li>
                <li><a href="{{url('/MasterAdmin/Communication/index')}}">Communication</a></li>
                <li><a href="{{url('/MasterAdmin/Library/index')}}">Library</a></li>
                <li><a href="{{url('/MasterAdmin/StockManager/index')}}">Stock Manager</a></li>
                <li><a href="{{url('/MasterAdmin/MarksManager/index')}}">Marks Manager</a></li>
                <li><a href="{{url('/MasterAdmin/Staff/index')}}">Employee/Staff</a></li>
                <li><a href="{{url('/MasterAdmin/Finance/index')}}">Finance/Account</a></li>
                <li><a href="">Payroll</a></li>
                <li><a href="{{url('/MasterAdmin/FrontOffice/index')}}">Front Office</a></li>
                <li><a href="{{url('/MasterAdmin/Reports/index')}}">Reports</a></li>
                <li><a href="{{url('/MasterAdmin/MobileApp/index')}}">Mobile App</a></li>
                <li><a href="{{url('/MasterAdmin/Website/index')}}">Website</a></li>
                <li><a href="{{url('/MasterAdmin/GlobalSetting/index')}}">Global Setting</a></li>
            </ul>
        </div><!-- navbar-search-body -->
    </div><!-- navbar-search -->


</header><!-- navbar -->
