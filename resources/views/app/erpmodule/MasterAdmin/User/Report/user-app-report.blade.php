@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">User</li>
            <li class="breadcrumb-item active" aria-current="page">App User Report</li>
        </ol>
    </nav>

    <div class="col-lg-12 p-0 m-0 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i> App User Report</b></div>
            <div class="panel-body pd-b-0 row">
                <div class="col-lg-12">

                </div>
                <div class="col-lg-12 text-right">
                    @include('layouts.actionbutton.action-button-verticle',['sms'=>1])
                </div>
                <div class="col-lg-12 bd-1 bd-t">
                    <table class="table datatable table-bordered mg-t-10">
                        <thead class="bg-light">
                        <tr>
                            <th class="text-center">Sl.No.</th>
                            <td class="text-center col-hide"><input type="checkbox"></td>
                            <th>Admission No.</th>
                            <th>Class/Course</th>
                            <th>Student Name</th>
                            <th>Father Name</th>
                            <th>Contact No.</th>
                            <th class="text-center">Last Login at</th>
                            <th class="text-center">Last Active</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $activeuser=0; @endphp
                        @foreach($student as $data)
                        <tr>
                            <td class="text-center">{{$loop->iteration}}</td>
                            <td class="text-center col-hide"><input type="checkbox"></td>
                            <td>{{$data->admission_no}}</td>
                            <td>{{$data->CourseSection()}}</td>
                            <td>{{$data->fullName()}}</td>
                            <td>{{$data->FatherName()}}</td>
                            <td>{{$data->student->contact_no}}</td>
                            <td class="text-center"><span class="badge badge-success">@if(isset($data->user)&&($data->user->LastLoginAt('login',0))){{$data->user->LastLoginAt('login',0)}}@endif</span></td>
                            <td class="text-center"><span class="badge badge-success">@if(isset($data->user)&&($data->user->LastLoginAt('dashboard',0))) @php $activeuser +=1; @endphp {{$data->user->LastLoginAt('dashboard',0)}}@endif</span></td>
                            <td><a class="text-primary">View Logs</a></td>
                        </tr>
                        @endforeach
                        </tbody>
                        <tfoot class="bg-light">
                        <tr>
                            <td colspan="10" class="tx-14">
                                <span class="badge badge-primary pd-l-10 pd-l-10 pd-r-10"><b>Total Student :</b> {{count($student)}}</span>
                                <span class="badge badge-success pd-l-10 pd-l-10 pd-r-10"><b>Total Active : </b> {{$activeuser}}</span>
                                <span class="badge badge-danger pd-l-10 pd-r-10"><b>Total Isolated : </b> 0</span>
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
