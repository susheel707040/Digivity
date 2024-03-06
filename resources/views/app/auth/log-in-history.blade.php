@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="{{url('/home')}}">Dashboard</a></li>
            <li class="breadcrumb-item " aria-current="page">User</li>
            <li class="breadcrumb-item active" aria-current="page">User Activity Logs</li>
        </ol>
    </nav>

    <div class="col-lg-10 mx-auto p-0 m-0">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-edit"></i> User Activity Logs</b></div>
            <div class="panel-body pd-b-0 row">
                <div class="col-lg-12">
                    <div class="col-lg-12 m-0 p-0 text-right">@include('layouts.actionbutton.action-button-verticle')</div>
                    <table id="example2" class="table-bordered datatable table mg-t-10">
                        <thead class="bg-light">
                        <tr>
                            <th class="text-center">Sl.No</th>
                            <th>User</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th class="text-center">Date</th>
                            <th class="text-center">Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($loginhistory as $data)
                        <tr>
                            <td class="text-center">{{$loop->iteration}}</td>
                            <td>{{$data->user->username}}</td>
                            <td>{{$data->user->fullName()}}</td>
                            <td class="wd-35p"></td>
                            <td class="text-center">{{nowdate($data->created_at,'d-M-Y h:i:sA')}}</td>
                            <td class="text-center tx-13">
                                @if($data->activity_status=="logout")
                                    <span class="badge badge-danger">Logout</span>
                                @elseif($data->activity_status=="login")
                                    <span class="badge badge-success">Login</span>
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
