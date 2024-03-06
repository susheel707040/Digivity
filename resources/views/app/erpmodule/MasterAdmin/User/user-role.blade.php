@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">User</li>
            <li class="breadcrumb-item active" aria-current="page">User Role</li>
        </ol>
    </nav>


    <div class="col-lg-8 p-0 m-0 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-sitemap"></i> User Role</b></div>
            <div class="panel-body pd-b-0 row">
                <form class="container-fluid" action="{{url('MasterAdmin/User/StoreUserRole')}}" method="POST">
                    {{csrf_field()}}
                <div class="col-lg-12 row pd-l-10 pd-r-10 pd-t-10 pd-b-10 m-0">
                    <table class="table table-bordered">
                        <thead class="bg-light">
                        <tr>
                            <th class="text-center">Sl.No.</th>
                            <th class="text-center"><input type="checkbox" class="CheckAll" value="checkbox1"></th>
                            <th>Username</th>
                            <th>Name</th>
                            <th>Role</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($user as $data)
                        <tr>
                            <td class="text-center">{{$loop->iteration}}</td>
                            <td class="text-center"><input type="checkbox" name="user_id[]" class="checkbox1" value="{{$data->id}}"></td>
                            <td>{{$data->username}}</td>
                            <td>{{$data->fullName()}}</td>
                            <td>
                                @include('components.role-import',['class'=>'form-control','name'=>'role_id_'.$data->id.'','selectid'=>$data->role_id])
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-lg-12 pd-b-20 pd-l-10 pd-r-10">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> Update</button>
                </div>
                </form>
            </div>
        </div>
    </div>

@endsection
