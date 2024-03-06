@extends('layouts.MasterLayout')

@section('ModelTitle','Add New SMS Template')
@section('ModelTitleInfo','Manage SMS Template')

@section('EditModelTitle','Edit SMS Template')
@section('EditModelTitleInfo','Modify SMS Template')

@section('AddModelPage')
    @include('app.erpmodule.MasterAdmin.Communication.MasterSetting.add.add-sms-template')
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Communication</li>
            <li class="breadcrumb-item active" aria-current="page">Master Setting</li>
            <li class="breadcrumb-item active" aria-current="page">Define SMS Template</li>
        </ol>
    </nav>

    <div class="col-lg-12 p-0 m-0 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i> SMS Template List</b></div>
            <div class="panel-body pd-b-0 row">
                <div class="col-lg-2">
                    @include('layouts.actionbutton.ActionButton')
                </div>

                <div class="col-lg-10 vhr">
                    <table id="example2" class="table datatable table-bordered" >
                        <thead>
                        <tr>
                            <th class="wd-10p text-center">Sl.No.</th>
                            <th>SMS Template Name</th>
                            <th class="text-center">SMS Type</th>
                            <th class="wd-35p">Template</th>
                            <th class="text-center">Is Active</th>
                            <th class="text-center">Unicode</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($smstemplate as $data)
                            <tr editurl="{{url('MasterAdmin/Communication/EditViewSMSTemplate/'.$data->id.'/view')}}"  deleteurl="{{url('/RecordDelete/'.$data->id.'/'.$data->getTable().'/delete')}}">
                                <td class="text-center">{{$loop->iteration}}</td>
                                <td>{{$data->template_name}}</td>
                                <td>{{$data->sms_type}}</td>
                                <td>{!! nl2br($data->template) !!}</td>
                                <td class="text-center">@if($data->is_active==1)<sapn class="badge badge-success">Yes</sapn>@else<sapn class="badge badge-danger">No</sapn>@endif</td>
                                <td class="text-center">@if($data->unicode=="yes")<sapn class="badge badge-success">Yes</sapn>@else<sapn class="badge badge-danger">No</sapn>@endif</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
