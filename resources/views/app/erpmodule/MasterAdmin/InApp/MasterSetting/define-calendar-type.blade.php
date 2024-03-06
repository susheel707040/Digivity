@extends('layouts.MasterLayout')

@section('ModelTitle','Add New Calendar Type')
@section('ModelTitleInfo','Manage Calendar Type')
@section('EditModelTitle','Edit Calendar Type')
@section('EditModelTitleInfo','Modify Calendar Type')

@section('AddModelPage')
    @include('app.erpmodule.MasterAdmin.InApp.MasterSetting.Add.add-calendar-type')
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">App</li>
            <li class="breadcrumb-item active" aria-current="page">Calendar Type</li>
        </ol>
    </nav>

    <div class="col-lg-11 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i> Calendar Type List</b></div>
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
                                <th class="text-center">Priority</th>
                                <th class="wd-25p">Calendar Type</th>
                                <th class="text-center">Color</th>
                                <th class="text-center">Status</th>
                                <th class="wd-20p text-center">Modify Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($calendartype as $data)
                                <tr editurl="{{url('MasterAdmin/App/EditViewCalendarType/'.$data->id.'/editview')}}" deleteurl="{{url('/RecordDelete/'.$data->id.'/'.$data->getTable().'/delete')}}">
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td class="text-center">{{$data->priority}}</td>
                                    <td>{{$data->calendar_type}}</td>
                                    <td class="text-center">
                                        <span class="badge pd-l-10 tx-13 pd-r-10 pd-t-10 pd-b-10" style="background:{{$data->color}}; ">{{$data->color}}</span>
                                    </td>
                                    <td class="text-center">
                                        @if($data->status=="yes")
                                        <span class="badge badge-success">Active</span>
                                        @elseif($data->status=="no")
                                        <span class="badge badge-danger">In-Active</span>
                                        @endif
                                    </td>
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
