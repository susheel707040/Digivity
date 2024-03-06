@extends('layouts.MasterLayout')

@section('ModelTitle','Add Fee Head')
@section('ModelTitleInfo','Manage Fee Head')
@section('EditModelTitle','Edit Fee Head')
@section('EditModelTitleInfo','Modify Fee Head')

@section('AddModelPage')
    @include('app.erpmodule.MasterAdmin.Finance.MasterSetting.FeeSetting.Add.add-fee-head')
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Finance</li>
            <li class="breadcrumb-item active" aria-current="page">Fee Setting</li>
            <li class="breadcrumb-item active" aria-current="page">Fee Head</li>
        </ol>
    </nav>

    <div class="col-lg-12 p-0 m-0 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i> Fee Head List</b></div>
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
                                <th><b>Fee Head</b></th>
                                <th><b>Print line 1</b></th>
                                <th><b>Print line 2</b></th>
                                <th class="text-center"><b>Type</b></th>
                                <th class="text-center"><b>Refund</b></th>
                                <th class="text-center"><b>Apply</b></th>
                                <th class="text-center"><b>Priority</b></th>
                                <th class="text-center"><b>Fee Custom</b></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($feehead as $data)
                                <tr editurl="{{url('MasterAdmin/Finance/EditViewFeeHead/'.$data->id.'/view')}}" deleteurl="{{url('/RecordDelete/'.$data->id.'/'.$data->getTable().'/delete')}}">
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td>{{$data->fee_head}}</td>
                                    <td>{{$data->print_line_one}}</td>
                                    <td>{{$data->print_line_two}}</td>
                                    <td class="text-center">@if($data->type)<span class="badge badge-success">{{ucfirst($data->type)}}</span>@endif</td>
                                    <td class="text-center">@if($data->refund=="yes") <span class="badge-success badge">Yes</span>@else <span class="badge-danger badge">No</span> @endif</td>
                                    <td class="text-center">@if($data->apply=="yes") <span class="badge-success badge">Yes</span>@else <span class="badge-danger badge">No</span> @endif</td>
                                    <td class="text-center">{{$data->priority}}</td>
                                    <td class="text-center">@if($data->fee_custom=="yes") <span class="badge-success badge">Yes</span> @else <span class="badge-danger badge">No</span> @endif</td>
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
