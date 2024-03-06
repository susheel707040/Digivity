@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Student Information</li>
            <li class="breadcrumb-item active" aria-current="page">Reports</li>
            <li class="breadcrumb-item active" aria-current="page">Class/Course Wise Mis Attendance Report</li>
        </ol>
    </nav>

    <div class="col-lg-12 p-0 m-0">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i> Class/Course Wise Mis Attendance Report</b></div>
            <div class="panel-body pd-b-0 row">
                <form class="container-fluid" action="{{url('MasterAdmin/Attendance/ClassWiseMisReport')}}" method="POST">
                    {{csrf_field()}}
                    <div class="col-lg-12 pd-b-10 row m-0">
                        <div class="col-lg-2">
                            <label>Class/Course :</label>
                            @include('components.course-import',['selectid'=>request()->get('course_id')])
                        </div>
                        <div class="col-lg-2">
                            <label>From Date :</label>
                            <input type="text" class="form-control date" autocomplete="off" name="from_date" value="{{nowdate(request()->get('from_date'),'d-m-Y')}}" placeholder="dd-mm-yyyy">
                        </div>
                        <div class="col-lg-2">
                            <label>To Date :</label>
                            <input type="text" class="form-control date" autocomplete="off" name="to_date" value="{{nowdate(request()->get('to_date'),'d-m-Y')}}" placeholder="dd-mm-yyyy">
                        </div>
                        <div class="col-lg-2">
                            <button type="submit" class="btn btn-primary mg-t-20"><i class="fa fa-search"></i> Get Result</button>
                        </div>
                    </div>
                </form>
                <div class="col-lg-12">
                    <div class="col-lg-12 bd-t bd-1 pd-t-10 pd-l-0 pd-r-0"><span class="float-right">@include('layouts.actionbutton.action-button-verticle')</span></div>
                    <div class="clearfix"></div>
                    <table class="table datatable table-bordered mg-t-10 mg-b-10">
                        <thead class="bg-light">
                        <tr>
                            <th colspan="8">Date Range : {{nowdate(request()->get('from_date'),'d-M-Y')}} ~ {{nowdate(request()->get('to_date'),'d-M-Y')}}</th>
                        </tr>
                        <tr>
                            <th class="text-center">S.No.</th>
                            <th class="text-center">Class/Course - Section</th>
                            <th class="text-center">Total Attendance</th>
                            <th class="text-center">Total Present</th>
                            <th class="text-center">Total Absent</th>
                            <th class="text-center">Total Leave</th>
                            <th class="text-center">Total Late</th>
                            <th class="text-center bg-success-light">Overall(%)</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                        $total=['totalattendance'=>0,'totalpresent'=>0,'totalabsent'=>0,'totalleave'=>0,'totallate'=>0];
                        $row=1;
                        @endphp
                        @foreach($course as $data)
                            @foreach($data->sections as $data1)
                             @php
                                        $fromdate=nowdate(request()->get('from_date'),'Y-m-d');
                                        $todate=nowdate(request()->get('to_date'),'Y-m-d');
                                        $attendancedays = studenttotalattendancedays(['course_id'=>$data->id,'section_id'=>$data1->id] , ['whereBetween' => [ 'attendance_date' => [$fromdate,$todate] ]]);
                                        $studentattendance=studentattendanceresult(['course_id'=>$data->id,'section_id'=>$data1->id],[ 'whereBetween' => [ 'attendance_date' => [$fromdate,$todate] ]]);
                                        if(isset($attendancedays->totalattendance)){$total['totalattendance']+=$attendancedays->totalattendance;}
                                        if(isset($studentattendance->totalpresent)){$total['totalpresent']+=$studentattendance->totalpresent;}
                                        if(isset($studentattendance->totalabsent)){$total['totalabsent']+=$studentattendance->totalabsent;}
                                        if(isset($studentattendance->totalleave)){$total['totalleave']+=$studentattendance->totalleave;}
                                        if(isset($studentattendance->totallate)){$total['totallate']+=$studentattendance->totallate;}
                                        /*
                                         * Overall Percantage
                                         */
                                         $overall=0;
                                        if(isset($attendancedays->totalattendance)&&($attendancedays->totalattendance>0)&&(isset($studentattendance->totalpresent))&&($studentattendance->totalpresent>0)){
                                            $overall=($studentattendance->totalpresent*100)/$attendancedays->totalattendance;
                                        }
                             @endphp
                        <tr>
                            <td class="text-center"><b>{{$row++}}</b></td>
                            <td>{{$data->course}} - {{$data1->section}}</td>
                            <td class="text-center">@if(isset($attendancedays->totalattendance)) {{$attendancedays->totalattendance}} @else {{'0'}} @endif</td>
                            <td class="text-center">@if(isset($studentattendance->totalpresent)){{$studentattendance->totalpresent}}@else{{'0'}}@endif</td>
                            <td class="text-center">@if(isset($studentattendance->totalabsent)){{$studentattendance->totalabsent}}@else{{'0'}}@endif</td>
                            <td class="text-center">@if(isset($studentattendance->totalleave)){{$studentattendance->totalleave}}@else{{'0'}}@endif</td>
                            <td class="text-center">@if(isset($studentattendance->totallate)){{$studentattendance->totallate}}@else{{'0'}}@endif</td>
                            <td class="text-center bg-success-light"><b>@if(isset($overall)){{$overall}}@else{{'0'}}@endif%</b></td>
                        </tr>
                            @endforeach
                        @endforeach
                        </tbody>
                        <tfoot class="bg-success-light tx-bold">
                        <tr>
                            <td colspan="2" class="text-right"><b>Total :</b></td>
                            <td class="text-center">{{$total['totalattendance']}}</td>
                            <td class="text-center">{{$total['totalpresent']}}</td>
                            <td class="text-center">{{$total['totalabsent']}}</td>
                            <td class="text-center">{{$total['totalleave']}}</td>
                            <td class="text-center">{{$total['totallate']}}</td>
                            <td class="bg-success-light"></td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
