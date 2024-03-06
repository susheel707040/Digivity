@extends('layouts.MasterLayout')

@section('ModelTitle','Add New Holiday')
@section('ModelTitleInfo','Manage Holiday for Student and Staff')
@section('EditModelTitle','Edit Holiday')
@section('EditModelTitleInfo','Modify Holiday for Student and Staff')

@section('AddModelPage')
    @include('app.erpmodule.MasterAdmin.Attendance.MasterSetting.Add.add-holiday')
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Attendance</li>
            <li class="breadcrumb-item active" aria-current="page">Master Setting</li>
            <li class="breadcrumb-item active" aria-current="page">Define Holiday</li>
        </ol>
    </nav>

    <div class="col-lg-12 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i>Define Holiday</b></div>
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
                                <th class="wd-15p text-center">Holiday For</th>
                                <th class="">Holiday Date</th>
                                <th>Holiday</th>
                                <th class="wd-25p text-center">Description</th>
                                <th class="text-center">Symbol</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($holidaylist as $data)
                                <tr editurl="{{url('MasterAdmin/Attendance/EditViewHoliday/'.$data->id.'/edit')}}"
                                    deleteurl="{{url('/RecordDelete/'.$data->id.'/'.$data->getTable().'/delete')}}">
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td class="text-center">
                                        @if($data->for_student==1)
                                            <span class="badge badge-danger">Student</span>
                                        @endif
                                        @if($data->for_staff==1)
                                            <span class="badge badge-danger">Staff</span>
                                        @endif
                                    </td>
                                    <td>{{nowdate($data->holiday_from_date,'d-M-Y')}} <b>~</b> {{nowdate($data->holiday_to_date,'d-M-Y')}}</td>
                                    <td>{{$data->holiday}}</td>
                                    <td>{{$data->description}}</td>
                                    <td class="text-center">{{$data->symbol}}</td>
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
