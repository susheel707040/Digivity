@extends('layouts.MasterLayout')

@section('ModelTitle','Add Fee Head Map With Installment')
@section('ModelTitleInfo','Manage Fee Head Map With Installment')
@section('EditModelTitle','Edit Fee Head Map With Installment')
@section('EditModelTitleInfo','Modify Fee Head Map With Installment')

@section('AddModelPage')
    @include('app.erpmodule.MasterAdmin.Finance.MasterSetting.FeeSetting.Add.add-fee-heap-map-with-installment')
@endsection


@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Finance</li>
            <li class="breadcrumb-item active" aria-current="page">Fee Setting</li>
            <li class="breadcrumb-item active" aria-current="page">Fee Head Map With Installment</li>
        </ol>
    </nav>

    <div class="col-lg-12 p-0 m-0 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i> Fee Head Map With Installment List</b></div>
            <div class="panel-body pd-b-0 row">
                <div class="col-lg-12 pd-t-15 pd-b-15">
                    <button type="button" href="#addModels" data-toggle="modal" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add Fee Head Installment</button>
                </div>
                <div class="col-lg-12 vhr">
                    <div data-label="Example" class="df-example demo-table">
                        <table id="example2" class="table datatable table-bordered" >
                            <thead>
                            <tr>
                                <th class="wd-10p text-center"><b>Sl.No.</b></th>
                                <th><b>Fee Head</b></th>
                                <th><b>Instalment Name</b></th>
                                <th class="text-center"><b>Collect Date</b></th>
                                <th class="text-center"><b>End Date</b></th>
                                <th class="text-center"><b>Fine Apply</b></th>
                                <th class="text-center"><b>Concession</b></th>
                                <th class="text-center"><b>Action</b></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($feeheadinstallment as $data)
                                <tr editurl="{{url('MasterAdmin/Finance/EditViewFeeAccount/'.$data->id.'/view')}}" deleteurl="{{url('/RecordDelete/'.$data->id.'/'.$data->getTable().'/delete')}}">
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td>{{$data->feehead->fee_head}}</td>
                                    <td>{{$data->print_name}}</td>
                                    <td class="text-center">{{$data->start_date}}</td>
                                    <td class="text-center">{{$data->end_date}}</td>
                                    <td class="text-center">@if($data->fine_apply=="yes") <span class="badge-success badge">YES</span>@else <span class="badge-danger badge">NO</span> @endif</td>
                                    <td class="text-center">@if($data->concession_type=="f") {{$data->concession}} @else {{$data->concession}}% @endif</td>
                                    <td class="text-center wd-20p">
                                        <button class="btn btn-success btn-xs rounded-5"><i class="fa fa-edit"></i> Edit</button>
                                        <button class="btn btn-danger btn-xs rounded-5"><i class="fa fa-edit"></i> Remove</button>
                                    </td>
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
