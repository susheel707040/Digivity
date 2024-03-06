@extends('layouts.api-web-view-master-layout')
@section('content')
    @if($request->course_id)
    @php
        $course=explode("@",$request->course_id);
        $total=studenttotalattendancedays(['course_id'=>$course[0],'section_id'=>$course[1]],[ 'whereBetween' => [ 'attendance_date' => [nowdate($from_date,'Y-m-d'),nowdate($to_date,'Y-m-d')]]]);
    @endphp
    <div class='col-12 p-2 tx-13'>
        <table cellpadding='0' cellspacing='0' class='table table-bordered bg-light-dark'>
            <tbody>
            <tr>
                <td colspan="2"><b>Result :</b> {{$from_date}} <b>~</b> {{$to_date}}</td>
            </tr>
            <tr>
                <td><b>Class/Course : <span class="badge badge-primary tx-12"></span></b></td>
                <td><b>Total Working Day :</b> <span class="badge badge-success tx-12">@if(isset($total->totalattendance)){{$total->totalattendance}}@else{{'0'}}@endif</span></td>
            </tr>
            </tbody>
        </table>
    </div>

    <div class='col-12 p-2'>
        <table class="table table-bordered">
            <thead class="bg-light">
            <tr>
                <th>Student Details</th>
                <th class="text-center">PR.</th>
                <th class="text-center">AB.</th>
                <th class="text-center">LT.</th>
                <th class="text-center">LV.</th>
                <th class="text-center">(%)</th>
            </tr>
            </thead>
            <tbody>
            @foreach($student as $data)
                @php
                    $totalpercantage=0;
                    $attendance=studentattendanceresult(['student_id'=>$data->student_id],[ 'whereBetween' => [ 'attendance_date' => [nowdate($from_date,'Y-m-d'),nowdate($to_date,'Y-m-d')],'groupBy'=>'attendance_date' ]]);
                    if(isset($total->totalattendance)&&($total->totalattendance)&&(isset($attendance->totalpresent)&&($attendance->totalpresent))){
                        $totalpercantage=(($attendance->totalpresent*100)/$total->totalattendance);
                    }
                @endphp
                <tr>
                    <td>
                        <span class="tx-11 text-black-light"><b>Adm. No. :</b> {{$data->admission_no}} | <b>Roll No. :</b> {{$data->roll_no}}</span><br/>
                        <span class="tx-13"><b>{{$data->fullName()}}</b> <span class="tx-11"><b>({{$data->CourseSection()}})</b></span></span><br/>
                        <span class="tx-12">@if($data->student->gender=="male") <b>S/O</b> @elseif($data->student->gender=="female") <b>D/O</b> @endif{{$data->FatherName()}}  <span class="tx-11"><b>({{$data->student->contact_no}})</b></span></span>
                    </td>
                    <td class="text-center tx-13 align-middle"><span class="badge badge-success">@if($attendance->totalpresent){{$attendance->totalpresent}}@else{{'0'}}@endif</span></td>
                    <td class="text-center tx-13 align-middle"><span class="badge badge-danger">@if($attendance->totalabsent){{$attendance->totalabsent}}@else{{'0'}}@endif</span></td>
                    <td class="text-center tx-13 align-middle"><span class="badge badge-warning">@if($attendance->totalleave){{$attendance->totalleave}}@else{{'0'}}@endif</span></td>
                    <td class="text-center tx-13 align-middle"><span class="badge badge-dark">@if($attendance->totallate){{$attendance->totallate}}@else{{'0'}}@endif</span></td>
                    <td class="text-center tx-13 align-middle"><span class="badge badge-primary">{{numberformat($totalpercantage)}}%</span></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @else
        <h6 class="m-3 text-center text-danger">Please select course/class</h6>
@endif

@endsection
