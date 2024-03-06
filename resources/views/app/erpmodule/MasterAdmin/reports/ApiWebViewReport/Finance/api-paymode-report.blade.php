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


    <div class='col-12 p-2'>
        <table class="table border table-bordered bg-light-dark">
            <thead class="tx-13">
            <tr>
                <th colspan="3">Paymode Collection Summary</th>
            </tr>
            <tr>
                <td><b>Paymode</b></td>
                <td class="text-center"><b>Total Receipt</b></td>
                <td class="text-right"><b>Collect Amount</b></td>
            </tr>
            </thead>
            <tbody class="bg-light">
            @php $total=['total_recipt'=>0,'total_sum'=>0]; @endphp
            @foreach($paymode as $data)
                @php
                    $feecollection=dbtablesum(\App\Models\MasterAdmin\Finance\StudentFeeCollection::class,['dbrow'=>'SUM(paid_amount) as totalcollect,count(id) as total_receipt','search'=>['paymode_id'=>$data->id,'receipt_status'=>'paid'], 'customsearch' => [ 'whereBetween' => [ 'receipt_date' => [nowdate($form_date,'Y-m-d'),nowdate($to_date,'Y-m-d')]]]]);
                    if(isset($feecollection->totalcollect)) { $total['total_sum'] +=$feecollection->totalcollect;}
                    if(isset($feecollection->total_receipt)) { $total['total_recipt'] +=$feecollection->total_receipt;}
                @endphp
                <tr>
                    <td><b>{{$data->paymode}}</b></td>
                    <td class="text-center">@if(isset($feecollection->total_receipt)){{$feecollection->total_receipt}}@else{{"0"}}@endif</td>
                    <td class="text-right">@if(isset($feecollection->totalcollect)){{numberformat($feecollection->totalcollect,2)}}@else{{numberformat(0,2)}}@endif</td>
                </tr>
            @endforeach
            </tbody>
            <tfoot class="bg-light-dark tx-13">
            <tr>
                <td><b>Total :</b></td>
                <td class="text-center"><b>{{$total['total_recipt']}}</b></td>
                <td class="text-right"><b>{{numberformat($total['total_sum'],2)}}</b></td>
            </tr>
            </tfoot>
        </table>
    </div>


    <div class='col-12 p-2'>
        <table class="table border table-bordered bg-light-dark">
            <thead class="tx-13">
            <tr>
                <th colspan="{{count($paymode)+2}}">Paymode Date Wise Collection Summary</th>
            </tr>
            <tr class="tx-11">
                <td><b>Date</b></td>
                @php $total=array(); @endphp
                @foreach($paymode as $data)
                @php $total=array_merge($total,['total_'.$data->id=>0]); @endphp
                <td class="text-right"><b>{{$data->paymode}}</b></td>
                @endforeach
                @php $total=array_merge($total,['total'=>0]); @endphp
                <td class="text-right"><b>Total</b></td>
            </tr>
            </thead>
            @php
             $period = \Carbon\CarbonPeriod::create(nowdate($form_date,'Y-m-d'), nowdate($to_date,'Y-m-d'));
            @endphp
            <tbody class="tx-11">
            @foreach($period as $date)
                @php
                    $feecollectdate=$date->format('d-M-Y');
                @endphp
            <tr>
                <td><b>{{$feecollectdate}}</b></td>
                @php $totalsum=0; @endphp
                @foreach($paymode as $data)
                    @php
                    $fromdate=nowdate($feecollectdate,'Y-m-d');
                    $enddate=nowdate($feecollectdate,'Y-m-d');
                    $feecollection=dbtablesum(\App\Models\MasterAdmin\Finance\StudentFeeCollection::class,['dbrow'=>'SUM(paid_amount) as totalcollect,count(id) as totalreceipt','search'=>['receipt_status'=>'paid','paymode_id'=>$data->id],'customsearch' => [ 'whereBetween' => [ 'receipt_date' => [$fromdate,$enddate] ]]]);
                    if(isset($feecollection->totalcollect)){
                        $total['total_'.$data->id] +=$feecollection->totalcollect;
                        $total['total'] +=$feecollection->totalcollect;
                        $totalsum +=$feecollection->totalcollect;
                    }
                    @endphp
                <td class="text-right">@if(isset($feecollection->totalcollect)){{numberformat($feecollection->totalcollect,2)}}@else{{"0"}}@endif</td>
                @endforeach
                <td class="text-right"><b>{{numberformat($totalsum,2)}}</b></td>
            </tr>
            @endforeach
            </tbody>
            <tfoot class="tx-11">
            <tr class="text-right">
                <td><b>Total :</b></td>
                @foreach($total as $value)
                <td><b>{{numberformat($value,2)}}</b></td>
                @endforeach
            </tr>
            </tfoot>
        </table>
    </div>

@endsection
