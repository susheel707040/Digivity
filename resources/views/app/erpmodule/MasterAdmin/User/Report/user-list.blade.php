@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">User</li>
            <li class="breadcrumb-item active" aria-current="page">User List</li>
        </ol>
    </nav>
    <div class="col-lg-12 p-0 m-0 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i> User List</b></div>
            <div class="panel-body pd-b-0 row">
                <div class="col-lg-12"></div>
                <div class="col-lg-12 bd-1 bd-t">
                    <div class="col-lg-12 text-right">
                    @include('layouts.actionbutton.action-button-verticle')
                    </div>
                    <table id="example2" class="table datatable table-bordered">
                        <thead class="bg-light">
                        <tr>
                            <th class="text-center col-hide wd-5p">#</th>
                            <th>Role</th>
                            <th>Name</th>
                            <th>Contact No.</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th class="text-center">Password</th>
                            <th class="text-center">2FA Status</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Last Login</th>
                            <th class="col-hide">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($user as $data)
                        <tr>
                            <td class="col-hide text-center">{{$loop->iteration}}</td>
                            <td>@if(isset($data->roles->first()->name)){{$data->roles->first()->name}}@endif</td>
                            <td>{{$data->first_name}} {{$data->last_name}}</td>
                            <td>{{$data->contact_no}}</td>
                            <td>{{$data->email}}</td>
                            <td>{{$data->username}}</td>
                            <td class="text-center">********</td>
                            <td class="text-center">@if($data->two_fa_at=="yes")<span class="badge badge-success">Enable</span>@else<span class="badge badge-danger">Disable</span>@endif</td>
                            <td class="text-center">@if($data->active_at=="yes")<span class="badge badge-success">Active</span>@else<span class="badge badge-danger">In-Active</span>@endif</td>
                            <td class="text-center">10-Feb-2020 10:00:00am</td>
                            <td class="col-hide">
                                <div class="container-fluid col-hide dropdown pd-t-3 pd-b-3 text-right">
                                    <button class="badge container-fluid  tx-12 dropdown-toggle bg-primary border-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <b>Quick Action</b>
                                    </button>
                                    <div class="dropdown-menu tx-12" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0;  transform: translate3d(0px, 25px, 0px);">
                                        <li class="dropdown-item custom-model-btn" url="{{url('MasterAdmin/User/EditUser/'.$data->id.'/edit')}}" model-title="Edit User" model-class="modal-lg" model-title-info="Modify User Information">Edit User</li>
                                        <li class="dropdown-item" url="">2FA Enable</li>
                                        <li class="dropdown-item" url="">User Deactive</li>
                                        <li class="dropdown-item" url="">User Log History</li>
                                        <li class="dropdown-item" url="">User Logout</li>
                                        <li class="dropdown-item" url="">User Mobile App Logout</li>
                                    </div>
                                </div>
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
