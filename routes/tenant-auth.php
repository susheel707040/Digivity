<?php

use App\Http\Controllers\App\Auth\AuthenticatedSessionController;
use App\Http\Controllers\App\Auth\ConfirmablePasswordController;
use App\Http\Controllers\App\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\App\Auth\EmailVerificationPromptController;
use App\Http\Controllers\App\Auth\NewPasswordController;
use App\Http\Controllers\App\Auth\PasswordController;
use App\Http\Controllers\App\Auth\PasswordResetLinkController;
use App\Http\Controllers\App\Auth\RegisteredUserController;
use App\Http\Controllers\App\Auth\VerifyEmailController;
use App\Http\Controllers\App\BookmarksLinkController;
use App\Http\Controllers\App\DashboardController;
use App\Http\Controllers\App\CommonController;
use App\Http\Controllers\App\Delete\RecordDeleteController;
use App\Http\Controllers\App\Exports\ExportFileController as ExportsExportFileController;
use App\Http\Controllers\App\Exports\ExportPdfController;
use App\Http\Controllers\App\FileUploaderController;
use App\Http\Controllers\App\MasterAdmin\AcademicSetting\AdmissionTypeController;

use App\Http\Controllers\App\MasterAdmin\Timetable\ClassTimetableController;
use App\Http\Controllers\App\MasterAdmin\Timetable\TimetableController;
use App\Http\Controllers\App\MasterAdmin\AcademicSetting\CasteController;
use App\Http\Controllers\App\MasterAdmin\AcademicSetting\CategoryController;
use App\Http\Controllers\App\MasterAdmin\AcademicSetting\ClassWithSectionController;
use App\Http\Controllers\App\MasterAdmin\AcademicSetting\CourseController;
use App\Http\Controllers\App\MasterAdmin\AcademicSetting\HouseController;
use App\Http\Controllers\App\MasterAdmin\AcademicSetting\NationalityController;
use App\Http\Controllers\App\MasterAdmin\AcademicSetting\ParentStatusController;
use App\Http\Controllers\App\MasterAdmin\AcademicSetting\ParishController;
use App\Http\Controllers\APP\MasterAdmin\AcademicSetting\ReligionController;
use App\Http\Controllers\App\MasterAdmin\AcademicSetting\SectionController;
use App\Http\Controllers\App\MasterAdmin\AcademicSetting\StreamController;
use App\Http\Controllers\App\MasterAdmin\AcademicSetting\SubjectController;
use App\Http\Controllers\App\MasterAdmin\AcademicSetting\SubjectMapWithCourseController;
use App\Http\Controllers\App\MasterAdmin\AcademicSetting\WingController;
use App\Http\Controllers\App\MasterAdmin\Admission\AdmissionIndexController;
use App\Http\Controllers\App\MasterAdmin\Admission\StudentAdmissionController;
use App\Http\Controllers\App\MasterAdmin\Attendance\AttendanceIndexController;
use App\Http\Controllers\App\MasterAdmin\Communication\CommunicationIndexController;
use App\Http\Controllers\App\MasterAdmin\Finance\FinanceIndexController;
use App\Http\Controllers\App\MasterAdmin\FrontOffice\FrontOfficeIndexController;
use App\Http\Controllers\App\MasterAdmin\GlobalSetting\AcademicYearController;

use App\Http\Controllers\App\MasterAdmin\Library\MasterSetting\BookController;
use App\Http\Controllers\App\MasterAdmin\GlobalSetting\AdmissionIsNewStatusController;
use App\Http\Controllers\App\MasterAdmin\GlobalSetting\BarcodeController;
use App\Http\Controllers\App\MasterAdmin\GlobalSetting\CertificateController;
use App\Http\Controllers\App\MasterAdmin\GlobalSetting\CertificateIntegrateFormController;
use App\Http\Controllers\App\MasterAdmin\GlobalSetting\CertificateTemplateController;
use App\Http\Controllers\App\MasterAdmin\GlobalSetting\DynamicReportSettingController;
use App\Http\Controllers\App\MasterAdmin\GlobalSetting\EmailConfigurationController;
use App\Http\Controllers\App\MasterAdmin\GlobalSetting\FinancialYearController;
use App\Http\Controllers\App\MasterAdmin\GlobalSetting\FormNoAutoController;
use App\Http\Controllers\App\MasterAdmin\Library\LibraryReportController;
use App\Http\Controllers\App\MasterAdmin\GlobalSetting\GlobalSettingController as GlobalSettingGlobalSettingController;
use App\Http\Controllers\App\MasterAdmin\GlobalSetting\GlobalSettingIndexController;
use App\Http\Controllers\App\MasterAdmin\GlobalSetting\SchoolBoardController;
use App\Http\Controllers\App\MasterAdmin\GlobalSetting\SessionTransferController;
use App\Http\Controllers\App\MasterAdmin\GlobalSetting\SMSConfigurationController;
use App\Http\Controllers\App\MasterAdmin\GlobalSetting\TeacherClassMapController;
use App\Http\Controllers\App\MasterAdmin\GlobalSetting\UIDisplayController;
use App\Http\Controllers\App\MasterAdmin\Library\IssueBookController;
use App\Http\Controllers\App\MasterAdmin\Library\LibraryIndexController;
use App\Http\Controllers\App\MasterAdmin\MarksManager\MarksManagerIndexController;
use App\Http\Controllers\Auth\AuthTwoController;
use App\Http\Controllers\App\MasterAdmin\MasterUpdate\FileUpdateController;
use App\Http\Controllers\App\MasterAdmin\MobileApp\AboutSchoolController;
use App\Http\Controllers\App\MasterAdmin\Staff\StaffIndexController;
use App\Http\Controllers\App\MasterAdmin\Transport\TransportAssignController;
use App\Http\Controllers\App\MasterAdmin\Transport\TransportIndexController;
use App\Http\Controllers\App\MasterAdmin\User\ReportController;
use App\Http\Controllers\App\MasterAdmin\User\UserController;
use App\Http\Controllers\App\MasterAdmin\User\UserIndexController;
use App\Http\Controllers\App\MasterAdmin\User\UserPermissionController;
use App\Http\Controllers\App\MasterAdmin\User\UserRoleController;
use App\Http\Controllers\App\MasterAdmin\User\UserSettingController as UserUserSettingController;
use App\Http\Controllers\App\MasterAdmin\Website\WebsiteIndexController;
use App\Http\Controllers\App\Exports\ExportFileController;
use App\Http\Controllers\App\GetSelectBoxDataListController;
use App\Http\Controllers\App\MasterAdmin\AcademicSetting\StudentDocumentTypeController;
use App\Http\Controllers\App\MasterAdmin\Admission\MasterSetting\StudentInfoSettingController;
use App\Http\Controllers\App\MasterAdmin\Admission\MasterUpdate\StudentAccountController;
use App\Http\Controllers\App\MasterAdmin\Admission\MasterUpdate\StudentBulkUpdateController;
use App\Http\Controllers\App\MasterAdmin\Admission\MasterUpdate\StudentDocumentUpdateController;
use App\Http\Controllers\App\MasterAdmin\Admission\MasterUpdate\StudentProfileImageController;
use App\Http\Controllers\App\MasterAdmin\Admission\Reports\StudentBirthdayController;
use App\Http\Controllers\App\MasterAdmin\Admission\Reports\StudentProspectusReportController;
use App\Http\Controllers\App\MasterAdmin\Admission\Reports\StudentReportsController;
use App\Http\Controllers\App\MasterAdmin\Admission\Reports\StudentStrengthController;
use App\Http\Controllers\App\MasterAdmin\Admission\StudentGenerateTCController;
use App\Http\Controllers\App\MasterAdmin\Admission\StudentIDCardController;
use App\Http\Controllers\App\MasterAdmin\Admission\StudentImportDataController;
use App\Http\Controllers\App\MasterAdmin\Admission\StudentProspectusController;
use App\Http\Controllers\App\MasterAdmin\Attendance\MasterSetting\HolidayController;
use App\Http\Controllers\App\MasterAdmin\Attendance\MasterSetting\LeaveTypeController;
use App\Http\Controllers\App\MasterAdmin\Attendance\Report\StudentAttendanceReportController;
use App\Http\Controllers\App\MasterAdmin\Attendance\StaffAttendanceController as AttendanceStaffAttendanceController;
use App\Http\Controllers\App\MasterAdmin\Attendance\StudentAttendanceController as AttendanceStudentAttendanceController;
use App\Http\Controllers\App\MasterAdmin\Certificate\CertificatePreviewController;
use App\Http\Controllers\App\MasterAdmin\Certificate\CertificateReportController;
use App\Http\Controllers\App\MasterAdmin\Certificate\GenerateCertificateController;
use App\Http\Controllers\App\MasterAdmin\Communication\AutoSendSMSController;
use App\Http\Controllers\App\MasterAdmin\Communication\CommunicationViewPageController;
use App\Http\Controllers\App\MasterAdmin\Communication\ImportPhoneBookController;
use App\Http\Controllers\App\MasterAdmin\Communication\MasterSetting\EmailTemplateController;
use App\Http\Controllers\App\MasterAdmin\Communication\MasterSetting\FixHeaderFooterController;
use App\Http\Controllers\App\MasterAdmin\Communication\MasterSetting\SMSTemplateController;
use App\Http\Controllers\App\MasterAdmin\Communication\MasterSetting\UserSMSCopyController;
use App\Http\Controllers\App\MasterAdmin\Communication\PhoneBookGroupController;
use App\Http\Controllers\App\MasterAdmin\Communication\Report\CommunicationFailureController;
use App\Http\Controllers\App\MasterAdmin\Communication\Report\ReportController as ReportReportController;
use App\Http\Controllers\App\MasterAdmin\Communication\SendSMSController;
use App\Http\Controllers\App\MasterAdmin\FrontOffice\Entry\EnquiryController;
use App\Http\Controllers\App\MasterAdmin\FrontOffice\Entry\GatePassController;
use App\Http\Controllers\App\MasterAdmin\FrontOffice\Entry\VisitorController;
use App\Http\Controllers\App\MasterAdmin\InApp\AssignmentController;
use App\Http\Controllers\App\MasterAdmin\InApp\HomeworkController;
use App\Http\Controllers\App\MasterAdmin\InApp\NoticeController;
use App\Http\Controllers\App\MasterAdmin\Library\MasterSetting\BookImportController;
use App\Http\Controllers\App\MasterAdmin\Library\MasterSetting\LibraryAuthorController;
use App\Http\Controllers\App\MasterAdmin\Library\MasterSetting\LibraryCategoryController;
use App\Http\Controllers\App\MasterAdmin\Library\MasterSetting\LibraryController;
use App\Http\Controllers\App\MasterAdmin\Library\MasterSetting\LibraryGenreController;
use App\Http\Controllers\App\MasterAdmin\Library\MasterSetting\LibraryRackController;
use App\Http\Controllers\App\MasterAdmin\Library\MasterSetting\LibrarySettingController;
use App\Http\Controllers\App\MasterAdmin\Library\MasterSetting\TagController;
use App\Http\Controllers\App\MasterAdmin\Staff\MasterSetting\DocumentController;
use App\Http\Controllers\App\MasterAdmin\Staff\MasterSetting\ProfessionTypeController;
use App\Http\Controllers\App\MasterAdmin\Staff\MasterSetting\StaffQualificationController;
use App\Http\Controllers\App\MasterAdmin\Staff\MasterSetting\SkillAndKnowledgeController;
use App\Http\Controllers\App\MasterAdmin\Staff\MasterSetting\StaffDepartmentController;
use App\Http\Controllers\App\MasterAdmin\Staff\MasterSetting\StaffDesignationController;
use App\Http\Controllers\App\MasterAdmin\Staff\MasterSetting\StaffTypeController;
use App\Http\Controllers\App\MasterAdmin\Staff\MasterUpdate\StaffProfileImageController;
use App\Http\Controllers\App\MasterAdmin\Staff\Report\StaffReportController;
use App\Http\Controllers\App\MasterAdmin\Staff\StaffImportController;
use App\Http\Controllers\App\MasterAdmin\Staff\StaffRecordController;
use App\Http\Controllers\App\MasterAdmin\Transport\FinanceStudentAssignTransportController;
use App\Http\Controllers\App\MasterAdmin\Transport\MasterSetting\RouteController;
use App\Http\Controllers\App\MasterAdmin\Transport\MasterSetting\RouteRelationController;
use App\Http\Controllers\App\MasterAdmin\Transport\MasterSetting\RouteStopController;
use App\Http\Controllers\App\MasterAdmin\Transport\MasterSetting\TravelAgencyController;
use App\Http\Controllers\App\MasterAdmin\Transport\MasterSetting\VehicleController;
use App\Http\Controllers\App\MasterAdmin\Transport\MasterSetting\VehicleTypeController;
use App\Http\Controllers\App\MasterAdmin\Transport\Report\TransportReportController;
use App\Http\Controllers\App\MasterAdmin\FrontOffice\Entry\AppointmentController;
use App\Http\Controllers\App\MasterAdmin\Communication\MasterSetting\CommunicationTypeController;
use App\Http\Controllers\App\MasterAdmin\Communication\PhoneBookController;
use App\Http\Controllers\MasterAdmin\GlobalSetting\GlobalSettingController;
use App\Http\Controllers\MasterAdmin\User\UserSettingController;
use App\Http\Controllers\App\MasterAdmin\Library\LibraryBookEntryController;
use App\Http\Controllers\App\MasterAdmin\Finance\MasterSetting\FeeCollectionSetting;
use App\Http\Controllers\App\MasterAdmin\Finance\MasterSetting\FeeReceiptSettingController;
use App\Http\Controllers\App\MasterAdmin\Finance\MasterSetting\PaymodeController;
use App\Http\Controllers\App\MasterAdmin\Finance\MasterSetting\FeeAccountController;
use App\Http\Controllers\App\MasterAdmin\Finance\MasterSetting\FeeGroupController;
use App\Http\Controllers\App\MasterAdmin\Finance\MasterSetting\FeeGroupMapWithCourseController;
use App\Http\Controllers\App\MasterAdmin\Finance\MasterSetting\FeeHeadController;
use App\Http\Controllers\App\MasterAdmin\Finance\MasterSetting\FeeHeadMapWithInstallmentController;
use App\Http\Controllers\App\MasterAdmin\Finance\MasterSetting\FeeStrutureController;
use App\Http\Controllers\App\MasterAdmin\Finance\MasterSetting\ConcessionTypeController;
use App\Http\Controllers\App\MasterAdmin\Finance\MasterSetting\FineSettingController;
use App\Http\Controllers\App\MasterAdmin\Finance\MasterSetting\ConcessionSettingController;
use App\Http\Controllers\App\MasterAdmin\Finance\FeeEntry\FeeCollectionController;
use App\Http\Controllers\App\MasterAdmin\Finance\FeeEntry\ChequeBounceEntryController;
use App\Http\Controllers\App\MasterAdmin\Finance\FeeEntry\FeeReceiptCancelController;
use App\Http\Controllers\App\MasterAdmin\Finance\FeeEntry\FeeReceiptModifyController;
use App\Http\Controllers\App\MasterAdmin\Finance\MasterUpdate\StudentFeeModifyController;
use App\Http\Controllers\APp\MasterAdmin\Finance\FeeEntry\OnlineFeeSettlementController;
use App\Http\Controllers\App\MasterAdmin\Finance\FeeEntry\FeeUploadDepositBankController;
use App\Http\Controllers\App\MasterAdmin\Finance\Reports\FeeDefaulterReportController;
use App\Http\Controllers\App\MasterAdmin\Finance\Reports\FeeCollectionReportController;
use App\Http\Controllers\App\MasterAdmin\Finance\Reports\StudentConcessionReportController;
use App\Http\Controllers\App\MasterAdmin\Finance\Reports\FeeCollectionConcessionReport;
use App\Http\Controllers\App\MasterAdmin\Finance\Reports\FeeOpeningBalanceController;
use App\Http\Controllers\App\MasterAdmin\GlobalSetting\IDCardTemplateController;
use App\Http\Controllers\App\MasterAdmin\MarksManager\Entry\ExamMarksImportController;
use App\Http\Controllers\App\MasterAdmin\MarksManager\OnlineExam\OnlineExamController;
use App\Http\Controllers\App\MasterAdmin\MarksManager\OnlineExam\SetOnlineExamQuestionController;
use App\Http\Controllers\App\MasterAdmin\MarksManager\MasterSetting\ExamSubjectController;
use App\Http\Controllers\App\MasterAdmin\MarksManager\MasterSetting\ExamActivitiesController;
use App\Http\Controllers\App\MasterAdmin\MarksManager\MasterSetting\ExamSubjectSkillGroupController;
use App\Http\Controllers\App\MasterAdmin\MarksManager\MasterSetting\ExamSubjectSkillController;
use App\Http\Controllers\App\MasterAdmin\MarksManager\MasterSetting\ExamSubjectMapWithCourseController;
use App\Http\Controllers\App\MasterAdmin\MarksManager\MasterSetting\ExamTypeController;
use App\Http\Controllers\App\MasterAdmin\MarksManager\MasterSetting\ExamTermController;
use App\Http\Controllers\App\MasterAdmin\MarksManager\MasterSetting\ExamAssessmentController;
use App\Http\Controllers\App\MasterAdmin\MarksManager\MasterSetting\ExamGradeSystemController;
use App\Http\Controllers\App\MasterAdmin\MarksManager\MasterSetting\ExamConfigurationController;
use App\Http\Controllers\App\MasterAdmin\MarksManager\Report\ExamReportCardController;
use App\Http\Controllers\App\MasterAdmin\MarksManager\Report\ExamHallTicketController;
use App\Http\Controllers\App\MasterAdmin\MarksManager\Entry\ExamMarksEntryController;
use App\Http\Controllers\App\MasterAdmin\InApp\CalendarTypeController;
use App\Http\Controllers\App\MasterAdmin\InApp\DownloadController;
use App\Http\Controllers\App\MasterAdmin\InApp\SyllabusController;
use App\Http\Controllers\App\MasterAdmin\InApp\CalendarController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
                ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::get('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');


                Route::get('/print/{header}', function ($header) {
                    return view('Print.print-page', compact(['header'])); });


    Route::post('/image-save', [DashboardController::class, 'imageSave']);
    Route::get('/TwoFaAuthentication', [AuthTwoController::class,'twofashow']);
    Route::get('/UserProfile/{user}/view', [AuthTwoController::class,'userprofileshow']);
    Route::get('/EditUserProfile/{user}/edit', [AuthTwoController::class,'edituserprofileshow']);
    Route::post('/EditProfilePost/{user}/edit', [AuthTwoController::class,'edituserprofilepost']);
    Route::get('/ChangePassword', [AuthTwoController::class,'changepasswordshow']);
    Route::get('/LogInHistory',[AuthTwoController::class,'loginhistoryshow']);
    Route::post('/ChangePasswordPost/{user}/password', [AuthTwoController::class,'changepasswordpost']);
    Route::post('/TwoFaPost/{user}/2fa', [AuthTwoController::class,'twofastatuspost']);
    //after login redirect to home/dashboard page
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])
    ->name('dashboard');
    //academic year and financial year change
    Route::post('/UserYearChange/{user}/change',  [CommonController::class, 'academicyearchange']);
    Route::post('/FileUpdateModel', [FileUpdateController::class,'fileupdate']);
    //get select box data ajax for option
    Route::get('/GetSelectBoxDataList/{datawith}', [GetSelectBoxDataListController::class,'datalist']);
    //bookmarks links
    Route::get('BookmarksLink', [BookmarksLinkController::class,'index']);
    Route::post('StoreBookmarksLink', [BookmarksLinkController::class,'store']);
    Route::post('GenerateBarcodePrint', [BarcodeController::class,'barcodeprint'])->name('admin.barcodeprint');

    /**
     * Master Admin StudentInformation Module
     */
    Route::prefix('MasterAdmin/StudentInformation')->group(function () {


        Route::get('index', [AdmissionIndexController::class,'index'])->name('admission.analytics');
        Route::get('StudentRegistration', [StudentAdmissionController::class,'index'])->name('student.admission');
        Route::post('StudentCreate', [StudentAdmissionController::class,'store']);
        Route::get('EditStudentView/{studentid}/view',[StudentAdmissionController::class,'editview']);
        Route::get('ModalEditStudentView/{studentid}/view', [StudentAdmissionController::class,'modaleditview']);
        Route::post('EditStudent/{studentid}/edit', [StudentAdmissionController::class,'modify']);
        Route::post('EditStudentUpdate', [StudentBulkUpdateController::class,'modify']);

        Route::get('ProspectusEntry', [StudentProspectusController::class, 'index'])->name('prospectus.entry');
        Route::post('ProspectusCreate',  [StudentProspectusController::class, 'store']);
        Route::get('EditViewProspectus/{studentprospectus}/edit', [StudentProspectusController::class,'editview']);
        Route::post('EditProspectus/{studentprospectus}/edit', [StudentProspectusController::class,'modify']);
        Route::get('ProspectusPayment/{studentprospectus}/Entry', [StudentProspectusController::class,'paymentprocess']);

        Route::get('ImportStudentData', [StudentImportDataController::class, 'index'])->name('import.student.data');
        Route::post('ImportStudentView', [StudentImportDataController::class,'indexview']);
        Route::post('ImportStudentCreate',  [StudentImportDataController::class, 'importstudentstore']);
        Route::get('StudentInformationSetting', [StudentInfoSettingController::class,'index']);
        Route::post('StudentInfoSettingStore/{id}', [StudentInfoSettingController::class,'store']);

        Route::match(['GET', 'POST'], 'ClassWiseStudentList',  [StudentReportsController::class,'classwisestudentlist']);
        Route::match(['GET', 'POST'], 'InactiveStudentList', [StudentReportsController::class,'inactivestudentlist']);
        Route::match(['GET', 'POST'], 'StudentCredentials', [StudentReportsController::class,'studentcredentialslist']);
        Route::match(['GET', 'POST'], 'ProspectusReport', [StudentProspectusReportController::class,'prospectussalereport']);
        Route::match(['GET', 'POST'], 'ProspectusSearch', [StudentProspectusReportController::class,'prospectussearchindex']);
        Route::match(['GET', 'POST'], 'ProspectusAutoSearch',[StudentProspectusReportController::class,'prospectusautosearch']);
        Route::post('ProspectusPaymentCollection', [StudentProspectusController::class,'prospectuspaymentcollection']);
        Route::match(['GET', 'POST'], 'StudentBirthdayList',[StudentBirthdayController::class,'index']);


        Route::get('DefineDocumentType', [StudentDocumentTypeController::class,'index'])->name('define.document.type');
        Route::post('CreateStudentDocumentType',  [StudentDocumentTypeController::class,'store']);
        Route::get('EditViewDocumentType/{documenttype}/edit',  [StudentDocumentTypeController::class,'editview']);
        Route::post('EditStudentDocumentType/{documenttype}/edit', [StudentDocumentTypeController::class,'modify']);

        Route::get('StudentIDCard', [StudentIDCardController::class,'index']);
        Route::post('StudentIDCard', [StudentIDCardController::class,'indexsearch']);
        Route::get('GenerateStudentIDCard/{idcardtemplate}/{selectuser}/{selectuserids}/view', [StudentIDCardController::class,'idcardprint']);


        Route::match(['GET', 'POST'], 'BulkUpdateStudent',[StudentBulkUpdateController::class,'index'])->name('update.student.detail');
        Route::match(['GET', 'POST'], 'BulkUpdateStudentProfile', [StudentProfileImageController::class,'index'])->name('update.student.profile.image');
        Route::match(['GET', 'POST'], 'BulkUpdateParentProfile',  [StudentProfileImageController::class,'parentprofileindex'])->name('update.parent.profile.image');
        Route::match(['GET', 'POST'], 'StudentDocumentUpdate',[StudentDocumentUpdateController::class,'index'])->name('student.document.attachment.update');
        Route::get('StudentDocumentUpload/{studentrecord}/{documentid}', [StudentDocumentUpdateController::class,'uploadindex']);
        Route::post('UploadStudentDocument', [StudentDocumentUpdateController::class,'store']);
        Route::get('RemoveStudentDocument/{studentid}/{documentids}', [StudentDocumentUpdateController::class,'studentdocumentremove'])->name('document.remove');

        Route::match(['GET', 'POST'], 'GenerateCertificate', [GenerateCertificateController::class,'index']);
        Route::get('GenerateCertificate/{studentrecord}/{certificate}/entry', [GenerateCertificateController::class,'certificateentrypreview']);
        Route::get('GenerateCertificate/{studentrecord}/{certificate}/preview', [GenerateCertificateController::class,'certificatepreview']);
        Route::post('CertificateRecord',  [GenerateCertificateController::class,'certificatestore']);

        Route::match(['GET', 'POST'], 'GenerateStudentTC/{certificate}/index', [StudentGenerateTCController::class,'index']);
        Route::post('StoreCertificateFields',[GenerateCertificateController::class,'storefields']);
        Route::match(['GET', 'POST'], 'CertificateReports', [CertificateReportController::class,'index']);
        Route::match(['GET', 'POST'], 'ClassWiseStrength', [StudentStrengthController::class,'classwisestrength']);
        Route::match(['GET', 'POST'], 'GenderWiseStrength', [StudentStrengthController::class,'genderwisestrength']);
        Route::get('StudentAccount/{studentrecord}/{status}', [StudentAccountController::class,'index']);
        Route::post('StudentStatus/{studentrecord}/Update', [StudentAccountController::class,'statusupdate']);
        Route::match(['GET', 'POST'], 'StudentDocumentReport',[StudentReportsController::class,'studentdocumentreport']);

    });

    Route::prefix('MasterAdmin/Certificate')->group(function () {
        Route::get('CertificateView/{certificaterecord}/preview', [CertificatePreviewController::class,'index']);
        Route::get('StudentCertificate/{certificaterecord}/remove', [CertificateReportController::class,'remove']);
        Route::get('StudentCertificate/{certificaterecord}/edit', [CertificateReportController::class,'editview']);
        Route::get('StudentCertificate/{certificaterecord}/pdf',  [CertificateReportController::class,'downloadpdf']);

    });


    Route::prefix('MasterAdmin/Transport')->group(function () {

        Route::get('index', [TransportIndexController::class,'index']);
        Route::get('StudentRouteRemove/{studentrecord}/remove', [TransportAssignController::class,'permanentlyremove']);
        Route::match(['GET', 'POST'], 'AssignTransportToStudent',  [TransportAssignController::class,'studentassignindex']);
        Route::match(['GET', 'POST'], 'BulkAssignTransportToStudent',  [TransportAssignController::class,'bulkAssignStudentTransport']);
        Route::match(['GET', 'POST'], 'ImportAssignTransportToStudent',  [TransportAssignController::class,'ImportAssignTransportToStudent']);
        Route::get('removeStudentTransport/{student_id}',  [TransportAssignController::class,'deleteStudentTransportindex']);

        Route::match(['GET', 'POST'], 'CourseWiseAssignTransport',  [TransportAssignController::class,'classwiseassigntransportindex']);
        Route::match(['GET', 'POST'], 'CreateCourseWiseAssignTransport',  [TransportAssignController::class,'classWiseAssignTransportStore']);


        Route::post('studentAssignTransport',  [TransportAssignController::class,'studentAssignTransport']);
        Route::match(['GET', 'POST'], 'AssignTransportToStaff',  [TransportAssignController::class,'studentassignindex']);
        Route::post('CreateStudentToTransport',  [TransportAssignController::class,'studenttransportstore']);
        Route::post('FinanceStudentAssignTransport/{studentrecord}/store', [FinanceStudentAssignTransportController::class,'store']);
        Route::get('DefineVehicleType', [VehicleTypeController::class,'index']);
        Route::post('CreateVehicleType', [VehicleTypeController::class,'store']);
        Route::get('EditViewVehicleType/{vehicletype}/edit', [VehicleTypeController::class,'editview']);
        Route::post('EditVehicleType/{vehicletype}/edit',[VehicleTypeController::class,'modify']);
        Route::get('DefineVehicle', [VehicleController::class,'index']);
        Route::post('CreateVehicle', [VehicleController::class,'store']);
        Route::get('EditViewVehicle/{vehicle}/edit', [VehicleController::class,'editview']);
        Route::post('EditVehicle/{vehicle}/edit', [VehicleController::class,'modify']);
        Route::get('DefineRoute', [RouteController::class,'index']);
        Route::post('CreateRoute',  [RouteController::class,'store']);
        Route::get('EditViewRoute/{route}/edit',  [RouteController::class,'editview']);
        Route::post('EditRoute/{route}/edit',  [RouteController::class,'modify']);
        Route::get('DefineRouteStop',[RouteStopController::class,'index']);
        Route::post('CreateRouteStop', [RouteStopController::class,'store']);
        Route::get('EditViewRouteStop/{routestop}/edit', [RouteStopController::class,'editview']);
        Route::post('EditRouteStop/{routestop}/edit', [RouteStopController::class,'modify']);
        Route::get('DefineTravelAgency', [TravelAgencyController::class,'index']);
        Route::post('CreateTravelAgency',  [TravelAgencyController::class,'store']);
        Route::get('EditViewTravelAgency/{travelagency}/edit', [TravelAgencyController::class,'editview']);
        Route::post('EditTravelAgency/{travelagency}/edit',  [TravelAgencyController::class,'modify']);
        Route::get('DefineRouteRelation', [RouteRelationController::class,'index']);
        Route::get('DefineRouteRelation/{routeid}/search', [RouteRelationController::class,'search']);
        Route::post('CreateRouteRelation',[RouteRelationController::class,'store']);
        Route::get('EditViewRouteRelation/{routerelation}/edit', [RouteRelationController::class,'editview']);
        Route::post('EditRouteRelation/{routerelation}/edit', [RouteRelationController::class,'modify']);

        /**
         * Transport Reports
         */
        Route::match(['GET', 'POST'], 'StudentTransportReport', [TransportReportController::class,'studenttransportreport']);
        Route::match(['GET', 'POST'], 'StudentSelfTransportReport', [TransportReportController::class,'studentselftransportreport']);
        Route::match(['GET', 'POST'], 'ClassWiseTransportMisReport', [TransportReportController::class,'classwisetransportmisreport']);
        Route::match(['GET', 'POST'], 'RouteWiseTransportMisReport', [TransportReportController::class,'rousewisemisreport']);
        Route::match(['GET', 'POST'], 'RouteStopWiseTransportMisReport', [TransportReportController::class,'routestopwisemisreport']);
        Route::match(['GET', 'POST'], 'DriverWiseTransportMisReport', [TransportReportController::class,'driverwisetransportmisreport']);
        Route::match(['GET', 'POST'], 'ClassAndRoundWiseTransportMisReport', [TransportReportController::class,'classandroutewisemisreport']);
        Route::match(['GET', 'POST'], 'StudentTransportFeeDefaulter', [TransportReportController::class,'studenttransportfeedefaulter']);

    });

    Route::prefix('MasterAdmin/Attendance')->group(function () {
        Route::get('index', [AttendanceIndexController::class,'index']);
        Route::match(['GET', 'POST'], 'StudentMarkAttendance', [AttendanceStudentAttendanceController::class,'index']);
        Route::post('CreateStudentMarkAttendance/{courseid}/{sectionid}/{attendancedate}/create',[AttendanceStudentAttendanceController::class,'store']);


        Route::match(['GET', 'POST'], 'StaffMarkAttendance',[AttendanceStaffAttendanceController::class,'index']);
        Route::post('CreateStaffMarkAttendance/{designationid}/{departmentid}/{attendancedate}/create',[AttendanceStaffAttendanceController::class,'store']);


        Route::match(['GET', 'POST'], 'StudentMarkAttendanceReport', [AttendanceStudentAttendanceController::class,'index']);



        Route::get('StudentBulkMarkAttendance',  [AttendanceStudentAttendanceController::class,'bulkindex']);
        Route::match(['GET', 'POST'], 'DayWiseStudentAttendanceReport', [StudentAttendanceReportController::class,'daywiseattendanceindex']);
        Route::match(['GET', 'POST'], 'ClassWiseMisReport', [StudentAttendanceReportController::class,'classwisemisreport']);
        Route::match(['GET', 'POST'], 'StudentMonthlyMisReport', [StudentAttendanceReportController::class,'studentmonthlymisreport']);
        Route::match(['GET', 'POST'], 'StudentAttendanceMisReport', [StudentAttendanceReportController::class,'studentattendancemisreport']);
        Route::get('DefineHoliday', [HolidayController::class,'index']);
        Route::post('StoreHoliday', [HolidayController::class,'store']);
        Route::get('EditViewHoliday/{holiday}/edit', [HolidayController::class,'editview']);
        Route::post('EditHoliday/{holiday}/edit', [HolidayController::class,'modify']);
        Route::get('LeaveType', [LeaveTypeController::class,'index'])->name('leavetype.index');
        Route::post('StoreLeaveType', [LeaveTypeController::class,'store'])->name('leavetype.store');
        Route::get('EditViewLeaveType/{leavetype}/edit', [LeaveTypeController::class,'edit'])->name('leavetype.edit');
        Route::post('EditLeaveType/{leavetype}/edit', [LeaveTypeController::class,'update'])->name('leavetype.update');
    });

    Route::prefix('MasterAdmin/Timetable')->group(function () {
        Route::get('index', [AdmissionIndexController::class,'index']);
        Route::get('/DefineTimetable', [TimetableController::class, 'index']);
        Route::post('CreateTimetable', [TimetableController::class,'store']);
        Route::get('EditViewTimetable/{timetable}/editview',  [TimetableController::class,'editview']);
        Route::post('EditTimetable/{timetable}/edit',  [TimetableController::class,'modify']);
        Route::get('/UploadClassTimetable', [ClassTimetableController::class, 'index']);
        Route::post('/CreateClassTimetable', [ClassTimetableController::class, 'store'])->name('createClassTimetable');
    });


    Route::prefix('MasterAdmin/Communication')->group(function () {
        Route::get('index', [CommunicationIndexController::class,'index']);
        Route::post('GetCommunicationInfo', [CommunicationIndexController::class,'getinfo']);

        Route::get('DefineCommunicationType', [CommunicationTypeController::class,'index']);
        Route::post('CreateCommunicationType', [CommunicationTypeController::class,'store']);
        Route::get('EditViewCommunicationType/{communicationtype}/view', [CommunicationTypeController::class,'editview']);
        Route::post('EditCommunicationType/{communicationtype}/edit', [CommunicationTypeController::class,'modify']);

        Route::get('DefineFixHeaderFooter', [FixHeaderFooterController::class,'index']);
        Route::post('CreateFixHeaderFooter', [FixHeaderFooterController::class,'store']);
        Route::get('EditViewFixHeaderFooter/{fixheaderfooter}/view',  [FixHeaderFooterController::class,'editview']);
        Route::post('EditFixHeaderFooter/{fixheaderfooter}/edit',  [FixHeaderFooterController::class,'modify']);
        Route::get('DefineUserSMSCopy', [UserSMSCopyController::class,'index']);
        Route::post('CreateUserSMSCopy', [UserSMSCopyController::class,'store']);
        Route::get('EditViewUserSMSCopy/{usersmscopy}/view', [UserSMSCopyController::class,'editview']);
        Route::post('EditUserSMSCopy/{usersmscopy}/edit', [UserSMSCopyController::class,'modify']);

        Route::get('DefinePhoneBookGroup', [PhoneBookGroupController::class,'index']);
        Route::post('CreatePhoneBookGroup', [PhoneBookGroupController::class,'store']);
        Route::get('EditViewPhoneBookGroup/{phonebookgroup}/view', [PhoneBookGroupController::class,'editview']);
        Route::post('EditPhoneBookGroup/{phonebookgroup}/edit', [PhoneBookGroupController::class,'modify']);

        Route::get('DefinePhoneBookContact', [PhoneBookController::class,'index']);
        Route::post('CreatePhoneBookContact', [PhoneBookController::class,'store']);
        Route::get('EditViewPhoneBookContact/{phonebookcontact}/view', [PhoneBookController::class,'editview']);
        Route::post('EditPhoneBookContact/{phonebookcontact}/edit',[PhoneBookController::class,'modify']);

        Route::get('DefineSMSTemplate', [SMSTemplateController::class,'index']);
        Route::post('CreateSMSTemplate', [SMSTemplateController::class,'store']);
        Route::get('EditViewSMSTemplate/{smstemplate}/view', [SMSTemplateController::class,'editview']);
        Route::post('EditSMSTemplate/{smstemplate}/edit', [SMSTemplateController::class,'modify']);

        Route::get('DefineEmailTemplate', [EmailTemplateController::class,'index']);
        Route::post('CreateEmailTemplate',[EmailTemplateController::class,'store']);
        Route::get('EditViewEmailTemplate/{emailtemplate}/view', [EmailTemplateController::class,'editview']);
        Route::post('EditEmailTemplate/{emailtemplate}/edit', [EmailTemplateController::class,'modify']);

        Route::get('ImportPhoneBook', [ImportPhoneBookController::class,'index']);
        Route::post('UploadImportPhoneBook', [ImportPhoneBookController::class,'importphonebook']);
        Route::post('ExportPhoneBookSheet', [ImportPhoneBookController::class,'exportphonebook']);


        Route::get('ComposeSMS', [SendSMSController::class,'composeindex']);
        Route::get('BulkSMS',  [SendSMSController::class,'bulkindex']);
        Route::get('IndividualSMS',  [SendSMSController::class,'individualsmsinbox']);
        Route::post('SendSMS',  [SendSMSController::class,'sendsms']);

        Route::get('SMSTemplate', [CommunicationViewPageController::class,'smstemplateindex']);
        Route::get('SMSTyping', [CommunicationViewPageController::class,'smstypingindex']);
        Route::get('ListHeaderAndFooter', [CommunicationViewPageController::class,'headerandfooterindex']);

        Route::match(['GET', 'POST'], 'SMSReport', [ReportReportController::class,'index']);
        Route::match(['GET', 'POST'], 'SMSReport/{communicationtokenid}/View',  [ReportReportController::class,'indexsearch']);
        Route::post('SMSFailureResend', [CommunicationFailureController::class,'failureresend']);
        Route::get('ModalSMSIndex', [SendSMSController::class,'modalsmsindex']);
        /*
         * Send SMS Notification
         */
        Route::get('AfterQueryAutoSendSMS/{pageid}/{ids}', [AutoSendSMSController::class,'autosend']);
    });

    Route::prefix('MasterAdmin/App')->group(function () {
        Route::get('index',  [AdmissionIndexController::class,'index']);

        Route::match(['GET', 'POST'], 'DefineHomework', [HomeworkController::class,'index']);
        Route::post('CreateHomework', [HomeworkController::class,'store']);
        Route::get('EditViewHomework/{homework}/editview', [HomeworkController::class,'editview']);
        Route::post('EditHomework/{homework}/edit', [HomeworkController::class,'modify']);

        Route::match(['GET', 'POST'], 'DefineNotice', [NoticeController::class,'index']);
        Route::post('CreateNotice',  [NoticeController::class,'store']);
        Route::get('EditViewNotice/{notice}/editview',  [NoticeController::class,'editview']);
        Route::post('EditNotice/{notice}/edit',  [NoticeController::class,'modify']);

        Route::match(['GET', 'POST'], 'DefineAssignment', [AssignmentController::class,'index']);
        Route::post('CreateAssignment',  [AssignmentController::class,'store']);
        Route::get('EditViewAssignment/{assignment}/editview',  [AssignmentController::class,'editview']);
        Route::post('EditAssignment/{assignment}/edit/',  [AssignmentController::class,'modify']);

        Route::match(['GET', 'POST'], 'DefineDownload', [DownloadController::class, 'index']);
        Route::post('CreateDownload', [DownloadController::class, 'store']);
        Route::get('EditViewDownload/{download}/editview', [DownloadController::class, 'editview']);
        Route::post('EditDownload/{download}/edit',[DownloadController::class, 'modify']);


        Route::match(['GET', 'POST'], 'DefineSyllabus', [SyllabusController::class, 'index']);
        Route::post('CreateSyllabus', [SyllabusController::class, 'store']);
        Route::get('EditViewSyllabus/{syllabus}/editview', [SyllabusController::class, 'editview']);
        Route::post('EditSyllabus/{syllabus}/edit', [SyllabusController::class, 'modify']);

        Route::match(['GET', 'POST'], 'DefineCalendar', [CalendarController::class, 'index']);
        Route::post('CreateCalendar', [CalendarController::class, 'store']);
        Route::get('EditViewCalendar/{calendar}/editview', [CalendarController::class, 'editview']);
        Route::post('EditCalendar/{calendar}/edit', [CalendarController::class, 'modify']);

        Route::get('DefineCalendarType', [CalendarTypeController::class, 'index']);
        Route::post('CreateCalendarType', [CalendarTypeController::class, 'store']);
        Route::get('EditViewCalendarType/{calendartype}/editview', [CalendarTypeController::class, 'editview']);
        Route::post('EditCalendarType/{calendartype}/edit', [CalendarTypeController::class, 'modify']);
        Route::get('fullcalendar', [CalendarController::class, 'fullcalendar']);

    });


    Route::prefix('MasterAdmin/Library')->group(function () {

        Route::get('index', [LibraryIndexController::class,'index']);
        Route::match(['GET', 'POST'], 'IssueBook', [IssueBookController::class, 'index']);
        Route::get('IssueBook/{selectuserid}/{selectuser}/search', [IssueBookController::class, 'indexsearch']);
        Route::get('IssueBook/{user}/{memberid}/book/{bookid}/{operation}/{entryid}', [IssueBookController::class,'issuebookindex']);
        Route::post('LibraryBookEntry', [LibraryBookEntryController::class,'issuebook']);
        /*
         * Library Master Setting
         */

        Route::get('DefineLibrary', [LibraryController::class,'index']);
        Route::post('CreateLibrary', [LibraryController::class,'store']);
        Route::get('EditViewLibrary/{library}/editview', [LibraryController::class,'editview']);
        Route::post('EditLibrary/{library}/edit', [LibraryController::class,'modify']);

        Route::get('DefineItemCategory', [LibraryCategoryController::class,'index']);
        Route::post('CreateItemCategory', [LibraryCategoryController::class,'store']);
        Route::get('EditViewItemCategory/{libraryCategory}/editview', [LibraryCategoryController::class,'editview']);
        Route::post('EditItemCategory/{libraryCategory}/edit', [LibraryCategoryController::class,'modify']);

        Route::get('DefineRacks', [LibraryRackController::class,'index']);
        Route::post('CreateRacks', [LibraryRackController::class,'store']);
        Route::get('EditViewRacks/{racks}/editview', [LibraryRackController::class,'editview']);
        Route::post('EditRacks/{racks}/edit', [LibraryRackController::class,'modify']);

        Route::get('DefineAuthor', [LibraryAuthorController::class,'index']);
        Route::post('CreateAuthor',[LibraryAuthorController::class,'store']);
        Route::get('EditViewAuthor/{author}/editview', 'MasterAdmin\Library\MasterSetting\LibraryAuthorController@editview');
        Route::post('EditAuthor/{author}/edit', 'MasterAdmin\Library\MasterSetting\LibraryAuthorController@modify');

        Route::get('DefineTag', [TagController::class,'index']);
        Route::post('CreateTag', [TagController::class,'store']);
        Route::get('EditViewTag/{tag}/editview', 'MasterAdmin\Library\MasterSetting\TagController@editview');
        Route::post('EditTag/{tag}/edit', 'MasterAdmin\Library\MasterSetting\TagController@modify');

        Route::get('DefineGenres', [LibraryGenreController::class,'index']);
        Route::post('CreateGenres',[LibraryGenreController::class,'store']);
        Route::get('EditViewGenres/{librarygenre}/editview', 'MasterAdmin\Library\MasterSetting\LibraryGenreController@editview');
        Route::post('EditGenres/{librarygenre}/edit', 'MasterAdmin\Library\MasterSetting\LibraryGenreController@modify');

        Route::match(['GET', 'POST'], 'DefineBooks', [BookController::class, 'index']);
        Route::get('CreateNewBook', [BookController::class,'createbookindex']);
        Route::post('StoreBook', [BookController::class,'store']);
        Route::get('EditBook/{book}/view', [BookController::class,'editview']);
        Route::post('EditBook/{book}/edit', [BookController::class,'modify']);
        // Route::post('EditBook/{book}/edit', [BookController::class, 'modify'])->name('MasterAdmin.Library.EditBook.update');

        Route::get('Book/{book}/view', [BookController::class,'preview']);
        Route::post('BookSearch/{selectuserid}/{selectuser}', [BookController::class,'bookautocomplete']);

        Route::get('ImportBulkBook', [BookImportController::class,'index'])->name('import-book');
        Route::post('StoreImportBook', [BookImportController::class,'store']);
        Route::post('CreateTag', [TagController::class,'store']);
        Route::get('EditViewTag/{tag}/editview', 'MasterAdmin\Library\MasterSetting\TagController@editview');
        Route::post('EditTag/{tag}/edit', 'MasterAdmin\Library\MasterSetting\TagController@modify');

        Route::get('LibraryConfiguration', [LibrarySettingController::class,'index']);
        /*
         * Reports
         */
        Route::any('DailyEntryReport', [LibraryReportController::class, 'dailyentryreport'])->name('daily.entry.report');
           });

    Route::prefix('MasterAdmin/StockManager')->group(function () {
        Route::get('index',  [AdmissionIndexController::class,'index']);

    });

     Route::prefix('MasterAdmin/MarksManager')->group(function () {
         Route::get('index', [MarksManagerIndexController::class,'index']);
         Route::get('ExamMarksImport', [ExamMarksImportController::class,'index'])->name('exam.marks.import');

           Route::match(['GET', 'POST'], 'ExamSubjectWiseMarksEntry', [ExamMarksEntryController::class, 'subjectmarksentryindex']);
           Route::post('StoreExamSubjectWiseMarksEntry', [ExamMarksEntryController::class, 'subjectmarkentry']);
           Route::match(['GET', 'POST'], 'StudentExamMarksEntry', [ExamMarksEntryController::class, 'studentmarksentryindex']);


           Route::match(['GET', 'POST'], 'ExamHallTicket', [ExamHallTicketController::class, 'index']);
           Route::get('ExamHallTicketPrint/{studentids}', [ExamHallTicketController::class, 'print']);
           Route::match(['GET', 'POST'], 'Report/GenerateStudentReportCard', [ExamReportCardController::class, 'index']);
           Route::get('Report/ReportCardPrint', [ExamReportCardController::class, 'print']);

           Route::get('DefineSubjectGroup', [ExamSubjectController::class,'subjectgroupindex']);
    //     Route::get('EditExamViewSubjectGroup/{examsubject}/edit', 'MasterAdmin\MarksManager\MasterSetting\ExamSubjectController@subjectgroupview');
    //     Route::post('EditExamSubjectGroup/{examsubject}/edit', 'MasterAdmin\MarksManager\MasterSetting\ExamSubjectController@subjectgroupmodify');

           Route::get('DefineSubject', [ExamSubjectController::class,'index']);
           Route::post('StoreExamSubject', [ExamSubjectController::class,'store']);
    //     Route::get('EditViewExamSubject/{examsubject}/edit', 'MasterAdmin\MarksManager\MasterSetting\ExamSubjectController@editview');

    //     Route::get('EditViewSubjectActivities/{examsubject}/edit', 'MasterAdmin\MarksManager\MasterSetting\ExamSubjectController@editactivityview');
    //     Route::post('EditExamSubject/{examsubject}/edit', 'MasterAdmin\MarksManager\MasterSetting\ExamSubjectController@modify');
    //     Route::post('EditExamSubjectActivities/{examsubject}/edit', 'MasterAdmin\MarksManager\MasterSetting\ExamSubjectController@activitymodify');

           Route::get('DefineExamType', [ExamTypeController::class, 'index']);
           Route::post('StoreExamType', [ExamTypeController::class, 'store']);
           Route::get('EditViewExamType/{examtype}/edit', [ExamTypeController::class, 'editview']);
           Route::post('EditExamType/{examtype}/edit', [ExamTypeController::class, 'modify']);

           Route::get('DefineExamTerm', [ExamTermController::class, 'index']);
           Route::post('StoreExamTerm', [ExamTermController::class, 'store']);
           Route::get('EditViewExamTerm/{examterm}/edit', [ExamTermController::class, 'editview']);
           Route::post('EditExamTerm/{examterm}/edit', [ExamTermController::class, 'modify']);

           Route::get('DefineExamAssessment', [ExamAssessmentController::class, 'index']);
           Route::post('StoreExamAssessment', [ExamAssessmentController::class, 'store']);
           Route::get('EditViewExamAssessment/{examassessment}/edit', [ExamAssessmentController::class, 'editview']);
           Route::post('EditExamAssessment/{examassessment}/edit', [ExamAssessmentController::class, 'modify']);

           Route::get('DefineExamActivities', [ExamActivitiesController::class,'index']);
           Route::post('StoreExamActivities', [ExamActivitiesController::class,'store']);
           Route::get('EditViewExamActivities/{examassessment}/edit', [ExamActivitiesController::class, 'editview']);
           Route::post('EditExamActivities/{examassessment}/edit', [ExamActivitiesController::class,'modify']);

           Route::get('DefineExamGradeSystem', [ExamGradeSystemController::class,'index']);
           Route::post('StoreExamGradeSystem', [ExamGradeSystemController::class, 'store']);
           Route::get('EditViewExamGradeSystem/{examgradesystem}/edit', [ExamGradeSystemController::class, 'editview']);
           Route::post('EditExamGradeSystem/{examgradesystem}/edit', [ExamGradeSystemController::class, 'modify']);

           Route::get('DefineExamSubjectSkillGroup', [ExamSubjectSkillGroupController::class, 'index']);
           Route::post('StoreExamSubjectSkillGroup', [ExamSubjectSkillGroupController::class, 'store']);
           Route::get('EditViewExamSubjectSkillGroup/{examsubjectskillgroup}/edit', [ExamSubjectSkillGroupController::class, 'editview']);
           Route::post('EditExamSubjectSkillGroup/{examsubjectskillgroup}/edit', [ExamSubjectSkillGroupController::class, 'modify']);

           Route::get('DefineExamSubjectSkill',[ExamSubjectSkillController::class, 'index']);
           Route::post('StoreExamSubjectSkill', [ExamSubjectSkillController::class, 'store']);
           Route::get('EditViewExamSubjectSkill/{examsubjectskill}/edit', [ExamSubjectSkillController::class, 'editview']);
           Route::post('EditExamSubjectSkill/{examsubjectskill}/edit', [ExamSubjectSkillController::class, 'modify']);

           Route::get('SubjectMapWithCourse', [ExamSubjectMapWithCourseController::class,'index']);
           Route::get('SubjectMapWithCourse/{course}', [ExamSubjectMapWithCourseController::class, 'indexsearch']);
           Route::get('SubjectMapWithClass/ImportSubject/{rowid}', [ExamSubjectMapWithCourseController::class, 'importsubjecttablerow']);
           Route::get('SubjectMapWithClass/{subjectid}/{rowid}/ImportSubjectSkill', [ExamSubjectMapWithCourseController::class, 'importsubjectskilltablerow']);
           Route::post('StoreSubjectMapWithCourse', [ExamSubjectMapWithCourseController::class, 'store']);
           Route::get('ExamConfiguration', [ExamConfigurationController::class, 'index']);
           Route::get('ExamConfiguration/{course}/{examtermid}', [ExamConfigurationController::class, 'indexsearch']);
           Route::get('ExamConfiguration/ImportSubjectAndAssessment', [ExamConfigurationController::class, 'subjectandassessmentimport']);
           Route::post('StoreExamConfiguration', [ExamConfigurationController::class, 'store']);

           Route::get('DefineOnlineExam', [OnlineExamController::class, 'index']);
           Route::post('StoreOnlineExam', [OnlineExamController::class, 'store']);
    //     Route::get('EditViewOnlineExam/{onlineexam}/edit', 'MasterAdmin\MarksManager\OnlineExam\OnlineExamController@editview');
    //     Route::post('EditOnlineExam/{onlineexam}/edit', 'MasterAdmin\MarksManager\OnlineExam\OnlineExamController@modify');
           Route::match(['GET', 'POST'], 'SetOnlineExamQuestion', [SetOnlineExamQuestionController::class, 'index']);
           Route::get('AddOnlineQuestionPaper/{onlineexam}/{courseid}/{sectionid}', [SetOnlineExamQuestionController::class,'addqoutationindex']);
           Route::post('StoreOnlineQuestion', [SetOnlineExamQuestionController::class, 'storeonlineexam']);
    //     Route::get('QuestionCategoryIndex/{examid}', 'MasterAdmin\MarksManager\OnlineExam\QuestionCategoryController@index');
    //     Route::post('StoreQuestionCategory', 'MasterAdmin\MarksManager\OnlineExam\QuestionCategoryController@store');
    //     Route::get('SetQuestionCategory/{examid}/{questioncategoryid}', 'MasterAdmin\MarksManager\OnlineExam\QuestionCategoryController@defaultset');
           Route::get('ViewOnlineQuestionPaper/{examid}/{courseid}', [SetOnlineExamQuestionController::class, 'viewquestionpaper']);
     });

    Route::prefix('MasterAdmin/Finance')->group(function () {
        Route::match(['GET', 'POST'], 'index', [FinanceIndexController::class,'index']);

          Route::get('FeeCollection', [FeeCollectionController::class,'index']);
          Route::get('FeeCollection/{studentid}/{feeuptodate}/{feepayid}/search', [FeeCollectionController::class,'indexsearch']);
          Route::post('StudentFeeCollection', [FeeCollectionController::class,'feecollect']);

    //     Route::get('StudentCustomFee/{studentid}/index', 'MasterAdmin\Finance\FeeEntry\AddStudentCustomFeeController@index');
    //     Route::post('AddStudentCustomFee/{studentid}/create', 'MasterAdmin\Finance\FeeEntry\AddStudentCustomFeeController@store');

    //     Route::get('StudentConcession/{studentid}/index', 'MasterAdmin\Finance\FeeEntry\AddStudentConcessionController@index');
    //     Route::post('AddStudentConcession/{studentrecord}/create', 'MasterAdmin\Finance\FeeEntry\AddStudentConcessionController@store');
    //     Route::get('RemoveStudentConcession/{studentrecord}/remove', 'MasterAdmin\Finance\FeeEntry\AddStudentConcessionController@removeconcession');

    //     Route::get('SearchStudentList/{acledgerno}/{payuptomonth}/{admissionno}', 'MasterAdmin\Finance\FeeEntry\StudentSearchController@index');
           Route::match(['GET', 'POST'], 'StudentFeeModify', [StudentFeeModifyController::class,'index']);

    //     Route::get('StudentFeeHeadConcession/{studentid}/{feeuptodate}/{feepayid}/index', 'MasterAdmin\Finance\FeeEntry\AddStudentFeeHeadConcessionController@index');
    //     Route::post('AddStudentFeeHeadConcession/{studentid}/create', 'MasterAdmin\Finance\FeeEntry\AddStudentFeeHeadConcessionController@store');
    //     Route::get('RemoveStudentFeeHeadInstalmentConcession/{studentid}/remove', 'MasterAdmin\Finance\FeeEntry\AddStudentFeeHeadConcessionController@remove');

    //     Route::get('StudentFeeHeadAvoid/{studentid}/{feeuptodate}/{feepayid}/index', 'MasterAdmin\Finance\FeeEntry\StudentFeeHeadAvoidController@index');
    //     Route::post('AddFeeHeadAvoid/{studentrecord}/create', 'MasterAdmin\Finance\FeeEntry\StudentFeeHeadAvoidController@store');
    //     Route::get('RemoveFeeHeadAvoid/{studentrecord}/remove', 'MasterAdmin\Finance\FeeEntry\StudentFeeHeadAvoidController@remove');

    //     Route::get('StudentFeeHeadInstalmentAvoid/{studentid}/{feeuptodate}/{feepayid}/index', 'MasterAdmin\Finance\FeeEntry\StudentFeeHeadInstalmentAvoidController@index');
    //     Route::post('AddFeeHeadInstalmentAvoid/{studentid}/create', 'MasterAdmin\Finance\FeeEntry\StudentFeeHeadInstalmentAvoidController@store');

    //     Route::get('StudentFeeHeadFineConcession/{studentid}/{feeuptodate}/{feepayid}/index', 'MasterAdmin\Finance\FeeEntry\StudentFeeHeadFineConcessionController@index');
    //     Route::post('AddStudentFeeHeadFineConcession/{studentid}/create', 'MasterAdmin\Finance\FeeEntry\StudentFeeHeadFineConcessionController@store');
    //     Route::get('RemoveStudentFeeHeadInstalmentFineConcession/{studentid}/remove', 'MasterAdmin\Finance\FeeEntry\StudentFeeHeadFineConcessionController@remove');

    //     Route::get('StudentAssignTransport/{studentid}/index', 'MasterAdmin\Transport\FinanceStudentAssignTransportController@index');
    //     Route::get('AddACLedger/{studentid}/index', 'MasterAdmin\Finance\FeeEntry\AddStudentAccountLedgerController@index');
    //     Route::post('AddStudentACledgerNo/{studentrecord}/create', 'MasterAdmin\Finance\FeeEntry\AddStudentAccountLedgerController@store');
    //     Route::get('RemoveStudentACledgerNo/{studentrecord}/remove', 'MasterAdmin\Finance\FeeEntry\AddStudentAccountLedgerController@removeledgerno');

           Route::get('DefinePaymode', [PaymodeController::class,'index']);
           Route::post('CreatePaymode', [PaymodeController::class,'store']);
    //     Route::get('EditViewPaymode/{paymode}/view', 'MasterAdmin\Finance\MasterSetting\PaymodeController@editview');
    //     Route::post('EditPaymode/{paymode}/edit', 'MasterAdmin\Finance\MasterSetting\PaymodeController@modify');

           Route::get('DefineFeeAccount', [FeeAccountController::class,'index']);
           Route::post('CreateFeeAccount', [FeeAccountController::class,'store']);
    //     Route::get('EditViewFeeAccount/{feeaccount}/view', 'MasterAdmin\Finance\MasterSetting\FeeAccountController@editview');
    //     Route::post('EditFeeAccount/{feeaccount}/edit', 'MasterAdmin\Finance\MasterSetting\FeeAccountController@modify');

           Route::get('DefineFeeGroup', [FeeGroupController::class,'index']);
           Route::post('CreateFeeGroup', [FeeGroupController::class,'store']);
    //     Route::get('EditViewFeeGroup/{feegroup}/view', 'MasterAdmin\Finance\MasterSetting\FeeGroupController@editview');
    //     Route::post('EditFeeGroup/{feegroup}/edit', 'MasterAdmin\Finance\MasterSetting\FeeGroupController@modify');

           Route::get('DefineFeeGroupMapWithCourse', [FeeGroupMapWithCourseController::class,'index']);
           Route::get('DefineFeeGroupMapWithCourse/{feegroupid}/search', [FeeGroupMapWithCourseController::class,'indexsearch']);
           Route::post('CreateFeeGroupMapWithCourse', [FeeGroupMapWithCourseController::class,'store']);

           Route::get('DefineFeeHead', [FeeHeadController::class,'index']);
           Route::post('CreateFeeHead', [FeeHeadController::class,'store']);
           Route::get('EditViewFeeHead/{feehead}/view', [FeeHeadController::class,'editview']);
           Route::post('EditFeeHead/{feehead}/edit', [FeeHeadController::class,'modify']);

           Route::get('DefineFeeHeadMapWithInstallment', [FeeHeadMapWithInstallmentController::class,'index']);
           Route::post('CreateFeeHeadMapWithInstallment', [FeeHeadMapWithInstallmentController::class,'store']);
           Route::get('DefineFeeHeadMapWithInstallment', [FeeHeadMapWithInstallmentController::class,'index']);

           Route::get('DefineFeeStructure', [FeeStrutureController::class,'index']);
           Route::get('DefineFeeStructure/{feegroupid}/search', [FeeStrutureController::class,'indexsearch']);
           Route::post('Fee3StructureIndex/{feehead}', [FeeStrutureController::class,'feestructureindex']);
           Route::post('CreateFeeStructure', [FeeStrutureController::class,'store']);
           Route::get('RemoveFeeStructure/{id}', [FeeStrutureController::class,'feestructureremove']);

           Route::get('DefineConcessionType', [ConcessionTypeController::class,'index']);
           Route::post('CreateConcessionType', [ConcessionTypeController::class,'store']);
           Route::get('EditViewConcessionType/{concessiontype}/view', [ConcessionTypeController::class,'editview']);
           Route::post('EditConcessionType/{concessiontype}/edit', [ConcessionTypeController::class,'modify']);

           Route::get('ConcessionSetting', [ConcessionSettingController::class,'index']);
           Route::get('ConcessionSetting/{concessiontype}/search', [ConcessionSettingController::class,'indexsearch']);
           Route::post('CreateConcessionSetting', [ConcessionSettingController::class,'store']);

           Route::get('FineSetting', [FineSettingController::class,'index']);
           Route::get('FineSetting/{feegroupid}/search', [FineSettingController::class,'indexsearch']);
           Route::post('CreateFineSetting', [FineSettingController::class,'store']);
           Route::get('RemoveFineSetting/{feegroupid}/delete', [FineSettingController::class,'fineremove']);
           Route::get('FeeReceiptSetting', [FeeReceiptSettingController::class,'index']);
           Route::post('CreateFeeReceiptSetting',[FeeReceiptSettingController::class,'store']);
           Route::post('EditFeeReceiptSetting/{feereceiptsetting}/edit', [FeeReceiptSettingController::class,'modify']);

    //     Route::get('Receipt/{receiptid}/{grouptokenid}/Print', 'MasterAdmin\Finance\Reports\FeeReceiptPrintController@receiptprint');
    //     Route::get('FeeEstimateReceipt/{studentid}/{acledgerno}/{feeuptodate}/{feepayid}/Print', 'MasterAdmin\Finance\Reports\FeeReceiptPrintController@feeestimateprint');
    //     Route::get('FeeDetailsPreview/{admissionno}/{acledgerno}/{feeuptodate}/{feepayid}/Preview', 'MasterAdmin\Finance\Reports\FeeReceiptPrintController@feedetailspreview');
    //     Route::get('FeeEstimateToken/{feeuptodate}/{feepayid}/{studentids}/Print', 'MasterAdmin\Finance\Reports\FeeEstimatePrintController@feeestimate');
    //     Route::get('FeeReceiptPreview/{receiptid}/{studentid}/{key}', 'MasterAdmin\Finance\Reports\FeeReceiptPrintController@feepreview');
    //     Route::get('StudentFeeLedgerPreview', 'MasterAdmin\Finance\Reports\FeeReceiptPrintController@studentledgerpreview');
    //     /**
    //      * Master Update
    //      */
    //     Route::match(['GET', 'POST'], 'StudentOpeningBalance', 'MasterAdmin\Finance\MasterUpdate\StudentOpeningBalanceController@index');
    //     Route::post('CreateStudentOpeningBalance', 'MasterAdmin\Finance\MasterUpdate\StudentOpeningBalanceController@store');
    //     Route::match(['GET', 'POST'], 'StudentAssignLedger', 'MasterAdmin\Finance\MasterUpdate\StudentAssignLedgerController@index');
    //     Route::post('CreateStudentAssignLedger', 'MasterAdmin\Finance\MasterUpdate\StudentAssignLedgerController@store');
    //     Route::match(['GET', 'POST'], 'StudentAssignConcession', 'MasterAdmin\Finance\MasterUpdate\StudentAssignConcessionController@index');
    //     Route::post('CreateStudentAssignConcession', 'MasterAdmin\Finance\MasterUpdate\StudentAssignConcessionController@store');
           Route::get('ChequeBounceEntry', [ChequeBounceEntryController::class,'index']);
           Route::get('ChequeBounceEntry/{receiptno}/search', [ChequeBounceEntryController::class,'indexsearch']);
           Route::post('ChequeBounceEntry/{feecollection}/{studentid}/entry', [ChequeBounceEntryController::class,'store']);

           Route::get('CancelFeeReceipt', [FeeReceiptCancelController::class,'index']);
           Route::get('CancelFeeReceipt/{receiptno}/search', [FeeReceiptCancelController::class,'indexsearch']);
           Route::post('CancelFeeReceipt/{feecollection}/entry', [FeeReceiptCancelController::class,'store']);
           Route::get('FeeReceiptModify', [FeeReceiptModifyController::class,'index']);
           Route::post('EditFeeReceiptModify/{feecollection}/modify', [FeeReceiptModifyController::class,'modify']);
           Route::get('OnlineFeeSettlement', [OnlineFeeSettlementController::class,'index']);
           Route::get('FeeUploadBankDeposit', [FeeUploadDepositBankController::class,'index']);
    //     /**
    //      * Reports
    //      */
           Route::match(['GET', 'POST'], 'ClassWiseStudentFeeDefaulterReport', [FeeDefaulterReportController::class,'classwisefeedefaulter']);
           Route::match(['GET', 'POST'], 'ACLedgerStudentFeeDefaulterReport', [FeeDefaulterReportController::class,'acledgerfeedefaulter']);
           Route::match(['GET', 'POST'], 'StudentFeeHeadDefaulterReport', [FeeDefaulterReportController::class,'feeheadfeedefaulter']);
           Route::match(['GET', 'POST'], 'SiblingsFeeDefaulterReport', [FeeDefaulterReportController::class,'siblingfeedefaulter']);
    //     /**
    //      * fee collection report
    //      */
           Route::match(['GET', 'POST'], 'FeeCollectionReport', [FeeCollectionReportController::class,'index']);
           Route::match(['GET', 'POST'], 'DailyFeeCollectionFullReport', [FeeCollectionReportController::class,'dailyfeecollectionfull']);
           Route::match(['GET', 'POST'], 'DaybookReport', [FeeCollectionReportController::class,'daybookreport']);
           Route::match(['GET', 'POST'], 'FeeHeadCollectionReport', [FeeCollectionReportController::class,'feeheadcollection']);
           Route::match(['GET', 'POST'], 'FeeHeadInstalmentCollectionReport', [FeeCollectionReportController::class,'feeheadinstalmentcollection']);
           Route::match(['GET', 'POST'], 'CourseWiseCollectionReport', [FeeCollectionReportController::class,'coursefeecollection']);
           Route::match(['GET', 'POST'], 'DayWiseCollectionReport', [FeeCollectionReportController::class,'daywisefeecollection']);
           Route::match(['GET', 'POST'], 'MonthMISCollectionReport', [FeeCollectionReportController::class,'monthwisefeecollection']);
           Route::match(['GET', 'POST'], 'PaymodeWiseFeeCollectionReport', [FeeCollectionReportController::class,'paymodefeecollection']);
           Route::match(['GET', 'POST'], 'DateWisePaymodeWiseFeeCollectionReport', [FeeCollectionReportController::class,'datewisepaymodefeecollection']);
           Route::match(['GET', 'POST'], 'StudentFeeCollectionLedgerReport', [FeeCollectionReportController::class,'studentfeecollectionledger']);
           Route::match(['GET', 'POST'], 'HeadWiseStudentConsolidatedReport', [FeeCollectionReportController::class,'studentconslidatedreport']);
           Route::match(['GET', 'POST'], 'StudentConcessionReport', [StudentConcessionReportController::class,'regularconcessionreport']);
           Route::match(['GET', 'POST'], 'FeeCollectionConcessionReport', [FeeCollectionConcessionReport::class,'index']);
           Route::match(['GET', 'POST'], 'ConcessionConsolidatedReport', [FeeCollectionConcessionReport::class,'concessionconslidatedreport']);
           Route::match(['GET', 'POST'], 'StudentOpeningBalanceReport', [FeeOpeningBalanceController::class,'index']);

        Route::post('AddSpecialConcession/{studentid}', 'MasterAdmin\Finance\FeeEntry\AddSpecialConcessionController@index');
        Route::get('FeeCollectionSetting', [FeeCollectionSetting::class,'index']);
        Route::post('UpdateFeeCollectionSetting',[FeeCollectionSetting::class,'store']);

    });

    Route::prefix('MasterAdmin/Staff')->group(function () {
        Route::get('index', [StaffIndexController::class,'index']);

        Route::get('StaffRegistration', [StaffRecordController::class,'index']);
        Route::post('CreateStaff', [StaffRecordController::class,'store']);
        Route::get('EditViewStaff/{staffrecord}/editview', [StaffRecordController::class,'editview']);
        Route::post('EditStaff/{staffrecord}/edit', [StaffRecordController::class,'modify']);

        Route::get('StaffImport', [StaffImportController::class,'index'])->name('staff.import');
        Route::post('StaffImportView', [StaffImportController::class,'staffindexview']);
        // Route::match(['GET' , 'POST'], 'StaffImportView',[StaffImportController::class,'staffindexview']);
        Route::post('ImportStaffCreate', [StaffImportController::class,'importstaffstore']);











        Route::get('DefineQualification', [StaffQualificationController::class,'index']);

        Route::post('CreateQualification', [StaffQualificationController::class,'store']);
        Route::get('EditViewQualification/{qualification}/editview', [StaffQualificationController::class,'editview'])->name('edit_view_qualification');
        Route::post('EditQualification/edit', [StaffQualificationController::class,'modify'])->name('store_view_qualification');

        Route::get('DefineProfessionType', [ProfessionTypeController::class,'index']);
        Route::post('CreateProfessionType',  [ProfessionTypeController::class,'store']);
        Route::get('EditViewProfessionType/{professiontype}/editview',  [ProfessionTypeController::class,'editview']);
        Route::post('EditProfessionType/{professiontype}/edit',  [ProfessionTypeController::class,'modify']);

        Route::get('DefineStaffType', [StaffTypeController::class,'index']);
        Route::post('CreateStaffType', [StaffTypeController::class,'store']);
        Route::get('EditViewStaffType/{stafftype}/editview', [StaffTypeController::class,'editview']);
        Route::post('EditStaffType/{stafftype}/edit', [StaffTypeController::class,'modify']);

        Route::get('DefineDepartment', [StaffDepartmentController::class,'index']);
        Route::post('CreateDepartment', [StaffDepartmentController::class,'store']);
        Route::get('EditViewDepartment/{staffdepartment}/editview', [StaffDepartmentController::class,'editview']);
        Route::post('EditDepartment/{staffdepartment}/edit', [StaffDepartmentController::class,'modify']);
        Route::get('DefineDepartment', [StaffDepartmentController::class,'index']);

        Route::get('DefineDesignation', [StaffDesignationController::class,'index']);
        Route::post('CreateDesignation', [StaffDesignationController::class,'store']);
        Route::get('EditViewDesignation/{staffdesignation}/editview', [StaffDesignationController::class,'editview']);
        Route::post('EditDesignation/{staffdesignation}/edit', [StaffDesignationController::class,'modify']);

        Route::get('DefineDocument', [DocumentController::class,'index']);
        Route::post('CreateDocument', [DocumentController::class,'store']);
        Route::get('EditViewDocument/{document}/editview',  [DocumentController::class,'editview']);
        Route::post('EditDocument/{document}/edit', [DocumentController::class,'modify']);

        Route::get('DefineSkillAndKnowledge', [SkillAndKnowledgeController::class,'index']);
        Route::post('CreateSkillAndknowledge', [SkillAndKnowledgeController::class,'store']);
        Route::get('EditViewSkillAndKnowledge/{skillandknowledge}/editview', [SkillAndKnowledgeController::class,'editview']);
        Route::post('EditSkillAndKnowledge/{skillandknowledge}/edit', [SkillAndKnowledgeController::class,'modify']);


        Route::match(['GET', 'POST'], 'StaffList', [StaffReportController::class, 'index']);
        Route::match(['GET', 'POST'], 'StaffCredentialsReport', [StaffReportController::class, 'staffcredentials']);
        Route::match(['GET', 'POST'], 'StaffProfileImageUpdate', [StaffProfileImageController::class, 'staffprofileupdateindex']);
    });

    Route::prefix('MasterAdmin/reports')->group(function () {

        Route::get('index',  [AdmissionIndexController::class,'index']);

    });

    Route::prefix('MasterAdmin/MobileApp')->group(function () {

        Route::get('index',  [AdmissionIndexController::class,'index']);
        Route::get('AboutSchool', [AboutSchoolController::class,'index']);
        Route::get('AboutSchool/{pageid}/search',  [AboutSchoolController::class,'indexsearch']);
        Route::post('CreateAboutSchool',  [AboutSchoolController::class,'store']);
        Route::get('RemoveAboutSchool',  [AboutSchoolController::class,'remove']);

    });

    Route::prefix('MasterAdmin/FrontOffice')->group(function () {

        Route::get('index', [FrontOfficeIndexController::class,'index']);

        Route::get('EntryEnquiry', [EnquiryController::class,'index']);
        Route::post('CreateEntryEnquiry',  [EnquiryController::class,'store']);
        Route::get('EditViewEntryEnquiry/{enquiry}/view',  [EnquiryController::class,'editview']);
        Route::post('EditEntryEnquiry/{enquiry}/edit', [EnquiryController::class,'modify']);

        Route::get('EntryGatePass', [GatePassController::class,'index']);
        Route::post('CreateGatePass', [GatePassController::class,'store']);
        Route::get('EditViewGatePass', [GatePassController::class,'editview']);
        Route::post('ModifyGatePass', [GatePassController::class,'modify']);

        Route::get('EntryVisitor', [VisitorController::class,'index']);
        Route::post('CreateVisitor', [VisitorController::class,'store']);
        Route::get('EditViewVisitor', [VisitorController::class,'editview']);
        Route::post('ModifyVisitor', [VisitorController::class,'modify']);

        Route::get('EntryAppointment',[AppointmentController::class,'index']);
        Route::post('CreateAppointment', [AppointmentController::class,'store']);
        Route::get('EditViewAppointment', [AppointmentController::class,'editview']);
        Route::post('ModifyAppointment',  [AppointmentController::class,'modify']);

        Route::get('EntryComplaint',  [AppointmentController::class,'index']);
        Route::post('CreateComplaint',  [AppointmentController::class,'store']);
        Route::get('EditViewComplaint',  [AppointmentController::class,'editview']);
        Route::post('ModifyComplaint',  [AppointmentController::class,'modify']);

        Route::get('EntryServiceRequest',  [AppointmentController::class,'index']);
        Route::post('CreateServiceRequest',  [AppointmentController::class,'store']);
        Route::get('EditViewServiceRequest',  [AppointmentController::class,'editview']);
        Route::post('ModifyServiceRequest',  [AppointmentController::class,'modify']);
    });


    Route::prefix('MasterAdmin/Website')->group(function () {

        Route::get('index', [WebsiteIndexController::class,'index']);

    });

    Route::prefix('MasterAdmin/User')->group(function () {
        Route::get('index', [UserIndexController::class,'index']);
        Route::get('CreateRole', [UserIndexController::class,'CreateRole']);
        Route::post('StoreRole', [UserIndexController::class,'StoreRole']);
        Route::get('CreateUser', [UserController::class,'index']);
        Route::post('StoreUser', [UserController::class,'store']);
        Route::get('UserList', [ReportController::class,'userlist']);
        Route::get('DefineRole', [ReportController::class,'rolelist']);
        Route::get('UserSetting', [UserUserSettingController::class,'index']);
        Route::get('EditUser/{user}/edit', [UserController::class,'editview']);
        Route::get('UserPermission',[UserPermissionController::class,'index']);
        Route::post('UserPermission', [UserPermissionController::class,'indexsearch']);
        Route::post('CreateUserPermission', [UserPermissionController::class,'store']);
        Route::get('UserRole', [UserRoleController::class,'index']);
        Route::post('StoreUserRole', [UserRoleController::class,'updaterole']);
        /*
         * Report
         */
        Route::match(['GET', 'POST'], 'AppUseReport',[ReportController::class,'appuserreport']);
    });

    Route::prefix('MasterAdmin/GlobalSetting')->group(function () {

        Route::get('index', [GlobalSettingIndexController::class,'index']);

        Route::get('SchoolBoard', [SchoolBoardController::class,'index']);
        Route::get('SchoolInfo', [GlobalSettingGlobalSettingController::class,'schoolinfoview']);
        Route::post('SchoolInfo/{schoolbranch}/update', [GlobalSettingGlobalSettingController::class,'schoolinfoupdate']);
        Route::post('CreateSchoolBoard', [SchoolBoardController::class,'store']);
        Route::get('EditViewSchoolBoard/{schlbrd}/editview', [SchoolBoardController::class,'editview']);
        Route::post('EditSchoolBoard/{schoolboard}/edit', [SchoolBoardController::class,'edit']);

        Route::get('FormAutoIncrementConfiguration', [FormNoAutoController::class,'index']);
        Route::post('CreateFormAutoIncrementConfiguration', [FormNoAutoController::class,'store']);

        Route::get('AcademicYear', [AcademicYearController::class,'academicyearview']);
        Route::post('CreateAcademicYear', [AcademicYearController::class,'storeacademic']);
        Route::get('EditViewAcademicYear/{academic}/edit',[AcademicYearController::class,'editviewacademicyear']);
        Route::post('EditAcademicYear/{academic}/edit', [AcademicYearController::class,'editacademicyear']);

        Route::get('FinancialYear', [FinancialYearController::class,'index']);
        Route::post('CreateFinancialYear', [FinancialYearController::class,'store']);
        Route::get('EditViewFinancialYear/{financial}/edit', [FinancialYearController::class,'editview']);
        Route::post('EditFinancialYear/{financial}/edit', [FinancialYearController::class,'modify']);

        Route::get('AdmissionIsNewStatus', [AdmissionIsNewStatusController::class,'index']);
        Route::post('CreateAdmissionIsNewStatus', [AdmissionIsNewStatusController::class,'store']);
        Route::get('EditViewAdmissionIsNewStatus/{admissionisnewstatus}/edit', [AdmissionIsNewStatusController::class,'editview']);
        Route::post('EditAdmissionIsNewStatus/{admissionisnewstatus}/edit', [AdmissionIsNewStatusController::class,'modify']);

        Route::get('UserMapWithModule', [GlobalSettingGlobalSettingController::class,'usermapwithmoduleview']);
        Route::get('UserMapWithModule/{roleid}/{userid}/continue',  [GlobalSettingGlobalSettingController::class,'usermapwithmodulesearch']);
        Route::post('CreateUserModule',  [GlobalSettingGlobalSettingController::class,'usermapmodulestore']);

        Route::get('SmsConfiguration', [SMSConfigurationController::class,'index']);
        Route::post('CreateSmsConfiguration',  [SMSConfigurationController::class,'store']);

        Route::get('EmailConfiguration', [EmailConfigurationController::class,'index']);
        Route::match(['GET', 'POST'], 'SessionTransfer', [SessionTransferController::class,'index']);
        Route::post('SessionTransfer/{module}/create', [SessionTransferController::class,'create'])->name('admin.sessiontransfer');
        /**
         * Academic Setting
         */
        Route::get('DefineWing', [WingController::class,'index'])->name('define.wing');
        Route::post('CreateWing', [WingController::class,'store'])->name('define.wing.store');
        Route::get('EditViewWing/{wing}/edit', [WingController::class,'editview']);
        Route::post('EditWing/{wing}/edit', [WingController::class,'modify']);

        Route::get('DefineClass', [CourseController::class,'index']);
        Route::post('CreateClass',[CourseController::class,'store']);
        Route::get('EditViewClass/{course}/edit',[CourseController::class,'editview']);
        Route::post('EditClass/{course}/edit', [CourseController::class,'modify']);

        Route::get('DefineSection', [SectionController::class,'index']);
        Route::post('CreateSection', [SectionController::class,'store']);
        Route::get('EditViewSection/{section}/edit', [SectionController::class,'editview']);
        Route::post('EditSection/{section}/edit', [SectionController::class,'modify']);

        Route::get('MapClassWithSection', [ClassWithSectionController::class,'index']);
        Route::post('CreateClassWithSection', [ClassWithSectionController::class,'store']);

        Route::get('DefineStream', [StreamController::class,'index']);
        Route::post('CreateStream',  [StreamController::class,'store']);
        Route::get('EditViewStream/{stream}/edit',  [StreamController::class,'editview']);
        Route::post('EditStream/{stream}/edit',  [StreamController::class,'modify']);

        Route::get('DefineCategory', [CategoryController::class,'index']);
        Route::post('CreateCategory', [CategoryController::class,'store']);
        Route::get('EditViewCategory/{category}/edit', [CategoryController::class,'editview']);
        Route::post('EditCategory/{category}/edit',[CategoryController::class,'modify']);

        Route::get('DefineNationality', [NationalityController::class,'index']);
        Route::post('CreateNationality',  [NationalityController::class,'store']);
        Route::get('EditViewNationality/{nationality}/edit',  [NationalityController::class,'editview']);
        Route::post('EditNationality/{nationality}/edit', [NationalityController::class,'modify']);

        Route::get('DefineReligion', [ReligionController::class,'index']);
        Route::post('CreateReligion', [ReligionController::class,'store']);
        Route::get('EditViewReligion/{religion}/edit', [ReligionController::class,'editview']);
        Route::post('EditReligion/{religion}/edit', [ReligionController::class,'modify']);

        Route::get('DefineParish', [ParishController::class,'index']);
        Route::post('CreateParish', [ParishController::class,'store']);
        Route::get('EditViewParish/{parish}/edit', [ParishController::class,'editview']);
        Route::post('EditParish/{parish}/edit', [ParishController::class,'modify']);

        Route::get('DefineCaste', [CasteController::class,'index']);
        Route::post('CreateCaste', [CasteController::class,'store']);
        Route::get('EditViewCaste/{caste}/edit', [CasteController::class,'editview']);
        Route::post('EditCaste/{caste}/edit', [CasteController::class,'modify']);

        Route::get('DefineAdmissionType', [AdmissionTypeController::class,'index']);
        Route::post('CreateAdmissionType',  [AdmissionTypeController::class,'store']);
        Route::get('EditViewAdmissionType/{admissiontype}/edit',  [AdmissionTypeController::class,'editview']);
        Route::post('EditAdmissionType/{admissiontype}/edit',  [AdmissionTypeController::class,'modify']);

        Route::get('DefineHouse', [HouseController::class,'index']);
        Route::post('CreateHouse',  [HouseController::class,'store']);
        Route::get('EditViewHouse/{house}/edit',  [HouseController::class,'editview']);
        Route::post('EditHouse/{house}/edit',  [HouseController::class,'modify']);

        Route::get('DefineParentStatus', [ParentStatusController::class,'index']);
        Route::post('CreateParentStatus',  [ParentStatusController::class,'store']);
        Route::get('EditViewParentStatus/{parentstatus}/edit',  [ParentStatusController::class,'editview']);
        Route::post('EditParentStatus/{parentstatus}/edit',  [ParentStatusController::class,'modify']);

        Route::get('DefineSubject', [SubjectController::class,'index']);
        Route::post('CreateSubject', [SubjectController::class,'store']);
        Route::get('EditViewSubject/{subject}/edit',[SubjectController::class,'editview']);
        Route::post('EditSubject/{subject}/edit', [SubjectController::class,'modify']);
        Route::get('SubjectMapWithCourse', [SubjectMapWithCourseController::class,'index']);
        Route::post('CreateSubjectMapWithCourse', [SubjectMapWithCourseController::class,'store']);
        Route::get('RemoveSubjectMapWithCourse',[SubjectMapWithCourseController::class,'remove']);

        Route::get('DynamicReportSetting', [DynamicReportSettingController::class,'index']);
        Route::get('DynamicReportSetting/{pagename}/search',[DynamicReportSettingController::class,'indexsearch']);
        Route::post('CreateDynamicReportSetting', [DynamicReportSettingController::class,'store']);
        Route::get('IDCardTemplate', [IDCardTemplateController::class,'index']);

        Route::get('/UIDisplay', [UIDisplayController::class,'index']);
        Route::post('/CreateUIDisplay',  [UIDisplayController::class,'store']);
        Route::get('/ResetUI',  [UIDisplayController::class,'resetui']);

        Route::get('DefineCertificate', [CertificateController::class,'index']);
        Route::post('CreateCertificate',  [CertificateController::class,'store']);
        Route::get('EditViewCertificate/{certificate}/editview',  [CertificateController::class,'editview']);
        Route::post('EditCertificate/{certificate}/edit',  [CertificateController::class,'modify']);

        Route::match(['GET', 'POST'], 'CertificateTemplate', [CertificateTemplateController::class,'index']);
        Route::post('CreateCertificateTemplate',  [CertificateTemplateController::class,'store']);
        Route::get('CertificateSetting',  [CertificateTemplateController::class,'index']);

        Route::match(['GET', 'POST'], 'CertificateIntegrateFormFields', [CertificateIntegrateFormController::class,'index']);
        Route::post('StoreCertificateIntegrateFormFields', [CertificateIntegrateFormController::class,'store']);

        Route::get('TeacherClassMap', [TeacherClassMapController::class,'index']);
        Route::get('TeacherClassMap/{staffno}/{staffid}/search', [TeacherClassMapController::class,'indexsearch']);
        Route::post('StoreTeacherClassMap', [TeacherClassMapController::class,'store']);
        Route::get('RemoveTeacherClassMap/{staffid}/remove', [TeacherClassMapController::class,'remove']);

    });

    /*
     * comman database table tr soft delete
     */
    Route::get('/RecordDelete/{id}/{tbl}/delete', [RecordDeleteController::class,'destroy']);
    Route::post('/File/Upload', [FileUploaderController::class,'index']);
});

Route::get('uploadfile', function () {
    //$dd=Storage::disk('google')->get('1VrxpDZs1V47m35eHrYm_HEYjH8s0YEVU');
    return view('app.demo.googleupload');
    // Get root directory contents...
});

Route::post('/upload', function (\Illuminate\Http\Request $request) {
    $id = $request->file('thing')->store('1t3VTAvPo2dgNSjNsn1Mloe-buIVNLYwP', 'google');
    dd($id);

});


Route::post('ExportFile', [ExportsExportFileController::class,'exportfile']);
Route::post('ExportFilePdf', [ExportPdfController::class,'exportviewpdf']);

