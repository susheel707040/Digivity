@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">Finance/Account</li>
            <li class="breadcrumb-item" aria-current="page">Reports</li>
            <li class="breadcrumb-item active" aria-current="page">DayBook Report</li>
        </ol>
    </nav>

    <div class="col-lg-12  p-0 m-0 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i> DayBook Report</b></div>
            <div class="panel-body tx-11 pd-b-5 row">
                <form class="container-fluid" action="{{url('MasterAdmin/Finance/DaybookReport')}}" method="POST" enctype="multipart/form-data">
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
                        <button type="submit" class="btn btn-primary mg-t-20"><i class="fa fa-search"></i> Get Result</button>
                    </div>
                </div>
                </form>

                @php
                /*
                * fianance get details
                */
                $fromdate=nowdate(request()->get('from_date'),'Y-m-d');
                $enddate=nowdate(request()->get('to_date'),'Y-m-d');

                $feecollection=dbtablesum(\App\Models\MasterAdmin\Finance\StudentFeeCollection::class,['dbrow'=>'SUM(paid_amount) as totalcollect,count(id) as totalreceipt','search'=>['receipt_status'=>'paid'],'customsearch' => [ 'whereBetween' => [ 'receipt_date' => [$fromdate,$enddate] ]]]);
                $totalcollect=0; if(isset($feecollection->totalcollect)){$totalcollect=$feecollection->totalcollect;}
                $totalreceipt=0; if(isset($feecollection->totalreceipt)){$totalreceipt=$feecollection->totalreceipt;}

                $totalexpense=0;
                $totalvoucher=0;
                @endphp

                <div class="col-lg-12 pd-t-10 bd-1 bd-t m-0 row">
                    <div class="col-lg-12 text-right">@include('layouts.actionbutton.action-button-verticle')</div>
                    <table cellspacing="0" cellpadding="0" class="table datatable table-bordered">
                        <tr>
                            <td>
                                <div class="col-lg-12 m-0 p-0">
                                    <table class="table table-bordered">
                                        <tr class="bg-light">
                                            <td colspan="4"><b>Date Range :</b> {{nowdate(request()->get('from_date'),'d-M-Y')}} - {{nowdate(request()->get('to_date'),'d-M-Y')}}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Total Receipt : {{$totalreceipt}}</b></td>
                                            <td><b>Total Fee Collection Amount : {{numberformat($totalcollect)}}</b></td>
                                            <td><b>Total Voucher : {{$totalvoucher}}</b></td>
                                            <td><b>Total Expense Amount : {{$totalexpense}}</b></td>
                                        </tr>
                                    </table>

                                    <table cellpadding="0" cellspacing="0" class="table p-0 m-0">
                                        <tr>
                                            <td class="wd-30p p-0 bd-0 bd-t m-0" style="vertical-align:top; border:0; ">
                                                <table class="table table-bordered">
                                                    <thead class="bg-light">
                                                    <tr>
                                                        <th colspan="2">Paymode Wise Fee Collect</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td><b>Paymode</b></td>
                                                        <td class="text-right"><b>Amount</b></td>
                                                    </tr>
                                                    </tbody>
                                                    <tbody>
                                                    @php $totalpaymode=0; @endphp
                                                    @foreach($paymode as $data)
                                                        @php
                                                            $feecollection=dbtablesum(\App\Models\MasterAdmin\Finance\StudentFeeCollection::class,['dbrow'=>'SUM(paid_amount) as totalcollect','search'=>['paymode_id'=>$data->id,'receipt_status'=>'paid'], 'customsearch' => [ 'whereBetween' => [ 'receipt_date' => [$fromdate,$enddate] ]]]);
                                                            $paymodeamount=0; if(isset($feecollection->totalcollect)) { $paymodeamount +=$feecollection->totalcollect; $totalpaymode +=$feecollection->totalcollect;}
                                                        @endphp
                                                        <tr>
                                                            <td><b>{{$data->paymode}}</b></td><td class="text-right">{{numberformat($paymodeamount)}}</td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                    <tfoot class="bg-light">
                                                    <tr>
                                                        <td><b>Total</b></td><td class="text-right"><b>{{numberformat($totalpaymode)}}</b></td>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </td>

                                            <td class=" m-0 pd-r-0" style=" padding-top:0; padding-left:20px;  border:0; vertical-align:top;">
                                                <table class="table  p-0 table-bordered">
                                                    <thead class="bg-light">
                                                    <tr>
                                                        <th colspan="8">Course Wise Fee Collect</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td><b>Course</b></td><td><b>Fee Amount</b></td><td><b>Concession</b></td><td><b>Collect Amount</b></td>
                                                        <td><b>Course</b></td><td><b>Fee Amount</b></td><td><b>Concession</b></td><td><b>Amount</b></td>
                                                    </tr>
                                                    </tbody>
                                                    <tbody>
                                                    @php $total=['totalfee'=>0,'totalconcession'=>0,'totalcollect'=>0] @endphp
                                                    @foreach(courselist() as $data)

                                                        @php
                                                            $feecollection=dbtablesum(\App\Models\MasterAdmin\Finance\StudentFeeCollection::class,['dbrow'=>'SUM(concession_total) as totalconcession,SUM(paid_amount) as totalcollect,SUM(fee_payable) as totalfee,count(id) as totalreceipt','search'=>['receipt_status'=>'paid','course_id'=>$data->id],'customsearch' => [ 'whereBetween' => [ 'receipt_date' => [$fromdate,$enddate] ]]]);
                                                            if(isset($feecollection->totalfee)){$total['totalfee'] +=$feecollection->totalfee;}
                                                            if(isset($feecollection->totalconcession)){$total['totalconcession'] +=$feecollection->totalconcession;}
                                                            if(isset($feecollection->totalcollect)){$total['totalcollect'] +=$feecollection->totalcollect;}
                                                        @endphp

                                                        @if($loop->iteration % 2!=0)
                                                            <tr>
                                                                @endif

                                                                @if($loop->iteration % 2!=0)
                                                                    <td>{{$data->course}}</td>
                                                                    <td class="text-right">@if(isset($feecollection->totalfee)){{numberformat($feecollection->totalfee,2)}}@else{{"0"}}@endif</td>
                                                                    <td class="text-right">@if(isset($feecollection->totalconcession)){{numberformat($feecollection->totalconcession,2)}}@else{{"0"}}@endif</td>
                                                                    <td class="text-right">@if(isset($feecollection->totalcollect)){{numberformat($feecollection->totalcollect,2)}}@else{{"0"}}@endif</td>
                                                                @endif

                                                                @if($loop->iteration % 2==0)
                                                                    <td>{{$data->course}}</td>
                                                                    <td class="text-right">@if(isset($feecollection->totalfee)){{numberformat($feecollection->totalfee,2)}}@else{{"0"}}@endif</td>
                                                                    <td class="text-right">@if(isset($feecollection->totalconcession)){{numberformat($feecollection->totalconcession,2)}}@else{{"0"}}@endif</td>
                                                                    <td class="text-right">@if(isset($feecollection->totalcollect)){{numberformat($feecollection->totalcollect,2)}}@else{{"0"}}@endif</td>
                                                                @endif

                                                                @if($loop->iteration % 2==0)
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                    </tbody>
                                                    <tfoot class="bg-light">
                                                    <tr>
                                                        <td colspan="8"><b><span class="pd-r-10">Total Fee :{{numberformat($total['totalfee'],2)}} </span>|<span class="pd-l-10 pd-r-10"> Total Concession Amount : {{numberformat($total['totalconcession'],2)}} </span>| <span class="pd-l-10">Total Collection Amount : {{numberformat($total['totalcollect'],2)}}</span> </b></td>
                                                    </tr>
                                                    </tfoot>
                                                </table>

                                            </td>
                                        </tr>
                                    </table>

                                    <table class="table table-bordered">
                                        <thead class="bg-light">
                                        <tr>
                                            <th colspan="8">Fee Head Wise Fee Collect</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td><b>Fee Head</b></td>
                                            <td class="text-right"><b>Fee Total</b></td>
                                            <td class="text-right"><b>Concession</b></td>
                                            <td class="text-right"><b>Late Fee</b></td>
                                            <td class="text-right"><b>Fee Payable Amount</b></td>
                                            <td class="text-right"><b>Collect Amount</b></td>
                                        </tr>
                                        </tbody>
                                        <tbody>
                                        @php $totalsum=array('totalfee_sum'=>0,'totalconcession_sum'=>0,'totallatefee_sum'=>0,'totalpayable_sum'=>0,'totalpaid_sum'=>0); @endphp
                                        @foreach($feehead as $data)
                                            @php
                                                $receiptsummary=['totalfee'=>0,'totalconcession'=>0,'totallatefee'=>0,'totalpayable'=>0,'totalpaid'=>0];
                                                $feecollectionsummary=dbtablesum(\App\Models\MasterAdmin\Finance\StudentFeeCollection::class
                                               ,['search'=>['receipt_status'=>'paid'],'joinsearch'=>['t1.fee_head_id'=>$data->id],'customsearch' => [ 'whereBetween' => [ 'receipt_date' => [$fromdate,$enddate] ]]

                                               ,'join'=>['t1'=>['table'=>'finance_fee_collection_instalment_record','foreigntable'=>null,'foreign'=>'id','ownerkey'=>'fee_collection_id']]

                                               ,'dbrow'=>'SUM(t1.instalment_amount) as totalfee,SUM(t1.instalment_concession) as totalconcession
                                               ,SUM(t1.instalment_fine) as totallatefee,SUM(t1.instalment_total_amount) as totalpayable,SUM(t1.instalment_paid) as totalpaid']);

                                                if(isset($feecollectionsummary)){
                                $feecollectionsummary->totalfee ? $receiptsummary['totalfee'] +=$feecollectionsummary->totalfee : 0 ;
                                $feecollectionsummary->totalconcession ? $receiptsummary['totalconcession'] +=$feecollectionsummary->totalconcession : 0 ;
                                $feecollectionsummary->totallatefee ? $receiptsummary['totallatefee'] +=$feecollectionsummary->totallatefee : 0 ;
                                $feecollectionsummary->totalpayable ? $receiptsummary['totalpayable'] +=$feecollectionsummary->totalpayable : 0 ;
                                $feecollectionsummary->totalpaid ? $receiptsummary['totalpaid'] +=$feecollectionsummary->totalpaid : 0 ;
                            }
                                                $totalsum['totalfee_sum'] +=$receiptsummary['totalfee'];
                                                $totalsum['totalconcession_sum'] +=$receiptsummary['totalconcession'];
                                                $totalsum['totallatefee_sum'] +=$receiptsummary['totallatefee'];
                                                $totalsum['totalpayable_sum'] +=$receiptsummary['totalpayable'];
                                                $totalsum['totalpaid_sum'] +=$receiptsummary['totalpaid'];

                                            @endphp

                                            @if(($receiptsummary['totalfee']))
                                                <tr>
                                                    <td>{{$data->fee_head}}</td>
                                                    <td class="text-right">{{numberformat($receiptsummary['totalfee'])}}</td>
                                                    <td class="text-right">{{numberformat($receiptsummary['totalconcession'])}}</td>
                                                    <td class="text-right">{{numberformat($receiptsummary['totallatefee'])}}</td>
                                                    <td class="text-right">{{numberformat($receiptsummary['totalpayable'])}}</td>
                                                    <td class="text-right">{{numberformat($receiptsummary['totalpaid'])}}</td>
                                                </tr>
                                            @endif

                                        @endforeach
                                        </tbody>
                                        <tfoot class="bg-light">
                                        <tr>
                                            <td><b>Total</b></td>
                                            @foreach($totalsum as $value)
                                                <td class="text-right"><b>{{numberformat($value)}}</b></td>
                                            @endforeach
                                        </tr>
                                        </tfoot>
                                    </table>

                                </div>
                            </td>
                        </tr>
                    </table>


                </div>
            </div>
        </div>
    </div>

@endsection
