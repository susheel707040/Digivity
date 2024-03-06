@extends('layouts.MasterLayout')

@section('ModelTitle','Add Fee Group')
@section('ModelTitleInfo','Manage Fee Group')
@section('EditModelTitle','Edit Fee Group')
@section('EditModelTitleInfo','Modify Fee Group')

@section('AddModelPage')
    @include('app.erpmodule.MasterAdmin.Finance.MasterSetting.FeeSetting.Add.add-fee-group')
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Finance</li>
            <li class="breadcrumb-item active" aria-current="page">Fee Setting</li>
            <li class="breadcrumb-item active" aria-current="page">Fee Group</li>
        </ol>
    </nav>

    <div class="col-lg-12 p-0 m-0 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i> Fee Group List</b></div>
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
                                <th><b>Fee Group</b></th>
                                <th class="text-center"><b>Sequence</b></th>
                                <th class="text-center"><b>Modify Date</b></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($feegroup as $data)
                                <tr editurl="{{url('MasterAdmin/Finance/EditViewFeeGroup/'.$data->id.'/view')}}" deleteurl="{{url('/RecordDelete/'.$data->id.'/'.$data->getTable().'/delete')}}">
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td>{{$data->feeaccount->fee_account}}</td>
                                    <td>{{$data->fee_group}}</td>
                                    <td class="text-center">{{$data->sequence}}</td>
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
