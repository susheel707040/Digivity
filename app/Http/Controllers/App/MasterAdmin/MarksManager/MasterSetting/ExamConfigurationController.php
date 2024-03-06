<?php

namespace App\Http\Controllers\App\MasterAdmin\MarksManager\MasterSetting;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterAdmin\MarksManager\ExamConfigurationRequest;
use App\Models\MasterAdmin\MarksManager\ExamConfiguration;
use App\Repositories\MasterAdmin\MarksManager\MarksManagerRepositories;
use Illuminate\Http\Request;

class ExamConfigurationController extends Controller
{
    public function index()
    {
        return view('app.erpmodule.MasterAdmin.MarksManager.MasterSetting.exam-configuration');
    }

    public function indexsearch($course, $examtermid)
    {
        if (($course) && ($examtermid)) {
            $coursearr = explode("@", $course);
            $courseid = $coursearr[0];
            $sectionid = $coursearr[1];

            //exam config if already
            $examconfig=(new MarksManagerRepositories())->examconfiguration(['course_id'=>$courseid,'section_id'=>$sectionid,'exam_term_id'=>$examtermid]);

            $examtype = (new MarksManagerRepositories())->examtypelist();
            $examassessment = (new MarksManagerRepositories())->examassessmentlist(['exam_term_id' => $examtermid]);

            return view('app.erpmodule.MasterAdmin.MarksManager.MasterSetting.exam-configuration', compact(['examtype', 'examassessment', 'courseid', 'sectionid', 'examtermid','examconfig']));
        }
        return back()->with('danger', 'Sorry Class/Course Or Exam Term id Is Missing');
    }

    public function subjectandassessmentimport(Request $request)
    {
        $examtypeid = $request->examtypeid;

        $assessmentids = explode(",", $request->examassessmentids);
        $integrate = $request->integrate;

        $subject = (new MarksManagerRepositories())->examcoursemaponlysubjectlist(['search'=>['course_id' => $request->courseid, 'section_id' => $request->sectionid,'integrate'=>$integrate]],['subject']);
        $examassessment = (new MarksManagerRepositories())->examassessmentlist(['customsearch' => ['whereIn' => ['id' => $assessmentids]]]);

        return view('app.erpmodule.MasterAdmin.MarksManager.MasterSetting.ExamConfigImport.exam-subject-config-table-import', compact(['subject', 'examassessment', 'examtypeid', 'integrate','examconfig']));
    }

    public function store(ExamConfigurationRequest $request)
    {
        //dd($request->all());
        $entrycount = 0;
        if (isset($request->exam_type_id) && (is_array($request->exam_type_id))) {
            //existing record remove
            ExamConfiguration::query()->where(['course_id'=>$request->course_id,'section_id'=>$request->section_id,'exam_term_id'=>$request->exam_term_id])->record()->forceDelete();

            foreach ($request->exam_type_id as $examtypeid) {

                //exam assessment
                if(isset($request["exam_assessment_" . $examtypeid . "_id"]) && (is_array($request["exam_assessment_" . $examtypeid . "_id"])) && (count($request["exam_assessment_" . $examtypeid . "_id"]) > 0)) {
                    foreach ($request["exam_assessment_" . $examtypeid . "_id"] as $examassessmentid) {

                        //exam subject
                        if (isset($request["subject_" . $examtypeid . "_id"]) && (is_array($request["subject_" . $examtypeid . "_id"])) && (count($request["subject_" . $examtypeid . "_id"]) > 0)) {
                            foreach ($request["subject_" . $examtypeid . "_id"] as $subjectid) {

                                $groupid = $examtypeid."_".$examassessmentid."_".$subjectid;
                                //find subject and activity id

                                $datainsert = [
                                    'course_id' => $request->course_id,
                                    'section_id' => $request->section_id,
                                    'exam_term_id' => $request->exam_term_id,
                                    'exam_type_id' => $examtypeid,
                                    'exam_assessment_id' => $examassessmentid,
                                    'marks' => $request["exam_assessment_".$groupid."_marks"],
                                    'integrate' => $request["exam_integrate_".$examtypeid.""],
                                    'subject_id' => $subjectid,
                                    'grace' => $request["subject_".$examtypeid."_".$subjectid."_grace"] ? $request["subject_".$examtypeid."_".$subjectid."_grace"] : 0,
                                    'convert_to_grade' => $request["subject_".$examtypeid."_".$subjectid."_to_grade"] ? "yes" : "no",
                                    'sum_in_total' => $request["subject_".$examtypeid."_".$subjectid."_sum_in_total"] ? "yes" : "no",
                                    'grade_id' => $request["grade_".$examtypeid ."_id"]
                                ];
                                $entry = ExamConfiguration::create($datainsert);
                                if ($entry) {
                                    $entrycount++;
                                }
                            }
                        }
                    }
                }
            }
        }

        if ($entrycount > 0) {
            return back()->with('success', 'Record Save Successful Complete');
        } else {
            return back()->with('danger', 'Sorry, Request failed Please try again');
        }

    }
}
