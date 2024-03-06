<?php


namespace App\Helper;


class UserModules
{
    public $webapp = array();
    public $mobileapp = array();

    public function __construct()
    {
        $this->webapp = [
            'master-admin' => ['student-information', 'transport', 'attendance', 'time-table', 'communication', 'app', 'library', 'stock-manager'
                , 'marks-manager', 'employee/hr', 'finance/account', 'payroll', 'front-office', 'reports', 'mobile-app', 'website'
                ,'user-management', 'global-setting'],

            'principal' => ['admission'],

            'chair-person' => [],

            'accountant' => [],

            'librarian' => [],

            'examiner' => [],

            'teacher' => ['my-profile'],

            'parent' => ["attendance"],

            'student' => ["my-profile", "homework", "time-table", "finance", "report-card"]
        ];

        $this->mobileapp = [

            'master-admin' => [

                'quick-action'=>['new-student','add-staff','student-attendance','send-sms','upload-homework','upload-notice','upload-assignment'
                ,'upload-syllabus','upload-activity','upload-downloads','student-photo','staff-photo','leave-approvals','master-update'],

                'reports'=>['student-list','staff-list','attendance-reports','transport-reports'
                ,'app-admin-reports','finance/account-reports','examination-reports','communication-reports'
                ,'front-office-reports','library-reports','stock-reports','user-reports']
            ],

            'principal' => [
                'quick-action'=> ['admission','report'],
                'reports'=> ['s','s']
            ],

            'chair-person' => [

            ],
            'accountant' => [

            ],
            'librarian' => [

            ],
            'examiner' => [

            ],
            'teacher' => [
                'quick-action'=>['inbox','attendance', 'homework', 'notice', 'assignment', 'student-photo', 'calendar','exam-entry','student-health','PTM','master-update'],
                'important-links'=>['student-list','student-fee-report','attendance-report','student-performance','exam-result','student-homework-check','my-student-birthday'],
                'about-school'=>['website','about-school','manager-message','principal-message','school-rule-regulation','staff-guidance','school-staff','contact-us']
            ],
            'parent' => [
                'quick-action'=>[
                 "attendance", "time-table", "fees", "notice", "homework", "exam-result", "classtest-result", "library", "bus-route",
                 "assignment", "performance-chart", "calender", "my-teacher", "my-classmates", "leave-request", "transfer-certificate", "certificate", "service-request", "complaint", "downloads"
                , "website", "about-school", "school-rule-regulation", "staff-guidance", "school-staff"
                , "contact-us"
                ]
            ],
            'student' => [
                'quick-action'=>['inbox','attendance','time-table','fees','notice','homework','assignment','syllabus','leave-request','exam-result','classtest-result','library','e-library','bus-route',
                'gallery','PTM','online-exam'],
                'important-links'=>['appointment','school-rating','calender','performance-chart','my-achievement','transfer-certificate','certificate','my-teacher','my-classmates','service-request','complaint','downloads'],
                'about-school'=>['website','about-school','manager-message','principal-message','school-rule-regulation','student-guidance','parent-guidance','school-staff','contact-us']
            ]
        ];

        $this->module=[
          'student-information'=>[
              'admission.analytics'=>0,
              'admission.entry'=>['student.admission'=>0,'prospectus.entry'=>0,'import.student.data'=>0,'modify.student.details'=>0],
              'master.update'=>['update.student.detail'=>0,'update.student.profile.image'=>0,'update.parent.profile.image'=>0,'student.profile.image.download'=>0,'student.document.attachment.update'=>0],
              'reports'=>['class.wise.student.detail'=>0,'student.credentials.detail'=>0,'inactive.student.details'=>0,'Class-Section.wise.strength'=>0],
              'master.setting'=>['define.document.type'=>0]
          ]
        ];

        $this->navitemicon=[
           'admission.analytics'=>'fa fa-chart-line',
           'admission.entry'=>'fa fa-user-plus',
           'master.update'=>'fa fa-edit',
           'master.setting'=>'fa fa-cogs'
        ];

    }

    public static function getwebapp($key)
    {
        return (new static())->webapp[$key] ?? null;
    }

    public static function getmobileapp($key)
    {
        return (new static())->mobileapp[$key] ?? null;
    }

    public static function erpmodule($key)
    {
        try {
            if ($key) {
                return (new static())->module[$key];
            }
            return (new static())->module;
        }catch (\Exception $e){
            return [];
        }
    }

    public static function getlinkicon($key)
    {
        try {
            return (new static())->navitemicon[$key];
        }catch (\Exception $e){
            return null;
        }
    }

}
