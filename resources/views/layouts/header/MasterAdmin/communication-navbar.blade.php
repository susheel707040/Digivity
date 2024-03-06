<ul class="nav digishiksha-navbar-header nav-line tx-12" id="myTab5" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" href="{{url('MasterAdmin/Communication/index')}}"><i class="fa fa-chart-line"></i> Communication Analytics</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="profile-tab5" data-toggle="dropdown" href="#profile5" ><i class="fa fa-envelope-open-text"></i> Communication <i class="fa fa-angle-down"></i></a>
        <div class="dropdown-menu navbar-menu-sub tx-11 pd-0 pd-t-5">
            <a href="{{url('MasterAdmin/Communication/ComposeSMS')}}" class="dropdown-item">Compose SMS</a>
            <a href="{{url('MasterAdmin/Communication/BulkSMS')}}" class="dropdown-item">Bulk SMS</a>
            <a href="{{url('MasterAdmin/Communication/IndividualSMS')}}" class="dropdown-item">Send SMS Individual Student/Staff/User </a>
            {{-- <a href="{{url('MasterAdmin/Communication/PromotionalSMS')}}" class="dropdown-item"> Promotional SMS </a>
            <a href="{{url('MasterAdmin/Communication/ComposeEmail')}}" class="dropdown-item">Compose Email</a>
            <a href="{{url('MasterAdmin/Communication/VoiceSMS')}}" class="dropdown-item">Voice Call/SMS</a>
            <a href="{{url('MasterAdmin/Communication/MobileAppNotification')}}" class="dropdown-item">Mobile App Notification</a>
            <a href="{{url('MasterAdmin/Communication/MobileAppVoiceCall')}}" class="dropdown-item">Mobile App Voice Call</a> --}}
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link" id="profile-tab5" data-toggle="dropdown" href="#profile5" ><i class="fa fa-mobile"></i> Phonebook <i class="fa fa-angle-down"></i></a>
        <div class="dropdown-menu navbar-menu-sub tx-11 pd-0 pd-t-5">
            <a href="{{url('MasterAdmin/Communication/DefinePhoneBookGroup')}}" class="dropdown-item">Phonebook Group</a>
            <a href="{{url('MasterAdmin/Communication/DefinePhoneBookContact')}}" class="dropdown-item">Phonebook Contact</a>
            <a href="{{url('MasterAdmin/Communication/ImportPhoneBook')}}" class="dropdown-item">Import Phonebook Contact</a>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link" id="contact-tab5" data-toggle="dropdown" href="#contact5"> <i class="fa fa-file-export"></i>Reports <i class="fa fa-angle-down"></i></a>
        <div class="dropdown-menu navbar-menu-sub tx-11 pd-0 pd-t-5">
            <a href="{{url('MasterAdmin/Communication/SMSReport')}}" class="dropdown-item">Communication SMS Detail</a>
            <a href="{{url('MasterAdmin/Communication/SMSAndEmailBalance')}}" class="dropdown-item" hidden>SMS & Email Balance</a>
            <a href="{{url('MasterAdmin/Communication/DayWiseSMSMisReport')}}" class="dropdown-item" hidden>Day Wise SMS Mis Detail</a>
            <a href="{{url('MasterAdmin/Communication/MonthWiseSMSMisReport')}}" class="dropdown-item" hidden>Month Wise SMS Mis Detail</a>
            <a href="{{url('MasterAdmin/Communication/DayWiseEmailMisReport')}}" class="dropdown-item" hidden>Day Wise Email Mis Detail</a>
            <a href="{{url('MasterAdmin/Communication/MonthWiseEmailMisReport')}}" class="dropdown-item" hidden>Month Wise Email Mis Detail</a>
            <a href="{{url('MasterAdmin/Communication/SMSStatusReport')}}" class="dropdown-item" hidden>SMS Status Detail</a>
            <a href="{{url('MasterAdmin/Communication/MobileNoStatusReport')}}" class="dropdown-item" hidden>Mobile Number Valid/Invalid Detail</a>
            <a href="{{url('MasterAdmin/Communication/EmailStatusReport')}}" class="dropdown-item" hidden>Email Valid/Invalid Detail</a>
        </div>
    </li>


    <li class="nav-item">
        <a class="nav-link" id="contact-tab5" data-toggle="dropdown" href="#contact5"> <i class="fa fa-cogs"></i> Master Setting <i class="fa fa-angle-down"></i></a>
        <div class="dropdown-menu navbar-menu-sub tx-11 pd-0 pd-t-5">
            <a href="{{url('MasterAdmin/Communication/DefineCommunicationType')}}" class="dropdown-item">Define Communication Type</a>
            <a href="{{url('MasterAdmin/Communication/DefineFixHeaderFooter')}}" href="" class="dropdown-item">Define Fix Header and Footer</a>
            <a href="{{url('MasterAdmin/Communication/DefineUserSMSCopy')}}" href="" class="dropdown-item">Define User SMS & Email Duplicate Copy</a>
            <a href="{{url('MasterAdmin/Communication/DefineSMSTemplate')}}" href="" class="dropdown-item">Define Communication SMS Template</a>
            <a href="{{url('MasterAdmin/Communication/DefineEmailTemplate')}}" href="" class="dropdown-item">Define Communication Email Template</a>
            <a href="{{url('MasterAdmin/Communication/DefineUserSMSCopy')}}" href="" class="dropdown-item">SMS & Email Auto Reminder</a>
        </div>
    </li>
</ul>
