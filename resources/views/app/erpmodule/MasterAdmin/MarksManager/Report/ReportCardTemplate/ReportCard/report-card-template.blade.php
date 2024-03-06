<div class="container-fluid">
@php

$overall=['subject'=>0,'totalsum'=>0];
$examtypelist=(new \App\Repositories\MasterAdmin\MarksManager\MarksManagerRepositories())->examconfigexamtypelist(['course_id'=>$data->course_id,'section_id'=>$data->section_id]);
$examtermlist=(new \App\Repositories\MasterAdmin\MarksManager\MarksManagerRepositories())->examconfigexamtermlist(['search'=>['course_id'=>$data->course_id,'section_id'=>$data->section_id],'customsearch'=>['whereIn'=>['exam_term_id'=>explode(",",request()->get('examterm'))]]]);

$exammarksresult=(new \App\Repositories\MasterAdmin\MarksManager\MarksManagerRepositories())->examstudentmarksrecord(['course_id'=>$data->course_id,'section_id'=>$data->section_id,'student_id'=>$data->student_id]);

$examgrade=(new \App\Repositories\MasterAdmin\MarksManager\MarksManagerRepositories())->examgradeconfig(['course_id'=>$data->course_id,'section_id'=>$data->section_id]);

//create grade list in collection
$gradelist = new \Illuminate\Support\Collection();
foreach($examgrade as $grade){
    $gradearr=unserialize($grade['grade_input']);
    foreach ($gradearr['grade_name'] as $key=>$gradename)
    $gradelist->push((object)[
    'id'=>$grade->id,
    'grade_title'=>$grade->grade_title,
    'grade_point'=>$gradearr['grade_point'][$key],
    'grade' => $gradename,
    'grade_from'=>$gradearr['grade_from'][$key],
    'grade_to'=>$gradearr['grade_to'][$key]
    ]);
}

@endphp
@foreach($examtypelist as $examtypedata)
  @php
  if($examtypedata->integrate=="subject"){
  $examsubject=(new \App\Repositories\MasterAdmin\MarksManager\MarksManagerRepositories())->examsubjectconfig(['course_id'=>$data->course_id,'section_id'=>$data->section_id,'exam_type_id'=>$examtypedata->id]);
  }elseif($examtypedata->integrate=="activities"){
   $examsubject=(new \App\Repositories\MasterAdmin\MarksManager\MarksManagerRepositories())->examactivitiesconfig(['course_id'=>$data->course_id,'section_id'=>$data->section_id,'exam_type_id'=>$examtypedata->id]);
  }
  @endphp

<div class="col-lg-12 m-0 p-0">
    <table class="table table-bordered">
        <thead class="bg-light">
        <tr>
            <th>@if($examtypedata->alias) {{$examtypedata->alias}} @else {{$examtypedata->exam_type}} @endif</th>
            @php $examassessmentlist=[]; @endphp
            @foreach($examtermlist as $examtermdata)
                @php
                    $examassessment=(new \App\Repositories\MasterAdmin\MarksManager\MarksManagerRepositories())->examassessmentconfig(['course_id'=>$data->course_id,'section_id'=>$data->section_id,'exam_type_id'=>$examtypedata->id,'exam_term_id'=>$examtermdata->id]);

            foreach ($examassessment as $examassessmentdata){
                        $examassessmentlist[]=['id'=>$examassessmentdata->id,'assessment'=>$examassessmentdata->exam_assessment,'alias'=>$examassessmentdata->alias,'exam_term_id'=>$examtermdata->id,'marks'=>$examassessmentdata->marks];
                    }
                @endphp
            @if($examassessment)
            <th @if($examtypedata->integrate=="subject") colspan="{{count($examassessment)+2}}" @else colspan="{{count($examassessment)}}" @endif class="text-center">@if($examtermdata->alias) {{$examtermdata->alias}} @else {{$examtermdata->exam_term}} @endif</th>
            @endif
            @endforeach
        </tr>
        </thead>
        <thead>
        <tr>
            <th>{{ucwords($examtypedata->integrate)}}</th>
            @foreach($examassessmentlist as $examassessmentdata)
            <th class="text-center">{{$examassessmentdata['assessment']}}</th>
            @endforeach
            @if($examtypedata->integrate=="subject")
            <th class="text-center">Mark Obtained</th>
            <th class="text-center">GR</th>
            @endif
        </tr>
        </thead>

        <tbody>

        @foreach($examsubject as $examsubjectdata)
            @php $mo=0; @endphp
        <tr>
            <!--Subject and Activity-->
            <td>{{$examsubjectdata->SubjectActivitiesName()}}</td>

            <!--Exam Term---->
           @foreach($examtermlist as $examtermdata)

            <!--Exam Assessment Term Wise-->
            @foreach($examassessmentlist as $examassessmentdata)
            @php $uniquekey=$examsubjectdata->id."_".$examassessmentdata['id']; @endphp
            @php
            if(isset($exammarksresult)&&($exammarksresult)){
            $exammarks=collect($exammarksresult)->where('exam_term_id',$examassessmentdata['exam_term_id'])->where('exam_type_id',$examtypedata->id)->where('integrate',$examtypedata->integrate)->where('exam_assessment_id',$examassessmentdata['id'])->where('subject_id',$examsubjectdata->id)->first();
            //total sum in
            if((isset($exammarks->marks))&&is_numeric($exammarks->marks)&&($exammarks->marks>0)){
            $overall[]=[$uniquekey=>$exammarks->marks];
            $mo +=$exammarks->marks;
            }
            }

            $overall['totalsum'] +=$examassessmentdata['marks'];
            @endphp
            <td class="text-center wd-10p">@if(isset($exammarks->attend_status)&&($exammarks->attend_status)) {{strtoupper($exammarks->attend_status)}} @elseif(isset($exammarks->marks)) {{$exammarks->marks}} @endif</td>
            @endforeach

            @php
            $grade=collect($gradelist)->where('id',2)->where('grade_from','<',$mo)->where('grade_to','>',$mo)->first();


            $overall['subject'] +=$mo;
            @endphp


            <!--Mark Obtain and Grade-->
            @if($examtypedata->integrate=="subject")
                <th class="text-center">{{$mo}}</th>
                <th class="text-center">{{$grade->grade}}</th>
            @endif

           <!---close exam term--->
          @endforeach
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endforeach

    @php
        $percentage=(($overall['subject']*100)/$overall['totalsum']);
    @endphp
<div class="col-lg-12 pd-l-0 pd-r-0">
    <table class="table table-bordered">
        <tr>
            <td><b>TOTAL</b></td><td colspan="2">{{$overall['subject']}} / <b>{{$overall['totalsum']}}</b></td>
        </tr>
        <tr>
            <td><b>PERCENTAGE (%)</b></td><td colspan="2">{{numberformat($percentage,2)}} <b>%</b></td>
        </tr>
        <tr>
            <td><b>RESULT</b></td><td colspan="2"></td>
        </tr>
        <tr>
            <td class="ht-50"><b>CLASS TEACHER REMARK</b></td><td colspan="2"></td>
        </tr>
        <tr>
            <td rowspan="2" class="ht-50 align-bottom"><b>DATE</b></td>
            <td class="ht-80"></td>
            <td></td>
        </tr>
        <tr>
            <td class="text-center align-bottom">SIGNATURE OF CLASS TEACHER</td>
            <td class="text-center align-bottom">SIGNATURE OF PRINCIPAL</td>
        </tr>
    </table>
</div>

<!--Exam Grade List-->
@if(isset($examgrade)&&(count($examgrade)>0))
    @foreach($examgrade as $examgradedata)
        <div class="col-lg-12 pd-l-0 pd-r-0">
            <span class="tx-12"><b>{{$examgradedata->description}}</b></span>
            @include('erpmodule.MasterAdmin.MarksManager.Report.ReportCardTemplate.OtherTemplate.grade-template',['examgradedata'=>$examgradedata])
        </div>
    @endforeach
@endif
</div>
