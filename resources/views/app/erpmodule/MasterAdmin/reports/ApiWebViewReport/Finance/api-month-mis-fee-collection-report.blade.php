@extends('layouts.api-web-view-master-layout')
@section('content')
    <div class='col-12 p-2 tx-13'>
        <table cellpadding='0' cellspacing='0' class='table table-bordered bg-light-dark'>
            <tbody>
            <tr>
                <td colspan="2"><b>Result Date :</b> {{$form_date}} to {{$to_date}}</td>
            </tr>
            </tbody>
        </table>
    </div>

    @php
        $totalcollection=0;
        $monthperiod = \Carbon\CarbonPeriod::create(nowdate($form_date,'Y-m-d'), '1 month',nowdate($to_date,'Y-m-d'));
    @endphp
    <div class='col-12 p-2 bg-light'>
        <table class="table border table-bordered bg-light">
            <thead class="tx-12 bg-light-dark">
            <tr>
                <th colspan="5"><b>Month Mis Fee Collection Summary</b></th>
            </tr>
            <tr>
                <th>Month-Year</th>
                <th class="text-center">Recpt.</th>
                <th class="text-right">Total Fee</th>
                <th class="text-right">Concession</th>
                <th class="text-right">Collect Amt.</th>
            </tr>
            </thead>
            <tbody>
            @php $total=['receipt'=>0,'totalfee'=>0,'totalconcession'=>0,'totalcollect'=>0] @endphp
            @foreach($monthperiod as $monthyear)
                @php
                    $fromdate=$monthyear->format("Y-m")."-"."1";
                    $enddate=$monthyear->format("Y-m")."-"."31";
                    $feecollection=dbtablesum(\App\Models\MasterAdmin\Finance\StudentFeeCollection::class,['dbrow'=>'SUM(paid_amount) as totalcollect,SUM(concession_total) as totalconcession,SUM(fee_payable) as totalpayablefee,count(id) as totalreceipt','search'=>['receipt_status'=>'paid'],'customsearch' => [ 'whereBetween' => [ 'receipt_date' => [$fromdate,$enddate] ]]]);
                    if(isset($feecollection->totalreceipt)){$total['receipt'] +=$feecollection->totalreceipt;}
                    if(isset($feecollection->totalpayablefee)){$total['totalfee'] +=$feecollection->totalpayablefee;}
                    if(isset($feecollection->totalconcession)){$total['totalconcession'] +=$feecollection->totalconcession;}
                    if(isset($feecollection->totalcollect)){$total['totalcollect'] +=$feecollection->totalcollect;}
                @endphp
            <tr>
                <td><b>{{$monthyear->format("F-Y")}}</b></td>
                <td class="text-center">@if(isset($feecollection->totalreceipt)){{$feecollection->totalreceipt}}@else{{"0.00"}}@endif</td>
                <td class="text-right">@if(isset($feecollection->totalpayablefee)){{numberformat($feecollection->totalpayablefee,2)}}@else{{"0.00"}}@endif</td>
                <td class="text-right">@if(isset($feecollection->totalconcession)){{numberformat($feecollection->totalconcession,2)}}@else{{"0.00"}}@endif</td>
                <td class="text-right">@if(isset($feecollection->totalcollect)){{numberformat($feecollection->totalcollect,2)}}@else{{"0.00"}}@endif</td>
            </tr>
            @endforeach
            </tbody>
            <tfoot class="bg-light-dark">
            <tr>
                <td><b>Total :</b></td>
                <td class="text-center"><b>{{$total['receipt']}}</b></td>
                <td class="text-right"><b>{{numberformat($total['totalfee'],2)}}</b></td>
                <td class="text-right"><b>{{numberformat($total['totalconcession'],2)}}</b></td>
                <td class="text-right"><b>{{numberformat($total['totalcollect'],2)}}</b></td>
            </tr>
            </tfoot>
        </table>
    </div>


    @foreach($monthperiod as $monthyear)
    <div class='col-12 p-2'>
        <table class="table border table-bordered bg-light">
            <thead class="tx-12 bg-light-dark">
            <tr>
                <th colspan="5"><b>{{$monthyear->format("F-Y")}}, Daywise Fee Collection Summary</b></th>
            </tr>
            <tr>
                <th>Date</th>
                <th class="text-center">Recpt.</th>
                <th class="text-right">Total Fee</th>
                <th class="text-right">Concession</th>
                <th class="text-right">Collect Amt.</th>
            </tr>
            </thead>
            <tbody>
            @php $total=['receipt'=>0,'totalfee'=>0,'totalconcession'=>0,'totalcollect'=>0] @endphp
            @for($i=1;$i<=31;$i++)
                @php
                    $fromdate=nowdate($monthyear->format("Y-m")."-".$i,'Y-m-d');
                    $dateexist=\Carbon\Carbon::parse($fromdate)->toDateString();
                    $enddate=nowdate($monthyear->format("Y-m")."-".$i,'Y-m-d');
                @endphp
                @if($fromdate==nowdate($dateexist,'Y-m-d'))
                    @php
                        $feecollection=dbtablesum(\App\Models\MasterAdmin\Finance\StudentFeeCollection::class,['dbrow'=>'SUM(paid_amount) as totalcollect,SUM(concession_total) as totalconcession,SUM(fee_payable) as totalpayablefee,count(id) as totalreceipt','search'=>['receipt_status'=>'paid'],'customsearch' => [ 'whereBetween' => [ 'receipt_date' => [$fromdate,$enddate] ]]]);
                        if(isset($feecollection->totalreceipt)){$total['receipt'] +=$feecollection->totalreceipt;}
                        if(isset($feecollection->totalpayablefee)){$total['totalfee'] +=$feecollection->totalpayablefee;}
                        if(isset($feecollection->totalconcession)){$total['totalconcession'] +=$feecollection->totalconcession;}
                        if(isset($feecollection->totalcollect)){$total['totalcollect'] +=$feecollection->totalcollect;}
                    @endphp

                <tr>
                    <td>{{nowdate($fromdate,'d-M-Y')}}</td>
                    <td class="text-center">@if(isset($feecollection->totalreceipt)){{$feecollection->totalreceipt}}@else{{"0.00"}}@endif</td>
                    <td class="text-right">@if(isset($feecollection->totalpayablefee)){{numberformat($feecollection->totalpayablefee,2)}}@else{{"0.00"}}@endif</td>
                    <td class="text-right">@if(isset($feecollection->totalconcession)){{numberformat($feecollection->totalconcession,2)}}@else{{"0.00"}}@endif</td>
                    <td class="text-right">@if(isset($feecollection->totalcollect)){{numberformat($feecollection->totalcollect,2)}}@else{{"0.00"}}@endif</td>
                </tr>
                @endif
            @endfor
            </tbody>
            <tfoot class="bg-light-dark">
            <tr>
                <td><b>Total :</b></td>
                <td class="text-center"><b>{{$total['receipt']}}</b></td>
                <td class="text-right"><b>{{numberformat($total['totalfee'],2)}}</b></td>
                <td class="text-right"><b>{{numberformat($total['totalconcession'],2)}}</b></td>
                <td class="text-right"><b>{{numberformat($total['totalcollect'],2)}}</b></td>
            </tr>
            </tfoot>
        </table>
    </div>
    @endforeach


@endsection
