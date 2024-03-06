@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Fee Entry</li>
            <li class="breadcrumb-item active" aria-current="page">Bank Fee Deposit Entry </li>
        </ol>
    </nav>

    <div class="col-lg-12 p-0 m-0 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-plus"></i> Bank Fee Deposit Entry</b></div>
            <div class="panel-body pd-b-0 row">
                <div class="col-lg-12 search-section  pd-10 m-0 row">
                    <div class="col-lg-2">
                        <label><b>Fee Entry Date :</b></label>
                        <input type="text" class="form-control input-sm" placeholder="dd-mm-yyyy">
                    </div>
                    <div class="col-lg-3">
                        <label><b>Import File Bank Deposit Fee :</b></label>
                        <input type="file" class="form-control input-sm">
                    </div>
                    <div class="col-lg-2">
                        <button type="submit" class="btn mg-t-20 btn-primary">Continue <i class="fa fa-angle-right"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
