@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">Finance/Account</li>
            <li class="breadcrumb-item" aria-current="page">Reports</li>
            <li class="breadcrumb-item active" aria-current="page">Day Wise Fee Collection Report</li>
        </ol>
    </nav>


    <div class="col-lg-12  p-0 m-0 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i> Day Wise Fee Collection Report</b></div>
            <div class="panel-body tx-11 pd-b-5 row">
                <form class="container-fluid" action="{{url('MasterAdmin/Finance/DayWiseCollectionReport')}}" method="POST" enctype="multipart/form-data">
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
                    $period = \Carbon\CarbonPeriod::create(nowdate(request()->get('from_date'),'Y-m-d'), nowdate(request()->get('to_date'),'Y-m-d'));
                    @endphp
                    <table id="example2" class="table datatable mg-t-10 table-bordered">
                        <thead class="bg-light">
                        <tr>
                            <th colspan="11">Date Range : {{nowdate(request()->get('from_date'),'d-F-Y')}} - {{nowdate(request()->get('to_date'),'d-F-Y')}}</th>
                        </tr>
                        </thead>
                        <thead class="bg-light">
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Fee Collect Date</th>
                            <th class="text-center">Generate Receipt</th>
                            <th class="text-right">Fee Total</th>
                            <th class="text-right">Concession</th>
                            <th class="text-right">Late Fee</th>
                            <th class="text-right">Fee Payable</th>
                            <th class="text-right">Instalment Paid Amount</th>
                            <th class="text-right">Balance</th>
                            <th class="text-right">Excess</th>
                            <th class="text-right">Total Fee Collection</th>
                        </tr>
                        </thead>

                        <tbody>
                        @php $totalsum=array('totalreceipt_sum'=>0,'totalfee_sum'=>0,'totalconcession_sum'=>0,'totallatefee_sum'=>0,'totalpayable_sum'=>0,'totalpaid_sum'=>0,'totalbal_sum'=>0,'totalexcess_sum'=>0,'totalcollect_sum'=>0); @endphp
                        @foreach($period as $date)
                            @php
                            $feecollectdate=$date->format('d-F-Y');
                            $fromdate=$date->format('Y-m-d');
                            $enddate=$date->format('Y-m-d');
                            $receiptsummary=['totalreceipt'=>0,'totalfee'=>0,'totalconcession'=>0,'totallatefee'=>0,'totalpayable'=>0,'totalpaid'=>0,'totalbal'=>0,'excessamt'=>0,'totalcollect'=>0];

                            /*
                             * fee collection table without relation
                             */
                            $feecollection=dbtablesum(\App\Models\MasterAdmin\Finance\StudentFeeCollection::class,['dbrow'=>'SUM(paid_amount) as totalcollect','search'=>['receipt_status'=>'paid'], 'customsearch' => [ 'whereBetween' => [ 'receipt_date' => [$fromdate,$enddate] ]]]);
                            $totalcollectamt=0; if(isset($feecollection->totalcollect)){ $totalcollectamt=$feecollection->totalcollect;}
                            /*
                             * fee instalment relation get details
                             */
                               $feecollectionsummary=dbtablesum(\App\Models\MasterAdmin\Finance\StudentFeeCollection::class
                               ,['search'=>['receipt_status'=>'paid'],'customsearch' => [ 'whereBetween' => [ 'receipt_date' => [$fromdate,$enddate] ]]

                               ,'join'=>['t1'=>['table'=>'finance_fee_collection_instalment_record','foreigntable'=>null,'foreign'=>'id','ownerkey'=>'fee_collection_id']]

                               ,'dbrow'=>'count(DISTINCT finance_fee_collection_record.id) as toalreceipt,SUM(t1.instalment_amount) as totalfee,SUM(t1.instalment_concession) as totalconcession
                               ,SUM(t1.instalment_fine) as totallatefee,SUM(t1.instalment_total_amount) as totalpayable,SUM(t1.instalment_paid) as totalpaid']);

                                if(isset($feecollectionsummary)){
                               $feecollectionsummary->totalfee ? $receiptsummary['totalfee'] +=$feecollectionsummary->totalfee : 0 ;
                               $feecollectionsummary->totalconcession ? $receiptsummary['totalconcession'] +=$feecollectionsummary->totalconcession : 0 ;
                               $feecollectionsummary->totallatefee ? $receiptsummary['totallatefee'] +=$feecollectionsummary->totallatefee : 0 ;
                               $feecollectionsummary->totalpayable ? $receiptsummary['totalpayable'] +=$feecollectionsummary->totalpayable : 0 ;
                               $feecollectionsummary->totalpaid ? $receiptsummary['totalpaid'] +=$feecollectionsummary->totalpaid : 0 ;
                               $feecollectionsummary->toalreceipt ? $receiptsummary['totalreceipt'] +=$feecollectionsummary->toalreceipt : 0 ;
                                }

                                $receiptsummary['totalbal'] +=$receiptsummary['totalpayable']-$receiptsummary['totalpaid'];
                                $receiptsummary['excessamt'] +=$totalcollectamt-$receiptsummary['totalpaid'];
                                $receiptsummary['totalcollect'] +=$receiptsummary['totalpaid']+$receiptsummary['excessamt'];
                                $totalsum['totalfee_sum'] +=$receiptsummary['totalfee'];
                                $totalsum['totalconcession_sum'] +=$receiptsummary['totalconcession'];
                                $totalsum['totallatefee_sum'] +=$receiptsummary['totallatefee'];
                                $totalsum['totalpayable_sum'] +=$receiptsummary['totalpayable'];
                                $totalsum['totalpaid_sum'] +=$receiptsummary['totalpaid'];
                                $totalsum['totalbal_sum'] +=$receiptsummary['totalpayable']-$receiptsummary['totalpaid'];
                                $totalsum['totalreceipt_sum'] +=$receiptsummary['totalreceipt'];
                                $totalsum['totalexcess_sum'] +=$receiptsummary['excessamt'];
                                $totalsum['totalcollect_sum'] +=$receiptsummary['totalcollect'];

                            @endphp
                            <tr>
                                <td class="text-center"><b>{{$loop->iteration}}</b></td>
                                <td class="text-center"><b>@if(isset($feecollectdate)){{$date->format('d-F-Y')}}@endif</b></td>
                                <td class="text-center">{{$receiptsummary['totalreceipt']}}</td>
                                <td class="text-right">{{numberformat($receiptsummary['totalfee'])}}</td>
                                <td class="text-right">{{numberformat($receiptsummary['totalconcession'])}}</td>
                                <td class="text-right">{{numberformat($receiptsummary['totallatefee'])}}</td>
                                <td class="text-right">{{numberformat($receiptsummary['totalpayable'])}}</td>
                                <td class="text-right">{{numberformat($receiptsummary['totalpaid'])}}</td>
                                <td class="text-right">{{numberformat($receiptsummary['totalbal'])}}</td>
                                <td class="text-right">{{numberformat($receiptsummary['excessamt'])}}</td>
                                <td class="text-right bg-success-light">{{numberformat($receiptsummary['totalcollect'])}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot class="bg-light">
                        <tr>
                            <td></td>
                            <td class="text-right"><b>Total :</b></td>
                            @foreach($totalsum as $totalcollectamt)
                                @if($loop->iteration==1)
                                    <td class="text-center"><b>{{$totalcollectamt}}</b></td>
                                @else
                                    <td class="text-right"><b>{{numberformat($totalcollectamt)}}</b></td>
                                @endif
                            @endforeach
                        </tr>
                        </tfoot>
                    </table>
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection
