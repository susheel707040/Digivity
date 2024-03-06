@extends('layouts.MasterLayout')

@section('ModelTitle','Add Vehicle')
@section('ModelTitleInfo','Manage Vehicle ')
@section('EditModelTitle','Edit Vehicle ')
@section('EditModelTitleInfo','Modify Vehicle ')

@section('AddModelPage')
    @include('app.erpmodule.MasterAdmin.transport.mastersetting.add.add-vehicle')
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="{{url('/home')}}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{url('/MasterAdmin/Transport/index')}}">Transport</a></li>
            <li class="breadcrumb-item active" aria-current="page">Vehicle Details</li>
        </ol>
    </nav>

    <div class="col-lg-12 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i> Vehicle List</b></div>
            <div class="panel-body pd-b-0 row">
                <div class="col-lg-2">
                    @include('layouts.actionbutton.ActionButton')
                </div>

                <div class="col-lg-10 vhr">
                    <div data-label="Example" class="df-example demo-table">
                        <table id="example2" class="table datatable table-bordered tx-12" >
                            <thead>
                            <tr>
                                <th class="wd-10p text-center">Sl.No.</th>
                                <th>Vehicle Type</th>
                                <th>Vehicle</th>
                                <th>Reg. No.</th>
                                <th class="text-center">Reg. Date</th>
                                <th class="text-center">Mileage(km)</th>
                                <th>Fuel Type</th>
                                <th>Owner</th>
                                <th>Mobile</th>
                                <th class="text-center">Modify Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($vehicle as $data)
                                <tr editurl="{{url('MasterAdmin/Transport/EditViewVehicle/'.$data->id.'/edit')}}" deleteurl="{{url('/RecordDelete/'.$data->id.'/'.$data->getTable().'/delete')}}">
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td>{{$data->vehicletype->vehicle_type}}</td>
                                    <td>{{$data->vehicle_name}}</td>
                                    <td>{{$data->registration_no}}</td>
                                    <td class="text-center">{{$data->registration_date}}</td>
                                    <td class="text-center">{{$data->mileage_km}}km</td>
                                    <td class="text-uppercase">{{$data->fuel_type}}</td>
                                    <td class="text-uppercase">{{$data->owner_name}}</td>
                                    <td class="text-center text-uppercase">{{$data->mobile_no}}</td>
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
