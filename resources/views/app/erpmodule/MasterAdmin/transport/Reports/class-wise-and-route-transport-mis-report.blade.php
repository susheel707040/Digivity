@extends('layouts.MasterLayout')
@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="#">Transport</a></li>
            <li class="breadcrumb-item active" aria-current="page">Class/Course and Route Wise Transport Mis Report</li>
        </ol>
    </nav>

    <div class="col-lg-12 p-0 m-0">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i> Class/Course and Route Wise Transport Mis Report</b></div>
            <div class="panel-body p-0 m-0 row">
                <div class="col-lg-12 text-right">
                    @include('layouts.actionbutton.action-button-verticle')
                </div>

                <div class="col-lg-12 pd-b-10">
                    <table id="example2" class="table datatable tx-11 table-bordered">
                        <thead class="bg-light">
                        <tr>
                            <th rowspan="2" style=" vertical-align: middle;">Route Stop</th>
                            <th colspan="{{count($course)+1}}">Course and Route Stop Transport Strength</th>
                        </tr>
                        <tr>
                        @php $total=array(); @endphp
                        @foreach($course as $data1)
                        @php $total +=['total_'.$data1->id=>0]; @endphp
                        <th class="text-center">{{$data1->course}}</th>
                        @endforeach
                        @php $total +=['total'=>0]; @endphp
                        <th class="text-center">Total</th>
                        </tr>
                        </thead>


                        <tbody>
                        @foreach($routestop as $data)
                        <tr>
                            <td>@if($data->stop_no) {{$data->stop_no}} - @endif{{$data->route_stop}}</td>
                            @php $subtotal=0; @endphp
                            @foreach($course as $data1)
                                @php
                                    $studenttransport=dbtablesum(\App\Models\MasterAdmin\Admission\StudentRecord::class,['dbrow'=>'count(transport_id) as totalstrength','search'=>['course_id'=>$data1->id,'transport_status'=>'active']

                                    ,'join'=>['t1'=>['table'=>'transport_route_relations','foreigntable'=>null,'foreign'=>'transport_id','ownerkey'=>'id']]
                                    ,'joinsearch'=>['t1.route_stop_id'=>$data->id]

                                    ,'customsearch'=>['whereNotNull'=>'transport_id','whereNull'=>'transport_stop_date']]);
                                    $studenttransport->totalstrength ? $transportstrength=$studenttransport->totalstrength : $transportstrength=0;
                                $total['total_'.$data1->id.''] +=$transportstrength;
                                $subtotal +=$transportstrength;
                                $total['total'] +=$transportstrength;
                                @endphp

                            <td class="text-center">{{$transportstrength}}</td>
                            @endforeach
                            <td class="text-center bg-light">{{$subtotal}}</td>
                        </tr>
                        @endforeach
                        </tbody>

                        <tfoot class="tx-bold bg-success-light">
                        <tr>
                            <td>Total Strength :</td>
                            @foreach($total as $value)
                            <td class="text-center">{{$value}}</td>
                            @endforeach
                        </tr>
                        </tfoot>

                    </table>
                </div>

            </div>
        </div>
    </div>


@endsection
