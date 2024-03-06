@extends('layouts.MasterLayout')

@section('ModelTitle','Add New Designation')
@section('ModelTitleInfo','Manage Designation')
@section('EditModelTitle','Edit Designation')
@section('EditModelTitleInfo','Modify Designation')

@section('AddModelPage')
    @include('app.erpmodule.MasterAdmin.Staff.MasterSetting.Add.add-designation')
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Staff</li>
            <li class="breadcrumb-item active" aria-current="page">Master Setting</li>
            <li class="breadcrumb-item active" aria-current="page">Define Designation</li>
        </ol>
    </nav>

    <div class="col-lg-12 p-0 m-0 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i> Department List</b></div>
            <div class="panel-body pd-b-0 row">
                <div class="col-lg-2">
                    @include('layouts.actionbutton.ActionButton')
                </div>

                <div class="col-lg-10 vhr">
                    <div data-label="Example" class="df-example demo-table">
                        <table id="example2" class="table datatable table-bordered" >
                            <thead>
                            <tr>
                                <th class="wd-10p text-center">Sl.No.</th>
                                <th>Designation</th>
                                <th class="text-center">Show in Payroll</th>
                                <th class="text-center">Default Set</th>
                                <th class="text-center">Modify Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($staffdesignation as $data)
                                <tr editurl="{{url('MasterAdmin/Staff/EditViewDesignation/'.$data->id.'/editview')}}" deleteurl="{{url('/RecordDelete/'.$data->id.'/'.$data->getTable().'/delete')}}">
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td>{{$data->designation}}</td>
                                    <td class="text-center">@if($data->show_in_payroll=="yes")<span class="badge badge-success">Yes</span>@else <span class="badge badge-danger">No</span> @endif</td>
                                    <td class="text-center">@if($data->default_at=="yes")<span class="badge badge-success">Active</span>@endif</td>
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
