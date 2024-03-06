@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">Finance/Account</li>
            <li class="breadcrumb-item" aria-current="page">Reports</li>
            <li class="breadcrumb-item active" aria-current="page">Fee Head Wise Fee Instalment Collection Report</li>
        </ol>
    </nav>

    <div class="col-lg-12  p-0 m-0 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i> Fee Head Wise Fee Instalment Collection Report</b></div>
            <div class="panel-body tx-11 pd-b-5 row">

                <form class="container-fluid" action="{{url('MasterAdmin/Finance/FeeHeadInstalmentCollectionReport')}}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="col-lg-12 pd-b-15 row m-0">
                        <div class="col-lg-1 pd-l-0 pd-r-5">
                            <label><b>Class/Course :</b></label>
                            @include('components.course-import',['selectid'=>request()->get('course_id')])
                        </div>
                        <div class="col-lg-1 pd-l-0 pd-r-5">
                            <label><b>Section :</b></label>
                            @include('components.section-import',['selectid'=>request()->get('section_id')])
                        </div>
                        <div class="col-lg-1 pd-l-0 pd-r-5">
                            <label><b>From Date :</b></label>
                            <input type="text" name="from_date" class="form-control1 date" value="{{nowdate(request()->get('from_date'),'d-m-Y')}}">
                        </div>
                        <div class="col-lg-1 pd-l-5 pd-r-0">
                            <label><b>To Date :</b></label>
                            <input type="text" name="to_date" class="form-control1 date" value="{{nowdate(request()->get('to_date'),'d-m-Y')}}">
                        </div>
                        <div class="col-lg-2">
                            <label><b>Fee Head :</b></label>
                            @include('components.Finance.fee-head-import',['selectid'=>request()->get('fee_head_id')])
                        </div>
                        <div class="col-lg-1 pd-l-0 pd-r-5">
                            <label><b>Instalment :</b></label>
                            @include('components.Finance.fee-head-instalment-group-import',['selectid'=>request()->get('instalment_id')])
                        </div>
                        <div class="col-lg-1 pd-l-5 pd-r-0">
                            <label><b>Paymode :</b></label>
                            @include('components.Finance.paymode-import',['selectid'=>request()->get('paymode_id')])
                        </div>
                        <div class="col-lg-2">
                            <label>With Report :</label>
                            <table class="tx-11">
                                <tr>
                                    <td><input type="checkbox" name="with_concession" value="yes" @if(request()->get('with_concession')=="yes") checked @endif></td><td class="pd-l-5">Concession</td>
                                    <td class="pd-l-10"><input type="checkbox" name="with_late_fee" value="yes" @if(request()->get('with_late_fee')=="yes") checked @endif></td><td class="pd-l-5">Late Fee</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-lg-2">
                            <button type="submit" class="btn btn-primary mg-t-20"><i class="fa fa-search"></i> Get Result</button>
                        </div>
                    </div>
                </form>

                @php
                    $fromdate=nowdate(request()->get('from_date'),'Y-m-d');
                    $enddate=nowdate(request()->get('to_date'),'Y-m-d');
                @endphp
                <div class="col-lg-12 bd-1 bd-t">
                    <div class="col-lg-12 text-right">@include('layouts.actionbutton.action-button-verticle')</div>
                    <div class="col-lg-12 ">
                    <table  class="table datatable table-bordered mg-t-10">
                        <thead class="bg-light">
                        <tr>
                            <th rowspan="2" class="align-middle">Fee Head</th><th colspan="{{count($feeheadinstalmentgroup)+1}}"><b>Fee Instalment</b></th>
                        </tr>
                        <tr>
                            @php $total=array(); @endphp
                            @foreach($feeheadinstalmentgroup as $data1)
                                @php $total +=['total_'.$data1->instalment_unique_id.''=>0]; @endphp
                                <th class="text-right"><b>{{ucwords($data1->instalment_unique_id)}}</b></th>
                            @endforeach
                            @php $total +=['total'=>0]; @endphp
                                <th class="text-right"><b>Total</b></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($feehead as $data)
                        <tr>
                            <td><b>{{$data->fee_head}}</b></td>
                            @php $subtotal=0; @endphp
                            @foreach($feeheadinstalmentgroup as $data1)
                                @php

                                $receiptsummary=['totalfee'=>0,'totalconcession'=>0,'totallatefee'=>0,'totalpayable'=>0,'totalpaid'=>0];

                                $feecollectionsummary=dbtablesum(\App\Models\MasterAdmin\Finance\StudentFeeCollection::class
                                ,['search'=>$bladesearch,'joinsearch'=>['t1.instalment_unique_id'=>$data1->instalment_unique_id,'t1.fee_head_id'=>$data->id],'customsearch' => [ 'whereBetween' => [ 'receipt_date' => [$fromdate,$enddate] ]]

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

                                if(request()->get('with_concession')=="yes" && request()->get('with_late_fee')=="yes"){
                                  $total['total'] +=$receiptsummary['totalpaid'];
                                  $instalment_paid=$receiptsummary['totalpaid'];
                                  $total['total_'.$data1->instalment_unique_id.''] +=$receiptsummary['totalpaid'];
                                  $subtotal +=$receiptsummary['totalpaid'];
                                }else{
                                    $total['total'] +=$receiptsummary['totalfee'];
                                    $instalment_paid=$receiptsummary['totalfee'];
                                    $total['total_'.$data1->instalment_unique_id.''] +=$receiptsummary['totalfee'];
                                    $subtotal +=$receiptsummary['totalfee'];
                                }



                                @endphp
                                <td class="text-right">{{numberformat($instalment_paid)}}</td>
                            @endforeach
                            <td class="text-right bg-success-light"><b>{{numberformat($subtotal)}}</b></td>
                        </tr>
                        @endforeach
                        </tbody>
                        <tfoot class="bg-success-light">
                        <td class="text-right"><b>Total Collect Payment :</b></td>
                        @foreach($total as $totalamt)
                        <td class="text-right"><b>{{numberformat($totalamt)}}</b></td>
                        @endforeach
                        </tfoot>
                    </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
