@extends('layouts.MasterLayout')
@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-style1 mg-b-10">
        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        <li class="breadcrumb-item" aria-current="page">User</li>
        <li class="breadcrumb-item active" aria-current="page">Add Role</li>
    </ol>
</nav>

<div class="col-lg-12 p-0 m-0 mx-auto">
    <div class="panel panel-default">
        <div class="panel-heading"><b><i class="fa fa-sitemap"></i> Add Role</b></div>
        <div class="panel-body pd-b-0 row">
            <form class="container-fluid" action="{{url('MasterAdmin/User/StoreRole')}}" method="POST">
                {{csrf_field()}}
            <div class="col-lg-12 row pd-l-0 pd-r-0 pd-t-10 pd-b-10 m-0">
                <div class="col-lg-2">
                    <label>Role Name :</label>
                    <input type="text" name="name"  placeholder="Enter Role Name" class="form-control">
                </div>
                <div class="col-lg-2">
                    <button class="btn btn-primary mg-t-20">Submit <i class="fa fa-arrow-right"></i></button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection
