@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">Finance/Account</li>
            <li class="breadcrumb-item" aria-current="page">Reports</li>
            <li class="breadcrumb-item active" aria-current="page">Fee Collection Report</li>
        </ol>
    </nav>
    <div class="col-lg-12 p-0 m-0 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i> Fee Collection Report</b></div>
            <div class="panel-body pd-b-10 row">
                <form action="{{url('MasterAdmin/Finance/FeeCollectionReport')}}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="row col-lg-12  pd-b-10 m-0">
                        <div class="col-lg-2">
                            <label><b>Receipt No. :</b></label>
                            <input name="receipt_id" placeholder="Enter Receipt No." autocomplete="off" type="text" value="{{request()->get('receipt_id')}}" class="form-control1 input-sm">
                        </div>
                        <div class="col-lg-2">
                            <label><b>Admission No. :</b></label>
                            <input name="admission_no" placeholder="Enter Admission No." autocomplete="off" type="text" value="{{request()->get('admission_no')}}" class="form-control1 input-sm">
                        </div>
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
                            <label><b>Course :</b></label>
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
                    <div class="row col-lg-12 m-0 bd-1 bd-t">
                        <div class="col-lg-12 text-right">@include('layouts.actionbutton.action-button-verticle')</div>
                        <table id="example2" datasum="true" colsum="8,9,10,12,14,15" class="table datatable tx-11 table-bordered">
                            <thead class="bg-light">
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Rec. No.</th>
                                <th class="text-center">Rec. Date</th>
                                <th>Adm. No.</th>
                                <th>Class/Course</th>
                                <th>Student</th>
                                <th>Father</th>
                                <th>Instalment</th>
                                <th class="text-right">Fee Amount</th>
                                <th class="text-right">Late Fee</th>
                                <th class="text-center">Fee Amt.+Late Fee</th>
                                <th class="text-right">Concession</th>
                                <th class="text-right">Fee Payable</th>
                                <th class="text-left">Paymode</th>
                                <th class="text-right">Paid</th>
                                <th class="text-right">Bal.</th>
                                <th class="text-center">Status</th>
                                <th class='text-center'>Instrument No.</th>
                                <th class='text-center'>Instrument Date</th>
                                <th class="text-center col-hide">Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($feecollection as $data)
                                @php
                                    $instalment="";
                                    $feecollectioninstalment=feecollectioninstalmentgrouplist(['fee_collection_id'=>$data->id]);
                                    if(isset($feecollectioninstalment)&&(is_array($feecollectioninstalment))){
                                    $instalment=implode(', ',array_column($feecollectioninstalment,'instalment_unique_id'));
                                    }
                                @endphp


                                <tr @if($data->receipt_status=="cancel") class="bg-pink-light" @elseif($data->receipt_status=="unpaid") class="bg-warning-light" @endif>
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td class="text-center">{{$data->receipt_id}}</td>
                                    <td class="text-center">{{\Carbon\Carbon::createFromDate($data->receipt_date)->format('d-M-Y')}}</td>
                                    <td class="text-center">{{$data->AdmissionNo()}}</td>
                                    <td>{{$data->CourseSection()}}</td>
                                    <td>{{$data->fullName()}}</td>
                                    <td>{{$data->FatherName()}}</td>
                                    <td>{{ucwords($instalment)}}</td>
                                    <td class="text-right">@if($data->receipt_status=="paid") {{numberformat($data->sub_total)}} @else {{"0"}} @endif</td>
                                    <td class="text-right">@if($data->receipt_status=="paid") {{numberformat($data->fine_total)}} @else {{"0"}} @endif</td>
                                    <td class="text-right">@if($data->receipt_status=="paid") {{numberformat($data->sub_total+$data->fine_total)}} @else {{"0"}} @endif</td>
                                    <td class="text-right">@if($data->receipt_status=="paid") {{numberformat($data->concession_total)}} @else {{"0"}} @endif</td>
                                    <td class="text-right">@if($data->receipt_status=="paid") {{numberformat($data->fee_payable)}} @else {{"0"}} @endif</td>
                                    <th>{{$data->PaymodeName()}}</th>
                                    <td class="text-right">@if($data->receipt_status=="paid") {{numberformat($data->paid_amount)}} @else {{"0"}} @endif</td>
                                    <td class="text-right">@if($data->receipt_status=="paid") {{numberformat($data->balance)}} @else {{"0"}} @endif</td>
                                    <td class="text-center">@if($data->receipt_status=="paid")<span class="badge badge-success">{{ucfirst($data->receipt_status)}}</span>@elseif($data->receipt_status=="unpaid") <span class="badge badge-warning">{{ucfirst($data->receipt_status)}}</span>@elseif($data->receipt_status=="cancel") <span class="badge badge-danger">{{ucfirst($data->receipt_status)}}</span> @endif</td>
                                    <th>{{$data->instrument_no}}</th>
                                    <th>@if($data->instrument_date){{nowdate($data->instrument_date,'d-M-Y')}}@endif</th>
                                    <td class="col-hide">
                                        <div class="container-fluid col-hide dropdown pd-t-3 pd-b-3 text-right">
                                            <button class="badge container-fluid pd-t-7 pd-b-7 border-primary  tx-12 dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Quick Action
                                            </button>
                                            <div class="dropdown-menu bg-light dropdown-menu-right shadow-lg tx-12" x-placement="bottom-start" style="position:absolute; will-change: transform; top: 0px; left: 0;  transform: translate3d(0px, 25px, 0px);">
                                                <a></a>
                                                <a target="_blank" loader-disable="true" href="{{url('/MasterAdmin/Finance/Receipt/'.$data->id.'/'.$data->receipt_group_token_id.'/Print')}}"><li class="dropdown-item" url=""><i class="fa fa-print"></i> Print Receipt</li></a>
                                                <a target="_blank" loader-disable="true" href="{{url('/MasterAdmin/Finance/ReceiptDownload/'.$data->id.'/download')}}"><li class="dropdown-item" url=""><i class="fa fa-file-pdf"></i> Download Receipt (.pdf)</li></a>
                                                <li class="dropdown-item" url=""><i class="fa fa-eye"></i> Receipt Preview</li>
                                                <a target="_blank" loader-disable="true" href="{{url('/MasterAdmin/Finance/FeeReceiptModify?receipt_no='.$data->receipt_id.'')}}"><li class="dropdown-item" url=""><i class="fa fa-edit"></i> Modify Receipt</li></a>
                                                <a target="_blank" loader-disable="true" href="{{url('/MasterAdmin/Finance/CancelFeeReceipt/'.$data->id.'/search')}}"><li class="dropdown-item" url=""><i class="fa fa-times"></i> Cancel Receipt</li></a>
                                                <li class="dropdown-item" url=""><i class="fa fa-hand-paper"></i> Hold Receipt</li>
                                                <a target="_blank" loader-disable="true" href="{{url('/MasterAdmin/Finance/ChequeBounceEntry/'.$data->id.'/search')}}"><li class="dropdown-item" url=""><i class="fa fa-times"></i> Cheque Bounce Entry</li></a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr class="bg-light">
                                <td></td>
                                <td></td>
                                <td colspan="6" class="text-right"><b>Total :</b></td>
                                <td class="text-right tx-bold">0.00</td>
                                <td class="text-right tx-bold">0.00</td>
                                <td class="text-right tx-bold">0.00</td>
                                <td class="text-right tx-bold">0.00</td>
                                <td class="text-right tx-bold">0.00</td>
                                <td></td>
                                <td class="text-right tx-bold">0.00</td>
                                <td class="text-right tx-bold">0.00</td>
                                <td colspan="4"></td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
