@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Student Information</li>
            <li class="breadcrumb-item active" aria-current="page">Reports</li>
            <li class="breadcrumb-item active" aria-current="page">Student Birthday Report</li>
        </ol>
    </nav>

    <div class="col-lg-12 p-0 m-0">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i> Student Birthday Report</b></div>
            <div class="panel-body pd-b-0 row">
                <form class="col-lg-12" action="{{url('MasterAdmin/StudentInformation/StudentBirthdayList')}}" method="POST">
                    {{csrf_field()}}
                    <div class="row pd-b-10 m-0">
                        <div class="col-lg-2 pd-l-0">
                            <label>Class/Course :</label>
                            @include('components.course-import',['selectid'=>request()->get('course_id')])
                        </div>
                        <div class="col-lg-2 pd-l-0">
                            <label>Section :</label>
                            @include('components.section-import',['selectid'=>request()->get('section_id')])
                        </div>
                        <div class="col-lg-2 pd-l-0">
                            <label>Birthday Date :</label>
                            <input type="text" autocomplete="off" name="birth_day_date" class="form-control date" value="{{nowdate(request()->get('birth_day_date'),'d-m-Y')}}">
                        </div>
                        <div class="col-lg-2 pd-l-0">
                            <button type="submit" class="btn btn-primary mg-t-20"><i class="fa fa-search"></i> Get Result</button>
                        </div>
                    </div>
                </form>

                <div class="row col-lg-12 pd-b-10 bd-t bd-1 m-0">
                    @php $sms=1; @endphp
                    <div class="col-lg-12 pd-l-0 pd-r-0"><span class="float-right">@include('layouts.actionbutton.action-button-verticle')</span></div>
                    <div class="col-lg-12 pd-l-0 pd-r-0">
                        <table id="example2" class="table datatable table-bordered mg-t-10">
                            <thead class="bg-light">
                            <tr>
                                <th class="text-center">Sl.No</th>
                                <th class="text-center"><input type="checkbox" class="CheckAll" value="checkbox1"></th>
                                <th class="text-center">Admission No.</th>
                                <th>Class/Course</th>
                                <th>Student Name</th>
                                <th>Father Name</th>
                                <th>Contact No.</th>
                                <th class="text-center">Birthday Date</th>
                                <th class="text-center">Age</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($student as $data)
                                <tr>
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td class="text-center"><input type="checkbox" data-name="{{$data->fullName()}} <b>({{$data->CourseSection()}})</b>" data-contact-no="{!! \App\Helper\MobileNumberValidate::validate($data->student->contact_no) !!}" name="student_id" value="{{$data->student_id}}" class="checkbox1 student_id"></td>
                                    <td class="text-center">{{$data->admission_no}}</td>
                                    <td>{{$data->CourseSection()}}</td>
                                    <td>{{$data->fullName()}}</td>
                                    <td>{{$data->FatherName()}}</td>
                                    <td>{{$data->student->contact_no}}</td>
                                    <td class="text-center">@if($data->dob())<span class="badge tx-15 badge-warning"><i class="fa fa-birthday-cake text-danger"></i>{{nowdate($data->dob(),'d-M-Y')}}</span>@endif</td>
                                    <td class="text-center">
                                        @php
                                            try {
                                            $birthdayyear=\Carbon\Carbon::parse($data->student->dob)->diff(nowdate(request()->get('birth_day_date'),'Y-m-d'))->format('%y');
                                            $birthdayyear=addOrdinalNumberSuffix($birthdayyear);
                                            }catch (\Exception $e){}
                                        @endphp
                                        {{$birthdayyear}} Birthday</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
@php
    // function addOrdinalNumberSuffix($num) {
    //         if (!in_array(($num % 100),array(11,12,13))){
    //           switch ($num % 10) {
    //             // Handle 1st, 2nd, 3rd
    //             case 1:  return $num.'st';
    //             case 2:  return $num.'nd';
    //             case 3:  return $num.'rd';
    //           }
    //         }
    //         return $num.'th';
    //       }
@endphp
@endsection
