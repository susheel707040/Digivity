@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Fee Entry</li>
            <li class="breadcrumb-item active" aria-current="page">Online Fee Receipt Settlement </li>
        </ol>
    </nav>
    <div class="col-lg-12 p-0 m-0 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-globe"></i> Online Fee Settlement</b></div>
            <div class="panel-body pd-b-10 row">
                <div class="col-lg-12 p-2 m-0 row">
                <div class="col-lg-2">
                    <label><b>From Date <sup>*</sup> :</b></label>
                    <input type="text" placeholder="dd-mm-yyyy" value="{{\Carbon\Carbon::createFromDate()->format('d-m-Y')}}" class="form-control date input-sm">
                </div>
                <div class="col-lg-2">
                    <label><b>To Date <sup>*</sup> :</b></label>
                    <input type="text" placeholder="dd-mm-yyyy" value="{{\Carbon\Carbon::createFromDate()->format('d-m-Y')}}" class="form-control date input-sm">
                </div>
                <div class="col-lg-2">
                    <button class="btn mg-t-20 btn-primary">Continue <i class="fa fa-angle-right"></i></button>
                </div>
                </div>
                <div class="col-lg-12 bd-1 bd-t p-2 m-0 row text-center">
                    <h5 class="text-danger mg-t-20 container-fluid">Sorry, Record No Found!</h5>
                </div>
            </div>
        </div>
    </div>
@endsection
