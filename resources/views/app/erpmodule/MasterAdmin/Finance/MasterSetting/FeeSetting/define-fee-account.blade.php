@extends('layouts.MasterLayout')

@section('ModelTitle','Add Fee Account')
@section('ModelTitleInfo','Manage Fee Account')
@section('EditModelTitle','Edit Fee Account')
@section('EditModelTitleInfo','Modify Fee Account')

@section('AddModelPage')
    @include('app.erpmodule.MasterAdmin.Finance.MasterSetting.FeeSetting.Add.add-fee-account')
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Finance</li>
            <li class="breadcrumb-item active" aria-current="page">Fee Setting</li>
            <li class="breadcrumb-item active" aria-current="page">Fee Account</li>
        </ol>
    </nav>

    <div class="col-lg-12 p-0 m-0 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i> Fee Account List</b></div>
            <div class="panel-body pd-b-0 row">
                <div class="col-lg-2">
                    @include('layouts.actionbutton.ActionButton')
                </div>

                <div class="col-lg-10 vhr">
                    <div data-label="Example" class="df-example demo-table">
                        <table id="example2" class="table datatable table-bordered" >
                            <thead>
                            <tr>
                                <th class="wd-10p text-center"><b>Sl.No.</b></th>
                                <th><b>Fee Account</b></th>
                                <th class="text-center"><b>Default Set</b></th>
                                <th class="text-center"><b>Modify Date</b></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($feeaccount as $data)
                                <tr editurl="{{url('MasterAdmin/Finance/EditViewFeeAccount/'.$data->id.'/view')}}" deleteurl="{{url('/RecordDelete/'.$data->id.'/'.$data->getTable().'/delete')}}">
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td>{{$data->fee_account}}</td>
                                    <td class="text-center">@if($data->default_at=="yes") <span class="badge-success badge">Yes</span> @endif</td>
                                    <td class="text-center">{{\App\Helper\DateFormat::date($data->updated_at)}}</td>
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
