@extends('layouts.MasterLayout')

@section('ModelTitle','Add New Visitor')
@section('ModelTitleInfo','Manage New Visitor')
@section('EditModelTitle','Edit Visitor')
@section('EditModelTitleInfo','Modify Visitor')
@section('ModelSize','modal-xxl')

@section('AddModelPage')
    @include('app.erpmodule.MasterAdmin.FrontOffice.Visitor.Add.add-visitor')
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">Front Office</li>
            <li class="breadcrumb-item active" aria-current="page">Define Visitor</li>
        </ol>
    </nav>

    <div class="col-lg-12 p-0 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i> Visitor List</b></div>
            <div class="panel-body pd-b-5 row m-0">
                <div class="col-lg-12"></div>
                <div class="col-lg-12 p-0 pd-t-10 pd-l-5">

                    <div class="col-lg-12 pd-t-0 pd-l-5 text-right">
                        <button type="button" href="#addModels" data-toggle="modal" class="btn btn-primary float-left btn-lg"><i class="fa fa-plus"></i> Add New Visitor</button>
                        @include('layouts.actionbutton.action-button-verticle',['sms'=>1])
                    </div><br/>

                    <div class="col-lg-12 p-0 pd-t-0 pd-l-5">
                        <table id="example2" class="table table-bordered tx-11 mg-t-10">
                            <thead class="bg-light">
                            <tr>
                                <th class="text-center">S.No.</th>
                                <th>Visitor No.</th>
                                <th>Purpose</th>
                                <th>Enquiry Date</th>
                                <th>Reminder Date</th>
                                <th>Follow Up Date</th>
                                <th>Applicant Name</th>
                                <th>Contact No.</th>
                                <th>Enquiry Observation</th>
                                <th>Enquiry Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
