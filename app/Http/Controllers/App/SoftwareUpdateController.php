<?php

namespace App\Http\Controllers;

use App\Models\MasterAdmin\AcademicSetting\CourseWithSection;
use App\Models\MasterAdmin\Finance\FeeSetting\FeeHeadInstallment;
use App\Models\MasterAdmin\Finance\ReceiptCancelRecord;
use App\Models\MasterAdmin\Finance\StudentFeeCollectionInstalmentRecord;
use App\Models\MasterAdmin\Finance\StudentFeeHeadInstalmentConcession;
use App\Models\MasterAdmin\GlobalSetting\FormNoAuto;
use App\Models\MasterAdmin\Library\Book;
use App\Models\MasterAdmin\Library\LibraryEntryRecord;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Schema;

class SoftwareUpdateController extends Controller
{
    public function updatesoftware(Request $request)
    {
        Artisan::call('migrate', array('--force' => true));
        if($request->passport==1){
            Artisan::call('migrate', array('--force' => true,'--path' => 'vendor/laravel/passport/database/migrations'));
            Artisan::call('passport:install');
        }
        Artisan::call('route:clear');
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('view:clear');
        Artisan::call('config:cache');
        Artisan::call('route:cache');
        Artisan::call('view:cache');
    }

    public function resetsoftware()
    {
        Artisan::call('route:clear');
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('view:clear');
        Artisan::call('config:cache');
        Artisan::call('route:cache');
        Artisan::call('view:cache');
        Artisan::call('storage:link');
    }

    public function migration(Request $request)
    {
        //(new \NavbarSeeder())->run();

        DB::statement('ALTER TABLE finance_fee_collection_fee_head_record MODIFY custom_fee_id VARCHAR(191);');
        DB::statement('ALTER TABLE finance_fee_collection_instalment_record MODIFY custom_fee_id VARCHAR(191);');
        DB::statement("ALTER TABLE student_admission_class_record MODIFY status enum('active','inactive','suspend') default 'active'");
        DB::statement("ALTER TABLE staff_record MODIFY date_of_retire date null");
        DB::statement("ALTER TABLE staff_record MODIFY date_of_extend date null");

        try {
            DB::statement('ALTER TABLE staff_record ADD shift_id BIGINT(20) unsigned NULL after hostel_id');
        } catch (\Exception $e) {
        }
        try {
            DB::statement('ALTER TABLE staff_record ADD integrated_id VARCHAR(191) NULL after shift_id');
        }catch (\Exception $e) {
        }
        try {
            DB::statement('ALTER TABLE staff_record ADD integrated_id VARCHAR(191) NULL after shift_id');
        }catch (\Exception $e) {
        }
        try {
            DB::statement('ALTER TABLE staff_record ADD category_id BIGINT(20) unsigned NULL after religion_id');
        } catch (\Exception $e) {
        }
        try {
            DB::statement("ALTER TABLE staff_record ADD generate_salary enum('yes','no') default 'yes' after bank_location");
        } catch (\Exception $e) {
        }
        try {
            DB::statement("ALTER TABLE staff_record ADD salary_to_bank enum('yes','no') default 'yes' after generate_salary");
        } catch (\Exception $e) {
        }
        try {
            DB::statement("ALTER TABLE staff_record ADD gratuity_code VARCHAR(191) NULL after salary_to_bank");
        } catch (\Exception $e) {
        }
        try {
            DB::statement("ALTER TABLE staff_record ADD emp_status VARCHAR(191) NULL after gratuity_code");
        } catch (\Exception $e) {
        }
        try {
            DB::statement('ALTER TABLE staff_record ADD integrated_id VARCHAR(191) NULL after shift_id');
        }catch (\Exception $e) {
        }
        try {
            DB::statement('ALTER TABLE staff_record ADD machine_no VARCHAR(191) NULL after pension');
        }catch (\Exception $e) {
        }
        try {
            DB::statement('ALTER TABLE staff_record ADD rfid_no VARCHAR(191) NULL after machine_no');
        }catch (\Exception $e) {
        }
        try {
            DB::statement('ALTER TABLE staff_record ADD gps_no VARCHAR(191) NULL after rfid_no');
        }catch (\Exception $e) {
        }
        try {
            DB::statement('ALTER TABLE staff_record ADD attendance VARCHAR(191) NULL after gps_no');
        }catch (\Exception $e) {
        }
        try {
            DB::statement('ALTER TABLE staff_record ADD username VARCHAR(191) NULL after profile_img');
        }catch (\Exception $e) {
        }
        try {
            DB::statement('ALTER TABLE staff_record ADD psw LONGTEXT NULL after username');
        }catch (\Exception $e) {
        }

        try {
            DB::statement('ALTER TABLE inapp_homework_attachment_file_record ADD extension VARCHAR(191) NULL after attachment_files');
        }catch (\Exception $e) {
        }

        try {
            if(ReceiptCancelRecord::query()->count()==0) {
                Schema::dropIfExists('finance_receipt_cancel_record');
                DB::table("migrations")->where('migration', '2020_03_24_075010_create_finance_receipt_cancel_record_table')->delete();
            }
        }catch (\Exception $e){
        }

        try {
            DB::statement('ALTER TABLE school_branches ADD about VARCHAR(191) NULL after address');
            DB::statement('ALTER TABLE school_branches ADD contact_no VARCHAR(191) NULL after about');
            DB::statement('ALTER TABLE school_branches ADD email VARCHAR(191) NULL after contact_no');
            DB::statement('ALTER TABLE school_branches ADD website VARCHAR(191) NULL after email');
            DB::statement('ALTER TABLE school_branches ADD logo LONGTEXT NULL after website');
            DB::statement('ALTER TABLE school_branches ADD banner_logo LONGTEXT NULL after logo');
            DB::statement('ALTER TABLE school_branches ADD city VARCHAR(191) NULL after banner_logo');
            DB::statement('ALTER TABLE school_branches ADD currency VARCHAR(191) NULL after city');
            DB::statement('ALTER TABLE school_branches ADD language VARCHAR(191) NULL after currency');
            DB::statement('ALTER TABLE school_branches ADD timezone VARCHAR(191) NULL after language');
            DB::statement('ALTER TABLE school_branches ADD location LONGTEXT NULL after timezone');
            DB::statement('ALTER TABLE school_branches ADD latitude VARCHAR(191) NULL after location');
            DB::statement('ALTER TABLE school_branches ADD longitude VARCHAR(191) NULL after latitude');
        }catch (\Exception $e) {
        }

        try {
            DB::statement('ALTER TABLE school_branches ADD website VARCHAR(191) NULL after email');
        }catch (\Exception $e){}

        try {
            DB::statement('ALTER TABLE finance_fee_head_instalment ADD instalment_unique_id VARCHAR(191) NULL after instalment_id');
        }catch (\Exception $e){}

        try {
            DB::statement("ALTER TABLE finance_fee_head ADD form_sale enum('yes','no') default 'no' after fee_custom");
        } catch (\Exception $e) {
        }
        try {
            DB::statement("ALTER TABLE online_class_record ADD password VARCHAR(191) NULL after join_group_id");
        } catch (\Exception $e) {
        }

        try {
            DB::statement('ALTER TABLE finance_fee_collection_instalment_record ADD instalment_unique_id VARCHAR(191) NULL after instalment_id');
        }catch (\Exception $e){}

        try {
            DB::statement('ALTER TABLE staff_map_with_record ADD for_course_id BIGINT(20) unsigned NULL after section_id');
            DB::statement('ALTER TABLE staff_map_with_record ADD for_section_id BIGINT(20) unsigned NULL after for_course_id');
            DB::statement('ALTER TABLE staff_map_with_record DROP COLUMN course_teacher_id');
        }catch (\Exception $e){}

        try {
            DB::statement('ALTER TABLE user_module ADD ac_user_id BIGINT(20) NULL after role_id');
        }catch (\Exception $e){}

        try {
            DB::statement('ALTER TABLE student_prospectus ADD transport_id VARCHAR(191) NULL after board_id');
        }catch (\Exception $e){}

        try {
            DB::statement("ALTER TABLE certificate ADD for enum('student','staff') default null after branches_id");
        }catch (\Exception $e){}

        try {
            DB::statement("ALTER TABLE certificate_template ADD certificate_title VARCHAR(191) NULL after certificate_id");
        }catch (\Exception $e){}

        try {
            DB::statement("ALTER TABLE certificate_template ADD certificate_title_slug VARCHAR(191) NULL after certificate_title");
        }catch (\Exception $e){}

        try {
            DB::statement("ALTER TABLE student_prospectus ADD status enum('approve','pending','reject','cancel','hold') default 'pending' after student_photo");
        }catch (\Exception $e){}

        try {
            DB::statement("ALTER TABLE certificate_record ADD integrate VARCHAR(191) NULL after certificate_for");
        }catch (\Exception $e){}
        try {
            DB::statement("ALTER TABLE certificate_record ADD request_data LONGTEXT NULL after integrate");
        }catch (\Exception $e){}
        try {
            DB::statement("ALTER TABLE student_document_record ADD document_id BIGINT(20) NULL after student_id");
        }catch (\Exception $e){}

        try {
            DB::statement("ALTER TABLE school_branches ADD color VARCHAR(191) NULL after school_name");
            DB::statement("ALTER TABLE school_branches ADD ads_color VARCHAR(191) NULL after address");
        }catch (\Exception $e){}

        try {
            DB::statement("ALTER TABLE bookmarks_url ADD position tinyint default '0' after bookmarks_category_id");
            DB::statement("ALTER TABLE bookmarks_url ADD open_window enum('_self','_blank','_parent','_top') default '_self' after url");
        }catch (\Exception $e){}

        try {
            DB::statement("ALTER TABLE communication_notification_record ADD send_to VARCHAR(191) NULL after communication_type_id");
            DB::statement("ALTER TABLE communication_notification_record ADD send_to_id BIGINT(20) NULL after send_to");
        }catch (\Exception $e){}

        try {
            DB::statement("ALTER TABLE student_admission_class_record ADD subject_id VARCHAR(191) NULL after stream_id");
            }catch (\Exception $e){}

        try {
            DB::statement("ALTER TABLE attendance_leave_type DROP COLUMN academic_id");
        }catch (\Exception $e){}
        try {
            DB::statement("ALTER TABLE attendance_holiday DROP COLUMN holiday_type_id");
        }catch (\Exception $e){}
        try {
            DB::statement("ALTER TABLE attendance_holiday ADD for_student enum('1','0') default '0' after academic_id");
            DB::statement("ALTER TABLE attendance_holiday ADD for_staff enum('1','0') default '0' after for_student");
            DB::statement("ALTER TABLE attendance_holiday ADD description LONGTEXT NULL after holiday");
            DB::statement("ALTER TABLE attendance_holiday ADD symbol VARCHAR(191) NULL after description");
            DB::statement("ALTER TABLE attendance_holiday ADD holiday_from_date date after symbol");
          }catch (\Exception $e){}
        try {
            DB::statement("ALTER TABLE attendance_holiday ADD holiday_to_date date after holiday_from_date");
        }catch (\Exception $e){}
        try {
            DB::statement("ALTER TABLE attendance_leave_record ADD document_ids LONGTEXT NULL after leave_status_updated");
        }catch (\Exception $e){}

        try {
            DB::statement("ALTER TABLE library_book ADD entry_id VARCHAR(191) NULL after current_issue");
        }catch (\Exception $e){}

        try {
            DB::statement("ALTER TABLE form_auto_increment_configuration ADD academic_id BIGINT(20) after branches_id");
        }catch (\Exception $e){}

        try {
            DB::statement("ALTER TABLE finance_fee_head_structure ADD admission_category VARCHAR(191) NULL after fee_applicable");
        }catch (\Exception $e){}

        try {
            DB::statement("ALTER TABLE attendance_leave_type ADD alias VARCHAR(191) NULL after leave_type");
            DB::statement("ALTER TABLE attendance_leave_type ADD description LONGTEXT NULL after alias");
            DB::statement("ALTER TABLE attendance_leave_type ADD sequence TinyInt DEFAULT 0 after branches_id");
        }catch (\Exception $e){}

        try {
            DB::statement("ALTER TABLE attendance_leave_record MODIFY leave_status enum('pending','reject','cancel','approve') default 'pending'");
        }catch (\Exception $e){}

        try {
            DB::statement("ALTER TABLE courses_map_sections ADD academic_id BIGINT(20) after branches_id");
        }catch (\Exception $e){}


        try {
            DB::statement("ALTER TABLE exam_subject ADD group_id BIGINT(20) NULL after academic_id");
        }catch (\Exception $e){}
        try {
            DB::statement("ALTER TABLE exam_subject ADD integrate enum('none','subject','activities') default 'subject' after description");
        }catch (\Exception $e){}
        try {
            DB::statement("ALTER TABLE exam_subject ADD define enum('none','parent') default 'none' after is_active");
        }catch (\Exception $e){}
        try {
            DB::statement("ALTER TABLE exam_subject ADD alias LONGTEXT NULL after subject_name");
        }catch (\Exception $e){}



        try {
            $course=CourseWithSection::query()->get();
            foreach ($course as $data){
                if(empty($data->academic_id)){
                    $data->update(['academic_id'=>1]);
                }
            }
            $formconfig=FormNoAuto::query()->get();
            foreach ($formconfig as $data){
                if(empty($data->academic_id)){
                    $data->update(['academic_id'=>1]);
                }
            }
        }catch (\Exception $e){}


        try {
            if(isset($request->libraryupdate)&&($request->libraryupdate==1)) {
                $bookentry = LibraryEntryRecord::query()->groupBy('book_id')->orderBy('id', 'DESC')->get();
                foreach ($bookentry as $data) {
                    $book = Book::find($data->book_id);
                    if ($book) {
                        $book->update(['current_issue' => 1, 'entry_id' => $data->entry_id]);
                    }
                }
            }
        }catch (\Exception $e){}

        try {
            DB::statement("ALTER TABLE finance_student_fee_head_instalment_concession ADD fee_collection_id BIGINT(20) NULL after concession");
            DB::statement("ALTER TABLE finance_student_fee_head_instalment_concession ADD adjust_status enum('1','0') default '0' after fee_collection_id");
            DB::statement("ALTER TABLE finance_student_fee_head_instalment_concession ADD adjust_date date NULL after fee_collection_id");

        }catch (\Exception $e){}

        try {
            $role=Role::query()->where(['alias'=>'chair-person'])->first();
            if($role) {
                $role->update(['alias' => 'admin', 'name' => 'Admin']);
            }
        }catch (\Exception $e){}

        try {
            $feeheadinstalment=FeeHeadInstallment::query()->whereNull('instalment_unique_id')->get();
            if($feeheadinstalment) {
                foreach ($feeheadinstalment as $data) {
                    $instalment=explode("_",$data->instalment_id);
                    $feeupdate = FeeHeadInstallment::find($data->id);
                    $feeupdate->update(['instalment_unique_id'=>$instalment[0]]);
                }
            }
        }catch (\Exception $e){}

        try {
            $feecollectinstalment=StudentFeeCollectionInstalmentRecord::query()->whereNull('instalment_unique_id')->get();
            if($feecollectinstalment){
                foreach ($feecollectinstalment as $data){
                    $instalment=explode("_",$data->instalment_id);
                    $feecollect=StudentFeeCollectionInstalmentRecord::find($data->id);
                    $feecollect->update(['instalment_unique_id'=>$instalment[0]]);
                }

            }
        }catch (\Exception $e){}
        //StudentAdmission::query()->where(['dob'=>'2020-04-06'])->update(['dob'=>null]);
        try {
            if(isset($request->sfc)&&($request->sfc==1)) {
                $feecollectinstalment = StudentFeeCollectionInstalmentRecord::query()->with(['feecollectionrecord'])->get();
                if (isset($feecollectinstalment) && ($feecollectinstalment)) {
                    foreach ($feecollectinstalment as $instalmentdata) {

                        $studentfeeheadconcession = StudentFeeHeadInstalmentConcession::query()->where(['student_id' => $instalmentdata->student_id, 'foreign_fee_head_id' => $instalmentdata->fee_head_id, 'instalment_id' => $instalmentdata->instalment_id, 'adjust_status' => '0'])->get();
                        if (isset($studentfeeheadconcession) && ($studentfeeheadconcession) && (count($studentfeeheadconcession) > 0)) {
                            foreach ($studentfeeheadconcession as $studentfeeheadconcessionupdate) {

                                if (isset($instalmentdata->feecollectionrecord->receipt_date) && ($instalmentdata->feecollectionrecord->receipt_date)) {
                                    $studentfeeheadconcessionupdate->update(['fee_collection_id' => $instalmentdata->fee_collection_id, 'adjust_date' => nowdate($instalmentdata->feecollectionrecord->receipt_date, 'Y-m-d'), 'adjust_status' => '1']);
                                }
                            }
                        }
                    }
                }
            }
        }catch (\Exception $e){}

    }
}
