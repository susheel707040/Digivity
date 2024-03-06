@extends('layouts.MasterLayout')

@section('ModelTitle','Add New Stream')
@section('ModelTitleInfo','Manage Stream')
@section('EditModelTitle','Edit Stream')
@section('EditModelTitleInfo','Modify Stream')

@section('AddModelPage')
    @include('app.erpmodule.MasterAdmin.GlobalSetting.AcademicSetting.Add.add-stream')
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Global Setting</li>
            <li class="breadcrumb-item active" aria-current="page">Define Stream</li>
        </ol>
    </nav>

    <div class="col-lg-10 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i> Stream List</b></div>
            <div class="panel-body pd-b-0 row">
                <div class="col-lg-2">
                    @include('layouts.actionbutton.ActionButton',['fileName'=>'StreamList','colspan'=>4])
                </div>

                <div class="col-lg-10 vhr">
                    <div data-label="Example" class="df-example demo-table">
                        <table id="example2" class="table datatable table-bordered">
                            <thead>
                            <tr>
                                <th class="wd-10p text-center">Sl.No.</th>
                                <th class="wd-25p">Stream</th>
                                <th class="wd-15p text-center">Default Set</th>
                                <th class="wd-20p text-center">Modify Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($stream as $data)
                                <tr editurl="{{url('MasterAdmin/GlobalSetting/EditViewStream/'.$data->id.'/edit')}}"
                                    deleteurl="{{url('/RecordDelete/'.$data->id.'/'.$data->getTable().'/delete')}}">
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td>{{$data->stream}}</td>
                                    <td class="text-center">@if($data->default_at=="yes")<span
                                            class="badge badge-success">Active</span>@endif</td>
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
