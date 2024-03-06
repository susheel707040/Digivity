@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">Finance/Account</li>
            <li class="breadcrumb-item" aria-current="page">Reports</li>
            <li class="breadcrumb-item active" aria-current="page">Date Wise Paymode Fee Collection Report</li>
        </ol>
    </nav>

    <div class="col-lg-12  p-0 m-0 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i> Date Wise Paymode Fee Collection Report</b></div>
            <div class="panel-body tx-11 pd-b-5 row">
                <form class="container-fluid" action="{{url('MasterAdmin/Finance/DateWisePaymodeWiseFeeCollectionReport')}}" method="POST" enctype="multipart/form-data">
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
                            <label><b>Paymode :</b></label>
                            @include('components.Finance.paymode-import',['selectid'=>request()->get('paymode_id')])
                        </div>
                        <div class="col-lg-2">
                            <button type="submit" class="btn btn-primary mg-t-20"><i class="fa fa-search"></i> Search</button>
                        </div>
                    </div>
                </form>

                <div class="col-lg-12 pd-t-10 bd-1 bd-t m-0 row">
                    <div class="col-lg-12 p-0 m-0 text-right">@include('layouts.actionbutton.action-button-verticle')</div>
                    <div class="col-lg-12 p-0 m-0">
                        <table class="table datatable table-bordered tx-11 mg-t-10">
                            @php
                                $totalsum=[];
                                $period = \Carbon\CarbonPeriod::create(nowdate(request()->get('from_date'),'Y-m-d'), nowdate(request()->get('to_date'),'Y-m-d'));
                            @endphp
                            <thead class="bg-light">
                            <tr>
                                <th colspan="{{(count($paymodelist)*2)+4}}"><b>Date Range : {{nowdate(request()->get('from_date'),'d-F-Y')}} - {{nowdate(request()->get('to_date'),'d-F-Y')}}</b></th>
                            </tr>
                            </thead>
                            <thead>
                            <tr class="bg-light">
                                <th rowspan="3" class="text-center align-middle">#</th>
                                <th rowspan="3" class="align-middle">Date</th>
                                <th colspan="{{(count($paymodelist)*2)+2}}">Paymode</th>
                            </tr>
                            <tr class="bg-light">
                                @foreach($paymodelist as $data)

                                    @php
                                        $totalsum +=['total_receipt_'.$data->id=>0,'total_collect_'.$data->id=>0];
                                    @endphp

                                    <th colspan="2">{{$data->paymode}}</th>
                                @endforeach

                                @php
                                    $totalsum +=['total_receipt'=>0,'total_collect'=>0];
                                @endphp

                                <th rowspan="2" class="align-middle bg-success-light">Total Receipt</th>
                                <th rowspan="2" class="align-middle bg-success-light text-right">Total Fee Collect</th>
                            </tr>
                            <tr class="bg-light">
                                @foreach($paymodelist as $data)
                                    <th class="text-center"><b>Total Receipt</b></th>
                                    <th class="text-right">Fee Collect</th>
                                @endforeach
                            </tr>
                            </thead>
                            <tbody>
                            @php $row=0; @endphp
                            @foreach($period as $date)
                                @php
                                    $row++;
                                    $feecollectdate=$date->format('d-M-Y');
                                    $totalfeecollect=0;
                                    $totalfeereceipt=0;
                                @endphp
                                <tr>
                                    <td class="text-center">{{$row}}</td>
                                    <td>{{$feecollectdate}}</td>

                                    @foreach($paymodelist as $data)

                                        @php
                                            $fromdate=nowdate($feecollectdate,'Y-m-d');
                                            $enddate=nowdate($feecollectdate,'Y-m-d');
                                                $feecollection=dbtablesum(\App\Models\MasterAdmin\Finance\StudentFeeCollection::class,['dbrow'=>'SUM(paid_amount) as totalcollect,count(id) as totalreceipt','search'=>['receipt_status'=>'paid','paymode_id'=>$data->id],'customsearch' => [ 'whereBetween' => [ 'receipt_date' => [$fromdate,$enddate] ]]]);
                                                $totalcollect=0; if(isset($feecollection->totalcollect)){$totalcollect=$feecollection->totalcollect;}
                                                $totalreceipt=0; if(isset($feecollection->totalreceipt)){$totalreceipt=$feecollection->totalreceipt;}
                                                $totalsum['total_receipt'] +=$totalreceipt;
                                                $totalsum['total_collect'] +=$totalcollect;
                                                $totalsum['total_receipt_'.$data->id] +=$totalreceipt;
                                                $totalsum['total_collect_'.$data->id] +=$totalcollect;
                                                $totalfeecollect +=$totalcollect;
                                                $totalfeereceipt +=$totalreceipt;
                                        @endphp

                                        <td class="text-center">{{$totalreceipt}}</td>
                                        <td class="text-right">{{numberformat($totalcollect)}}</td>
                                    @endforeach
                                    <td class="text-center bg-success-light">{{$totalfeereceipt}}</td>
                                    <td class="text-right bg-success-light">{{numberformat($totalfeecollect)}}</td>
                                </tr>
                            @endforeach
                            @foreach($paymodelist as $data)
                            @endforeach
                            </tbody>
                            <tfoot class="bg-light">
                            <tr>
                                <td colspan="2" class="text-right"><b>Total :</b></td>
                                @foreach($paymodelist as $data)
                                    <td class="text-center"><b>{{$totalsum['total_receipt_'.$data->id]}}</b></td>
                                    <td class="text-right"><b>{{numberformat($totalsum['total_collect_'.$data->id])}}</b></td>
                                @endforeach
                                <td class="text-center"><b>{{$totalsum['total_receipt']}}</b></td>
                                <td class="text-right"><b>{{numberformat($totalsum['total_collect'])}}</b></td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
