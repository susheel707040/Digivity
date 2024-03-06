@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Communication</li>
            <li class="breadcrumb-item active" aria-current="page">Student/Staff/User Individual SMS</li>
        </ol>
    </nav>
    <div class="col-lg-12 p-0 m-0 tx-12">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-envelope"></i> Student/Staff/User Individual SMS</b></div>
            <div class="panel-body pd-b-0 row">

                <div class="col-lg-12 pd-5 mg-t-2 d-flex bg-white">
                    <div class="col-lg-4 p-0 m-0 flex-1">

                        <div class="card">
                            <div class="card-header bg-gray-100"><i class="fa fa-user"></i> Select Receiver for SMS
                            </div>
                            <div class="card-body p-0 m-0 pd-10 pd-t-10 pd-b-10 tx-13 m-0 flex-fill">
                                <button class="btn btn-primary mg-5 btn-xs rounded-5"><i class="fa fa-plus"></i> Add Receiver</button>
                                <table class="table tx-11 pd-b-0">
                                    <thead class="bg-gray">
                                    <tr>
                                        <td class="text-center"><b>#</b></td>
                                        <td><b>Group</b></td>
                                        <td><b>Name</b></td>
                                        <td class="text-center"><b>Mobile No.</b></td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>

                            </div>
                        </div>

                        <div class="card mg-t-10">
                            <div class="card-header bg-gray-100"><i class="fa fa-check-square"></i> Select User For
                                Duplicate SMS Copy
                                <span class="float-right"><input type="checkbox" class="CheckAll" value="checkbox3"
                                                                 checked> Select All</span>
                            </div>
                            <div class="card-body p-0 m-0 pd-0 pd-t-10 pd-b-0 tx-13 m-0 flex-fill">
                                <table class="table tx-11 pd-b-0">
                                    <thead class="bg-gray">
                                    <tr>
                                        <td class="text-center"><b>#</b></td>
                                        <td><b>Designation</b></td>
                                        <td><b>Name</b></td>
                                        <td class="text-center"><b>Mobile No.</b></td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach(usersmscopylist() as $data)
                                        <tr>
                                            <td class="text-center"><input class="checkbox3" type="checkbox"></td>
                                            <td class="text-capitalize">{{$data->designation}}</td>
                                            <td class="text-capitalize">{{$data->name}}</td>
                                            <td class="text-capitalize text-center">{{$data->mobile_no}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>

                                </table>
                            </div>
                        </div>

                    </div>

                    <div class="divider-text divider-vertical">and</div>

                    <div class="flex-1">
                        <div class="card mg-t-10 p-0 m-0">
                            <div class="card-header bg-gray-100"><i class="fa fa-envelope"></i> Text Message
                            </div>
                            <div class="card-body m-0 pd-0 pd-t-0 pd-b-10 tx-13 m-0 flex-fill row">
                                @php
                                    $input_check="checked";
                                @endphp
                                @include('app.erpmodule.MasterAdmin.Communication.PagePlugin.sms-page-model')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
