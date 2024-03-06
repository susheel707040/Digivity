@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">User</li>
            <li class="breadcrumb-item active" aria-current="page">Role List</li>
        </ol>
    </nav>

    <div class="col-lg-6 p-0 m-0 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i> Role List</b></div>
            <div class="panel-body pd-b-0 row">
                <div class="col-lg-12 text-right">
                    @include('layouts.actionbutton.action-button-verticle')
                </div>
                <div class="col-lg-12">
                    <table class="table datatable table-bordered mg-t-10">
                        <thead>
                        <tr class="bg-light">
                            <th class="text-center">#</th>
                            <th>Role</th>
                            <th class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($role as $data)
                        <tr>
                            <td class="text-center"><b>{{$loop->iteration}}</b></td>
                            <td>{{$data->name}}</td>
                            <td class="text-center"><p class="text-danger m-0 p-0">Not Permission</p></td>
                        </tr>
                        @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
