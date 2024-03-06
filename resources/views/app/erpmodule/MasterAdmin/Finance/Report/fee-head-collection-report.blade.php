@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">Finance/Account</li>
            <li class="breadcrumb-item" aria-current="page">Reports</li>
            <li class="breadcrumb-item active" aria-current="page">Fee Head Wise Fee Collection Report</li>
        </ol>
    </nav>

    <div class="col-lg-12  p-0 m-0 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i> Fee Head Wise Fee Collection Report</b></div>
            <div class="panel-body tx-11 pd-b-5 row">
                <form class="container-fluid" action="{{url('MasterAdmin/Finance/FeeHeadCollectionReport')}}" method="POST" enctype="multipart/form-data">
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
                            <label><b>Fee Head :</b></label>
                            @include('components.Finance.fee-head-import',['selectid'=>request()->get('fee_head_id'),'search'=>['type'=>'opening-balance']])

                         </div>
                        <div class="col-lg-2">
                            <label><b>Paymode :</b></label>
                            @include('components.Finance.paymode-import',['selectid'=>request()->get('paymode_id')])
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
                @endphp
                <div class="col-lg-12 pd-t-10 bd-1 bd-t m-0 row">
                    <div class="col-lg-12 text-right">@include('layouts.actionbutton.action-button-verticle')</div>
                    <div class="col-lg-12 ">
                    <table id="example2" class="table datatable table-bordered">
                        <thead class="bg-light">
                        <th class="text-center">#</th>
                        <th>Fee Head</th>
                        <th class="text-right">Sub Total</th>
                        <th class="text-right">Concession</th>
                        <th class="text-right">Late Fee</th>
                        <th class="text-right">Total Payable</th>
                        <th class="text-right">Collect Amount</th>
                        <th>Balance</th>
                        </thead>

                        <tbody>
                        @php $totalsum=array('totalfee_sum'=>0,'totalconcession_sum'=>0,'totallatefee_sum'=>0,'totalpayable_sum'=>0,'totalpaid_sum'=>0,'totalbal_sum'=>0); @endphp
                        @foreach($feehead as $data)

                            @php
                                $receiptsummary=['totalfee'=>0,'totalconcession'=>0,'totallatefee'=>0,'totalpayable'=>0,'totalpaid'=>0,'totalbal'=>0];
                                $feecollectionsummary=dbtablesum(\App\Models\MasterAdmin\Finance\StudentFeeCollection::class
                               ,['search'=>$bladesearch,'joinsearch'=>['t1.fee_head_id'=>$data->id],'customsearch' => [ 'whereBetween' => [ 'receipt_date' => [$fromdate,$enddate] ]]

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
                                $receiptsummary['totalbal'] +=$receiptsummary['totalpayable']-$receiptsummary['totalpaid'];
                                $totalsum['totalfee_sum'] +=$receiptsummary['totalfee'];
                                $totalsum['totalconcession_sum'] +=$receiptsummary['totalconcession'];
                                $totalsum['totallatefee_sum'] +=$receiptsummary['totallatefee'];
                                $totalsum['totalpayable_sum'] +=$receiptsummary['totalpayable'];
                                $totalsum['totalpaid_sum'] +=$receiptsummary['totalpaid'];
                                $totalsum['totalbal_sum'] +=$receiptsummary['totalpayable']-$receiptsummary['totalpaid'];

                            @endphp

                        <tr>
                            <td class="text-center"><b>{{$loop->iteration}}</b></td>
                            <td>{{$data->fee_head}}</td>
                            @foreach($receiptsummary as $feeheadamt)
                                <td class="text-right">{{numberformat($feeheadamt)}}</td>
                            @endforeach
                        </tr>
                        @endforeach
                        </tbody>
                        <tfoot class="bg-light">
                        <tr>
                            <td colspan="2" class="text-right"><b>Total :</b></td>
                            @foreach($totalsum as $totalval)
                                <td class="text-right"><b>{{numberformat($totalval)}}</b></td>
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
