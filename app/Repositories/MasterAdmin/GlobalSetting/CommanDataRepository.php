<?php


namespace App\Repositories\MasterAdmin\GlobalSetting;

use App\Models\BookmarksLink;
use App\Models\FileStorage;
use App\Models\MasterAdmin\AcademicSetting\AdmissionType;
use App\Models\MasterAdmin\AcademicSetting\Caste;
use App\Models\MasterAdmin\AcademicSetting\Category;
use App\Models\MasterAdmin\AcademicSetting\Course;
use App\Models\MasterAdmin\AcademicSetting\Stream;
use App\Models\MasterAdmin\AcademicSetting\Parish;
use App\Models\MasterAdmin\AcademicSetting\ParentStatus;



use App\Models\MasterAdmin\AcademicSetting\CourseWithSection;
use App\Models\MasterAdmin\AcademicSetting\House;
use App\Models\MasterAdmin\AcademicSetting\Nationality;
use App\Models\MasterAdmin\AcademicSetting\Religion;
use App\Models\MasterAdmin\AcademicSetting\Section;
use App\Models\MasterAdmin\AcademicSetting\StudentDocumentType;
use App\Models\MasterAdmin\AcademicSetting\Subject;
use App\Models\MasterAdmin\AcademicSetting\SubjectMapWithCourse;
use App\Models\MasterAdmin\GlobalSetting\AcademicSession;
use App\Models\MasterAdmin\GlobalSetting\AdmissionIsNewStatus;
use App\Models\MasterAdmin\GlobalSetting\Certificate;
use App\Models\MasterAdmin\GlobalSetting\CertificateTemplate;
use App\Models\MasterAdmin\GlobalSetting\DynamicReportSetting;
use App\Models\MasterAdmin\GlobalSetting\FinancialSession;
use App\Models\MasterAdmin\GlobalSetting\SchoolBoard;
use App\Models\MasterAdmin\GlobalSetting\SchoolBranch;
use App\Models\MasterAdmin\GlobalSetting\StaffMapCourse;
use App\Models\UserActivityLog;
use App\Repositories\MasterAdmin\RepositoryContract;

class CommanDataRepository extends RepositoryContract
{
    public function admissionisnewstatuslist($search=null)
    {
        if(!isset($search)){$search=[];}
        return AdmissionIsNewStatus::query()->where($search)->record()->OrderBy('priority','ASC')->get();
    }

    public function courseidspermission()
    {
        $course=CourseWithSection::query()->record()->groupBy('course_id')->get(['course_id'])->pluck(['course_id'])->toArray();
        if($course) {
            return $course;
        }
        return [];
    }

    public function courseselectlist($search=null)
    {
        $courseids=$this->courseidspermission();
        if(!isset($search)){$search=[];}
        return Course::query()->whereIn('id',$courseids)->where($search)->record()->with(['coursewithsection'])->orderBy('sequence', 'ASC')->get();
    }


    public function parishlist($search=null)
    {
        if(!isset($search)){$search=[];}
        return Parish::query()->where($search)->record()->get();
    }
    public function courseandsectionname($search)
    {
        $courseids=[];
        if(isset($search['coursesectionid'])){
            foreach ($search['coursesectionid'] as $coursesection){
                $course=explode("@",$coursesection);
                array_push($courseids,array($course[0]=>$course[1]));
            }
        }
        return "";
    }

    public function sectiongetlist($search=null,$relation=null)
    {
        return Section::query()->search($search)->record()->get();
    }
    public function coursesectionlist()
    {
        $courseids=$this->courseidspermission();
        return Course::query()->whereIn('id',$courseids)->with(['sections' => function ($query) {
            $query->orderBy('sequence', "asc");
        }])->record()->orderBy('sequence', 'asc')->get();
    }
    public function sectionlist($search = null)
    {
        if (!isset($search)) {
            $search = [];
        }

        return CourseWithSection::query()
            ->where($search)
            ->with(['section' => function ($query) {
                $query->orderBy('sequence', 'desc');
            }])
            ->record()
            ->groupBy(['section_id', 'courses_map_sections.id']) // Include all non-aggregated columns
            ->get();
    }


    public function teachercoursewithsection($search=null,$relation=null)
    {
        return StaffMapCourse::query()->where($search)->record()->get();
    }

    public function classteacherids($search=null,$relation=null)
    {
        $staffmapcourse=StaffMapCourse::query()->search($search)->record()->get()->groupBy('staff_id')->toArray();
        return array_keys($staffmapcourse);
    }

    public function boardselectlist()
    {
        return SchoolBoard::query()->record()->get();
    }

    public function houseselectlist()
    {
        return House::query()->record()->get();
    }

    public function academicyearlist($search=null)
    {
        if(!isset($search)){$search=[];}
        return AcademicSession::query()->where($search)->record()->get();
    }

    public function financialyearlist($search=null)
    {
        if(!isset($search)){$search=[];}
        return FinancialSession::query()->where($search)->record()->get();
    }

    public function schoolbranchlist($search)
    {
        return SchoolBranch::query()->where($search)->record()->get();
    }

    public function admissiontypeselectlist()
    {
        return AdmissionType::query()->record()->get();
    }

    public function categoryselectlist($search=null)
    {
        return Category::query()->record()->get();
    }

    public function nationalitylist($search=null)
    {
        if(!isset($search)){$search=[];}
        return Nationality::query()->where($search)->record()->get();
    }

    public function parentstatuslist($search=null)
    {
        if(!isset($search)){$search=[];}
        return ParentStatus::query()->where($search)->record()->get();
    }

    public function streamlist($search=null)
    {
        if(!isset($search)){$search=[];}
        return Stream::query()->where($search)->record()->get();
    }

    public function religionselectlist()
    {
        return Religion::query()->record()->get();
    }

    public function casteselectlist()
    {
        return Caste::query()->record()->get();
    }

    public function studentdocumenttypelist($search=null,$relation=null)
    {
        if(!isset($search)){$search=[];}
        return StudentDocumentType::query()->search($search,$relation)->record()->get();
    }

    public function dynamicreport($search)
    {
        return DynamicReportSetting::query()->where($search)->record()->first();
    }

    public function subjectlist($search=null)
    {
        return Subject::query()->search($search)->orderBy('priority','asc')->record()->get();
    }

    public function subjectmapwithcourselist($search)
    {
        return SubjectMapWithCourse::query()->where($search)->with(['course','section','subject'=>function($query){$query->orderBy('priority','asc');}])->groupBy('subject_id')->record()->get();
    }

    public function certificatelist($search=null)
    {
        return Certificate::query()->search($search)->record()->get();
    }

    public function certificatetemplatelist($search=null)
    {
        return CertificateTemplate::query()->where($search)->record()->get();
    }

    public function certificatetemplatenamelist($search=null)
    {
        return CertificateTemplate::query()->groupBy('certificate_title_slug')->record()->get();
    }

    public function tccertificatelist($search=null)
    {
        return Certificate::query()->where(['integrate'=>'tc'])->record()->get();
    }

    public function bookmarkslinklist($search=null,$relation=null)
    {
        return BookmarksLink::query()->where($search)->record()->get()->groupBy('bookmarklinkcategory.bookmarks_category');
    }

    public function useractivitylogs($search=null,$relation=null)
    {
        return UserActivityLog::where($search)->get();
    }

    public function filestorage($id)
    {
        return FileStorage::find($id);
    }
}
