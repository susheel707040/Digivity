<?php


namespace App\View;

use Illuminate\View\View;

class GlobalComposer
{
    public function compose(View $view)
    {
        if (auth()->check()) {
            $module = auth()->user()->modules()->count() ? unserialize(auth()->user()->modules()->first()->web_app_module) : [];
            $view->with('module', $module);
        }
        $title_name = array('mr.', 'ms.', 'mrs.', 'miss.', 'dr.', 'fr.', 'sr.');
        $genderlist = array('male', 'female', 'transgender');
        $feetype = array('opening-balance', 'transport', 'hostel', 'library', 'discount', 'late-fee', 'excess-fee', 'cheque-bounce-charge', 'other');
        $feemonth = ['lifetime' => ['lifetime'], 'annual' => ['annual'], 'installment' => ['apr', 'may', 'jun', 'jul', 'aug', 'sep', 'oct', 'nov', 'dec', 'jan', 'feb', 'mar'], 'custom' => ['custom_1']];
        $bloodgroup = array('A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-', 'unknown');
        $maritalstatus = maritalstatus();
        $pagename = ['about-school' => 'About School/Information','manager-message'=>'Manager Message','principal-message'=>'Principal Message','school-rule-regulation' => 'School Rule Regulation',
            'student-guidance' => 'Student Guidance', 'parent-guidance' => 'Parent Guidance', 'school-staff' => 'School Staff',
            'contact-us' => 'Contact Us'];
        $formname = ['admission_no' => 'Admission No. in Admission Form', 'sr_no' => ' Sr.No. in Admission Form',
            'prospectus_no' => 'Prospectus Form Entry','staff_no'=>'Staff/Employee No. in Staff Registration', 'enquiry_no' => 'Enquiry Form', 'gatepass_no' => 'Gate Pass Form'
            ,'visitor_no'=>'Visitor Form','fee_receipt_no'=>'Fee Receipt No. in Fee Collection','certificate_no'=>'Certificate No. in Generate Certificate',
            'tc_no'=>'Transfer Certificate No.'];

        $integratedmodule=['transport'=>'Transportation','account'=>'Accounts'];

        $libraryaudience=["1500"=>"Children's: ages 0 - 8","40000"=>"Middle-Grade: ages 8 - 12","80000"=>"Young Adult: ages 12 - 18","100000"=>"New Adult: ages 18 - 25","120000"=>"Adult: ages 20+"];

        $view->with(['title_name' => $title_name, 'genderlist' => $genderlist
            , 'feetype' => $feetype, 'feemonth' => $feemonth,
            'bloodgroup' => $bloodgroup, 'maritalstatus' => $maritalstatus, 'pagename' => $pagename,'formname'=>$formname,'integratedmodule'=>$integratedmodule,'libraryaudience'=>$libraryaudience]);

    }
}
