@php
$grade=unserialize($examgradedata->grade_input);
@endphp
<table class="table table-bordered">
<thead class="bg-light">
<tr>
    <th class="wd-20p">Marks Range in (%) </th>
    @if(isset($grade['grade_name']))
        @foreach($grade['grade_name'] as $key=>$value)
            <th class="text-center">{{$grade['grade_from'][$key]}} - {{$grade['grade_to'][$key]}}</th>
        @endforeach
    @endif
</tr>
</thead>
<tbody>
<tr>
    <td><b>Grade</b></td>
    @if(isset($grade['grade_name']))
    @foreach($grade['grade_name'] as $key=>$value)
    <th class="text-center">{{$value}}</th>
    @endforeach
    @endif
</tr>
</tbody>
</table>
