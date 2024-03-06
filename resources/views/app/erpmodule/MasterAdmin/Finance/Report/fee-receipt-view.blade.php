<div class="col-lg-12">

</div>
<div class="col-lg-12">
    <table class="table mt-1 mb-1 bg-light bd-1 bd">
        <tr>
            <td><b>Receipt No.</b></td><td><b>:</b></td><td>{{$feereceipt->receipt_id}}</td>
            <td><b>Receipt Date</b></td><td><b>:</b></td><td>{{nowdate($feereceipt->receipt_date,'d-F-Y')}}</td>
            <td><b>Admission No.</b></td><td><b>:</b></td><td>{{$feereceipt->AdmissionNo()}}</td>
        </tr>
        <tr>
            <td><b>Student Name</b></td><td><b>:</b></td><td>{{$feereceipt->fullName()}}</td>
            <td><b>Father's Name</b></td><td><b>:</b></td><td>{{$feereceipt->FatherName()}}</td>
            <td><b>Class/Course</b></td><td><b>:</b></td><td>{{$feereceipt->CourseSection()}}</td>
        </tr>
        <tr>
            <td><b>Paymode</b></td><td><b>:</b></td><td @if(!$feereceipt->instrument_no&&!$feereceipt->instrument_date) colspan="7" @endif>{{$feereceipt->PaymodeName()}}</td>
            @if(isset($feereceipt->instrument_no)&&($feereceipt->instrument_no))<td><b>Instrument No.</b></td><td><b>:</b></td><td>{{$feereceipt->instrument_no}}</td>@endif
            @if(isset($feereceipt->instrument_date)&&($feereceipt->instrument_date))<td><b>Instrument Date</b></td><td><b>:</b></td><td>{{nowdate($feereceipt->instrument_date,'d-F-Y')}}</td>@endif
        </tr>
        <tr>
            <td><b>Receipt Status</b></td><td><b>:</b></td><td @if(!$feereceipt->bank) colspan="7" @endif>
                    <span class="badge @if($feereceipt->receipt_status=="paid") badge-success @elseif($feereceipt->receipt_status=="unpaid") badge-warning @elseif($feereceipt->receipt_status=="cancel") badge-danger @endif">{{ucwords($feereceipt->receipt_status)}}</span>
            </td>
            @if(isset($feereceipt->bank)&&($feereceipt->bank))<td><b>Bank</b></td><td><b>:</b></td><td colspan="4">{{$feereceipt->bank}}</td>@endif
        </tr>
    </table>
    <table class="table-receipt table-bordered mt-2 mb-2">
        <thead class="bg-light">
        <tr class="bg-dark text-white">
            <th colspan="2" class="text-right">Total</th>
            <th class="text-right">{{numberformat($feereceipt->feeheadinstalmentfull->sum('instalment_amount'))}}</th>
            <th class="text-right">{{numberformat($feereceipt->feeheadinstalmentfull->sum('instalment_concession'))}}</th>
            <th class="text-right">{{numberformat($feereceipt->feeheadinstalmentfull->sum('instalment_fine'))}}</th>
            <th class="text-right">{{numberformat($feereceipt->feeheadinstalmentfull->sum('instalment_total_amount'))}}</th>
            <th class="text-right">{{numberformat($feereceipt->feeheadinstalmentfull->sum('instalment_paid'))}}</th>
            <th class="text-right">{{numberformat($feereceipt->feeheadinstalmentfull->sum('instalment_bal'))}}</th>
        </tr>
        <tr>
            <th class="text-center">#</th>
            <th>Fees Name</th>
            <th class="text-right">Amount</th>
            <th class="text-right">Concession</th>
            <th class="text-right">Late Fee</th>
            <th class="text-right">Payable</th>
            <th class="text-right">Paid</th>
            <th class="text-right">Balance</th>
        </tr>
        </thead>
        <tbody>
        @foreach($feereceipt->feeheadrecord as $data)
            @php
                $feereceiptinstalment=[];
                try {
                 $feereceiptinstalment=collect($feereceipt->feeheadinstalmentfull)->where('fee_collection_fee_head_id',$data->id);
                }catch (\Exception $e){}
            @endphp
            @if(count($feereceiptinstalment)>1)
            <tr>
                <td class="text-center">{{$loop->iteration}}</td>
                <td>@if(isset($data->feehead->fee_head))<b>{{$data->feehead->fee_head}}</b>@else --- @endif</td>
                <td></td>
            </tr>
            @endif
            @foreach($feereceiptinstalment as $data1)
            <tr>
                <td></td>
                <td><span class="pd-l-20">@if(count($feereceiptinstalment)<=1) @if(isset($data->feehead->fee_head))<b>{{$data->feehead->fee_head}}</b> ({{$data1->instalment_print_name}}) @else --- @endif @else --{{$data1->instalment_print_name}} @endif</span></td>
                <td class="text-right">{{numberformat($data1->instalment_amount)}}</td>
                <td class="text-right">{{numberformat($data1->instalment_concession)}}</td>
                <td class="text-right">{{numberformat($data1->instalment_fine)}}</td>
                @php $payable=(($data1->instalment_amount)+($data1->instalment_fine)-($data1->instalment_concession)); @endphp
                <td class="text-right">{{numberformat($payable)}}</td>
                <td class="text-right bg-success-light">{{numberformat($data1->instalment_paid)}}</td>
                <td class="text-right bg-pink-light">{{numberformat(($payable-$data1->instalment_paid))}}</td>
            </tr>
            @endforeach
            @if(count($feereceiptinstalment)>1)
            <tr class="bg-warning-light">
                <td colspan="2"></td>
                <td class="text-right"><b>{{numberformat($feereceiptinstalment->sum('instalment_amount'))}}</b></td>
                <td class="text-right"><b>{{numberformat($feereceiptinstalment->sum('instalment_concession'))}}</b></td>
                <td class="text-right"><b>{{numberformat($feereceiptinstalment->sum('instalment_fine'))}}</b></td>
                <td class="text-right"><b>{{numberformat($feereceiptinstalment->sum('instalment_total_amount'))}}</b></td>
                <td class="text-right"><b>{{numberformat($feereceiptinstalment->sum('instalment_paid'))}}</b></td>
                <td class="text-right"><b>{{numberformat($feereceiptinstalment->sum('instalment_bal'))}}</b></td>
            </tr>
            @endif
        @endforeach
        </tbody>
    </table>
</div>