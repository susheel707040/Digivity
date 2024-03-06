@extends('layouts.MasterLayout')
@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="#">Transport</a></li>
            <li class="breadcrumb-item active" aria-current="page">Driver Wise Transport Mis Report</li>
        </ol>
    </nav>


    <div class="col-lg-12 p-0 m-0">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i> Driver With Route Wise Transport Mis Report</b></div>
            <div class="panel-body p-0 m-0 row">
                <div class="col-lg-12 text-right">
                    @include('layouts.actionbutton.action-button-verticle')
                </div>

                <div class="col-lg-12 pd-b-10">
                    <table id="example2" class="table datatable tx-11 table-bordered">
                        <thead class="bg-light">
                        <tr>
                            <th rowspan="2">Route Stop</th>
                            <th colspan="2">Driver With Route Wise Transport Strength Report</th>
                        </tr>
                        <tr>
                            @php $total=array(); @endphp
                            <th></th>
                            @php $total +=['total'=>0]; @endphp
                            <th class="text-center wd-20p">Total</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($routestop as $data)
                            <tr>
                                <td class="wd-20p">@if($data->stop_no){{$data->stop_no}}-@endif{{$data->route_stop}}</td>
                                <td class="text-center">0</td>
                                <td class="text-center bg-light">0</td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
