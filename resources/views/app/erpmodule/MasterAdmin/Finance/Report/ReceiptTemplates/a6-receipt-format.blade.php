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
<div class="col-lg-12 receipt-master-body row p-0 m-0" @if(isset($receiptconfig->rec_font_size)) style=" font-size:{{$receiptconfig->rec_font_size}}; " @endif>
    @for($i=1;$i<=$receiptcopy;$i++)
        <div class="col-6 mg-t-10">
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
                @if(isset($feecollectiondata->student->ac_ledger_no))
                <tr>
                    <td>AC Ledger No. :</td><td class="wd-10 text-center"><b>:</b></td>
                    <td>{{$feecollectiondata->student->ac_ledger_no}}</td>
                </tr>
                @endif
                <tr>
                    <td class="wd-25p"><b>Receipt No.</b></td><td class="wd-10 text-center"><b>:</b></td><td>{{$feecollectiondata->receipt_id}}</td>
                    <td class="wd-25p"><b>Receipt Date</b></td><td class="wd-10 text-center"><b>:</b></td><td>{{\Carbon\Carbon::createFromDate($feecollectiondata->receipt_date)->format('d-M-Y')}}</td>
                </tr>
                <tr>
                    <td class="wd-25p"><b>Adm. No.</b></td><td class="wd-10 text-center"><b>:</b></td><td>{{$student->admission_no}}</td>
                    <td class="wd-25p"><b>Class/Course</b></td><td class="wd-10 text-center"><b>:</b></td><td>{{$student->CourseSection()}}</td>
                </tr>
                <tr>
                    <td><b>Student's Name</b></td><td><b>:</b></td><td colspan="4">{{$feecollectiondata->fullName()}}</td>
                </tr>
                <tr>
                    <td><b>Father's Name</b></td><td><b>:</b></td><td colspan="4">{{$feecollectiondata->FatherName()}}</td>
                </tr>
                <tr>
                    <td><b>Contact No.</b></td><td><b>:</b></td><td colspan="4">{{$feecollectiondata->ContactNo()}}</td>
                </tr>
                </tbody>
            </table>
            <table class="table-receipt  bd-1 bd p-0 m-0">
                <thead class="bg-light">
                <tr>
                    <th><b>Fee Head</b></th>
                    <th><b>Fee Instalment</b></th>
                    <th class="text-right"><b>Total</b></th>
                    <th class="text-right">Paid</th>
                    <th class="text-right">Bal.</th>
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
                        <td class="wd-25p">{{$data->feehead->fee_head}}</td>
                        <td class="wd-40p">{{implode(", ",array_column($feeheadinstalment,'instalment_print_name'))}}</td>
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
                    <th colspan="2" class="text-right">Sub Total : </th>
                    <th class="text-right">{{number_format($totalpayable,2)}}</th>
                    <th class="text-right">{{number_format($totalpaid,2)}}</th>
                    <th class="text-right">{{number_format($totalbal,2)}}</th>
                </tr>
                </thead>
            </table>
            <table cellpadding="0" cellspacing="0" class="table table-borderless bd-1 bd m-0">
                <tbody>
                <tr>
                    <td class="wd-20p"><b>Sub Total</b></td><td class="wd-5p"><b>:</b></td><td>{{number_format($subtotal,2)}}</td>
                    <td  class="wd-15p"><b>Concession</b></td><td class="wd-5p"><b>:</b></td><td>{{number_format($concession,2)}}</td>
                    <td  class="wd-15p"><b>Late Fee</b></td><td class="wd-5p"><b>:</b></td><td>{{number_format($latefee,2)}}</td>
                </tr>
                <tr>
                    <td class="wd-20p"><b>Total Payable</b></td><td class="wd-5p"><b>:</b></td><td>{{number_format($totalpayable,2)}}</td>
                    <td  class="wd-15p"><b>Paid</b></td><td class="wd-5p"><b>:</b></td><td>{{number_format($feecollectiondata->paid_amount,2)}}</td>
                    <td  class="wd-15p"><b>Balance</b></td><td class="wd-5p"><b>:</b></td><td>{{number_format($balance,2)}}</td>
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
                <tr>
                    <td colspan="9" class="tx-11">
                        WE THANKFULLY ACKNOWLEDGE THE RECEIPT OF <b>{{number_format($feecollectiondata->paid_amount,2)}}</b><br/>
                        <b>IN WORDS</b> {{strtoupper(\App\Helper\NumberInWords::convertwords($feecollectiondata->paid_amount))}}
                    </td>
                </tr>
                <tr>
                    <td colspan="9">
                        <b>Note : </b><br/>
                        @if(isset($receiptconfig->receipt_note)) {!! $receiptconfig->receipt_note !!} @endif
                    </td>
                </tr>
                <tr>
                    <td colspan="3" class="ht-60 align-bottom"><b>Depositor's Signature</b></td>
                    <td colspan="2" class="tx-10 align-bottom text-center">Server#{{$feecollectiondata->ServerName()}}</td>
                    <td colspan="4" class="text-right align-bottom"><b>Account's Signature</b></td>
                </tr>
                </tbody>
            </table>
            @include('erpmodule.MasterAdmin.Finance.Report.ReceiptTemplates.receipt-footer-import')
        </div>
    @endfor
</div>

