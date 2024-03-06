@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">Global Setting</li>
            <li class="breadcrumb-item active" aria-current="page">ID Card Setting</li>
        </ol>
    </nav>

    <form action="{{url('MasterAdmin/GlobalSetting/StoreIDCardTemplate')}}" method="POST" enctype="multipart/form-data"
          data-parsley-validate="" novalidate="">
        {{csrf_field()}}
        <div class="col-lg-12 p-0 m-0">
            <div class="panel panel-default">
                <div class="panel-heading"><b><i class="fa fa-cog"></i> ID Card Template Setting</b></div>
                <div class="panel-body pd-b-10 pd-t-10 m-0 row">
                    <div class="card col-lg-12 mg-b-10 mx-auto p-0 ">
                        <div class="card-header bg-gray-100"><i class="fa fa-cog"></i> <b>Report Setting</b>
                        </div>
                        <div class="card-bod  pd-b-10 row pd-l-5 pd-t-5 tx-13 m-0 flex-fill">

                        </div>
                    </div>
                </div>
                </div>
            </div>
    </form>
@endsection
