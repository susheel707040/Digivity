@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item active"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">Attendance</li>
            <li class="breadcrumb-item" aria-current="page">Reports</li>
            <li class="breadcrumb-item" aria-current="page">Student Attendance MIS Report</li>
        </ol>
    </nav>

    <div class="col-lg-12 p-0 m-0">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i> Student Attendance MIS Report</b></div>
            <div class="panel-body pd-b-0 row">
                <form class="container-fluid" action="{{url('MasterAdmin/Attendance/StudentAttendanceMisReport')}}" method="POST">
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
                            <input type="text" autocomplete="off" class="form-control" name="admission_no" value="{{request()->get('admission_no')}}" placeholder="Enter Admission No.">
                        </div>
                        <div class="col-lg-2">
                            <label>Date :</label>
                            <input type="text" class="form-control date" autocomplete="off" name="month_date" value="{{nowdate(request()->get('month_date'),'d-m-Y')}}" placeholder="dd-mm-yyyy">
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
                            $month = '2015-01';
                            $start = \Carbon\Carbon::parse(nowdate(request()->get('month_date'),'Y-m'))->startOfMonth();
                            $end = \Carbon\Carbon::parse(nowdate(request()->get('month_date'),'Y-m'))->endOfMonth();
                            $fromdate=$start->format('Y-m-d');
                            $todate=$end->format('Y-m-d');

                            $dates = [];
                            while ($start->lte($end)) {
                            $dates[] = $start->copy();
                            $start->addDay();
                            }

                            $search=[];
                            if(request()->get('course_id')){
                            $search=array_merge($search,['course_id'=>request()->get('course_id')]);
                            }
                            if(request()->get('section_id')){
                            $search=array_merge($search,['section_id'=>request()->get('section_id')]);
                            }
                            /*
                             * get total attendance days
                             */
                            $attendancerecord = studenttotalattendancedays($search , ['whereBetween' => [ 'attendance_date' => [$fromdate,$todate] ]]);
                        @endphp
                        <table class="table datatable table-bordered mg-t-10 mg-b-10">
                            <thead class="bg-light">
                            <tr>
                                <th colspan="{{count($dates)+6}}"><span><b>Month : {{nowdate(request()->get('month_date'),'F-Y')}}</b></span>
                                <span class="pd-l-10">|</span><span class="pd-l-10">Total Attendance : @if(isset($attendancerecord->totalattendance)) {{$attendancerecord->totalattendance}} @else {{'0'}} @endif</span>
                                </th>
                            </tr>
                            <tr>
                                <th class="text-center">Sl.No.</th>
                                <th>Admission No.</th>
                                <th>Class/Course</th>
                                <th>Student</th>
                                <th>Father Name</th>
                                @foreach($dates as $date)
                                <th class="text-center">{{$date->format('d')}}</th>
                                @endforeach
                                <th class="bg-success-light text-center">%</th>
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
                                    @php $st_prsnt_dys=0; @endphp
                                    @foreach($dates as $date)
                                      @php
                                       $studentattendance=studentattendanceresult(['student_id'=>$data->student_id,'attendance_date'=>$date->format('Y-m-d')]);
                                      @endphp
                                    <td class="text-center">
                                        @if(attendanceholiday($date->format('Y-m-d'),'student'))
                                            <span class="badge badge-info tx-9">{{attendanceholiday($date->format('Y-m-d'),'student')}}</span>
                                        @elseif(isset($studentattendance->totalpresent)&&($studentattendance->totalpresent>0))
                                            @php $st_prsnt_dys+=1; @endphp
                                        <span class="badge-success badge">P</span>
                                        @elseif(isset($studentattendance->totalabsent)&&($studentattendance->totalabsent>0))
                                        <span class="badge-danger badge">AB</span>
                                        @elseif(isset($studentattendance->totalleave)&&($studentattendance->totalleave>0))
                                            <span class="badge-warning badge">LV</span>
                                        @elseif(isset($studentattendance->totallate)&&($studentattendance->totallate>0))
                                            <span class="badge-dark badge">LT</span>
                                        @endif
                                    </td>
                                    @endforeach
                                    <td class="bg-success-light text-center">
                                        @php
                                        if(isset($percantage)) {
                                            if($percantage) {
                                                echo numberformat($percantage);
                                            } else {
                                                echo '0.00';
                                            }
                                        } else {
                                            echo 'N/A'; // Display a default value when $percantage is not defined
                                        }
                                        @endphp
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    @endif
            </div>
        </div>
    </div>

@endsection
