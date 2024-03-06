@extends('layouts.api-web-view-master-layout')
@section('content')


@section('tbody')
    <tbody class="bg-light">
    @php $totalbalance=0; @endphp
    @foreach($student as $data)
        @php
            $payfeeid=$fee_head;
            $currentdate=$fee_month;
            $feestructure=studentfeerecord(studentparameter($data),$currentdate,$payfeeid);
            //fee pay instalment
            try {$feeinstalmentprint=call_user_func_array("array_merge",array_column($feestructure[0],'select_pay_instalment_print'));}catch (\Exception $e){$feeinstalmentprint=[];}
        @endphp
        @if((isset($feestructure[5]['feepayable']))&&$feestructure[5]['feepayable']<=0&&$zero_show=="no")
        @else
        <tr>
            <td class="text-left">
                <span class="tx-13"><b>{{$data->fullName()}}</b> - {{$data->CourseSection()}}</span><br/>
                <span class="tx-11 text-black-light"><b>Adm. No. :</b> {{$data->admission_no}}</span> @if(isset($data->ac_ledger_no))| <span class="tx-11 text-black-light"><b>A/C Ledger No. :</b> {{$data->ac_ledger_no}}</span>@endif<br/>
                <span class="tx-12"><b>@if($data->student->gender=="male") S/O :@elseif($data->student->gender=="female") D/O :@endif</b> {{$data->FatherName()}} - {{$data->student->contact_no}}</span><br/>
                <span class="tx-11 text-black-light"><b>Transport :</b> {{$data->TransportName()}}</span> | <span class="tx-11 text-black-light"><b>Concession :</b> {{$data->ConcessionName()}}</span><br/>
                <span class="tx-11 text-black-light"><b>Due Instalment :</b> {{implode(", ",$feeinstalmentprint)}}</span><br/>
                <span class="tx-11 text-black-light"><b>Last Paid Date :</b> @if($data->LastFeePaidDate()) {{nowdate($data->LastFeePaidDate(),'d-F-Y')}} @endif</span>
            </td>
            <th class="text-right align-middle text-danger tx-13">@if(isset($feestructure[5])){{numberformat($feestructure[5]['feepayable'])}} @php if($feestructure[5]['feepayable']>0){$totalbalance +=$feestructure[5]['feepayable'];}@endphp @endif</th>
        </tr>
        @endif
    @endforeach
    </tbody>
@endsection

    <div class='col-12 p-2 tx-13'>
        <table cellpadding='0' cellspacing='0' class='table table-bordered bg-light-dark'>
            <tbody>
            <tr>
                <td colspan="2"><b>Fee Upto Month :</b> {{nowdate($fee_month,'M-Y')}}</td>
            </tr>
            <tr>
                <td><b>Total Student : <span class="badge badge-primary tx-12">{{count($student)}}</span></b></td>
                <td><b>Total Balance :</b> <span class="badge badge-danger tx-12">{{numberformat($totalbalance,2)}}</span></td>
            </tr>
            </tbody>
        </table>
    </div>

    <div class='col-12 p-2'>
        <table class="table mg-t-0 border-bottom border">
            <thead class="bg-light-dark">
            <tr>
                <th>Student Information</th>
                <th class="text-right">Fee Balance</th>
            </tr>
            </thead>
            @yield('tbody')
            <tfoot class="bg-light-dark tx-13">
            <tr>
                <td class="text-right">
                    <b>Total Fee Balance :</b>
                </td>
                <td class="text-right"><b>{{numberformat($totalbalance)}}</b></td>
            </tr>
            </tfoot>
        </table>
    </div>
@endsection

