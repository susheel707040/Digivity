<tr>
    <td>@include('components.MarksManager.exam-subject-import',['name'=>'subject_id[]','class'=>'form-control exam-subject','data'=>'data-rowid='.$rowid.'','id'=>'subject_id_'.$rowid.''])</td>
    <td class="text-center wd-150">@include('components.position-import',['name'=>'position[]'])</td>
    <td>
        <table id="subject-skill-table-{{$rowid}}" class="table table-bordered subject-skill-table">
            <thead class="bg-primary-light">
            <tr>
                <th>Subject Skill Group</th>
                <th>Subject Skill</th>
                <th class="text-center">Position</th>
                <th class="text-center">Marking Type</th>
                <th class="text-center">Action</th>
            </tr>
            </thead>
            <tbody class="subject-skill-body-{{$rowid}}"></tbody>
        </table>
        <span onclick="SubjectSkillAdd({{$rowid}})" class="badge subject-skill-add badge-success pd-l-10 pd-t-5 pd-b-5 pd-r-10 cursor-pointer"><u><i class="fa fa-plus"></i> Add jj New</u></span>
    </td>
    <td class="text-center">
        <div id="subject-applicable-{{$rowid}}" class="text-left"><span class="text-danger">No Input</span></div>
    </td>
    <td class="text-center"><button type="button" class="btn btn-danger remove-subject-row btn-xs rounded-5"><i class="fa fa-trash"></i> Remove</button></td>
</tr>
