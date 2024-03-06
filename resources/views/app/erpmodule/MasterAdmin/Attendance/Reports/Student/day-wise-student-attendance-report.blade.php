@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item active"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">Attendance</li>
            <li class="breadcrumb-item" aria-current="page">Reports</li>
            <li class="breadcrumb-item" aria-current="page">Day Wise Student Attendance Report</li>
        </ol>
    </nav>
    <div class="col-lg-12 p-0 m-0">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i> Day Wise Student Attendance Report</b></div>
            <div class="panel-body pd-b-0 row">
                <form class="container-fluid" action="{{url('MasterAdmin/Attendance/DayWiseStudentAttendanceReport')}}" method="POST">
                 {{csrf_field()}}
                <div class="col-lg-12 pd-b-10 row m-0">
                    <div class="col-lg-2">
                        <label>Class/Course :</label>
                        @include('components.course-import',['selectid'=>request()->get('course_id'),'required'=>'required'])
                    </div>
                    <div class="col-lg-2">
                        <label>Section :</label>
                        @include('components.section-import',['selectid'=>request()->get('section_id'),'required'=>'required'])
                    </div>
                    <div class="col-lg-2">
                        <label>Admission No. :</label>
                        <input type="text" class="form-control" name="admission_no" value="{{request()->get('admission_no')}}" placeholder="Enter Admission No.">
                    </div>
                    <div class="col-lg-2">
                        <label>From Date :</label>
                        <input type="text" class="form-control date" autocomplete="off" name="form_date" value="{{nowdate(request()->get('form_date'),'d-m-Y')}}" placeholder="dd-mm-yyyy">
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

                @if(request()->get('_token'))
                <div class="col-lg-12 bd-t bd-1">
                    <div class="col-lg-12 bd-t bd-1 pd-t-10 pd-l-0 pd-r-0"><span class="float-right">@include('layouts.actionbutton.action-button-verticle')</span></div>
                    <div class="clearfix"></div>
                    <table class="table datatable table-bordered mg-t-10 mg-b-10">
                        <thead class="bg-light">
                        <tr>
                         <th colspan="12">
                             @php
                                     $fromdate=nowdate(request()->get('form_date'),'Y-m-d');
                                     $todate=nowdate(request()->get('to_date'),'Y-m-d');
                                     $search=[];
                                     if(request()->get('course_id')){
                                     $search=array_merge($search,['course_id'=>request()->get('course_id')]);
                                     }
                                     if(request()->get('section_id')){
                                     $search=array_merge($search,['section_id'=>request()->get('section_id')]);
                                     }
                                     $attendancedays = studenttotalattendancedays($search , ['whereBetween' => [ 'attendance_date' => [$fromdate,$todate]]])

                             @endphp
                             <span><b>Total Attendance : @if(isset($attendancedays->totalattendance)) {{$attendancedays->totalattendance}} @else {{'0'}} @endif</b></span>
                             <span class="pd-l-10">|</span><span class="pd-l-10"><b>Total Holiday : 0</b></span>
                             <span class="pd-l-10">|</span><span class="pd-l-10"><b>Date Range : {{nowdate(request()->get('form_date'),'d-M-Y')}} ~ {{nowdate(request()->get('to_date'),'d-M-Y')}}</b></span></th>
                        </tr>
                        <tr>
                        <th>S.No.</th>
                        <th>Admission No.</th>
                        <th>Roll No.</th>
                        <th>Class/Course</th>
                        <th>Student Name</th>
                        <th>Father Name</th>
                        <th>Contact No.</th>
                        <th class="text-center">Present</th>
                        <th class="text-center">Absent</th>
                        <th class="text-center">Leave</th>
                        <th class="text-center">Late</th>
                        <th class="text-center">Overall (%)</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $total=['totalpresent'=>0,'totalabsent'=>0,'totalleave'=>0,'totallate'=>0]; @endphp
                        @foreach($student as $data)
                          @php
                              $fromdate=nowdate(request()->get('form_date'),'Y-m-d');
                              $todate=nowdate(request()->get('to_date'),'Y-m-d');
                              $studentattendance=studentattendanceresult(['student_id'=>$data->student_id],[ 'whereBetween' => [ 'attendance_date' => [$fromdate,$todate] ]]);
                              if(isset($studentattendance->totalpresent)){ $total['totalpresent'] +=$studentattendance->totalpresent;}
                              if(isset($studentattendance->totalabsent)){ $total['totalabsent'] +=$studentattendance->totalabsent;}
                              if(isset($studentattendance->totalleave)){ $total['totalleave'] +=$studentattendance->totalleave;}
                              if(isset($studentattendance->totallate)){ $total['totallate'] +=$studentattendance->totallate;}
/*
                                * Overall Percantage
                                */
                                $overall=0;
                                if(isset($attendancedays->totalattendance)&&($attendancedays->totalattendance>0)&&(isset($studentattendance->totalpresent))&&($studentattendance->totalpresent>0)){
                                $overall=($studentattendance->totalpresent*100)/$attendancedays->totalattendance;
                                }
                          @endphp
                        <tr>
                            <td class="text-center"><b>{{$loop->iteration}}</b></td>
                            <td class="text-center">{{$data->admission_no}}</td>
                            <td class="text-center">{{$data->roll_no}}</td>
                            <td>{{$data->CourseSection()}}</td>
                            <td>{{$data->fullName()}}</td>
                            <td>{{$data->FatherName()}}</td>
                            <td>{{$data->student->contact_no}}</td>
                            <td class="text-center">@if(isset($studentattendance->totalpresent)) {{$studentattendance->totalpresent}} @else {{'0'}} @endif</td>
                            <td class="text-center">@if(isset($studentattendance->totalabsent)) {{$studentattendance->totalabsent}} @else {{'0'}} @endif</td>
                            <td class="text-center">@if(isset($studentattendance->totalleave)) {{$studentattendance->totalleave}} @else {{'0'}} @endif</td>
                            <td class="text-center"><b>@if(isset($studentattendance->totallate)) {{$studentattendance->totallate}} @else {{'0'}} @endif</b></td>
                            <td class="text-center bg-success-light"><b>@if(isset($overall)){{numberformat($overall,2)}}@else{{'0'}}@endif%</b></td>
                        </tr>
                        @endforeach
                        </tbody>
                        <tfoot class="bg-success-light">
                        <tr>
                            <td colspan="7" class="text-right"><b>Total :</b></td>
                            <td class="text-center"><b>{{$total['totalpresent']}}</b></td>
                            <td class="text-center"><b>{{$total['totalabsent']}}</b></td>
                            <td class="text-center"><b>{{$total['totalleave']}}</b></td>
                            <td class="text-center"><b>{{$total['totallate']}}</b></td>
                            <td class="bg-success-light"></td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
                @endif
            </div>
        </div>
    </div>

@endsection
