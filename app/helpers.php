<?php

use App\Helper\DBTableSum;

use App\Models\MasterAdmin\Admission\StudentRecord;
use App\Models\MasterAdmin\GlobalSetting\SMSConfiguration;
use App\Models\MasterAdmin\Transport\MasterSetting;
use App\Repositories\MasterAdmin\Finance\FinanceFeeCollectionRepository;
use App\Repositories\MasterAdmin\GlobalSetting\CommanDataRepository;
use App\Repositories\MasterAdmin\Transport\TransportRepository;
use App\Repositories\MasterAdmin\Communication\CommunicationRepository;
use App\Repositories\MasterAdmin\Staff\StaffRepositories;
use App\Repositories\MasterAdmin\StudentInformation\StudentRepository;
use App\Repositories\MasterAdmin\Finance\FinanceRepository;
use App\Repositories\MasterAdmin\Timetable\TimetableRepository;
use App\Repositories\MasterAdmin\InApp\InAppDataRepository;
use App\Repositories\MasterAdmin\Library\LibraryRepositories;
use App\Repositories\MasterAdmin\User\UserRepository;
use App\Repositories\MasterAdmin\MarksManager\MarksManagerRepositories;

/**
 * Global Setting Repository
 */
if (!function_exists('navbar')) {
    function navbar($key=null)
    {
        return \App\Helper\UserModules::erpmodule($key);
    }
}
if (!function_exists('navlink')) {
    function navlink($link)
    {
        if(Route::has($link)){
            return route($link);
        }
        return "#";
    }
}
if (!function_exists('getlinkicon')) {
    function getlinkicon($key=null)
    {
        if(\App\Helper\UserModules::getlinkicon($key)){
            return \App\Helper\UserModules::getlinkicon($key);
        }
        return "fa fa-globe";
    }
}
if (!function_exists('currency')) {
    function currency()
    {
        return "Rs.";
    }
}
if (!function_exists('recordnofound')) {
    function recordnofound($data=null)
    {
        $pageview=view('layouts.record-no-found',compact(['data']));
        $pageview=$pageview->render();
        $pageview=str_replace("\n","",$pageview);
        return $pageview;
    }
}

if (!function_exists('bookmarkslinklist')) {
    function bookmarkslinklist($search=null,$addonrelation=null)
    {
        $data=(new CommanDataRepository());
        return $data->bookmarkslinklist($search,$addonrelation);
    }
}
if (!function_exists('recordnofound')) {
    function recordnofound($length)
    {
        echo "<tr><td colspan='$length' class='text-danger text-center'><b>Sorry, Record No Found!</b></td></tr>";
    }
}
if (!function_exists('nowdate')) {
    function nowdate($date, $format)
    {
        if (!$format) {
            $format = "Y-m-d";
        }
        return \Carbon\Carbon::createFromDate($date)->format($format);
    }
}
if (!function_exists('maritalstatus')) {
    function maritalstatus()
    {
        return ['married', 'divorced', 'widowed', 'separated', 'single'];
    }
}
if (!function_exists('dynamicreport')) {
    function dynamicreport($search)
    {
        $data = new CommanDataRepository();
        return $data->dynamicreport($search);
    }
}

if (!function_exists('numberformat')) {
    function numberformat($value)
    {
        if(!empty($value)) {
            return number_format($value, 2);
        }
        return 0;
    }
}
/*
 * db table column sum values
 */
if (!function_exists('dbtablesum')) {
    function dbtablesum($model,$condition)
    {
        $data=DBTableSum::ModelSum($model,$condition);
        return $data;
    }
}
/*
 * all module form auto genrate number
 */
if (!function_exists('FormNoGenerate')) {
    function FormNoGenerate($keyid)
    {
        return \App\Helper\FormNoGenerate::generate($keyid);
    }
}
/*
 * Get File Path
 */
if (!function_exists('FileUrl')) {
    function FileUrl($filepath)
    {
        return \App\Helper\FileUrl::filepath($filepath);
    }
}
/*
 * sms config
 */
if (!function_exists('smsconfig')) {
    function smsconfig($key)
    {
        $smsconfiguration = SMSConfiguration::query()->record()->first();
        if($key=="senderid"){
            return "hggg";
        }
    }
}
if (!function_exists('CommunicationBalance')) {
    function CommunicationBalance($key=null)
    {
        $communicationbalance=\App\Helper\CommunicationBalance::Balance();
        if(isset($communicationbalance->text_balance)){
            return $communicationbalance->text_balance;
        }
        return 0;
    }
}
if (!function_exists('admissionisnewstatuslist')) {
    function admissionisnewstatuslist($search=null)
    {
        $data = new CommanDataRepository();
        return $data->admissionisnewstatuslist($search);
    }
}
if (!function_exists('courselist')) {
    function courselist()
    {
        $data = new CommanDataRepository();
        return $data->courseselectlist();
    }
}
if (!function_exists('teachercoursewithsection')) {
    function teachercoursewithsection($search=null,$relation=null)
    {
        $data = new CommanDataRepository();
        return $data->teachercoursewithsection($search);
    }
}


if (!function_exists('parishlist')) {
    function parishlist($search=null)
    {
        $data = new CommanDataRepository();
        return $data->parishlist($search);
    }
}


if (!function_exists('admissiontypeselectlist')) {
    function admissiontypeselectlist()
    {
        $data = new CommanDataRepository();
        return $data->admissiontypeselectlist();
    }
}
if (!function_exists('categoryselectlist')) {
    function categoryselectlist()
    {
        $data = new CommanDataRepository();
        return $data->categoryselectlist();
    }
}
if (!function_exists('nationalitylist')) {
    function nationalitylist($search=null)
    {
        $data = new CommanDataRepository();
        return $data->nationalitylist($search);
    }
}
if (!function_exists('parentstatuslist')) {
    function parentstatuslist($search=null)
    {
        $data = new CommanDataRepository();
        return $data->parentstatuslist($search);
    }
}
if (!function_exists('streamlist')) {
    function streamlist($search=null)
    {
        $data = new CommanDataRepository();
        return $data->streamlist($search);
    }
}
if (!function_exists('religionselectlist')) {
    function religionselectlist()
    {
        $data = new CommanDataRepository();
        return $data->religionselectlist();
    }
}
if (!function_exists('casteselectlist')) {
    function casteselectlist()
    {
        $data = new CommanDataRepository();
        return $data->casteselectlist();
    }
}
if (!function_exists('coursesectionlist')) {
    function coursesectionlist()
    {
        $data = new CommanDataRepository();
        return $data->coursesectionlist();
    }
}
if (!function_exists('sectionlist')) {
    function sectionlist($search)
    {
        $data = new CommanDataRepository();
        return $data->sectionlist($search);
    }
}
if (!function_exists('boardselectlist')) {
    function boardselectlist()
    {
        $data = new CommanDataRepository();
        return $data->boardselectlist();
    }
}
if (!function_exists('houseselectlist')) {
    function houseselectlist()
    {
        $data = new CommanDataRepository();
        return $data->houseselectlist();
    }
}

if (!function_exists('subjectlist')) {
    function subjectlist($search)
    {
        $data = new CommanDataRepository();
        return $data->subjectlist($search);
    }
}
if (!function_exists('subjectmapwithcourselist')) {
    function subjectmapwithcourselist($search)
    {
        $data = new CommanDataRepository();
        return $data->subjectmapwithcourselist($search);
    }
}
if (!function_exists('studentdocumenttypelist')) {
    function studentdocumenttypelist($search)
    {
        $data = new CommanDataRepository();
        return $data->studentdocumenttypelist($search);
    }
}
if (!function_exists('academicyearlist')) {
    function academicyearlist($search=null)
    {
        $academicyearlist = new CommanDataRepository();
        return $academicyearlist->academicyearlist($search);
    }
}
if (!function_exists('financialyearlist')) {
    function financialyearlist($search=null)
    {
        $financialyearlist = new CommanDataRepository();
        return $financialyearlist->financialyearlist($search);
    }
}
if (!function_exists('schoolbranchlist')) {
    function schoolbranchlist($search)
    {
        $data = new CommanDataRepository();
        return $data->schoolbranchlist($search);
    }
}
if (!function_exists('certificatelist')) {
    function certificatelist($search=null)
    {
        $data = new CommanDataRepository();
        return $data->certificatelist($search);
    }
}
if (!function_exists('certificatetemplatelist')) {
    function certificatetemplatelist($search=null)
    {
        $data = new CommanDataRepository();
        return $data->certificatetemplatelist($search);
    }
}
if (!function_exists('certificatetemplatenamelist')) {
    function certificatetemplatenamelist($search=null)
    {
        $data = new CommanDataRepository();
        return $data->certificatetemplatenamelist($search);
    }
}
if (!function_exists('tccertificatelist')) {
    function tccertificatelist($search=null)
    {
        $data = new CommanDataRepository();
        return $data->tccertificatelist($search);
    }
}


/**
 * Transport Repository
 */
if (!function_exists('routelist')) {
    function routelist()
    {
        $data = new TransportRepository();
        return $data->routelist();
    }
}

if (!function_exists('routestoplist')) {
    function routestoplist()
    {
        $data = new TransportRepository();
        return $data->routestoplist();
    }
}
if (!function_exists('vehicletypelist')) {
    function vehicletypelist($search=null)
    {
        $data = new TransportRepository();
        return $data->vehicletypelist($search=null);
    }
}

if (!function_exists('vehiclelist')) {
    function vehiclelist()
    {
        $data = new TransportRepository();
        return $data->vehiclelist();
    }
}

if (!function_exists('routerelationlist')) {
    function routerelationlist()
    {
        $data = new TransportRepository();
        return $data->routerelationlist();
    }
}


/**
 * Communication Repositories
 */
if (!function_exists('comunicationtypelist')) {
    function comunicationtypelist()
    {
        $data = new CommunicationRepository();
        return $data->comunicationtypelist();
    }
}
if (!function_exists('fixheaderfooterlist')) {
    function fixheaderfooterlist()
    {
        $data = new CommunicationRepository();
        return $data->fixheaderfooterlist();
    }
}
if (!function_exists('usersmscopylist')) {
    function usersmscopylist()
    {
        $data = new CommunicationRepository();
        return $data->usersmscopylist();
    }
}
if (!function_exists('smstemplate')) {
    function smstemplate()
    {
        $data = new CommunicationRepository();
        return $data->smstemplate();
    }
}
if (!function_exists('phonebookgrouplist')) {
    function phonebookgrouplist()
    {
        $data = new CommunicationRepository();
        return $data->phonebookgrouplist();
    }
}
if (!function_exists('smstemplatelist')) {
    function smstemplatelist($search=null)
    {
        $data = new CommunicationRepository();
        return $data->smstemplatelist($search);
    }
}



/**
 * Staff Repositories
 */
if (!function_exists('professtiontypelist')) {
    function professtiontypelist()
    {
        $data = new StaffRepositories();
        return $data->professtiontypelist();
    }
}

if (!function_exists('stafftypelist')) {
    function stafftypelist()
    {
        $data = new StaffRepositories();
        return $data->stafftypelist();
    }
}

if (!function_exists('staffdepartmentlist')) {
    function staffdepartmentlist()
    {
        $data = new StaffRepositories();
        return $data->staffdepartmentlist();
    }
}

if (!function_exists('satffdesignationlist')) {
    function satffdesignationlist()
    {
        $data = new StaffRepositories();
        return $data->satffdesignationlist();
    }
}

if (!function_exists('staffdocumentlist')) {
    function staffdocumentlist()
    {
        $data = new StaffRepositories();
        return $data->staffdocumentlist();
    }
}

if (!function_exists('staffqualificationlist')) {
    function staffqualificationlist()
    {
        $data = new StaffRepositories();
        return $data->staffqualificationlist();
    }
}
if (!function_exists('staffskillandknowledgelist')) {
    function staffskillandknowledgelist()
    {
        $data = new StaffRepositories();
        return $data->staffskillandknowledgelist();
    }
}
if (!function_exists('staffskillandknowledgelist')) {
    function staffskillandknowledgelist()
    {
        $data = new StaffRepositories();
        return $data->staffskillandknowledgelist();
    }
}

if (!function_exists('staffshortlist')) {
    function staffshortlist($search=null,$relation=null)
    {
        $data = new StaffRepositories();
        return $data->staffshortlist($search,$relation);
    }
}


if (!function_exists('studentshortlist')) {
    function studentshortlist($search=null,$relation=null,$status=null)
    {
        $data = new StudentRepository();
        return $data->studentshortlist($search,$relation,$status);
    }
}

/**
 * finance function list
 */
if (!function_exists('paymodelist')) {
    function paymodelist()
    {
        $data = new FinanceRepository();
        return $data->paymodelist();
    }
}

if (!function_exists('feeaccountlist')) {
    function feeaccountlist($search)
    {
        $data = new FinanceRepository();
        return $data->feeaccountlist($search);
    }
}

if (!function_exists('feegrouplist')) {
    function feegrouplist($search)
    {
        $data = new FinanceRepository();
        return $data->feegrouplist($search);
    }
}
if (!function_exists('feeheadinstalmentlist')) {
    function feeheadinstalmentlist($search)
    {
        $data = new FinanceRepository();
        return $data->feeheadinstalmentlist($search);
    }
}
if (!function_exists('feeheadinstalmentgrouplist')) {
    function feeheadinstalmentgrouplist($search=null)
    {
        $data = new FinanceRepository();
        return $data->feeheadinstalmentgrouplist($search);
    }
}
if (!function_exists('feecollectioninstalmentgrouplist')) {
    function feecollectioninstalmentgrouplist($search=null,$relation=null)
    {
        $data = new FinanceRepository();
        return $data->feecollectioninstalmentgrouplist($search,$relation);
    }
}
if (!function_exists('feeheadlist')) {
    function feeheadlist($search)
    {
        $data = new FinanceRepository();
        return $data->feeheadlist($search);
    }
}
if (!function_exists('concessiontypelist')) {
    function concessiontypelist($search)
    {
        $data = new FinanceRepository();
        return $data->concessiontypelist($search);
    }
}
if (!function_exists('feeheadinstalmentavoid')) {
    function feeheadinstalmentavoid($search)
    {
        $data = new FinanceRepository();
        return $data->feeheadinstalmentavoid($search);
    }
}
if (!function_exists('feecollectionlist')) {
    function feecollectionlist($search)
    {
        $data = new FinanceRepository();
        return $data->feecollectionlist($search);
    }
}
if (!function_exists('studentacledgerlist')) {
    function studentacledgerlist($search)
    {
        $data = new FinanceRepository();
        return $data->studentacledgerlist($search);
    }
}
if (!function_exists('studentfeerecord')) {
    function studentfeerecord($studentparameter, $feeuptodate, $feepayid)
    {
        $data = new FinanceFeeCollectionRepository();
        return $data->studentfeerecord($studentparameter, $feeuptodate, $feepayid);
    }
}
if (!function_exists('studentparameter')) {
    function studentparameter($student)
    {
        $data = [
            'studentid' => $student->student_id,
            'courseid' => $student->course_id,
            'sectionid' => $student->section_id,
            'feegroupid' => $student->feegroup()->exists()?$student->feegroup->fee_group_id:0,
            'feeconcessionid' => $student->fee_concession_id,
            'feeheadidavoid' => $student->fee_head_id_avoid,
            'transportid' => $student->transport_id,
            'transportstopdate' => $student->transport_stop_date,
            'studentinactivedate' => $student->inactive_date,
            'adm_type' => $student->is_new,
            'adm_category'=>$student->admission_type_id
        ];
        return $data;
    }
}
/*
 * timetable function
 */
if (!function_exists('timetablelist')) {
    function timetablelist($search)
    {
        $data = new TimetableRepository();
        return $data->timetablelist($search);
    }
}
/*
 * calander function
 */
if (!function_exists('calendartypelist')) {
    function calendartypelist($search)
    {
        $data = new InAppDataRepository();
        return $data->calendartypelist($search);
    }
}
if (!function_exists('calendarlist')) {
    function calendarlist($search)
    {
        $data = new InAppDataRepository();
        return $data->calendarlist($search);
    }
}
/*
 * Library
 */
if (!function_exists('librarylist')) {
    function librarylist($search=null,$addonrelation=null)
    {
        $data = new LibraryRepositories();
        return $data->librarylist($search,$addonrelation);
    }
}
if (!function_exists('libraryitemcategorylist')) {
    function libraryitemcategorylist($search=null,$addonrelation=null)
    {
        $data = new LibraryRepositories();
        return $data->libraryitemcategorylist($search,$addonrelation);
    }
}
if (!function_exists('rackslist')) {
    function rackslist($search=null,$addonrelation=null)
    {
        $data = new LibraryRepositories();
        return $data->rackslist($search,$addonrelation);
    }
}
if (!function_exists('authorlist')) {
    function authorlist($search=null,$addonrelation=null)
    {
        $data = new LibraryRepositories();
        return $data->authorlist($search,$addonrelation);
    }
}
if (!function_exists('genrelist')) {
    function genrelist($search=null,$addonrelation=null)
    {
        $data = new LibraryRepositories();
        return $data->genrelist($search,$addonrelation);
    }
}
if (!function_exists('taglist')) {
    function taglist($search=null,$addonrelation=null)
    {
        $data = new LibraryRepositories();
        return $data->taglist($search,$addonrelation);
    }
}
if (!function_exists('booksearchlist')) {
    function booksearchlist($search=null,$addonrelation=null)
    {
        $data = new LibraryRepositories();
        return $data->booksearchlist($search,$addonrelation);
    }
}
/*
 * User and Role list
 */
if (!function_exists('rolelist')) {
    function rolelist($search=null,$addonrelation=null)
    {
        $data = new UserRepository();
        return $data->rolelist($search,$addonrelation);
    }
}
if (!function_exists('userlist')) {
    function userlist($search=null,$addonrelation=null)
    {
        $data = new UserRepository();
        return $data->userlist($search,$addonrelation);
    }
}

//strength count
if (!function_exists('studentstrength')) {
    function studentstrength($search=null)
    {
        $searchsearch="['status' => 'active']";
        if(isset($search)&&($search)){
            $searchsearch=$search;
        }
        $student = dbtablesum(\App\Models\MasterAdmin\Admission\StudentRecord::class, ['dbrow' => 'count(id) as totalstrength','search'=>$searchsearch]);
        return $student->totalstrength ?  $student->totalstrength : 0;
    }
}

//Marks Manger Function
if (!function_exists('onlineexamlist')) {
    function onlineexamlist($search=null,$addonrelation=null)
    {
        $data = new MarksManagerRepositories();
        return $data->onlineexamlist($search,$addonrelation);
    }
}
if (!function_exists('examsubjectgrouplist')) {
    function examsubjectgrouplist($search=null, $relation = null)
    {
        $data = new MarksManagerRepositories();
        return $data->examsubjectgrouplist($search,$relation);
    }
}
if (!function_exists('examsubjectlist')) {
    function examsubjectlist($search=null,$addonrelation=null)
    {
        $data = new MarksManagerRepositories();
        return $data->examsubjectlist($search,$addonrelation);
    }
}
if (!function_exists('examsubjectskillgrouplist')) {
    function examsubjectskillgrouplist($search=null,$addonrelation=null)
    {
        $data = new MarksManagerRepositories();
        return $data->examsubjectskillgrouplist($search,$addonrelation);
    }
}
if (!function_exists('examsubjectskilllist')) {
    function examsubjectskilllist($search=null,$addonrelation=null)
    {
        $data = new MarksManagerRepositories();
        return $data->examsubjectskilllist($search,$addonrelation);
    }
}
if (!function_exists('examgradesystemlist')) {
    function examgradesystemlist($search=null,$addonrelation=null)
    {
        $data = new MarksManagerRepositories();
        return $data->examgradesystemlist($search,$addonrelation);
    }
}
if (!function_exists('onlineexamquestioncategorylist')) {
    function onlineexamquestioncategorylist($search=null,$addonrelation=null)
    {
        $data = new MarksManagerRepositories();
        return $data->onlineexamquestioncategorylist($search,$addonrelation);
    }
}
if (!function_exists('examtypelist')) {
    function examtypelist($search=null,$addonrelation=null)
    {
        $data = new MarksManagerRepositories();
        return $data->examtypelist($search,$addonrelation);
    }
}
if (!function_exists('examtermlist')) {
    function examtermlist($search=null,$addonrelation=null)
    {
        $data = new MarksManagerRepositories();
        return $data->examtermlist($search,$addonrelation);
    }
}
if (!function_exists('examassessmentlist')) {
    function examassessmentlist($search=null,$addonrelation=null)
    {
        $data = new MarksManagerRepositories();
        return $data->examassessmentlist($search,$addonrelation);
    }
}

//attendance result calculate
if (!function_exists('studentattendanceresult')) {
    function studentattendanceresult($search=null,$customsearch=null)
    {
        return dbtablesum(\App\Models\MasterAdmin\Attendance\StudentAttendance::class,
            ['dbrow' => 'SUM(if(attendance="p",1,0)) as totalpresent,SUM(if(attendance="a",1,0)) as totalabsent,SUM(if(attendance="l",1,0)) as totalleave,SUM(if(attendance="lt",1,0)) as totallate,count(id) as totalattendance'
                , 'search' => $search,'customsearch' => $customsearch]);
    }
}
if (!function_exists('studenttotalattendancedays')) {
    function studenttotalattendancedays($search=null,$customsearch=null)
    {
        return dbtablesum(\App\Models\MasterAdmin\Attendance\StudentAttendance::class,
            ['dbrow' => 'id,count(distinct attendance_date) as totalattendance'
                ,'search' =>$search,'customsearch'=>$customsearch]);
    }
}

if (!function_exists('attendanceholiday')) {
    function attendanceholiday($attendancedate=null,$userselect)
    {
        $search=[];
        if($userselect=="student"){$search['search']=['for_student'=>1];}elseif($userselect=="staff"){$search['search']=['for_staff'=>1];}
        if($attendancedate){$search['colsearch']=['where'=>['holiday_from_date'=>$attendancedate]];}
        $holiday=(new \App\Repositories\MasterAdmin\Attendance\StudentAttendanceRepositories())->holidaylist($search);
        if(\Carbon\Carbon::parse($attendancedate)->format('l')=="Sunday"){
            return "Sun";
        }elseif(count($holiday)>0){
            return "HL";
        }else{
            return 0;
        }
    }
}

