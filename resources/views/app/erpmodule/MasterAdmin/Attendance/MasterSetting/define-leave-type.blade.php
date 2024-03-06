@extends('layouts.MasterLayout')

@section('ModelTitle','Add Leave Type')
@section('ModelTitleInfo','Manage Leave Type for Student and Staff')
@section('EditModelTitle','Edit Add Leave Type')
@section('EditModelTitleInfo','Modify Leave Type for Student and Staff')

@section('AddModelPage')
    @include('app.erpmodule.MasterAdmin.Attendance.MasterSetting.Add.add-leave-type')
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Attendance</li>
            <li class="breadcrumb-item active" aria-current="page">Master Setting</li>
            <li class="breadcrumb-item active" aria-current="page">Define Leave Type</li>
        </ol>
    </nav>

    <div class="col-lg-12 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i>Define Leave Type</b></div>
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
                                <td class="text-center">Sequence</td>
                                <th class=" text-center">Leave Type</th>
                                <th class="text-center">Alias</th>
                                <th class="wd-35p text-center">Description</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($leavetypelist as $data)
                                <tr editurl="{{route('leavetype.edit',['leavetype'=>$data->id])}}"
                                    deleteurl="{{url('/RecordDelete/'.$data->id.'/'.$data->getTable().'/delete')}}">
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td class="text-center">{{$data->sequence}}</td>
                                    <td>{{$data->leave_type}}</td>
                                    <td>{{$data->alias}}</td>
                                    <td>{{$data->description}}</td>
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
