@extends('layouts.MasterLayout')

@section('ModelTitle','Add New Subject')
@section('ModelTitleInfo','Manage Subject')
@section('EditModelTitle','Edit Subject')
@section('EditModelTitleInfo','Modify Subject')

@section('AddModelPage')
    @include('app.erpmodule.MasterAdmin.GlobalSetting.AcademicSetting.Add.add-subject')
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Global Setting</li>
            <li class="breadcrumb-item active" aria-current="page"> Subject</li>
        </ol>
    </nav>

    <div class="col-lg-12 p-0 m-0 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i> Subject List</b></div>
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
                                <th class="text-left">Subject</th>
                                <th class="text-left">Subject Code</th>
                                <th class="text-center">Priority</th>
                                <th class="text-center">Status</th>
                                <th class="wd-20p text-center">Modify Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($subject as $data)
                                <tr editurl="{{url('MasterAdmin/GlobalSetting/EditViewSubject/'.$data->id.'/edit')}}" deleteurl="{{url('/RecordDelete/'.$data->id.'/'.$data->getTable().'/delete')}}">
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td>{{$data->subject_name}}</td>
                                    <td>{{$data->subject_code}}</td>
                                    <td class="text-center">{{$data->priority}}</td>
                                    <td class="text-center">@if($data->status=="active")<span class="badge badge-success">{{$data->status}}</span>@else <span class="badge badge-danger">{{$data->status}}</span> @endif</td>
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
