@extends('layouts.MasterLayout')

@section('ModelTitle','Add New Parish')
@section('ModelTitleInfo','Manage Parish')
@section('EditModelTitle','Edit Parish')
@section('EditModelTitleInfo','Modify Parish')

@section('AddModelPage')
    @include('app.erpmodule.MasterAdmin.GlobalSetting.AcademicSetting.Add.add-parish')
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Global Setting</li>
            <li class="breadcrumb-item active" aria-current="page">Parish</li>
        </ol>
    </nav>

    <div class="col-lg-10 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i> Parish List</b></div>
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
                                <th class="wd-20p">Religion</th>
                                <th class="wd-20p">Parish</th>
                                <th class="wd-15p text-center">Default Set</th>
                                <th class="wd-15p text-center">Modify Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($parish as $data)
                                <tr editurl="{{url('MasterAdmin/GlobalSetting/EditViewParish/'.$data->id.'/edit')}}" deleteurl="{{url('/RecordDelete/'.$data->id.'/'.$data->getTable().'/delete')}}">
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td>{{$data->religions->religion}}</td>
                                    <td>{{$data->parish}}</td>
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
