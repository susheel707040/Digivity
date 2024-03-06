<?php

namespace Database\Seeders;

use App\Models\MasterAdmin\GlobalSetting\AcademicSession;
use App\Models\MasterAdmin\GlobalSetting\FinancialSession;
use App\Models\MasterAdmin\GlobalSetting\SchoolBranch;
use App\Models\MasterAdmin\GlobalSetting\SchoolInformation;
use App\Models\MasterAdmin\GlobalSetting\UserMapModule;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Role;
use Illuminate\Database\Seeder;

class TenantDataBaseSeeder extends Seeder
{
    public function run(): void
    {
        $RoleData = [
            ['name' => 'Master Admin', 'alias' => 'master-admin'],
            ['name' => 'Admin', 'alias' => 'admin'],
            ['name' => 'Principal', 'alias' => 'principal'],
        ];
        $SchoolData = ['school_name' => 'Test', 'school_no' => '123'];


        foreach ($RoleData as $roleData) {
            $role = Role::create([
                'name' => $roleData['name'],
                'alias' => $roleData['alias'],
            ]);
        }
        $school = SchoolInformation::create([
            'school_name' => $SchoolData['school_name'],
            'school_no' => $SchoolData['school_no'],
        ]);

        $schoolBranch = SchoolBranch::create([
            'school_id' => $school->id,
            'school_name' => $SchoolData['school_name'],
        ]);

         AcademicSession::create([
            'school_id' => $school->id,
            'branches_id' => $schoolBranch->id,
            'academic_session' => '2024-2025',
            'start_date' => '2024-01-06',
            'end_date' => '2024-04-30',
        ]);

         FinancialSession::create([
            'school_id' => $school->id,
            'branches_id' => $schoolBranch->id,
            'financial_session' => '2024-2025',
            'start_date' => '2024-01-06',
            'end_date' => '2024-04-30',
        ]);

        DB::insert("INSERT INTO `form_auto_increment_configuration` (`id`, `school_id`, `branches_id`, `academic_id`, `key_id`, `should_be`, `p_s_support_date`, `prefix`, `prefix_date`, `start_from`, `suffix`, `suffix_date`, `status`, `user_id`, `deleted_at`, `created_at`, `updated_at`)
         VALUES
(195, 1, 1, 1, 'admission_no', 'auto', 'yes', 'DIGISM-', NULL, '22', '-2020', NULL, 'yes', 1, NULL, '2020-06-24 05:19:24', '2021-02-26 06:21:25'),
(196, 1, 1, 1, 'sr_no', 'auto', 'yes', NULL, NULL, '1250', NULL, NULL, 'yes', 1, NULL, '2020-06-24 05:19:24', '2021-02-26 06:21:25'),
(197, 1, 1, 1, 'prospectus_no', 'auto', 'yes', 'POS-', NULL, '11', NULL, NULL, 'yes', 1, NULL, '2020-06-24 05:19:24', '2021-02-25 08:00:44'),
(198, 1, 1, 1, 'staff_no', 'auto', 'yes', 'EMP/', NULL, '1', '/2020', NULL, 'yes', 1, NULL, '2020-06-24 05:19:24', '2020-06-24 05:19:24'),
(199, 1, 1, 1, 'enquiry_no', 'auto', 'yes', 'ENQ-', NULL, '1', '-2020', NULL, 'yes', 1, NULL, '2020-06-24 05:19:24', '2020-06-24 05:19:24'),
(200, 1, 1, 1, 'gatepass_no', 'auto', 'yes', NULL, NULL, '1', NULL, NULL, 'yes', 1, NULL, '2020-06-24 05:19:24', '2020-06-24 05:19:24'),
(201, 1, 1, 1, 'visitor_no', 'auto', 'yes', NULL, NULL, '1', NULL, NULL, 'yes', 1, NULL, '2020-06-24 05:19:24', '2020-06-24 05:19:24'),
(202, 1, 1, 1, 'fee_receipt_no', 'auto', 'yes', 'FEE-', NULL, '148', '/2020', NULL, 'yes', 1, NULL, '2020-06-24 05:19:24', '2023-09-06 12:14:38'),
(203, 1, 1, 1, 'certificate_no', 'auto', 'yes', NULL, NULL, '1', NULL, NULL, 'yes', 1, NULL, '2020-06-24 05:19:24', '2020-06-24 05:19:24'),
(204, 1, 1, 2, 'admission_no', 'auto', 'yes', NULL, NULL, '2', NULL, NULL, 'yes', 1, NULL, '2021-01-12 11:55:49', '2021-01-12 11:57:06'),
(205, 1, 1, 2, 'sr_no', 'auto', 'yes', NULL, NULL, '2', NULL, NULL, 'yes', 1, NULL, '2021-01-12 11:55:49', '2021-01-12 11:57:06'),
(206, 1, 1, 2, 'prospectus_no', 'auto', 'yes', NULL, NULL, '1', NULL, NULL, 'yes', 1, NULL, '2021-01-12 11:55:49', '2021-01-12 11:55:49'),
(207, 1, 1, 2, 'staff_no', 'auto', 'yes', NULL, NULL, '1', NULL, NULL, 'yes', 1, NULL, '2021-01-12 11:55:49', '2021-01-12 11:55:49'),
(208, 1, 1, 2, 'enquiry_no', 'auto', 'yes', NULL, NULL, '1', NULL, NULL, 'yes', 1, NULL, '2021-01-12 11:55:49', '2021-01-12 11:55:49'),
(209, 1, 1, 2, 'gatepass_no', 'auto', 'yes', NULL, NULL, '1', NULL, NULL, 'yes', 1, NULL, '2021-01-12 11:55:49', '2021-01-12 11:55:49'),
(210, 1, 1, 2, 'visitor_no', 'auto', 'yes', NULL, NULL, '1', NULL, NULL, 'yes', 1, NULL, '2021-01-12 11:55:49', '2021-01-12 11:55:49'),
(211, 1, 1, 2, 'fee_receipt_no', 'auto', 'yes', NULL, NULL, '1', NULL, NULL, 'yes', 1, NULL, '2021-01-12 11:55:49', '2021-01-12 11:55:49'),
(212, 1, 1, 2, 'certificate_no', 'auto', 'yes', NULL, NULL, '1', NULL, NULL, 'yes', 1, NULL, '2021-01-12 11:55:49', '2021-01-12 11:55:49'),
(213, 1, 1, 2, 'tc_no', 'auto', 'yes', NULL, NULL, '1', NULL, NULL, 'yes', 1, NULL, '2021-01-12 11:55:49', '2021-01-12 11:55:49'),
(216, 1, 1, 5, 'staff_no', 'auto', 'yes', NULL, NULL, '4', NULL, NULL, 'yes', 1, NULL, '2023-10-16 20:05:19', '2023-10-28 23:02:58'),
(217, 1, 1, 5, 'enquiry_no', 'auto', 'yes', NULL, NULL, '1', NULL, NULL, 'yes', 1, NULL, '2023-10-16 20:05:19', '2023-10-16 20:05:19'),
(218, 1, 1, 5, 'gatepass_no', 'auto', 'yes', NULL, NULL, '1', NULL, NULL, 'yes', 1, NULL, '2023-10-16 20:05:19', '2023-10-16 20:05:19'),
(219, 1, 1, 5, 'visitor_no', 'auto', 'yes', NULL, NULL, '1', NULL, NULL, 'yes', 1, NULL, '2023-10-16 20:05:19', '2023-10-16 20:05:19'),
(220, 1, 1, 5, 'fee_receipt_no', 'auto', 'yes', NULL, NULL, '53', NULL, NULL, 'yes', 1, NULL, '2023-10-16 20:05:19', '2023-11-28 13:31:50')");


         UserMapModule::create([
            'school_id' => $school->id,
            'branches_id' => $schoolBranch->id,
            'role_id' => 1,
            'ac_user_id' => 1,
             'web_app_module' => 'a:18:{s:19:"student-information";a:3:{s:9:"module_id";s:19:"student-information";s:11:"module_text";s:19:"Student Information";s:15:"module_sequence";s:1:"1";}s:9:"transport";a:3:{s:9:"module_id";s:9:"transport";s:11:"module_text";s:9:"Transport";s:15:"module_sequence";s:1:"2";}s:10:"attendance";a:3:{s:9:"module_id";s:10:"attendance";s:11:"module_text";s:10:"Attendance";s:15:"module_sequence";s:1:"3";}s:10:"time-table";a:3:{s:9:"module_id";s:10:"time-table";s:11:"module_text";s:10:"Time Table";s:15:"module_sequence";s:1:"4";}s:13:"communication";a:3:{s:9:"module_id";s:13:"communication";s:11:"module_text";s:13:"Communication";s:15:"module_sequence";s:1:"5";}s:3:"app";a:3:{s:9:"module_id";s:3:"app";s:11:"module_text";s:3:"App";s:15:"module_sequence";s:1:"6";}s:7:"library";a:3:{s:9:"module_id";s:7:"library";s:11:"module_text";s:7:"Library";s:15:"module_sequence";s:1:"7";}s:13:"stock-manager";a:3:{s:9:"module_id";s:13:"stock-manager";s:11:"module_text";s:13:"Stock Manager";s:15:"module_sequence";s:1:"8";}s:13:"marks-manager";a:3:{s:9:"module_id";s:13:"marks-manager";s:11:"module_text";s:13:"Marks Manager";s:15:"module_sequence";s:1:"9";}s:11:"employee/hr";a:3:{s:9:"module_id";s:11:"employee/hr";s:11:"module_text";s:11:"Employee/hr";s:15:"module_sequence";s:2:"10";}s:15:"finance/account";a:3:{s:9:"module_id";s:15:"finance/account";s:11:"module_text";s:15:"Finance/account";s:15:"module_sequence";s:2:"11";}s:7:"payroll";a:3:{s:9:"module_id";s:7:"payroll";s:11:"module_text";s:7:"Payroll";s:15:"module_sequence";s:2:"12";}s:12:"front-office";a:3:{s:9:"module_id";s:12:"front-office";s:11:"module_text";s:12:"Front Office";s:15:"module_sequence";s:2:"13";}s:7:"reports";a:3:{s:9:"module_id";s:7:"reports";s:11:"module_text";s:7:"Reports";s:15:"module_sequence";s:2:"14";}s:10:"mobile-app";a:3:{s:9:"module_id";s:10:"mobile-app";s:11:"module_text";s:10:"Mobile App";s:15:"module_sequence";s:2:"15";}s:7:"website";a:3:{s:9:"module_id";s:7:"website";s:11:"module_text";s:7:"Website";s:15:"module_sequence";s:2:"16";}s:15:"user-management";a:3:{s:9:"module_id";s:15:"user-management";s:11:"module_text";s:15:"User Management";s:15:"module_sequence";s:2:"17";}s:14:"global-setting";a:3:{s:9:"module_id";s:14:"global-setting";s:11:"module_text";s:14:"Global Setting";s:15:"module_sequence";s:2:"18";}}',
            'mobile_app_module' =>'a:2:{s:12:"quick-action";a:12:{s:9:"add-staff";a:3:{s:9:"module_id";s:9:"add-staff";s:11:"module_text";s:9:"Add Staff";s:15:"module_sequence";s:1:"2";}s:8:"send-sms";a:3:{s:9:"module_id";s:8:"send-sms";s:11:"module_text";s:8:"Send Sms";s:15:"module_sequence";s:1:"4";}s:15:"upload-homework";a:3:{s:9:"module_id";s:15:"upload-homework";s:11:"module_text";s:15:"Upload Homework";s:15:"module_sequence";s:1:"5";}s:13:"upload-notice";a:3:{s:9:"module_id";s:13:"upload-notice";s:11:"module_text";s:13:"Upload Notice";s:15:"module_sequence";s:1:"6";}s:17:"upload-assignment";a:3:{s:9:"module_id";s:17:"upload-assignment";s:11:"module_text";s:17:"Upload Assignment";s:15:"module_sequence";s:1:"7";}s:15:"upload-syllabus";a:3:{s:9:"module_id";s:15:"upload-syllabus";s:11:"module_text";s:15:"Upload Syllabus";s:15:"module_sequence";s:1:"8";}s:15:"upload-activity";a:3:{s:9:"module_id";s:15:"upload-activity";s:11:"module_text";s:15:"Upload Activity";s:15:"module_sequence";s:1:"8";}s:16:"upload-downloads";a:3:{s:9:"module_id";s:16:"upload-downloads";s:11:"module_text";s:16:"Upload Downloads";s:15:"module_sequence";s:2:"10";}s:13:"student-photo";a:3:{s:9:"module_id";s:13:"student-photo";s:11:"module_text";s:13:"Student Photo";s:15:"module_sequence";s:1:"9";}s:11:"staff-photo";a:3:{s:9:"module_id";s:11:"staff-photo";s:11:"module_text";s:11:"Staff Photo";s:15:"module_sequence";s:2:"10";}s:15:"leave-approvals";a:3:{s:9:"module_id";s:15:"leave-approvals";s:11:"module_text";s:15:"Leave Approvals";s:15:"module_sequence";s:2:"11";}s:13:"master-update";a:3:{s:9:"module_id";s:13:"master-update";s:11:"module_text";s:13:"Master Update";s:15:"module_sequence";s:2:"15";}}s:7:"reports";a:12:{s:12:"student-list";a:3:{s:9:"module_id";s:12:"student-list";s:11:"module_text";s:12:"Student List";s:15:"module_sequence";s:1:"1";}s:10:"staff-list";a:3:{s:9:"module_id";s:10:"staff-list";s:11:"module_text";s:10:"Staff List";s:15:"module_sequence";s:1:"2";}s:18:"attendance-reports";a:3:{s:9:"module_id";s:18:"attendance-reports";s:11:"module_text";s:18:"Attendance Reports";s:15:"module_sequence";s:1:"3";}s:17:"transport-reports";a:3:{s:9:"module_id";s:17:"transport-reports";s:11:"module_text";s:17:"Transport Reports";s:15:"module_sequence";s:1:"4";}s:17:"app-admin-reports";a:3:{s:9:"module_id";s:17:"app-admin-reports";s:11:"module_text";s:17:"App Admin-reports";s:15:"module_sequence";s:1:"5";}s:23:"finance/account-reports";a:3:{s:9:"module_id";s:23:"finance/account-reports";s:11:"module_text";s:15:"Finance Reports";s:15:"module_sequence";s:1:"6";}s:19:"examination-reports";a:3:{s:9:"module_id";s:19:"examination-reports";s:11:"module_text";s:19:"Examination Reports";s:15:"module_sequence";s:1:"7";}s:21:"communication-reports";a:3:{s:9:"module_id";s:21:"communication-reports";s:11:"module_text";s:11:"SMS Reports";s:15:"module_sequence";s:1:"8";}s:20:"front-office-reports";a:3:{s:9:"module_id";s:20:"front-office-reports";s:11:"module_text";s:20:"Front Office-reports";s:15:"module_sequence";s:1:"9";}s:15:"library-reports";a:3:{s:9:"module_id";s:15:"library-reports";s:11:"module_text";s:15:"Library Reports";s:15:"module_sequence";s:2:"10";}s:13:"stock-reports";a:3:{s:9:"module_id";s:13:"stock-reports";s:11:"module_text";s:13:"Stock Reports";s:15:"module_sequence";s:2:"11";}s:12:"user-reports";a:3:{s:9:"module_id";s:12:"user-reports";s:11:"module_text";s:12:"User Reports";s:15:"module_sequence";s:1:"9";}}}'
        ]);


        DB::insert("INSERT INTO `navbar` (`id`, `school_id`, `branches_id`, `sequence`, `for`, `module_id`, `parent_id`, `key`, `value`, `operation`, `description`, `icon`, `link`, `default_value`, `status`, `deleted_at`, `created_at`, `updated_at`)
        VALUES
        (1, $school->id, $schoolBranch->id, 0, 'Admin', '', NULL, 'student-information', 'student information', '', NULL, NULL, NULL, NULL, '1', NULL, NOW(), NOW()),
        (2, $school->id, $schoolBranch->id, 1, 'Admin', '', 'student-information', 'admission.analytics', 'admission.analytics', '', NULL, NULL, NULL, NULL, '1', NULL, NOW(), NOW()),
        (3, $school->id,$schoolBranch->id, 2, 'Admin', '', 'student-information', 'admission.entry', 'admission.entry', '', NULL, NULL, NULL, NULL, '1', NULL, NOW(), NOW()),
        (4, $school->id, $schoolBranch->id, 1, 'Admin', '', 'admission.entry', 'student.admission', 'student.admission', 'add', NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL),
        (5, $school->id, $schoolBranch->id, 2, 'Admin', '', 'admission.entry', 'prospectus.entry', 'prospectus.entry', 'add', NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL),
        (6, $school->id, $schoolBranch->id, 3, 'Admin', '', 'admission.entry', 'import.student.data', 'import.student.data', '', NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL),
        (7, $school->id, $schoolBranch->id, 4, 'Admin', '', 'admission.entry', 'modify.student.details', 'modify.student.details', '', NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL),
        (8, $school->id, $schoolBranch->id, 4, 'Admin', '', 'student-information', 'master.update', 'master.update', '', NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL),
        (9, $school->id, $schoolBranch->id, 1, 'Admin', '', 'master.update', 'update.student.detail', 'update.student.detail', '', NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL),
        (10,$school->id,$schoolBranch->id, 2, 'Admin', '', 'master.update', 'update.student.profile.image', 'update.student.profile.image', '', NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL),
        (11,$school->id,$schoolBranch->id, 3, 'Admin', '', 'master.update', 'update.parent.profile.image', 'update.parent.profile.image', '', NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL),
        (12,$school->id,$schoolBranch->id, 4, 'Admin', '', 'master.update', 'student.profile.image.download', 'student.profile.image.download', '', NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL),
        (13,$school->id,$schoolBranch->id, 5, 'Admin', '', 'master.update', 'student.document.attachment.update', 'student.document.attachment.update', '', NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL),
        (14,$school->id,$schoolBranch->id, 6, 'Admin', '', 'student-information', 'reports', 'reports', '', NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL),
        (15,$school->id,$schoolBranch->id, 1, 'Admin', '', 'reports', 'class.wise.student.detail', 'class.wise.student.detail', '', NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL),
        (16,$school->id,$schoolBranch->id, 2, 'Admin', '', 'reports', 'student.credentials.detail', 'student.credentials.detail', '', NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL),
        (17,$school->id,$schoolBranch->id, 3, 'Admin', '', 'reports', 'inactive.student.details', 'inactive.student.details', '', NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL),
        (18,$school->id,$schoolBranch->id, 4, 'Admin', '', 'reports', 'Class-Section.wise.strength', 'Class Section.wise.strength', '', NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL),
        (19,$school->id,$schoolBranch->id, 5, 'Admin', '', 'reports', 'student.birthday.details', 'student.birthday.details', '', NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL),
        (20,$school->id,$schoolBranch->id, 8, 'Admin', '', 'student-information', 'master.setting', 'master.setting', '', NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL),
        (21,$school->id,$schoolBranch->id, 1, 'Admin', '', 'master.setting', 'define.document.type', 'define.document.type', '', NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL),
        (22,$school->id,$schoolBranch->id, 1, 'Admin', '', NULL, 'transport', 'transport', '', NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL),
        (23,$school->id,$schoolBranch->id, 2, 'Admin', '', NULL, 'attendance', 'attendance', '', NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL),
        (24,$school->id,$schoolBranch->id, 3, 'Admin', '', NULL, 'time-table', 'time table', '', NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL),
        (25,$school->id,$schoolBranch->id, 4, 'Admin', '', NULL, 'communication', 'communication', '', NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL),
        (26,$school->id,$schoolBranch->id, 5, 'Admin', '', NULL, 'app', 'app', '', NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL),
        (27,$school->id,$schoolBranch->id, 6, 'Admin', '', NULL, 'library', 'library', '', NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL),
        (28,$school->id,$schoolBranch->id, 7, 'Admin', '', NULL, 'stock-manager', 'stock manager', '', NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL),
        (29,$school->id,$schoolBranch->id, 8, 'Admin', '', NULL, 'marks-manager', 'marks manager', '', NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL),
        (30,$school->id,$schoolBranch->id, 9, 'Admin', '', NULL, 'employee', 'employee', '', NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL),
        (31,$school->id,$schoolBranch->id, 10, 'Admin', '', NULL, 'finance', 'finance', '', NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL),
        (32,$school->id,$schoolBranch->id, 11, 'Admin', '', NULL, 'payroll', 'payroll', '', NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL),
        (33,$school->id,$schoolBranch->id, 12, 'Admin', '', NULL, 'front-office', 'front office', '', NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL),
        (34,$school->id,$schoolBranch->id, 13, 'Admin', '', NULL, 'reports', 'reports', '', NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL),
        (35,$school->id,$schoolBranch->id, 14, 'Admin', '', NULL, 'mobile-app', 'mobile app', '', NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL),
        (36,$school->id,$schoolBranch->id, 15, 'Admin', '', NULL, 'website', 'website', '', NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL),
        (37,$school->id,$schoolBranch->id, 16, 'Admin', '', NULL, 'user-management', 'user management', '', NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL),
        (38,$school->id,$schoolBranch->id, 17, 'Admin', '', NULL, 'global-setting', 'global setting', '', NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL)");
    }
}
