@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item active"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">Attendance</li>
            <li class="breadcrumb-item" aria-current="page">Reports</li>
            <li class="breadcrumb-item" aria-current="page">Student Monthly Mis Attendance Report</li>
        </ol>
    </nav>

    <div class="col-lg-12 p-0 m-0">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i> Student Monthly Mis Attendance Report</b></div>
            <div class="panel-body pd-b-0 row">
                <form class="container-fluid" action="{{url('MasterAdmin/Attendance/StudentMonthlyMisReport')}}" method="POST" >
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
                        @php
                        $monthperiod = \Carbon\CarbonPeriod::create(nowdate(request()->get('form_date'),'Y-m-d'), '1 month',nowdate(request()->get('to_date'),'Y-m-d'));
                        @endphp
                        <table class="table datatable table-bordered mg-t-10 mg-b-10">
                            <thead class="bg-light">
                            <tr>
                                <th class="text-center">S.No.</th>
                                <th>Admission No.</th>
                                <th>Class/Course</th>
                                <th>Student</th>
                                <th>Father Name</th>
                                @php $monthtotal=[]; @endphp
                                @foreach($monthperiod as $monthyear)
                                @php
                                        $fromdate=$monthyear->format("Y-m")."-1";
                                        $todate=$monthyear->format("Y-m")."-31";
                                        $search=[];
                                        if(request()->get('course_id')){
                                            $search=array_merge($search,['course_id'=>request()->get('course_id')]);
                                        }
                                        if(request()->get('section_id')){
                                            $search=array_merge($search,['section_id'=>request()->get('section_id')]);
                                        }
                                        $attendancerecord = studenttotalattendancedays($search , ['whereBetween' => [ 'attendance_date' => [$fromdate,$todate] ]]);
                                if($attendancerecord->totalattendance){
                                    $monthtotal[nowdate($fromdate,'Y-m')]=$attendancerecord->totalattendance;
                                }else{$monthtotal[nowdate($fromdate,'Y-m')]=0;}
                                @endphp
                                <th colspan="2" class="text-center">{{$monthyear->format("M-Y")}}<br/>
                                    <b>Total :@if(isset($attendancerecord->totalattendance)) {{$attendancerecord->totalattendance}} @else {{'0'}} @endif Days</b></th>
                                @endforeach
                                <th class="text-center bg-success-light">Overall (%)</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($student as $data)
                            <tr>
                                <td class="text-center">{{$loop->iteration}}</td>
                                <td>{{$data->admission_no}}</td>
                                <td>{{$data->CourseSection()}}</td>
                                <td>{{$data->fullName()}}</td>
                                <td>{{$data->FatherName()}}</td>
                                @php $stu_total_prsnt=0; @endphp
                                @foreach($monthperiod as $monthyear)
                                 @php
                                         $fromdate=$monthyear->format("Y-m")."-1";
                                         $todate=$monthyear->format("Y-m")."-31";
                                         $studentattendance=studentattendanceresult(['student_id'=>$data->student_id],[ 'whereBetween' => [ 'attendance_date' => [$fromdate,$todate] ]]);
                                 @endphp
                                 <td class="text-center">@if(isset($studentattendance->totalpresent)) @php $stu_total_prsnt +=$studentattendance->totalpresent; @endphp {{$studentattendance->totalpresent}} @else {{'0'}} @endif</td>
                                 @php
                                     $monthpercantage=0; try {$monthpercantage=(($studentattendance->totalpresent*100)/$monthtotal[nowdate($fromdate,'Y-m-d')]);}catch (Exception $e){}
                                 @endphp
                                 <td class="bg-warning-light text-center">{{numberformat($monthpercantage)}}%</td>
                                @endforeach

                                @php
                                $totalpercantage=0;try {$totalpercantage=(($stu_total_prsnt*100)/array_sum($monthtotal));}catch (\Exception $e){}
                                @endphp

                                <td class="text-center bg-success-light">{{$totalpercantage}}%</td>
                            </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
