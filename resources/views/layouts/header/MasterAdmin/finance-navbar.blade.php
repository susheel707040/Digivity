<ul class="nav digishiksha-navbar-header nav-line tx-12" id="myTab5" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" href="{{url('MasterAdmin/Finance/index')}}"><i class="fa fa-chart-line"></i> Finance Analytics</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="profile-tab5" data-toggle="dropdown" href="#profile5" ><i class="fa fa-thumb"></i> Fee Entry <i class="fa fa-angle-down"></i></a>
        <div class="dropdown-menu navbar-menu-sub tx-11 pd-0 pd-t-5">
            <a href="{{url('MasterAdmin/Finance/FeeCollection')}}" class="dropdown-item">Fee Collection Entry</a>
            <a href="{{url('MasterAdmin/Finance/ChequeBounceEntry')}}" class="dropdown-item">Cheque Bounce Entry</a>
            <a href="{{url('MasterAdmin/Finance/CancelFeeReceipt')}}" class="dropdown-item">Cancel Fee Receipt</a>
            <a href="{{url('MasterAdmin/Finance/FeeReceiptModify')}}" class="dropdown-item">Manual Fee Receipt Modify</a>
            <a href="{{url('MasterAdmin/Finance/OnlineFeeSettlement')}}" class="dropdown-item">Online Fee Settlement</a>
            <a href="{{url('MasterAdmin/Finance/FeeUploadBankDeposit')}}" class="dropdown-item">Fee Upload With Deposit Bank</a>
        </div>

    </li>

    <li class="nav-item">
        <a class="nav-link" id="profile-tab5" data-toggle="dropdown" href="#profile5" ><i class="fa fa-edit"></i> Master Update <i class="fa fa-angle-down"></i></a>
        <div class="dropdown-menu navbar-menu-sub tx-11 pd-0 pd-t-5">
            <a href="{{url('MasterAdmin/Finance/StudentOpeningBalance')}}" class="dropdown-item">Student Bulk Opening Balance Entry</a>
            <a href="{{url('MasterAdmin/Finance/StudentAssignLedger')}}" class="dropdown-item">Student Bulk Assign Account Ledger</a>
            <a href="{{url('MasterAdmin/Finance/StudentAssignConcession')}}" class="dropdown-item">Student Bulk Assign Concession</a>
            <a href="{{url('MasterAdmin/Finance/StudentFeeModify')}}" class="dropdown-item">Student Opening & Other Fee Modify</a>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link" id="profile-tab5" data-toggle="dropdown" href="#profile5" ><i class="fa fa-file"></i> Reports <i class="fa fa-angle-down"></i></a>
        <div class="dropdown-menu dropright dropdown dropdown-submenu navbar-menu-sub tx-11 pd-0 pd-t-5">
            <a href="{{url('MasterAdmin/Finance/FeeCollectionReport')}}" class="dropdown-item">Daily Fee Collection Detail</a>
            <a href="{{url('MasterAdmin/Finance/HeadWiseStudentConsolidatedReport')}}" class="dropdown-item">Student Wise Detailed Consolidated Transaction</a>
            <a href="{{url('MasterAdmin/Finance/DailyFeeCollectionFullReport')}}" class="dropdown-item">Daily Fee Collection (Fee Head & Paymode) Detail</a>
            <a href="{{url('MasterAdmin/Finance/DaybookReport')}}" class="dropdown-item">Daybook Detail</a>
            <a href="{{url('MasterAdmin/Finance/FeeHeadCollectionReport')}}" class="dropdown-item">Fee Head Collection Detail</a>
            <a href="{{url('MasterAdmin/Finance/FeeHeadInstalmentCollectionReport')}}" class="dropdown-item">Fee Head Instalment Collection Detail</a>
            <a href="{{url('MasterAdmin/Finance/CourseWiseCollectionReport')}}" class="dropdown-item">Class/Course Wise Collection Detail</a>
            <a href="{{url('MasterAdmin/Finance/DayWiseCollectionReport')}}" class="dropdown-item">Date Wise Fee Collection MIS Detail</a>
            <a href="{{url('MasterAdmin/Finance/MonthMISCollectionReport')}}" class="dropdown-item">Month Mis Fee Collection Detail</a>
            <a href="{{url('MasterAdmin/Finance/PaymodeWiseFeeCollectionReport')}}" class="dropdown-item">Paymode Wise Fee Collection Detail</a>
            <a href="{{url('MasterAdmin/Finance/DateWisePaymodeWiseFeeCollectionReport')}}" class="dropdown-item">Date Wise Paymode Wise Fee Collection Detail</a>
            <a href="{{url('MasterAdmin/Finance/FeeCollectionConcessionReport')}}" class="dropdown-item">Fee Collection Concession/Discount Detail</a>
            <a href="{{url('MasterAdmin/Finance/ConcessionConsolidatedReport')}}" class="dropdown-item">Concession/Discount Consolidated Detail</a>
            <a href="{{url('MasterAdmin/Finance/ClassWiseStudentFeeDefaulterReport')}}" class="dropdown-item">Class Wise Student Fee Defaulter</a>
            <a href="{{url('MasterAdmin/Finance/ACLedgerStudentFeeDefaulterReport')}}" class="dropdown-item">A/C Ledger Wise Student Fee Defaulter Detail</a>
            <a href="{{url('MasterAdmin/Finance/SiblingsFeeDefaulterReport')}}" class="dropdown-item">Siblings Wise Fee Defaulter Detail</a>
            <a href="{{url('MasterAdmin/Finance/StudentFeeHeadDefaulterReport')}}" class="dropdown-item">Student Fee Head Wise Fee Defaulter Detail</a>
            <a href="{{url('MasterAdmin/Finance/StudentConcessionReport')}}" class="dropdown-item">Student Regular Concession Detail</a>
            <a href="{{url('MasterAdmin/Finance/StudentSpecialConcessionReport')}}" class="dropdown-item">Student Special Concession Detail</a>
            <a href="{{url('MasterAdmin/Finance/StudentFeeCollectionLedgerReport')}}" class="dropdown-item">Student Fee Collection Ledger Details</a>
            <a href="{{url('MasterAdmin/Finance/StudentOpeningBalanceReport')}}" class="dropdown-item">Student Opening Balance Details</a>
            <a href="{{url('MasterAdmin/Finance/StudentLedgerReport')}}" class="dropdown-item">Student Ledger Summary</a>
            <a href="{{url('MasterAdmin/Finance/ClassWisePaymentReport')}}" class="dropdown-item">Class Wise Payment Summary</a>
            <a href="{{url('MasterAdmin/Finance/StudentInactiveReport')}}" class="dropdown-item">Student Inactive Details</a>
        </div>
    </li>


    <li class="nav-item">
        <a class="nav-link" id="profile-tab5" data-toggle="dropdown" href="#profile5" ><i class="fa fa-cog"></i> Fee Setting <i class="fa fa-angle-down"></i></a>
        <div class="dropdown-menu navbar-menu-sub tx-11 pd-0 pd-t-5">
            <a href="{{url('MasterAdmin/Finance/DefineFeeAccount')}}" class="dropdown-item">Fee Account</a>
            <a href="{{url('MasterAdmin/Finance/DefineFeeGroup')}}" class="dropdown-item">Fee Group</a>
            <a href="{{url('MasterAdmin/Finance/DefineFeeGroupMapWithCourse')}}" class="dropdown-item">Fee Group Map With Course</a>
            <a href="{{url('MasterAdmin/Finance/DefineFeeHead')}}" class="dropdown-item">Fee Head</a>
            <a href="{{url('MasterAdmin/Finance/DefineFeeHeadMapWithInstallment')}}" class="dropdown-item">Fee Head Map With Installment</a>
            <a href="{{url('MasterAdmin/Finance/DefineFeeStructure')}}" class="dropdown-item">Fee Structure</a>
            <a hidden href="{{url('MasterAdmin/Finance/FeeSetting')}}" class="dropdown-item">Fee Setting</a>
            <a href="{{url('MasterAdmin/Finance/FineSetting')}}" class="dropdown-item">Fine Setting</a>
            <a href="{{url('MasterAdmin/Finance/DefineConcessionType')}}" class="dropdown-item">Concession Type</a>
            <a href="{{url('MasterAdmin/Finance/ConcessionSetting')}}" class="dropdown-item">Concession Setting</a>
        </div>

    </li>

    <li class="nav-item">
        <a class="nav-link" id="profile-tab5" data-toggle="dropdown" href="#profile5" ><i class="fa fa-cog"></i> Account Setting <i class="fa fa-angle-down"></i></a>
        <div class="dropdown-menu navbar-menu-sub tx-11 pd-0 pd-t-5">
            <a href="{{url('MasterAdmin/Finance/DefinePaymode')}}" class="dropdown-item">Define Paymode</a>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="profile-tab5" data-toggle="dropdown" href="#profile5" ><i class="fa fa-cog"></i> Master Setting <i class="fa fa-angle-down"></i></a>
        <div class="dropdown-menu navbar-menu-sub tx-11 pd-0 pd-t-5">
            <a href="{{url('MasterAdmin/Finance/FeeCollectionSetting')}}" class="dropdown-item">Fee Collection Setting</a>
            <a href="{{url('MasterAdmin/Finance/FeeReceiptSetting')}}" class="dropdown-item">Fee Receipt Setting</a>
        </div>
    </li>

</ul>
