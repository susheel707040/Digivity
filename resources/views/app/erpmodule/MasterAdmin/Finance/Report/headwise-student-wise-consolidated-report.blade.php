@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">Finance/Account</li>
            <li class="breadcrumb-item" aria-current="page">Reports</li>
            <li class="breadcrumb-item active" aria-current="page">Headwise Collection (Student wise Detailed Consolidated Transaction)</li>
        </ol>
    </nav>
    <div class="col-lg-12 p-0 m-0 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i> Headwise Collection (Student wise Detailed Consolidated Transaction</b></div>
            <div class="panel-body pd-b-10 p-0 row">
                <form action="{{url('MasterAdmin/Finance/HeadWiseStudentConsolidatedReport')}}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="row col-lg-12  pd-b-10 m-0">
                        <div class="col-lg-2">
                            <label><b>Entry Mode :</b></label>
                            @include('components.Finance.entry-mode-import',['selectid'=>request()->get('entry_mode')])
                        </div>
                        <div class="col-lg-2">
                            <label><b>Receipt From Date :</b></label>
                            <input placeholder="dd-mm-yyyy" name="from_date" type="text" value="{{nowdate(request()->get('from_date'),'d-m-Y')}}" class="form-control1 date input-sm">
                        </div>
                        <div class="col-lg-2">
                            <label><b>Receipt To Date :</b></label>
                            <input placeholder="dd-mm-yyyy" name="to_date" type="text" value="{{nowdate(request()->get('to_date'),'d-m-Y')}}" class="form-control1 date input-sm">
                        </div>
                        <div class="col-lg-2">
                            <label><b>Paymode :</b></label>
                            @include('components.Finance.paymode-import',['selectid'=>request()->get('paymode_id')])
                        </div>
                        <div class="col-lg-2">
                            <label><b>Receipt Status :</b></label>
                            @include('components.Finance.receipt-status-import',['selectid'=>request()->get('receipt_status')])
                        </div>
                        <div class="col-lg-2">
                            <label><b>Instrument No. :</b></label>
                            <input placeholder="Enter Instrument No." name="instrument_no" value="{{request()->get('instrument_no')}}" type="text" class="form-control1 input-sm">
                        </div>
                        <div class="col-lg-2">
                            <label><b>Class/Course :</b></label>
                            @include('components.course-import',['selectid'=>request()->get('course_id')])
                        </div>
                        <div class="col-lg-2">
                            <label><b>Section :</b></label>
                            @include('components.section-import',['selectid'=>request()->get('section_id')])
                        </div>
                        <div class="clearfix"></div>
                        <div><button type="submit" class="btn btn-primary mg-t-20"><i class="fa fa-search"></i> Get Result</button></div>
                    </div>
                </form>

                @if(isset($feecollection))

                    @php
                        //define fee head amount
                        function feeheadamount($feecollectionid,$feeheadid){

                          $feecollectionsummary=dbtablesum(\App\Models\MasterAdmin\Finance\StudentFeeCollection::class
                                               ,['search'=>['receipt_status'=>'paid'],'joinsearch'=>['t1.fee_head_id'=>$feeheadid,'finance_fee_collection_record.id'=>$feecollectionid]

                                               ,'join'=>['t1'=>['table'=>'finance_fee_collection_instalment_record','foreigntable'=>null,'foreign'=>'id','ownerkey'=>'fee_collection_id']]

                                               ,'dbrow'=>'SUM(t1.instalment_amount) as totalfee,SUM(t1.instalment_concession) as totalconcession
                                               ,SUM(t1.instalment_fine) as totallatefee,SUM(t1.instalment_total_amount) as totalpayable,SUM(t1.instalment_paid) as totalpaid']);

                          $feeheadtotal=0; isset($feecollectionsummary['totalpaid']) ? $feeheadtotal=$feecollectionsummary['totalpaid'] : $feeheadtotal=0;

                        return $feeheadtotal;
                        }
                        //total foot sum
                        $toalfeehead=[];
                        $totalpaymode=[];
                    @endphp


                    <div class="row col-lg-12 m-0 bd-1 bd-t">
                        <div class="col-lg-12 text-right">@include('layouts.actionbutton.action-button-verticle')</div>
                        <table  datasum="true" colsum="8,9,10,11,12,13" class="table bg-white datatable mg-t-15 tx-11 table-bordered">

                            <thead>
                            <tr>
                                <td class='text-center' colspan='21'><b>Headwise Collection (Student wise Detailed Consolidated Transactions)</b></td>
                            </tr>
                            <tr>
                                <td colspan='10'>
                                    <b>Session : </b> 2020-2021<br/>
                                    <b>Period From : {{request()->get('from_date')}} To {{request()->get('to_date')}}</b> <br/>

                                </td>
                                <td colspan='11' class='text-right'><b>Print Date : {{nowdate('','d-M-Y')}}</b></td>
                            </tr>
                            </thead>

                            <thead class="bg-light tx-12 text-center">
                            <tr>
                                <th colspan="21">Collection</th>
                            </tr>
                            </thead>
                            <thead class="bg-light">
                            <tr>
                                <th class="text-center">S.No.</th>
                                <th>Adm. No.</th>
                                <th>Student</th>
                                <th class="text-center">Class</th>
                                <th class="text-center">Receipt No.</th>
                                @php $gtotal=array(); @endphp
                                @foreach(feeheadlist([]) as $data1)
                                    @php $toalfeehead['feehead_'.$data1->id]=0; @endphp
                                    <th class="bg-warning-light text-right">{{$data1->fee_head}}</th>
                                    @php $gtotal +=['fee_head_gt_'.$data1->id=>0] @endphp
                                @endforeach
                                @php $gtotal +=['fee_head_gt_total'=>0]; @endphp

                                <th class="text-right">Head Total</th>

                                @php $paytotal=array(); @endphp
                                @foreach(paymodelist() as $data2)
                                    @php $totalpaymode['paymodesum_'.$data2->id]=0; @endphp
                                    <th class="bg-success-light text-right">{{ucwords($data2->paymode)}}</th>
                                    @php $paytotal +=['paytotal_'.$data2->id=>0] @endphp
                                @endforeach
                                @php $paytotal +=['paytotal'=>0] @endphp
                                <th class="text-right">Total</th>
                                <th ><div style='visibility: hidden;'>ENTRYED</div></th>
                                <th ><div style='visibility: hidden;'>ENTRYED</div></th>
                                <th>Cheque No./Instrument No.</th>
                            </tr>
                            </thead>
                            @php $row=0; @endphp
                            @foreach($feecollection as $receiptdate=>$feecollectionlist)

                                @php
                                    foreach ($toalfeehead as $key=>$value){$toalfeehead[$key]=0;}
                                    foreach ($totalpaymode as $key=>$value){$totalpaymode[$key]=0;}

                                @endphp
                                <thead>
                                <tr>
                                    <th colspan="100" class="bg-light tx-15">{{nowdate($receiptdate,'d-F-Y')}}</th>
                                </tr>
                                </thead>

                                @foreach($feecollectionlist as $data)
                                    @php $row++; @endphp
                                    <tbody>
                                    <tr @if($data->receipt_status=="cancel") class="bg-pink-light" @elseif($data->receipt_status=="unpaid") class="bg-warning-light" @endif>
                                        <td class="text-center">{{$row}}</td>
                                        <td class="text-center">{{$data->AdmissionNo()}}</td>

                                        <td>{{$data->fullName()}}</td>
                                        <td class="text-center">{{$data->CourseSection()}}</td>
                                        <td class="text-center">{{$data->receipt_id}}</td>

                                        @php $feeheadtotal=0; @endphp
                                        @foreach(feeheadlist([]) as $data1)
                                            @php
                                                $feeheadamt=feeheadamount($data->id,$data1->id);
                                                $toalfeehead['feehead_'.$data1->id] +=$feeheadamt;
                                                $feeheadtotal +=$feeheadamt;
                                                $gtotal['fee_head_gt_'.$data1->id] +=$feeheadamt;
                                                $gtotal['fee_head_gt_total'] +=$feeheadamt;
                                            @endphp
                                            <th class="bg-warning-light text-right">{{numberformat($feeheadamt)}}</th>
                                        @endforeach

                                        <td class="text-right">@if($data->receipt_status=="paid") {{numberformat($feeheadtotal)}} @else {{"0"}} @endif</td>

                                        @foreach(paymodelist() as $data2)
                                            <th class="bg-success-light text-right">@if($data->paymode_id==$data2->id) @php $totalpaymode['paymodesum_'.$data2->id] +=$data->paid_amount; $paytotal['paytotal_'.$data2->id] +=$data->paid_amount; $paytotal['paytotal'] +=$data->paid_amount;  @endphp {{numberformat($data->paid_amount)}}@else{{numberformat(0)}}@endif</th>

                                        @endforeach
                                        <td class="text-right">@if($data->receipt_status=="paid") {{numberformat($data->paid_amount)}} @else {{"0"}} @endif</td>
                                        <th></th>
                                        <th></th>
                                        <td>{{$data->instrument_no}}</td>
                                    </tr>
                                    @endforeach

                                    <tr class='bg-normal-light'>
                                        <td></td>
                                        <td></td>
                                        <td colspan="3" class="text-right"><b>Total :</b></td>
                                        @foreach($toalfeehead as $total)
                                            <td class="text-right bg-warning"><b>{{numberformat($total)}}</b></td>
                                        @endforeach
                                        <td class="text-right tx-bold">{{numberformat($feecollectionlist->where('receipt_status','paid')->sum('paid_amount'))}}</td>
                                        @foreach($totalpaymode as $total)
                                            <td class="text-right bg-success"><b>{{numberformat($total)}}</b></td>
                                        @endforeach

                                        <td class="text-right tx-bold">{{numberformat($feecollectionlist->where('receipt_status','paid')->sum('paid_amount'))}}</td>
                                        <td class="text-right tx-bold" colspan='3'></td>
                                        <td colspan="5"></td>
                                    </tr>
                                    </tbody>
                                @endforeach
                                <tbody>
                                <tr>
                                    <td colspan="2"></td>
                                    <td colspan="3" class="text-right"><b>G.Total :</b></td>
                                    @foreach($gtotal as $totalamt)
                                        <td class="text-right"><b>{{numberformat($totalamt)}}</b></td>
                                    @endforeach
                                    @foreach($paytotal as $totalamts)
                                        <td class="text-right"><b>{{numberformat($totalamts)}}</b></td>
                                    @endforeach
                                </tr>
                                </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
