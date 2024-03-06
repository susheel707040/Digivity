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
            <thead class="tx-12">
            <tr>
                <th colspan="5"><b>Class/Course Collection Summary</b></th>
            </tr>
            <tr>
                <th>Class/Course</th>
                <th class="text-center">Recpt.</th>
                <th class="text-right">Total Fee</th>
                <th class="text-right">Concession</th>
                <th class="text-right">Collect Amt.</th>
            </tr>
            </thead>
            <tbody class="bg-light">
            @php $totalcourse=['total_recipt'=>0,'totalfee'=>0,'totalconcession'=>0,'total_sum'=>0]; @endphp
            @foreach($course as $data)
                @php
                    $feecollection=dbtablesum(\App\Models\MasterAdmin\Finance\StudentFeeCollection::class,['dbrow'=>'SUM(paid_amount) as totalcollect,SUM(fee_payable) as totalfee,SUM(concession_total) as totalconcession,count(id) as total_receipt','search'=>['course_id'=>$data->id,'receipt_status'=>'paid'], 'customsearch' => [ 'whereBetween' => [ 'receipt_date' => [nowdate($form_date,'Y-m-d'),nowdate($to_date,'Y-m-d')]]]]);
                    if(isset($feecollection->totalcollect)) { $totalcourse['total_sum'] +=$feecollection->totalcollect;}
                    if(isset($feecollection->total_receipt)) { $totalcourse['total_recipt'] +=$feecollection->total_receipt;}
                    if(isset($feecollection->totalfee)) { $totalcourse['totalfee'] +=$feecollection->totalfee;}
                    if(isset($feecollection->totalconcession)) { $totalcourse['totalconcession'] +=$feecollection->totalconcession;}
                @endphp
                <tr>
                    <td><b>{{$data->course}}</b></td>
                    <td class="text-center">@if(isset($feecollection->total_receipt)) {{$feecollection->total_receipt}} @else {{"0"}} @endif</td>
                    <td class="text-right">@if(isset($feecollection->totalfee)) {{numberformat($feecollection->totalfee,2)}} @else {{numberformat(0,2)}} @endif</td>
                    <td class="text-right">@if(isset($feecollection->totalconcession)) {{numberformat($feecollection->totalconcession,2)}} @else {{numberformat(0,2)}} @endif</td>
                    <td class="text-right">@if(isset($feecollection->totalcollect)) {{numberformat($feecollection->totalcollect,2)}} @else {{numberformat(0,2)}} @endif</td>
                </tr>
            @endforeach
            </tbody>
            <tfoot class="bg-light-dark tx-13">
            <tr>
                <td><b>Total :</b></td>
                <td class="text-center"><b>{{$totalcourse['total_recipt']}}</b></td>
                <td class="text-right"><b>{{numberformat($totalcourse['totalfee'],2)}}</b></td>
                <td class="text-right"><b>{{numberformat($totalcourse['totalconcession'],2)}}</b></td>
                <td class="text-right"><b>{{numberformat($totalcourse['total_sum'],2)}}</b></td>
            </tr>
            </tfoot>
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
                <th colspan="4"><b>Fee Head Collection Summary</b></th>
            </tr>
            <tr>
                <td><b>Fee Head</b></td>
                <th class="text-right">Total Fee</th>
                <th class="text-right">Concession</th>
                <th class="text-right">Collect Amt.</th>
            </tr>
            </thead>
            <tbody class="bg-light">
            @php $total=['totalfee'=>0,'totalconcession'=>0,'totalpaid'=>0] @endphp
            @foreach($feehead as $data)
                @php
                    $feecollectionsummary=dbtablesum(\App\Models\MasterAdmin\Finance\StudentFeeCollection::class
                    ,['search'=>['receipt_status'=>'paid'],'joinsearch'=>['t1.fee_head_id'=>$data->id],'customsearch' => [ 'whereBetween' => [ 'receipt_date' => [nowdate($form_date,'Y-m-d'),nowdate($to_date,'Y-m-d')] ]]

                    ,'join'=>['t1'=>['table'=>'finance_fee_collection_instalment_record','foreigntable'=>null,'foreign'=>'id','ownerkey'=>'fee_collection_id']]

                    ,'dbrow'=>'SUM(t1.instalment_amount) as totalfee,SUM(t1.instalment_concession) as totalconcession

                    ,SUM(t1.instalment_fine) as totallatefee,SUM(t1.instalment_total_amount) as totalpayable,SUM(t1.instalment_paid) as totalpaid']);
                    $feecollectionsummary->totalconcession ? $total['totalconcession'] +=$feecollectionsummary->totalconcession : 0 ;
                    //$feecollectionsummary->totallatefee ? $total['totallatefee'] +=$feecollectionsummary->totallatefee : 0 ;
                    $feecollectionsummary->totalpayable ? $total['totalfee'] +=$feecollectionsummary->totalpayable : 0 ;
                    $feecollectionsummary->totalpaid ? $total['totalpaid'] +=$feecollectionsummary->totalpaid : 0 ;

                @endphp
                <tr>
                    <td><b>{{$data->fee_head}}</b></td>
                    <td class="text-right">@if(isset($feecollectionsummary->totalpayable)) {{numberformat($feecollectionsummary->totalpayable,2)}} @else {{"0"}} @endif</td>
                    <td class="text-right">@if(isset($feecollectionsummary->totalconcession)) {{numberformat($feecollectionsummary->totalconcession,2)}} @else {{"0"}} @endif</td>
                    <td class="text-right">@if(isset($feecollectionsummary->totalpaid)) {{numberformat($feecollectionsummary->totalpaid,2)}} @else {{"0"}} @endif</td>
                </tr>
            @endforeach
            </tbody>
            <tfoot class="bg-light-dark tx-13">
            <tr>
                <td><b>Total :</b></td>
                @foreach($total as $value)
                <td class="text-right"><b>{{numberformat($value,2)}}</b></td>
                @endforeach
            </tr>
            </tfoot>
        </table>
    </div>
@endsection
