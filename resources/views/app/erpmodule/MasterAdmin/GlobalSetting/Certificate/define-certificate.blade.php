@extends('layouts.MasterLayout')

@section('ModelTitle','Add New Certificate')
@section('ModelTitleInfo','Manage Certificate')
@section('EditModelTitle','Edit Certificate')
@section('EditModelTitleInfo','Modify Certificate')

@section('AddModelPage')
    @include('app.erpmodule.MasterAdmin.GlobalSetting.Certificate.Add.add-certificate')
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item " aria-current="page">Global Setting</li>
            <li class="breadcrumb-item " aria-current="page">Certificate</li>
            <li class="breadcrumb-item active" aria-current="page">Define Certificate</li>
        </ol>
    </nav>

    <div class="col-lg-12 p-0 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i>Certificate List</b></div>
            <div class="panel-body pd-b-0 row">
                <div class="col-lg-2">
                    @include('layouts.actionbutton.ActionButton')
                </div>

                <div class="col-lg-10 vhr">
                    <div data-label="Example" class="df-example demo-table">
                        <table id="example2" class="table datatable table-bordered">
                            <thead>
                            <tr>
                                <th class="wd-10p text-center">Sl.No.</th>
                                <th>For</th>
                                <th class="text-center">Sequence</th>
                                <th class="wd-25p">Certificate</th>
                                <th class="text-center">Integrate</th>
                                <th>Icon</th>
                                <th>Description</th>
                                <th class="text-center">Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($certificate as $data)
                                <tr editurl="{{url('MasterAdmin/GlobalSetting/EditViewCertificate/'.$data->id.'/editview')}}"
                                    deleteurl="{{url('/RecordDelete/'.$data->id.'/'.$data->getTable().'/delete')}}">
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td>{{ucwords($data->for)}}</td>
                                    <td class="text-center">{{$data->sequence}}</td>
                                    <td>{{$data->certificate_name}}</td>
                                    <td class="text-center"><span class="badge badge-success">{{strtoupper($data->integrate)}}</span></td>
                                    <td></td>
                                    <td>{{$data->description}}</td>
                                    <td class="text-center">@if($data->status=="active") <span class="badge badge-success">Active</span> @elseif($data->status=="inactive") <span class="badge badge-danger">In-Active</span> @endif</td>
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
