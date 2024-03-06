@extends('layouts.MasterLayout')

@section('ModelTitle','Add New Fix Header Text')
@section('ModelTitleInfo','Manage Fix Header Text')
@section('EditModelTitle','Edit Fix Header Text')
@section('EditModelTitleInfo','Modify Fix Header Text')

@section('AddModelPage')
    @include('app.erpmodule.MasterAdmin.Communication.MasterSetting.add.add-fix-header-footer')
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Communication</li>
            <li class="breadcrumb-item active" aria-current="page">Master Setting</li>
            <li class="breadcrumb-item active" aria-current="page">Define Fix Header Footer</li>
        </ol>
    </nav>

    <div class="col-lg-12 p-0 m-0 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i> Fix Header Footer List</b></div>
            <div class="panel-body pd-b-0 row">
                <div class="col-lg-2">
                    @include('layouts.actionbutton.ActionButton')
                </div>

                <div class="col-lg-10 vhr">
                    <div data-label="Example" class="df-example demo-table">
                        <table id="example2" class="table datatable table-bordered" >
                            <thead>
                            <tr>
                                <th class="wd-5p text-center">Sl.No.</th>
                                <th>Title</th>
                                <th>Header Text</th>
                                <th>Footer Text</th>
                                <th  class="wd-10p text-center">Unicode</th>
                                <th  class="wd-10p">Default Set</th>
                                <th class="wd-10p">Modify Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($fixheaderfooter as $data)
                                <tr editurl="{{url('MasterAdmin/Communication/EditViewFixHeaderFooter/'.$data->id.'/view')}}" deleteurl="{{url('/RecordDelete/'.$data->id.'/'.$data->getTable().'/delete')}}">
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td>{{$data->title}}</td>
                                    <td>{{$data->header_text}}</td>
                                    <td>{{$data->footer_text}}</td>
                                    <td class="text-center">@if($data->unicode=="yes")<span class="badge badge-success">YES</span>@endif</td>
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
