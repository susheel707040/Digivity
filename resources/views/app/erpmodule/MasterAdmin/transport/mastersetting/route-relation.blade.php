@extends('layouts.MasterLayout')
@section('EditModelTitle','Edit Route Relation')
@section('EditModelTitleInfo','Modify Route Relation')
@section('ModelSize','modal-xl')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="{{url('/home')}}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{url('/MasterAdmin/Transport/index')}}">Transport</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Route Relation</li>
        </ol>
    </nav>
    <div class="col-lg-12 p-0 m-0 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-bus"></i> Route Relations With (Route, Stop, Bus, Driver, Fee
                    Amount Etc.)</b></div>
            <div class="panel-body pd-b-0 row">
                <div class="col-lg-12 pd-t-20 pd-b-20 nav-line">
                    <div class="col-lg-6 p-0 m-0 mx-auto ">
                        <table class="container-fluid bd-b-2-f">
                            <tr>
                                <td class="wd-10p"><b>Route</b> :</td>
                                <td>
                                    <select id="route_id" class="form-control">
                                        <option value="">---Select---</option>
                                        @foreach($route as $data)
                                            <option value="{{$data->id}}"
                                                    @if(request()->route('routeid')==$data->id) selected @endif>{{$data->route}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="wd-20p pd-l-10">
                                    <button type="button" id="ContinueBtn" class="btn btn-outline-primary">Continue <i
                                            class="fa fa-angle-right"></i></button>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                @if(!empty(request()->route('routeid')))
                    <div class="col-lg-12 mg-t-10 mg-b-0">
                        <button class="btn btn-primary btn-sm" type="button" href="#addRouteRelation"
                                data-toggle="modal"><i class="fa fa-plus"></i> Add New Route Relation
                        </button>
                    </div>
                    @include('app.erpmodule.MasterAdmin.transport.mastersetting.add.add-route-relation')

                    <div class="col-lg-12 mg-t-0 mg-b-15">
                        <div class="flex-1 mg-t-20">
                            <div class="card">
                                <div class="card-header bg-gray-100"><i class="fa fa-list"></i> Route Relation List
                                </div>
                                <div class="card-body pd-10 pd-t-20 pd-b-5 tx-13 m-0 flex-fill">

                                    <table class="table table-bordered rounded-5 tx-12 ">
                                        <thead class="bg-gray-100 ">
                                        <tr>
                                            <th><b>Route</b></th>
                                            <th><b>Route Stop</b></th>
                                            <th><b>Morning Time</b></th>
                                            <th><b>Afternoon Time</b></th>
                                            <th class="wd-15p"><b>Vehicle</b></th>
                                            <th><b>Driver</b></th>
                                            <th class="wd-30p"><b>Transport Fee</b></th>
                                            <th class="wd-10p text-center"><b>Action</b></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($routerelation as $data)
                                            <tr>
                                                <td>{{$data->route->route}}</td>
                                                <td>{{$data->routestop->route_stop}}</td>
                                                <td>{{$data->morning_time}}</td>
                                                <td>{{$data->afternoon_time}}</td>
                                                <td>@if(!empty($data->vehicle->id)) {{$data->vehicle->registration_no}}
                                                    ({{$data->vehicle->vehicle_name}}) @endif</td>
                                                <td></td>
                                                <td class="text-center">
                                                    @if(!empty($data->routefeecharge))
                                                    @foreach($data->routefeecharge as $feedata)
                                                        <span class="badge wd-100 bg-primary-light tx-11 text-capitalize mb-b-3 mg-t-3"> <b>{{$feedata->instalment_id}} : <i class="fa fa-rupee-sign"></i>{{$feedata->fee_amount}}</b></span>
                                                    @endforeach
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <a>
                                                        <button value="{{url('MasterAdmin/Transport/EditViewRouteRelation/'.$data->id.'/edit')}}" type="button" class="btn BtnEditUrl btn-success btn-xs rounded-5">
                                                            <i class="fa fa-pen"></i>
                                                        </button>
                                                    </a>
                                                    <a href="{{url('/RecordDelete/'.$data->id.'/'.$data->getTable().'/delete')}}">
                                                        <button type="button" class="btn btn-remove btn-danger btn-xs rounded-5"><i
                                                                class="fa fa-trash"></i>
                                                        </button>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach

                                        @if(!$routerelation->count())
                                            <tr>
                                                <td colspan="10">
                                                    <h6 class="text-danger text-center p-0 m-0">No Route Relation
                                                        Found!!</h6>
                                                </td>
                                            </tr>
                                        @endif
                                        </tbody>

                                    </table>


                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        @endif

        <script type="text/javascript">
            $(document).ready(function () {
                $("#ContinueBtn").click(function () {
                    if ($("#route_id").val()) {
                        window.location.assign("/MasterAdmin/Transport/DefineRouteRelation/" + $("#route_id").val() + "/search");
                        return false;
                    }
                    window.location.assign("/MasterAdmin/Transport/DefineRouteRelation");
                });
            });
        </script>

@endsection

