@if(isset($examconfig)&&(count($examconfig)>0))
    @php
    //exam configuration
    $examconfigdata=collect($examconfig)->where('exam_type_id',$data->id);

    $existsubjectids=array_keys($examconfigdata->groupBy('subject_id')->toArray());
    $existassessmentids=array_keys($examconfigdata->groupBy('exam_assessment_id')->toArray());

    $examassessment=collect($examassessment)->whereIn('id',$existassessmentids);

    $subject=(new \App\Repositories\MasterAdmin\MarksManager\MarksManagerRepositories())->examcoursemaponlysubjectlist(['search'=>['course_id' => $courseid, 'section_id' => $sectionid,'integrate'=>$data->integrate]],['subject']);

    @endphp
@endif


<table class="table table-bordered m-0 p-0">
    <thead class="bg-primary-light">
    <tr>
        <th class="wd-40 text-center"><input type="checkbox" checked></th>
        <th class="text-left">@if($integrate=="subject") Subject @elseif($integrate=="activities") Activities @endif</th>
        @foreach($examassessment as $assessmentdata)
            <th class="text-left"><span><input type="hidden" name="exam_assessment_{{$examtypeid}}_id[]" autocomplete="off" value="{{$assessmentdata->id}}" readonly="readonly"> {{$assessmentdata->exam_assessment}}</span></th>
        @endforeach
        <td class="text-center wd-60"><b>Grace</b></td>
        <td class="wd-150 text-left"><b>Configuration</b></td>
    </tr>
    </thead>
    <tbody>
    @foreach($subject as $subjectdata)
        @php
            $subjectid=$subjectdata->subject_id;
        @endphp
        <tr>
            <td class="text-center">
                <input type="checkbox" name="subject_{{$examtypeid}}_id[]" value="{{$subjectid}}" @if(isset($existsubjectids)&&(is_array($existsubjectids))&&(in_array($subjectid,$existsubjectids))) checked @endif>
            </td>
            <td class="text-left">
                {{$subjectdata->SubjectName()}}
            </td>
            @foreach($examassessment as $assessmentdata)
                @php
                if(isset($examconfigdata)&&count($examconfigdata)>0){
                    $examconfigassessmentdata=$examconfigdata->where('subject_id',$subjectid)->where('exam_assessment_id',$assessmentdata->id)->shift();
                }
                @endphp

                @php $groupid=$examtypeid."_".$assessmentdata->id."_".$subjectid; @endphp
                <td class="text-left">
                    <input type="text" class="form-control1 wd-50" onkeypress="javascript:return isNumber(event)" name="exam_assessment_{{$groupid}}_marks" placeholder="Marks" @if(isset($examconfigassessmentdata->marks)&&($examconfigassessmentdata->marks)) value="{{$examconfigassessmentdata->marks}}" @else value="{{$assessmentdata->marks}}" @endif >
                </td>
            @endforeach
            <td class="text-center"><input type="text" class="form-control1 wd-60 text-center" onkeypress="javascript:return isNumber(event)" name="subject_{{$examtypeid}}_{{$subjectdata->subject_id}}_grace" @if(isset($examconfigassessmentdata->grace)&&($examconfigassessmentdata->grace)) value="{{$examconfigassessmentdata->grace}}"  @else value="0" @endif></td>
            <td class="text-left">
                <span><input type="checkbox" name="subject_{{$examtypeid}}_{{$subjectid}}_to_grade" value="yes" @if(isset($examconfigassessmentdata->convert_to_grade)&&($examconfigassessmentdata->convert_to_grade=="yes")) checked @endif> Convert to Grade</span><br/>
                <span><input type="checkbox" name="subject_{{$examtypeid}}_{{$subjectid}}_sum_in_total" value="yes" @if(isset($examconfigassessmentdata->sum_in_total)&&($examconfigassessmentdata->sum_in_total=="yes")) checked @endif> Sum in Total</span>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
