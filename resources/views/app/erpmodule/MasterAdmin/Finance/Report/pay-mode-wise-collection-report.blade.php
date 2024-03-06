@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">Finance/Account</li>
            <li class="breadcrumb-item" aria-current="page">Reports</li>
            <li class="breadcrumb-item active" aria-current="page">Paymode Wise Fee Collection Report</li>
        </ol>
    </nav>

    <div class="col-lg-12  p-0 m-0 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i> Paymode Wise Fee Collection Report</b></div>
            <div class="panel-body tx-11 pd-b-5 row">
                <form class="container-fluid" action="{{url('MasterAdmin/Finance/PaymodeWiseFeeCollectionReport')}}" method="POST" enctype="multipart/form-data">
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
                    <table class="table datatable mg-t-10 table-bordered">
                        @php
                            $fromdate=nowdate(request()->get('from_date'),'Y-m-d');
                            $enddate=nowdate(request()->get('to_date'),'Y-m-d');
                            $totalsum=array('total_receipt'=>0,'total_collect'=>0);
                        @endphp
                        <thead class="bg-light">
                        <tr>
                            <th colspan="4"><b>Date Range : {{nowdate(request()->get('from_date'),'d-F-Y')}} - {{nowdate(request()->get('to_date'),'d-F-Y')}}</b></th>
                        </tr>
                        </thead>
                        <thead>
                        <tr>
                            <th class="text-center">#</th><th>Paymode</th><th class="text-center"><b>Total Receipt</b></th><th class="text-right">Fee Collect</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($paymodelist as $data)
                            @php
                                $feecollection=dbtablesum(\App\Models\MasterAdmin\Finance\StudentFeeCollection::class,['dbrow'=>'SUM(paid_amount) as totalcollect,count(id) as totalreceipt','search'=>['receipt_status'=>'paid','paymode_id'=>$data->id],'customsearch' => [ 'whereBetween' => [ 'receipt_date' => [$fromdate,$enddate] ]]]);
                                $totalcollect=0; if(isset($feecollection->totalcollect)){$totalcollect=$feecollection->totalcollect;}
                                $totalreceipt=0; if(isset($feecollection->totalreceipt)){$totalreceipt=$feecollection->totalreceipt;}
                                $totalsum['total_receipt'] +=$totalreceipt;
                                $totalsum['total_collect'] +=$totalcollect;

                            @endphp
                            <tr>
                                <td class="text-center">{{$loop->iteration}}</td><td>{{$data->paymode}}</td>
                                <td class="text-center">{{$totalreceipt}}</td>
                                <td class="text-right">{{numberformat($totalcollect)}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot class="bg-light">
                        <tr>
                            <td colspan="2" class="text-right"><b>Total Fee Collection :</b></td>
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
