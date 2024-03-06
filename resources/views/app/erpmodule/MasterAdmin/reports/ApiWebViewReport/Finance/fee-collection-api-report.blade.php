@extends('layouts.api-web-view-master-layout')
@section('content')
    @php
        $feecollect=collect($feecollection)->where('receipt_status','paid');
    @endphp
    <div class='col-12 p-2 tx-13'>
        <table cellpadding='0' cellspacing='0' class='table table-bordered bg-light-dark'>
            <tbody>
            <tr>
                <td colspan="2"><b>Receipt Date :</b> {{$form_date}} to {{$to_date}}</td>
            </tr>
            <tr>
                <td><b>Total Receipt : <span class="badge badge-primary tx-12">{{count($feecollection)}}</span></b></td>
                <td><b>Total Payable : {{numberformat($feecollect->sum('fee_payable'),2)}}</b></td>
            </tr>
            <tr>
                <td><b>Total Concession :</b> {{numberformat($feecollect->sum('concession_total'),2)}}</td>
                <td><b>Total Collect :</b> <span class="badge badge-success tx-12">{{numberformat($feecollect->sum('paid_amount'),2)}}</span></td>
            </tr>
            </tbody>
        </table>
    </div>
    @foreach($feecollection as $data)

        @php
            $instalment="";
            $feecollectioninstalment=feecollectioninstalmentgrouplist(['fee_collection_id'=>$data->id]);
            if(isset($feecollectioninstalment)&&(is_array($feecollectioninstalment))){
            $instalment=implode(', ',array_column($feecollectioninstalment,'instalment_unique_id'));
            }
        @endphp

        <div class='col-12 p-2'>
            <table cellpadding='0' cellspacing='0' class='table border table-bordered bg-light-dark shadow-sm @if($data->receipt_status=="cancel") bg-danger-light @elseif($data->receipt_status=="unpaid") bg-warning-light @endif'>
                <tbody>
                <tr>
                    <td colspan="4"><span><b>Receipt No. :</b> {{$data->receipt_id}}</span> |
                        <span><b>Receipt Date : </b> {{nowdate($data->receipt_date,'d-M-Y')}}</span></td>
                </tr>
                <tr>
                    <td colspan="4"><span><b>{{ucwords($data->fullName())}}</b> - {{$data->CourseSection()}}</span></td>
                </tr>
                <tr>
                    <td colspan="4"><span><b>Admission No.</b> : {{$data->AdmissionNo()}}</span> | <span><b>AC Ledger No. : </b> @if(isset($data->student->ac_ledger_no)){{$data->student->ac_ledger_no}}@else{{"N/A"}}@endif</span></td>
                </tr>
                <tr>
                    <td colspan="4"><span><b>{{ucwords($data->FatherName())}}</b> - ({{$data->ContactNo()}})</span></td>
                </tr>
                <tr>
                    <td class="text-right"><span><b>Paymode</b></span><br/><span class="badge badge-primary tx-12">{{$data->PaymodeName()}}</span></td>
                    <td class="text-right"><span><b>Fee Payable</b></span><br/><span class="badge badge-warning tx-12">{{numberformat($data->fee_payable,2)}}</span></td>
                    <td class="text-right"><span><b>Paid</b></span><br/><span class="badge badge-success tx-12">{{numberformat($data->paid_amount,2)}}</span></td>
                    @php $balance=$data->fee_payable-$data->paid_amount; @endphp
                    <td class="text-right"><span><b>@if($balance>0) Balance @else Excess @endif</b></span><br/>{{numberformat(abs($balance),2)}}</td>
                </tr>
                <tr>
                    <td class="text-right"><span><b>Instrument No.</b></span><br/>@if(isset($data->instrument_no)){{$data->instrument_no}}@else{{"N/A"}}@endif</td>
                    <td class="text-right"><span><b>Concession</b></span><br/><span class="badge badge-danger tx-12">{{numberformat($data->concession_total,2)}}</span></td>
                    <td class="text-right"><span><b>Late Fee</b></span><br/>{{numberformat($data->fine_total,2)}}</td>
                    <td class="text-right"><span><b>Receipt Status</b></span><br/>
                        <span class="badge @if($data->receipt_status=="paid") badge-success @elseif($data->receipt_status=="unpaid") badge-warning @elseif($data->receipt_status=="cancel") badge-danger @endif tx-12">{{ucwords($data->receipt_status)}}</span></td>
                </tr>
                <tr>
                    <td class="text-left"><b>Paid Instalment</b></td>
                    <td colspan="3">{{ucwords($instalment)}}</td>
                </tr>
                </tbody>

            </table>
        </div>
    @endforeach

@endsection

