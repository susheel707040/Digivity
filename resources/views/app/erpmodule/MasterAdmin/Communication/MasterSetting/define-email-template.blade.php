@extends('layouts.MasterLayout')

@section('ModelTitle','Add New Email Template')
@section('ModelTitleInfo','Manage Email Template')

@section('EditModelTitle','Edit Email Template')
@section('EditModelTitleInfo','Modify Email Template')

@section('AddModelPage')
    @include('app.erpmodule.MasterAdmin.Communication.MasterSetting.add.add-email-template')
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Communication</li>
            <li class="breadcrumb-item active" aria-current="page">Master Setting</li>
            <li class="breadcrumb-item active" aria-current="page">Define Email Template</li>
        </ol>
    </nav>

    <div class="col-lg-12 p-0 m-0 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i> Email Template List</b></div>
            <div class="panel-body pd-b-0 row">
                <div class="col-lg-2">
                    @include('layouts.actionbutton.ActionButton')
                </div>

                <div class="col-lg-10 vhr">
                    <table id="example2" class="table datatable table-bordered" >
                        <thead>
                        <tr>
                            <th class="wd-10p text-center">Sl.No.</th>
                            <th>Subject</th>
                            <th>Template Name</th>
                            <th class="text-center">Email Type</th>
                            <th class="wd-35p">Email Template</th>
                            <th class="text-center">Is Active</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($emailtemplate as $data)
                            <tr editurl="{{url('MasterAdmin/Communication/EditViewEmailTemplate/'.$data->id.'/view')}}"  deleteurl="{{url('/RecordDelete/'.$data->id.'/'.$data->getTable().'/delete')}}">
                                <td class="text-center">{{$loop->iteration}}</td>
                                <td>{{$data->subject}}</td>
                                <td>{{$data->template_name}}</td>
                                <td>{{$data->email_type}}</td>
                                <td>{!! nl2br($data->template) !!}</td>
                                <td class="text-center">@if($data->is_active==1)<sapn class="badge badge-success">Yes</sapn>@else<sapn class="badge badge-danger">No</sapn>@endif</td>
                              </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
