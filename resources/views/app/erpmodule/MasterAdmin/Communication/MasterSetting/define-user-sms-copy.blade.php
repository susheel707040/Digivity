@extends('layouts.MasterLayout')

@section('ModelTitle','Add New Communication Type')
@section('ModelTitleInfo','Manage Communication Type')
@section('EditModelTitle','Edit Communication Type')
@section('EditModelTitleInfo','Modify Communication Type')

@section('AddModelPage')
    @include('app.erpmodule.MasterAdmin.Communication.MasterSetting.add.add-user-sms-copy')
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Communication</li>
            <li class="breadcrumb-item active" aria-current="page">Master Setting</li>
            <li class="breadcrumb-item active" aria-current="page">Define Communication Type</li>
        </ol>
    </nav>

    <div class="col-lg-12 p-0 m-0 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i> Communication Type List</b></div>
            <div class="panel-body pd-b-0 row">
                <div class="col-lg-2">
                    @include('layouts.actionbutton.ActionButton')
                </div>

                <div class="col-lg-10 vhr">
                    <div data-label="Example" class="df-example demo-table">
                        <table id="example2" class="table datatable table-bordered" >
                            <thead>
                            <tr>
                                <th class="wd-5p">Sl.No.</th>
                                <th>Designation</th>
                                <th>Name</th>
                                <th>Gender</th>
                                <th>Mobile No.</th>
                                <th>Email</th>
                                <th>Note</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($usersmscopy as $data)
                                <tr editurl="{{url('MasterAdmin/Communication/EditViewUserSMSCopy/'.$data->id.'/view')}}" deleteurl="{{url('/RecordDelete/'.$data->id.'/'.$data->getTable().'/delete')}}">
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td class="text-capitalize">{{$data->designation}}</td>
                                    <td class="text-capitalize">{{$data->name}}</td>
                                    <td class="text-capitalize">{{$data->gender}}</td>
                                    <td>{{$data->mobile_no}}</td>
                                    <td>{{$data->email_id}}</td>
                                    <td class="text-capitalize">{{$data->note}}</td>
                                    <td class="text-center">@if($data->status=="active")<span class="badge badge-success">Active</span>@else <span class="badge badge-danger">In-Active</span> @endif</td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

    </div>


@endsection
