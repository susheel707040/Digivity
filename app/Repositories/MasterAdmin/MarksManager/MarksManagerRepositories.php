<?php

namespace App\Repositories\MasterAdmin\MarksManager;

use App\Models\MasterAdmin\MarksManager\ExamActivities;
use App\Models\MasterAdmin\MarksManager\ExamAssessment;
use App\Models\MasterAdmin\MarksManager\ExamConfiguration;
use App\Models\MasterAdmin\MarksManager\ExamGradeSystem;
use App\Models\MasterAdmin\MarksManager\ExamMarksRecord;
use App\Models\MasterAdmin\MarksManager\ExamSubject;
use App\Models\MasterAdmin\MarksManager\ExamSubjectMapWithCourse;
use App\Models\MasterAdmin\MarksManager\ExamSubjectSkill;
use App\Models\MasterAdmin\MarksManager\ExamSubjectSkillGroup;
use App\Models\MasterAdmin\MarksManager\ExamTerm;
use App\Models\MasterAdmin\MarksManager\ExamType;
use App\Models\MasterAdmin\MarksManager\OnlineExam;
use App\Models\MasterAdmin\MarksManager\OnlineExamQuestion;
use App\Models\MasterAdmin\MarksManager\OnlineExamQuestionCategory;
use App\Repositories\MasterAdmin\RepositoryContract;

class MarksManagerRepositories extends RepositoryContract
{
    public function onlineexamlist($search = null, $relation = null)
    {
        return OnlineExam::query()->search($search, $relation)->record()->get();
    }

    public function onlineexamquestionlist($search = null, $relation = null)
    {
        return OnlineExamQuestion::query()->search($search, $relation)->record()->get();
    }

    public function onlineexamquestioncategorylist($search = null, $relation = null)
    {
        return OnlineExamQuestionCategory::query()->search($search, $relation)->record()->get();
    }

    public function examsubjectgrouplist($search = null, $relation = null)
    {
        return ExamSubject::query()->where(['integrate'=>'none','define'=>'parent'])->search($search, $relation)->record()->get();
    }

    public function examsubjectlist($search = null, $relation = null)
    {
        return ExamSubject::query()->where(['define'=>'none'])->search($search, $relation)->record()->get();
    }

    public function examsubjectskillgrouplist($search = null, $relation = null)
    {
        return ExamSubjectSkillGroup::query()->search($search, $relation)->record()->get()->sortBy('position');
    }

    public function examsubjectskilllist($search = null, $relation = null)
    {
        return ExamSubjectSkill::query()->search($search, $relation)->record()->get()->sortBy('position');
    }

    public function examtypelist($search = null, $relation = null)
    {
        return ExamType::query()->search($search, $relation)->record()->get()->sortBy('position');
    }

    public function examtermlist($search = null, $relation = null)
    {
        return ExamTerm::query()->search($search, $relation)->record()->get()->sortBy('position');
    }

    public function examassessmentlist($search = null, $relation = null)
    {
        return ExamAssessment::query()->search($search, $relation)->record()->get()->sortBy('position');
    }

    public function examactivitieslist($search = null, $relation = null)
    {
        return ExamActivities::query()->search($search, $relation)->record()->get()->sortBy('position');
    }

    public function examgradesystemlist($search = null, $relation = null)
    {
        return ExamGradeSystem::query()->search($search, $relation)->record()->get()->sortBy('position');
    }

    public function examsubjectmapwithcourselist($search = null, $relation = null)
    {
        return ExamSubjectMapWithCourse::query()->search($search, $relation)->record()->get();
    }

    public function examcoursemaponlysubjectlist($search = null, $relation = null)
    {
        return ExamSubjectMapWithCourse::query()->search($search,$relation)->groupBy('subject_id')->record()->get();
    }

    public function examconfiguration($search = null, $relation = null)
    {
        return ExamConfiguration::query()->search($search, $relation)->record()->get();
    }

    /*
     * Exam Config
     */
    public function examconfigexamtermlist($search = null, $relation = null)
    {
        $examconfig=$this->examconfiguration($search);
        $examtermids=array_keys($examconfig->groupBy('exam_term_id')->toArray());
        if($examtermids&&is_array($examtermids)){
            return $this->examtermlist(['customsearch' => ['whereIn' => ['id' => $examtermids]]]);
        }
        return null;
    }
    public function examconfigexamtypelist($search = null, $relation = null)
    {
        $examconfig=$this->examconfiguration($search);
        $examtypeids=array_keys($examconfig->groupBy('exam_type_id')->toArray());
        if($examtypeids&&is_array($examtypeids)) {
            return $this->examtypelist(['customsearch' => ['whereIn' => ['id' => $examtypeids]]]);
        }
        return null;
    }
    public function examassessmentconfig($search = null, $relation = null)
    {
        $examconfig=$this->examconfiguration($search);
        $examassessmentids=array_keys($examconfig->groupBy('exam_assessment_id')->toArray());
        if($examassessmentids&&is_array($examassessmentids)){
            return $this->examassessmentlist(['customsearch' => ['whereIn' => ['id' => $examassessmentids]]]);
        }
        return null;
    }

    public function examsubjectconfig($search = null, $relation = null)
    {
        $examconfig=$this->examconfiguration($search);
        $examsubjectids=array_keys($examconfig->groupBy('subject_id')->toArray());
        if($examsubjectids&&(is_array($examsubjectids))){
            return $this->examsubjectlist(['customsearch' => ['whereIn' => ['id' => $examsubjectids]]]);
        }
        return null;
    }

    public function examactivitiesconfig($search = null, $relation = null)
    {
        $examconfig=$this->examconfiguration($search);
        $examactivitiesids=array_keys($examconfig->groupBy('subject_id')->toArray());
        if($examactivitiesids&&is_array($examactivitiesids)){
            return $this->examactivitieslist(['customsearch' => ['whereIn' => ['id' => $examactivitiesids]]]);
        }
        return null;
    }

    public function examgradeconfig($search = null, $relation = null)
    {
        $examconfig=$this->examconfiguration($search);
        $examgradeids=array_keys($examconfig->groupBy('grade_id')->toArray());
        if($examgradeids&&is_array($examgradeids)){
            return $this->examgradesystemlist(['customsearch' => ['whereIn' => ['id' => $examgradeids]]]);
        }
        return null;
    }
    //exam student marks record
    public function examstudentmarksrecord($search = null, $relation = null)
    {
        return ExamMarksRecord::query()->search($search,$relation)->record()->get();
    }


}
