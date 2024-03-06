@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">Finance/Account</li>
            <li class="breadcrumb-item" aria-current="page">Reports</li>
            <li class="breadcrumb-item active" aria-current="page">Daily Fee Collection Fee Head & Paymode Report</li>
        </ol>
    </nav>
    <div class="col-lg-12 p-0 m-0 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i> Daily Fee Collection Fee Head & Paymode Report</b></div>
            <div class="panel-body pd-b-10 p-0 row">
                <form action="{{url('MasterAdmin/Finance/DailyFeeCollectionFullReport')}}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="row col-lg-12  pd-b-10 m-0">
                        <div class="col-lg-2">
                            <label><b>Entry Mode :</b></label>
                            @include('components.Finance.entry-mode-import')
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
                            @include('components.Finance.paymode-import')
                        </div>
                        <div class="col-lg-2">
                            <label><b>Receipt Status :</b></label>
                            @include('components.Finance.receipt-status-import')
                        </div>
                        <div class="col-lg-2">
                            <label><b>Instrument No. :</b></label>
                            <input placeholder="Enter Instrument No." type="text" class="form-control1 input-sm">
                        </div>
                        <div class="col-lg-2">
                            <label><b>Course :</b></label>
                            @include('components.course-import')
                        </div>
                        <div class="col-lg-2">
                            <label><b>Section :</b></label>
                            @include('components.section-import')
                        </div>
                        <div class="clearfix"></div>
                        <div><button type="submit" class="btn btn-primary mg-t-20"><i class="fa fa-search"></i> Search</button></div>
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

                      $feeheadtotal=0; isset($feecollectionsummary['totalfee']) ? $feeheadtotal=$feecollectionsummary['totalfee'] : $feeheadtotal=0;
                    return $feeheadtotal;
                    }
                    //total foot sum
                    $toalfeehead=[];
                    $totalpaymode=[];
                    @endphp


                    <div class="row col-lg-12 m-0 bd-1 bd-t">
                        <div class="col-lg-12 text-right">@include('layouts.actionbutton.action-button-verticle')</div>
                        <table id="example2" datasum="true" colsum="8,9,10,11,12,13" class="table bg-white datatable mg-t-15 tx-11 table-bordered">
                            <thead class="bg-light tx-12 text-center">
                            <tr>
                                <th colspan="4">Student Informaton</th>
                                <th colspan="2">Receipt Informaton</th>
                                <th colspan="{{count(feeheadlist([]))}}">Fee Head Informaton</th>
                                <th colspan="4">Concession and Late Fee</th>
                                <th colspan="{{count(paymodelist())}}">Paymode Informaton</th>
                                <th colspan="7">Receipt Informaton</th>
                            </tr>
                            </thead>
                            <thead class="bg-light">
                            <tr>
                                <th class="text-center">S.No.</th>
                                <th>Adm. No.</th>
                                <th>Student</th>
                                <th class="text-center">Class</th>
                                <th class="text-center">Receipt No.</th>
                                @foreach(feeheadlist([]) as $data1)
                                    @php $toalfeehead['feehead_'.$data1->id]=0; @endphp
                                    <th class="bg-warning-light text-right">{{$data1->fee_head}}</th>
                                @endforeach
                                <th class="text-right">Head Total</th>
                                <th class="text-right">Concession</th>
                                <th class="text-right">Late Fee</th>
                                <th class="text-right">Fee Payable</th>

                                @foreach(paymodelist() as $data2)
                                    @php $totalpaymode['paymodesum_'.$data2->id]=0; @endphp
                                    <th class="bg-success-light text-right">{{ucwords($data2->paymode)}}</th>
                                @endforeach

                                <th class="text-right">Collect</th>
                                <th class="text-right">Bal.</th>
                                <th>Instrument No.</th>
                                <th>Instrument Date</th>
                                <th>Instrument Status</th>
                                <th class="text-center">Status</th>
                            </tr>
                            </thead>
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
                               <tbody>
                                <tr @if($data->receipt_status=="cancel") class="bg-pink-light" @elseif($data->receipt_status=="unpaid") class="bg-warning-light" @endif>
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td class="text-center">{{$data->AdmissionNo()}}</td>
                                    <td>{{$data->fullName()}}<br/>
                                        {{$data->FatherName()}}
                                    </td>
                                    <td class="text-center">{{$data->CourseSection()}}</td>
                                    <td class="text-center">{{$data->receipt_id}}</td>

                                    @foreach(feeheadlist([]) as $data1)
                                        @php
                                        $feeheadamt=feeheadamount($data->id,$data1->id);
                                        $toalfeehead['feehead_'.$data1->id] +=$feeheadamt;
                                        @endphp
                                        <th class="bg-warning-light text-right">{{numberformat($feeheadamt)}}</th>
                                    @endforeach

                                    <td class="text-right">@if($data->receipt_status=="paid") {{numberformat($data->sub_total)}} @else {{"0"}} @endif</td>
                                    <td class="text-right">@if($data->receipt_status=="paid") {{numberformat($data->concession_total)}} @else {{"0"}} @endif</td>
                                    <td class="text-right">@if($data->receipt_status=="paid") {{numberformat($data->fine_total)}} @else {{"0"}} @endif</td>
                                    <td class="text-right">@if($data->receipt_status=="paid") {{numberformat($data->fee_payable)}} @else {{"0"}} @endif</td>

                                    @foreach(paymodelist() as $data2)
                                        <th class="bg-success-light text-right">@if($data->paymode_id==$data2->id) @php $totalpaymode['paymodesum_'.$data2->id] +=$data->paid_amount; @endphp {{numberformat($data->paid_amount)}}@else{{numberformat(0)}}@endif</th>
                                    @endforeach

                                    <td class="text-right">@if($data->receipt_status=="paid") {{numberformat($data->paid_amount)}} @else {{"0"}} @endif</td>
                                    <td class="text-right">@if($data->receipt_status=="paid") {{numberformat($data->balance)}} @else {{"0"}} @endif</td>

                                    <td>{{$data->instrument_no}}</td>
                                    <td>  {{ $data->instrument_date ? nowdate($data->instrument_date,'d-M-Y') : "" }} </td>
                                    <td>N/A</td>

                                    <td class="text-center">@if($data->receipt_status=="paid")<span class="badge badge-success">{{ucfirst($data->receipt_status)}}</span>@elseif($data->receipt_status=="unpaid") <span class="badge badge-warning">{{ucfirst($data->receipt_status)}}</span>@elseif($data->receipt_status=="cancel") <span class="badge badge-danger">{{ucfirst($data->receipt_status)}}</span> @endif</td>
                                </tr>
                               @endforeach

                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td colspan="3" class="text-right"><b>Total :</b></td>
                                    @foreach($toalfeehead as $total)
                                        <td class="text-right bg-warning"><b>{{numberformat($total)}}</b></td>
                                    @endforeach
                                    <td class="text-right tx-bold">{{numberformat($feecollectionlist->where('receipt_status','paid')->sum('sub_total'))}}</td>
                                    <td class="text-right tx-bold">{{numberformat($feecollectionlist->where('receipt_status','paid')->sum('concession_total'))}}</td>
                                    <td class="text-right tx-bold">{{numberformat($feecollectionlist->where('receipt_status','paid')->sum('fine_total'))}}</td>
                                    <td class="text-right tx-bold">{{numberformat($feecollectionlist->where('receipt_status','paid')->sum('fee_payable'))}}</td>
                                    @foreach($totalpaymode as $total)
                                        <td class="text-right bg-success"><b>{{numberformat($total)}}</b></td>
                                    @endforeach

                                    <td class="text-right tx-bold">{{numberformat($feecollectionlist->where('receipt_status','paid')->sum('paid_amount'))}}</td>
                                    <td class="text-right tx-bold">---</td>
                                    <td colspan="5"></td>
                                </tr>

                            </tbody>
                            @endforeach

                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
