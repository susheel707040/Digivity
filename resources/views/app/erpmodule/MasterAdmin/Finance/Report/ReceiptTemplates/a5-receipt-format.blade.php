@php
    $receiptcopy=1;
    $copyname=[];
    if(isset($receiptconfig)){
    $receiptcopy=$receiptconfig->rec_copy_qty;
    $copyname=explode("@",$receiptconfig->rec_hard_copy);
    $applycopyno=explode(",",$receiptconfig->apply_rec_copy_no);
    }
@endphp
@php
    $feecollectiondata=$feecollection[0];
    $student=studentshortlist(['student_id'=>$feecollectiondata->student_id])->shift();
@endphp
<div class="col-lg-12 receipt-master-body row p-0 m-0" @if(isset($receiptconfig->rec_font_size)) style=" font-size:{{$receiptconfig->rec_font_size}}; " @endif >
    @for($i=1;$i<=$receiptcopy;$i++)
        <div class="col-12 mg-t-10">
            @include('erpmodule.MasterAdmin.Finance.Report.ReceiptTemplates.receipt-header-import',['course_id'=>$student->course_id])
            <table class="table-receipt bd-1 bd p-0 m-0">
                <thead class="bg-light">
                <tr>
                    <th colspan="6" class="text-left"><b>@if(isset($receiptconfig)) {{$receiptconfig->rec_title}} @endif</b>
                        <span class="float-right">@if(isset($copyname[($i-1)])){{$copyname[($i-1)]}}@endif</span>
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="wd-15p"><b>Receipt No.</b></td><td class="wd-5p"><b>:</b></td><td>{{$feecollectiondata->receipt_id}}
                        @if(isset($feecollectiondata->student->ac_ledger_no))<span class='pd-l-20'><b>AC Ledger No. :</b> {{$feecollectiondata->student->ac_ledger_no}}</span>@endif
                    </td>
                    <td class="wd-15p"><b>Receipt Date</b></td><td class="wd-5p"><b>:</b></td><td>{{\Carbon\Carbon::createFromDate($feecollectiondata->receipt_date)->format('d-M-Y')}}</td>
                </tr>
                <tr>
                    <td><b>Adm. No.</b></td><td class="wd-5p"><b>:</b></td><td>{{$feecollectiondata->AdmissionNo()}}</td>
                    <td><b>Academic Session</b></td><td class="wd-5p"><b>:</b></td><td>@if(isset($student->session->academic_session)) {{$student->session->academic_session}} @endif</td>
                </tr>
                <tr>
                    <td><b>Student Name</b></td><td class="wd-5p"><b>:</b></td><td>{{$student->fullName()}}</td>
                    <td><b>Course - Section</b></td><td class="wd-5p"><b>:</b></td><td>{{$feecollectiondata->CourseSection()}}</td>
                </tr>
                <tr>
                    <td><b>Father Name</b></td><td class="wd-5p"><b>:</b></td><td>{{$feecollectiondata->FatherName()}}</td>
                    <td><b>Contact No.</b></td><td class="wd-5p"><b>:</b></td><td>{{$feecollectiondata->ContactNo()}}</td>
                </tr>
                <tr>
                    <td><b>Address </b></td><td class="wd-5p"><b>:</b></td><td colspan="4">{{$feecollectiondata->Address()}}</td>
                </tbody>
            </table>
            <table class="table-receipt  bd-1 bd p-0 m-0">
                <thead class="bg-light">
                <tr>
                    <th><b>Fee Head</b></th>
                    <th class="text-center"><b>Qty.</b></th>
                    <th><b>Fee Instalment</b></th>
                    <th class="text-right"><b>Sub Total</b></th>
                    <th class="text-right"><b>Concession</b></th>
                    <th class="text-right"><b>Late Fee</b></th>
                    <th class="text-right"><b>Total</b></th>
                    <th class="text-right">Paid</th>
                    <th class="text-right">Balance</th>
                </tr>
                </thead>
                <tbody>
                @php
                    $feeheadinstalmentall=collect($feecollectiondata->feeheadinstalmentfull)->toArray();
                @endphp
                @foreach($feecollectiondata->feeheadrecord as $data)
                    @php
                        $feeheadinstalment=collect($feecollectiondata->feeheadinstalmentfull)->where('fee_collection_fee_head_id',$data->id)->toArray();
                    @endphp
                    <tr>
                        <td class="wd-15p">{{$data->feehead->fee_head}}</td>
                        <td class="text-center">{{count(array_column($feeheadinstalment,'instalment_print_name'))}}</td>
                        <td class="wd-30p">{{implode(", ",array_column($feeheadinstalment,'instalment_print_name'))}}</td>
                        <td class="text-right">{{number_format(array_sum(array_column($feeheadinstalment,'instalment_amount')),2)}}</td>
                        <td class="text-right">{{number_format(array_sum(array_column($feeheadinstalment,'instalment_concession')),2)}}</td>
                        <td class="text-right">{{number_format(array_sum(array_column($feeheadinstalment,'instalment_fine')),2)}}</td>
                        <td class="text-right">{{number_format(array_sum(array_column($feeheadinstalment,'instalment_total_amount')),2)}}</td>
                        <td class="text-right">{{number_format(array_sum(array_column($feeheadinstalment,'instalment_paid')),2)}}</td>
                        <td class="text-right">{{number_format(array_sum(array_column($feeheadinstalment,'instalment_bal')),2)}}</td>
                    </tr>
                @endforeach
                </tbody>
                @php
                    $subtotal=array_sum(array_column($feeheadinstalmentall,'instalment_amount'));
                    $concession=array_sum(array_column($feeheadinstalmentall,'instalment_concession'));
                    $latefee=array_sum(array_column($feeheadinstalmentall,'instalment_fine'));
                    $totalpaid=array_sum(array_column($feeheadinstalmentall,'instalment_paid'));
                    $totalbal=array_sum(array_column($feeheadinstalmentall,'instalment_bal'));
                    $totalpayable=(($subtotal-$concession)+$latefee);
                    $balance=($totalpayable-$feecollectiondata->paid_amount);
                @endphp
                <thead class="bg-light">
                <tr>
                    <th colspan="3" class="text-right">Total : </th>
                    <th class="text-right">{{number_format($subtotal,2)}}</th>
                    <th class="text-right">{{number_format($concession,2)}}</th>
                    <th class="text-right">{{number_format($latefee,2)}}</th>
                    <th class="text-right">{{number_format($totalpayable,2)}}</th>
                    <th class="text-right">{{number_format($totalpaid,2)}}</th>
                    <th class="text-right">{{number_format($totalbal,2)}}</th>
                </tr>
                </thead>
            </table>
            <table class="table table-borderless bd bd-1 m-0 p-0">
                <tbody>
                <tr>
                    <td class="wd-15p"><b>Sub Total</b></td><td class="wd-5p"><b>:</b></td><td>{{numberformat($subtotal)}}</td>
                    <td class="wd-10p"><b>Concession</b></td><td class="wd-5p"><b>:</b></td><td>{{numberformat($concession)}}</td>
                    <td class="wd-10p"><b>Late Fee</b></td><td class="wd-5p"><b>:</b></td><td>{{numberformat($latefee)}}</td>
                </tr>
                <tr>
                    <td><b>Fee Payable</b></td><td class="wd-5p"><b>:</b></td><td>{{numberformat($totalpayable)}}</td>
                    <td class="tx-14"><b>Paid Amount</b></td><td class="wd-5p"><b>:</b></td><td class="tx-14">{{numberformat($feecollectiondata->paid_amount)}}</td>
                    <td><b>Balance</b></td><td class="wd-5p"><b>:</b></td><td>{{numberformat($totalbal)}}</td>
                </tr>
                <tr>
                    <td><b>Paymode</b></td><td class="wd-5p"><b>:</b></td><td>@if(isset($feecollectiondata->paymode->paymode)) {{$feecollectiondata->paymode->paymode}} @endif</td>
                    @if($feecollectiondata->instrument_no)
                        <td><b>Instrument No.</b></td><td class="wd-5p"><b>:</b></td><td>{{$feecollectiondata->instrument_no}}</td>
                    @endif
                    @if($feecollectiondata->instrument_date)
                        <td><b>Instrument Date</b></td><td class="wd-5p"><b>:</b></td><td>{{nowdate($feecollectiondata->instrument_date,'d-M-Y')}}</td>
                    @endif
                </tr>
                @if($feecollectiondata->bank)
                    <tr>
                        <td><b>Bank</b></td><td><b>:</b></td><td colspan="6">{{$feecollectiondata->bank}}</td>
                    </tr>
                @endif
                </tbody>
                <tbody>
                <tr>
                    <td colspan="9">
                        WE THANKFULLY ACKNOWLEDGE THE RECEIPT OF <b>{{number_format($feecollectiondata->paid_amount,2)}}</b><br/>
                        <b>IN WORD</b> {{strtoupper(\App\Helper\NumberInWords::convertwords($feecollectiondata->paid_amount))}}
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <b>Note :</b><br/>
                        @if(isset($receiptconfig->receipt_note)) {!! $receiptconfig->receipt_note !!} @endif
                    </td>
                    <td colspan="3" class="ht-65 align-bottom text-right"><b>Depositor's Signature</b></td>
                    <td colspan="3" class="text-right align-bottom"><b>Account's Signature</b></td>
                </tr>
                </tbody>
            </table>
            @include('erpmodule.MasterAdmin.Finance.Report.ReceiptTemplates.receipt-footer-import')
        </div>
    @endfor
</div>
