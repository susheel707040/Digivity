@if(Str::contains(request()->url(),'/home'))
    @include('layouts.header.MasterAdmin.master-admin-dashboard-navbar')
@endif

@if(Str::contains(request()->url(),'/MasterAdmin/StudentInformation/'))
<!--@include('layouts.header.MasterAdmin.admin-navbar',['navbarid'=>'student-information'])-->
@include('layouts.header.MasterAdmin.admission-navbar')
@endif

@if(Str::contains(request()->url(), '/MasterAdmin/Transport/'))
    @include('layouts.header.MasterAdmin.transport-navbar')
@endif

@if(Str::contains(request()->url(), '/MasterAdmin/Attendance/'))
    @include('layouts.header.MasterAdmin.attendance-navbar')
@endif

@if(Str::contains(request()->url(), '/MasterAdmin/Timetable/'))
    @include('layouts.header.MasterAdmin.timetable-navbar')
@endif

@if(Str::contains(request()->url(), '/MasterAdmin/Communication/'))
    @include('layouts.header.MasterAdmin.communication-navbar')
@endif

@if(Str::contains(request()->url(), '/MasterAdmin/App/'))
    @include('layouts.header.MasterAdmin.app-navbar')
@endif

@if(Str::contains(request()->url(), '/MasterAdmin/Library/'))
    @include('layouts.header.MasterAdmin.library-navbar')
@endif

@if(Str::contains(request()->url(), '/MasterAdmin/StockManager/'))
    @include('layouts.header.MasterAdmin.stock-manage')
@endif

@if(Str::contains(request()->url(), '/MasterAdmin/MarksManager/'))
    @include('layouts.header.MasterAdmin.marks-manager-navbar')
@endif

@if(Str::contains(request()->url(), '/MasterAdmin/Staff/'))
    @include('layouts.header.MasterAdmin.staff-hr-navbar')
@endif

@if(Str::contains(request()->url(), '/MasterAdmin/Finance/'))
    @include('layouts.header.MasterAdmin.finance-navbar')
@endif

@if(Str::contains(request()->url(), '/MasterAdmin/Payroll/'))
    @include('layouts.header.MasterAdmin.Payroll.PayrollNavbar')
@endif

@if(Str::contains(request()->url(), '/MasterAdmin/reports/'))
    @include('layouts.header.MasterAdmin.report-navbar')
@endif

@if(Str::contains(request()->url(), '/MasterAdmin/MobileApp/'))
    @include('layouts.header.MasterAdmin.mobile-app-navbar')
@endif

@if(Str::contains(request()->url(), '/MasterAdmin/FrontOffice/'))
    @include('layouts.header.MasterAdmin.front-office-navbar')
@endif

@if(Str::contains(request()->url(), '/MasterAdmin/Website/'))
    @include('layouts.header.MasterAdmin.website-navbar')
@endif

@if(Str::contains(request()->url(), '/MasterAdmin/User/'))
    @include('layouts.header.MasterAdmin.user-navbar')
@endif

@if(Str::contains(request()->url(), '/MasterAdmin/GlobalSetting/'))
    @include('layouts.header.MasterAdmin.global-setting-navbar')
@endif


