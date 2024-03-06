<table class="table pd-b-0 mg-b-0 bd-1 bd tx-12">
    <tr>
        <td><b>Receipt ID</b></td>
        <td><b>:</b></td>
        <td>{{$feecollection->id}}</td>
        <td><b>Receipt No.</b></td>
        <td><b>:</b></td>
        <td>{{$feecollection->receipt_id}}</td>
        <td><b>Receipt Date</b></td>
        <td><b>:</b></td>
        <td>{{\Carbon\Carbon::createFromDate($feecollection->receipt_date)->format('d-M-Y')}}</td>
    </tr>
    <tr>
        <td><b>Sub Total</b></td>
        <td><b>:</b></td>
        <td>{{$feecollection->sub_total}}</td>
        <td><b>Concession</b></td>
        <td><b>:</b></td>
        <td>{{$feecollection->concession_total}}</td>
        <td><b>Late Fee</b></td>
        <td><b>:</b></td>
        <td>{{$feecollection->fine_total}}</td>
    </tr>
    <tr>
        <td><b>Total Payable</b></td>
        <td><b>:</b></td>
        <td>{{$feecollection->fee_payable}}</td>
        <td><b>Paid</b></td>
        <td><b>:</b></td>
        <td>{{$feecollection->paid_amount}}</td>
        <td><b>Balance</b></td>
        <td><b>:</b></td>
        <td>{{$feecollection->balance}}</td>
    </tr>
    <tr>
        <td><b>Entry Mode</b></td>
        <td><b>:</b></td>
        <td>{{ucfirst($feecollection->entry_mode)}}</td>
        <td><b>Online Status</b></td>
        <td><b>:</b></td>
        <td></td>
        <td><b>Receipt Status</b></td>
        <td><b>:</b></td>
        <td><span class="badge @if($feecollection->receipt_status=="paid") badge-success @elseif($feecollection->receipt_status=="unpaid")  badge-warning @elseif($feecollection->receipt_status=="cancel")  badge-danger @endif tx-13">{{ucfirst($feecollection->receipt_status)}}</span></td>
    </tr>
    <tr>
        <td><b>Paymode</b></td>
        <td><b>:</b></td>
        <td>{{$feecollection->PayModeName()}}</td>
        <td><b>Instrument No.</b></td>
        <td><b>:</b></td>
        <td>{{$feecollection->instrument_no}}</td>
        <td><b>Instrument Date</b></td>
        <td><b>:</b></td>
        <td>{{$feecollection->instrument_date}}</td>
    </tr>
    <tr>
        <td><b>Bank</b></td>
        <td><b>:</b></td>
        <td colspan="7">{{$feecollection->bank}}</td>
    </tr>
</table>
