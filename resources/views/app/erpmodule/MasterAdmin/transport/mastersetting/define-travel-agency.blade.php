@extends('layouts.MasterLayout')

@section('ModelTitle','Add Travel Agency')
@section('ModelTitleInfo','Manage Travel Agency')
@section('EditModelTitle','Edit Travel Agency')
@section('EditModelTitleInfo','Modify Travel Agency')

@section('AddModelPage')
    @include('app.erpmodule.MasterAdmin.transport.mastersetting.add.add-travel-agency')
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="{{url('/home')}}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{url('/MasterAdmin/Transport/index')}}">Transport</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Travel Agency</li>
        </ol>
    </nav>

    <div class="col-lg-12 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i> Travel Agency List</b></div>
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
                                <th>Travel Agency</th>
                                <th>Person Name</th>
                                <th>Mobile No.</th>
                                <th>Email</th>
                                <th class="text-center">Office Address</th>
                                <th class="text-center">Modify</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($travelagency as $data)
                                <tr editurl="{{url('MasterAdmin/Transport/EditViewTravelAgency/'.$data->id.'/edit')}}"
                                    deleteurl="{{url('/RecordDelete/'.$data->id.'/'.$data->getTable().'/delete')}}">
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td>{{$data->travel_agency}}</td>
                                    <td>{{$data->person_name}}</td>
                                    <td>{{$data->mobile_no}}</td>
                                    <td>{{$data->email}}</td>
                                    <td>{{$data->office_address}}</td>
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
