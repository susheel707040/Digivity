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
