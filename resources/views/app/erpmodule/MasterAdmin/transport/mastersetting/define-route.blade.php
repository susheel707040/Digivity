@extends('layouts.MasterLayout')

@section('ModelTitle','Add Route')
@section('ModelTitleInfo','Manage Route')
@section('EditModelTitle','Edit Route')
@section('EditModelTitleInfo','Modify Route')

@section('AddModelPage')
    @include('app.erpmodule.MasterAdmin.transport.mastersetting.add.add-route')
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="{{url('/home')}}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{url('/MasterAdmin/Transport/index')}}">Transport</a></li>
            <li class="breadcrumb-item active" aria-current="page">Define Route</li>
        </ol>
    </nav>

    <div class="col-lg-12 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i> Route List</b></div>
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
                                <th>Route</th>
                                <th>Longitude,Latitude</th>
                                <th>Map Api Url</th>
                                <th>Sch. to Rout. Dist.</th>
                                <th>Rout. to Sch. Dist.</th>
                                <th>Note</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($route as $data)
                                <tr editurl="{{url('MasterAdmin/Transport/EditViewRoute/'.$data->id.'/edit')}}" deleteurl="{{url('/RecordDelete/'.$data->id.'/'.$data->getTable().'/delete')}}">
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td class="text-center">{{$data->sequence}}</td>
                                    <td>{{$data->route}}</td>
                                    <td class="text-center">{{$data->longitude}},{{$data->latitude}}</td>
                                    <td>{{$data->map_api_url}}</td>
                                    <td class="text-center">{{$data->school_to_route_distance}} <b>km</b></td>
                                    <td class="text-center">{{$data->route_to_school_distance}} <b>km</b></td>
                                    <td>{{$data->note}}</td>
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
