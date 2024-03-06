@extends('layouts.MasterLayout')
@section('content')
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#">Transport</a></li>
                <li class="breadcrumb-item active" aria-current="page">Student Transport Report</li>
            </ol>
        </nav>
    <div class="col-lg-12 p-0 m-0">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i> Student Transport List</b></div>
            <div class="panel-body p-0 m-0 row">
                <form action="" method="POST">
                {{csrf_field()}}
                <div class="col-lg-12 tx-12 row m-0 pd-b-15">
                <div class="col-lg-2 pd-l-0 pd-r-10 ">
                    <label>Course/Class :</label><br>
                    @include('components.course-import',['selectid'=>request()->get('course_id')])
                </div>

                <div class="col-lg-2 pd-l-0 pd-r-0 ">
                    <label>Section :</label><br>
                    @include('components.section-import',['selectid'=>request()->get('section_id')])
                </div>

                <div class="col-lg-2 pd-l-10 pd-r-10 ">
                    <label>Route :</label><br>
                    @include('components.Transport.route-import',['selectid'=>request()->get('route_id')])
                </div>

                <div class="col-lg-2 pd-l-0 pd-r-10 ">
                    <label>Route Stop :</label><br>
                    @include('components.Transport.route-stop-import',['selectid'=>request()->get('route_stop_id')])
                </div>
                <div class="col-lg-2 pd-l-0 pd-r-0 ">
                    <label>Vehicle :</label><br>
                    @include('components.Transport.vehicle-import',['selectid'=>request()->get('vehicle_id')])
                </div>
                <div class="col-lg-2 pd-l-10 pd-r-10 ">
                    <label>Driver :</label><br>
                    @include('components.Transport.driver-import',['selectid'=>request()->get('driver_id')])
                </div>
                <div class="col-lg-2 pd-l-0 pd-r-0 ">
                    <label>Transport Status :</label><br>
                    @include('components.Transport.transport-status-import',['selectid'=>request()->get('transport_status')])
                </div>
                <div class="col-lg-2 pd-l-5 pd-r-10 ">
                    <label>With Student Photo :</label>
                    <table>
                        <tr>
                            <td><input type="radio" name="with_photo" value="yes"></td><td class="pd-l-5">Yes</td>
                            <td class="pd-l-10"><input type="radio" name="with_photo" value="no" checked></td><td class="pd-l-5">No</td>
                        </tr>
                    </table>
                </div>
                <div class="col-lg-2 pd-l-0 pd-r-10 ">
                    <button type="submit" class="btn btn-primary mg-t-20"><i class="fa fa-search"></i> Get Result</button>
                </div>
                </div>
                </form>

                <div class="col-lg-12 bd-1 bd-t row m-0">
                    <div class="col-lg-12 pd-r-0"><span class="float-right">@include('layouts.actionbutton.action-button-verticle',['sms'=>1])</span></div>

                    <table id="example2" class="table table-bordered datatable mg-t-10 tx-11">
                        <thead class="bg-light">
                        <tr>
                            <th class="text-center col-hide"><input type="checkbox" class="CheckAll" value="checkbox1"></th>
                            <th class="text-center">Adm. No.</th>
                            <th class="text-left">Course/Class - Section</th>
                            <th>Student</th>
                            <th>Father</th>
                            <th>Contact No.</th>
                            <th class="text-center">Joining Date</th>
                            <th>Route</th>
                            <th>Route Stop</th>
                            <th>Vehicle</th>
                            <th>Driver</th>
                            <th class="text-center">Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($student as $data)
                            <tr>
                                <td class="text-center col-hide"><input type="checkbox" class="checkbox1"></td>
                                <td class="text-center">{{$data->admission_no}}</td>
                                <td class="text-left">{{$data->CourseSection()}}</td>
                                <td>{{$data->fullName()}}</td>
                                <td>{{$data->FatherName()}}</td>
                                <td>{!! \App\Helper\MobileNumberValidate::validate($data->student->contact_no) !!}</td>
                                <td class="text-center">@if(isset($data->transport_start_date)){{nowdate($data->transport_start_date,'d-M-Y')}}@endif</td>
                                <td>@if(isset($data->transport)){{$data->transport->RouteName()}}@endif</td>
                                <td>@if(isset($data->transport)){{$data->transport->RouteStopName()}}@endif</td>
                                <td>@if(isset($data->transport)){{$data->transport->VehicleName()}}@endif</td>
                                <td>@if(isset($data->transport)){{$data->transport->DriverName()}}@endif</td>
                                <td class="text-center">
                                    @if(($data->transport_id)&&$data->transport_status=="active")
                                        <span class="badge badge-success">Active</span>
                                    @elseif(($data->transport_id)&&$data->transport_status=="inactive")
                                        <span class="badge badge-danger">Deactive</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

@endsection
