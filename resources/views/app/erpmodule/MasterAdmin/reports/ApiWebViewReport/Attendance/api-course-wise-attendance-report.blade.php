@extends('layouts.api-web-view-master-layout')
@section('content')
    <div class='col-12 p-2 tx-13'>
        <table cellpadding='0' cellspacing='0' class='table table-bordered bg-light-dark'>
            <tbody>
            <tr>
                <td colspan="2"><b>Date :</b> {{$from_date}} <b>~</b> {{$to_date}}</td>
            </tr>
            <tr>
                <td><b>Class/Course : <span class="badge badge-primary tx-12"></span></b></td>
            </tr>
            </tbody>
        </table>
    </div>

    <div class='col-12 p-2'>
        <table class="table table-bordered">
            <thead class="bg-light">
            <tr>
                <th class="text-center">#</th>
                <th>Class/Course</th>
                <th>Section</th>
                <th class="text-center">T. Stu.</th>
                <th class="text-center">PR.</th>
                <th class="text-center">AB.</th>
                <th class="text-center">LT.</th>
                <th class="text-center">LV.</th>
                <th class="text-center">(%)</th>
            </tr>
            </thead>
            <tbody>
            @php
                $row=1;
                $total=['student'=>0,'present'=>0,'absent'=>0,'leave'=>0,'late'=>0]
            @endphp
            @foreach($course as $data)
                @foreach($data->sections as $data1)
                @php
                        $studentstrength = studentstrength(['course_id'=>$data->id,'section_id'=>$data1->id,'status'=>'active']);
                        $attendance=studentattendanceresult(['course_id'=>$data->id,'section_id'=>$data1->id],[ 'whereBetween' => [ 'attendance_date' => [nowdate($from_date,'Y-m-d'),nowdate($to_date,'Y-m-d')],'groupBy'=>'attendance_date' ]]);
                        $totalpercantage=0;
                        if((isset($attendance->totalpresent)&&($attendance->totalpresent))){
                            $totalpercantage=(($attendance->totalpresent*100)/$studentstrength);
                        }
                        $total['student'] +=$studentstrength;
                        $total['present'] +=$attendance->totalpresent;
                        $total['absent'] +=$attendance->totalabsent;
                        $total['leave'] +=$attendance->totalleave;
                        $total['late'] +=$attendance->totallate;

                @endphp
            <tr @if($totalpercantage==0)style="background-color:#F2D7D5; "@endif>
                <td class="text-center">{{$row++}}</td>
                <td><b>{{$data->course}}</b></td>
                <td class="text-center"><b>{{$data1->section}}</b></td>
                <td class="text-center">{{$studentstrength}}</td>

                @if($totalpercantage==0)
                    <td colspan="5" class="text-center"><span class="badge-danger badge">No Mark Attendance</span></td>
                @else
                <td class="text-center"><span class="badge badge-success">{{$attendance->totalpresent}}</span></td>
                <td class="text-center"><span class="badge badge-danger">{{$attendance->totalabsent}}</span></td>
                <td class="text-center"><span class="badge badge-warning">{{$attendance->totalleave}}</span></td>
                <td class="text-center"><span class="badge badge-dark">{{$attendance->totallate}}</span></td>
                <td class="text-center"><span class="badge badge-info">{{numberformat($totalpercantage)}}%</span></td>
                @endif
            </tr>
                @endforeach
            @endforeach
            </tbody>
            <tfoot class="bg-success-light">
            <tr>
                <td colspan="3" class="text-right pd-r-20"><b>Total :</b></td>
                @foreach($total as $totaldata)
                <td class="text-center"><b>{{$totaldata}}</b></td>
                @endforeach
                @php
                    $totalpercantage=0;
                    if(isset($total['student'])&&($total['student'])&&(isset($total['present']))&&($total['present'])){
                     $totalpercantage=(($total['present']*100)/$total['student']);
                     }
                @endphp
                <td>{{numberformat($totalpercantage)}}%</td>
            </tr>
            </tfoot>
        </table>
    </div>

@endsection