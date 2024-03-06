@extends('layouts.MasterLayout')

@section('ModelTitle','Add Route Stop')
@section('ModelTitleInfo','Manage Route Stop')
@section('EditModelTitle','Edit Route Stop')
@section('EditModelTitleInfo','Modify Route Stop')

@section('AddModelPage')
    @include('app.erpmodule.MasterAdmin.transport.mastersetting.add.add-route-stop')
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="{{url('/home')}}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{url('/MasterAdmin/Transport/index')}}">Transport</a></li>
            <li class="breadcrumb-item active" aria-current="page">Define Route Stop</li>
        </ol>
    </nav>

    <div class="col-lg-12 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i> Route Stop List</b></div>
            <div class="panel-body pd-b-0 row">
                <div class="col-lg-2">
                    @include('layouts.actionbutton.ActionButton')
                </div>

                <div class="col-lg-10 vhr">
                    <div data-label="Example" class="df-example demo-table">
                        <table id="example2" class="table datatable table-bordered tx-12" >
                            <thead>
                            <tr>
                                <th class="text-left">Sl.No.</th>
                                <th class="wd-10p text-left">Sequence</th>
                                <th>Stop No.</th>
                                <th>Route Stop Name</th>
                                <th>Longitude,Latitude</th>
                                <th>Map Api Url</th>
                                <th>Sch. to Stop Dist.</th>
                                <th>Stop to Sch. Dist.</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($routestop as $data)
                                <tr editurl="{{url('MasterAdmin/Transport/EditViewRouteStop/'.$data->id.'/edit')}}" deleteurl="{{url('/RecordDelete/'.$data->id.'/'.$data->getTable().'/delete')}}">
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td class="text-center">{{$data->sequence}}</td>
                                    <td class="text-center">{{$data->stop_no}}</td>
                                    <td>{{$data->route_stop}}</td>
                                    <td class="text-center">{{$data->longitude}},{{$data->latitude}}</td>
                                    <td>{{$data->map_api_url}}</td>
                                    <td class="text-center">{{$data->school_to_stop_distance}} <b>km</b></td>
                                    <td class="text-center">{{$data->stop_to_school_distance}} <b>km</b></td>
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
