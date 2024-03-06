<tr>
    <td>@include('component.MarksManager.exam-subject-skill-group-import',['name'=>'skill_group_'.$subjectid.'_id[]'])</td>
    <td>@include('component.MarksManager.subject-skill-import',['name'=>'skill_'.$subjectid.'_id[]'])</td>
    <td>@include('component.position-import',['name'=>'position_'.$subjectid.'_id[]'])</td>
    <td class="wd-20p">@include('component.MarksManager.marking-type-import',['name'=>'marking_type_'.$subjectid.'_id[]'])</td>
    <td class="text-center"><button type="button" class="btn btn-danger remove-subject-skill-row btn-xs rounded-5"><i class="fa fa-trash"></i></button></td>
</tr>
