@php
$subjectlist=$subjectmapclass->groupBy('subject_id');
$rowid=0;
@endphp
@foreach($subjectlist as $subjectid=>$subjectdata)
@php $rowid++; @endphp
<tr>
    <td>@include('components.MarksManager.exam-subject-import',['name'=>'subject_id[]','class'=>'form-control exam-subject','data'=>'data-rowid='.$rowid.'','id'=>'subject_id_'.$rowid.'','selectid'=>$subjectid])</td>
    <td class="text-center wd-150">@include('components.position-import',['name'=>'position[]','selectid'=>$subjectdata[0]->position])</td>
    <td>
        <table id="subject-skill-table-{{$rowid}}" class="table table-bordered subject-skill-table">
            <thead class="bg-primary-light">
            <tr>
                <th>Subject Skill Group </th>
                <th>Subject Skill</th>
                <th class="text-center">Position</th>
                <th class="text-center">Marking Type</th>
                <th class="text-center">Action</th>
            </tr>
            </thead>
            <tbody class="subject-skill-body-{{$rowid}}">

            @foreach($subjectdata as $subjectskilldata)
                <tr>
                    <td>@include('component.MarksManager.exam-subject-skill-group-import',['name'=>'skill_group_'.$subjectid.'_id[]','selectid'=>$subjectskilldata->skill_group_id])</td>
                    <td>@include('component.MarksManager.subject-skill-import',['name'=>'skill_'.$subjectid.'_id[]','selectid'=>$subjectskilldata->skill_id])</td>
                    <td>@include('component.position-import',['name'=>'position_'.$subjectid.'_id[]','selectid'=>$subjectskilldata->skill_position])</td>
                    <td class="wd-20p">@include('component.MarksManager.marking-type-import',['name'=>'marking_type_'.$subjectid.'_id[]','selectid'=>$subjectskilldata->marking_type])</td>
                    <td class="text-center"><button type="button" class="btn btn-danger remove-subject-skill-row btn-xs rounded-5"><i class="fa fa-trash"></i></button></td>
                </tr>
            @endforeach

            </tbody>
        </table>
        <span onclick="SubjectSkillAdd({{$rowid}})" class="badge subject-skill-add badge-success pd-l-10 pd-t-5 pd-b-5 pd-r-10 cursor-pointer"><u><i class="fa fa-plus"></i> Add New</u></span>
    </td>
    <td class="text-center">
        <div id="subject-applicable-{{$rowid}}" class="text-left">
            <span><input type="radio" class="subject_applicable" name="subject_applicable_{{$subjectid}}" value="1" @if($subjectdata[0]->subject_applicable=="1") checked @endif> All Student</span><br>
            <span><input type="radio" class="subject_applicable" name="subject_applicable_{{$subjectid}}" value="0" @if($subjectdata[0]->subject_applicable=="0") checked @endif> Student Choose</span>
        </div>
    </td>
    <td class="text-center"><button type="button" class="btn btn-danger remove-subject-row btn-xs rounded-5"><i class="fa fa-trash"></i> Remove</button></td>
</tr>
@endforeach


