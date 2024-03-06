@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="{{url('/home')}}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{url('/MasterAdmin/StudentInformation/index')}}">Transport</a></li>
            <li class="breadcrumb-item active" aria-current="page">Student Generate {{$certificate->certificate_name}} </li>
        </ol>
    </nav>
    <div class="col-lg-12 p-0 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-certificate"></i>Student Generate {{$certificate->certificate_name}}</b></div>
            <div class="panel-body pd-b-0 row">

                <div class="col-lg-12 p-0 m-0">

                    @if(isset($certificateintegrateform)&&($certificateintegrateform))
                        @include('erpmodule.MasterAdmin.StudentInformation.Certificate.certificate-integrate-form-fields',[$studentrecord,$certificate])
                    @endif
                </div>

            </div>
        </div>
    </div>
@endsection
