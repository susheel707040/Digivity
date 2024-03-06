@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">Finance/Account</li>
            <li class="breadcrumb-item" aria-current="page">Reports</li>
            <li class="breadcrumb-item active" aria-current="page">Month MIS Fee Collection Report</li>
        </ol>
    </nav>

    <div class="col-lg-12  p-0 m-0 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i> Month MIS Fee Collection Report</b></div>
            <div class="panel-body tx-11 pd-b-5 row">
                <form class="container-fluid" action="{{url('MasterAdmin/Finance/MonthMISCollectionReport')}}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="col-lg-12 pd-b-15 row m-0">
                        <div class="col-lg-2">
                            <label><b>From Date :</b></label>
                            <input type="text" name="from_date" class="form-control1 date" value="{{nowdate(request()->get('from_date'),'d-m-Y')}}">
                        </div>
                        <div class="col-lg-2">
                            <label><b>To Date :</b></label>
                            <input type="text" name="to_date" class="form-control1 date" value="{{nowdate(request()->get('to_date'),'d-m-Y')}}">
                        </div>
                        <div class="col-lg-2">
                            <button type="submit" class="btn btn-primary mg-t-20"><i class="fa fa-search"></i> Search</button>
                        </div>
                    </div>
                </form>


                <div class="col-lg-12 pd-t-10 bd-1 bd-t m-0 row">
                    <div class="col-lg-12 p-0 m-0 text-right">@include('layouts.actionbutton.action-button-verticle')</div>
                    <div class="col-lg-12 p-0 m-0">
                    @php
                    $totalcollection=0;
                    $monthperiod = \Carbon\CarbonPeriod::create(nowdate(request()->get('from_date'),'Y-m-d'), '1 month',nowdate(request()->get('to_date'),'Y-m-d'));
                    @endphp
                    <table class="table datatable mg-t-10 table-bordered">
                        <thead class="bg-light">
                        <tr>
                            @php $totalsum=array(); @endphp
                            @foreach($monthperiod as $monthyear)
                                @php $totalsum['totalreceipt_'.$monthyear->format("Y_m")]=0; $totalsum['totalsum_'.$monthyear->format("Y_m")]=0; @endphp
                            <th colspan="3" class="text-left"><b>{{$monthyear->format("F-Y")}}</b></th>
                            @endforeach
                        </tr>

                        </thead>
                        <thead>
                        <tr>
                            @foreach($monthperiod as $monthyear)
                            <th class="text-center">Date</th><th class="text-center">Total Recpt.</th><th class="text-right"><b>Fee Collect</b></th>
                            @endforeach
                        </tr>
                        </thead>
                        <tbody>
                        @for($i=1;$i<=31;$i++)
                            <tr>
                                @foreach($monthperiod as $monthyear)
                                    @php
                                    $i=sprintf("%02d", $i);
                                    $fromdate=$monthyear->format("Y-m")."-".$i;
                                    $dateexist=\Carbon\Carbon::parse($fromdate)->toDateString();
                                    $enddate=$monthyear->format("Y-m")."-".$i;

                                    $feecollection=dbtablesum(\App\Models\MasterAdmin\Finance\StudentFeeCollection::class,['dbrow'=>'SUM(paid_amount) as totalcollect,count(id) as totalreceipt','search'=>['receipt_status'=>'paid'],'customsearch' => [ 'whereBetween' => [ 'receipt_date' => [$fromdate,$enddate] ]]]);
                                    $totalcollect=0; if(isset($feecollection->totalcollect)){$totalcollect=$feecollection->totalcollect;}
                                    $totalreceipt=0; if(isset($feecollection->totalreceipt)){$totalreceipt=$feecollection->totalreceipt;}

                                    $totalsum['totalreceipt_'.$monthyear->format("Y_m")] +=$totalreceipt;
                                    $totalsum['totalsum_'.$monthyear->format("Y_m")] +=$totalcollect;
                                    $totalcollection +=$totalcollect;
                                    @endphp
                                @if($fromdate==$dateexist)
                                <td class="text-center">{{$i}}-{{$monthyear->format("M-Y")}}</td><td class="text-center">{{$totalreceipt}}</td><td class="text-right bg-success-light">{{numberformat($totalcollect)}}</td>
                                @else
                                    <td class="text-center">---</td><td class="text-center">---</td><td class="text-center bg-success-light">---</td>
                                @endif
                                @endforeach
                            </tr>
                        @endfor
                        </tbody>
                        <tfoot class="bg-light">
                        <tr>
                        @foreach($monthperiod as $monthyear)
                            <td class="text-right"><b>Total :</b></td>
                                <td class="text-center tx-bold">@if(isset($totalsum['totalreceipt_'.$monthyear->format("Y_m")])){{$totalsum['totalreceipt_'.$monthyear->format("Y_m")]}} @else {{numberformat(0)}} @endif</td>
                                <td class="text-right tx-bold">@if(isset($totalsum['totalsum_'.$monthyear->format("Y_m")])){{numberformat($totalsum['totalsum_'.$monthyear->format("Y_m")])}}@else {{numberformat(0)}} @endif</td>
                        @endforeach
                        </tr>
                        <tr>
                            <td colspan="{{count($monthperiod)*3}}"><b>Total Fee Collection : {{numberformat($totalcollection)}}</b></td>
                        </tr>
                    </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
