@php
$pagecount=0;
@endphp
<div class="container-fluid p-0 m-0 row">
    @foreach($student as $data)
    <div class="col-6 mg-t-15 float-left">
        <table cellpadding="0" cellspacing="0" class="table-receipt bd-1 bd p-0 m-0">
            <thead>
            <tr>
                <th class="bg-light tx-13" colspan="6"><b>Fee Estimate Token Slip</b></th>
            </tr>
            </thead>
            <tr>
                <td><b>Adm. No.</b></td><td><b>:</b></td><td>{{$data->admission_no}}</td>
                <td><b>Course-Section</b></td><td><b>:</b></td><td>{{$data->CourseSection()}}</td>
            </tr>
            <tr>
                <td><b>Student Name</b></td><td><b>:</b></td><td colspan="4">{{$data->fullName()}}</td>
            </tr>
            <tr>
                <td><b>Father's Name</b></td><td><b>:</b></td><td colspan="4">{{$data->FatherName()}} <b>({{$data->student->contact_no}})</b></td>
            </tr>
            <tr>
                <td><b>Address</b></td><td><b>:</b></td><td colspan="4">{{$data->Address()}}</td>
            </tr>
            <tr>
                <td><b>Fee Month</b></td><td><b>:</b></td><td>{{nowdate($feeuptodate,'F-Y')}}</td>
                <td><b>Last Fee Paid</b></td><td><b>:</b></td><td>@if($data->LastFeePaidDate()){{nowdate($data->LastFeePaidDate(),'d-F-Y')}}@else{{"N/A"}}@endif</td>
            </tr>
        </table>
        <table  cellpadding="0" cellspacing="0" class="table-receipt bd-1 bd p-0 m-0">
            <thead class="bg-light">
            <tr>
                <th class="text-center">Sl.No.</th>
                <th>Fee Head</th>
                <th>Description</th>
                <th class="text-right">Fee Amount</th>
            </tr>
            </thead>
            <tbody>
            @php
                $slno=0;
                $totalpayable=0;
                $studentfeerecord = studentfeerecord(studentparameter($data),$feeuptodate,$feepayid);
            @endphp
            @foreach($studentfeerecord[0] as $data)
                @if(count($data['select_pay_instalment_print']))
                @php
                    $slno++;
                    $feeamount=(array_sum($data['select_pay_instalment_amount'])-array_sum($data['select_pay_instalment_concession'])+array_sum($data['select_pay_instalment_late_fee']));
                    $totalpayable +=$feeamount;
                @endphp
            <tr>
                <td class="text-center">{{$slno}}</td>
                <td>{{$data['fee_head']}}</td>
                <td>{{implode(",",$data['select_pay_instalment_print'])}}</td>
                <td class="text-right">{{numberformat($feeamount)}}</td>
            </tr>
                @endif
            @endforeach
            </tbody>
            <tfoot class="bg-light">
            <tr>
                <td colspan="3" class="text-right"><b>Total Fee Balance :</b></td>
                <td class="text-right"><b>{{numberformat($totalpayable)}}</b></td>
            </tr>
            </tfoot>
        </table>
        <table  cellpadding="0" cellspacing="0" class="table-receipt bd-1 bd p-0 m-0">
            <tbody>
            <tr>
                <td valign="top">
                    <b>In Words :</b> {{strtoupper(\App\Helper\NumberInWords::convertwords($totalpayable))}}<br/>
                    <b>Note :</b><br/>
                </td>
                <td valign="bottom" class="wd-35p ht-80 text-center"><b>Account's Signature</b></td>
            </tr>
            </tbody>
            <tfoot class="bg-light">
            <tr>
                <td colspan="2" class="text-center">Design By : Digi Shiksha | www.digishiksha.in</td>
            </tr>
            </tfoot>
        </table>
    </div>

        @php
         $pagecount++;
         if($pagecount==2){
             echo '<div class="col-12 page-break"></div>';
             $pagecount=0;
         }
        @endphp
    @endforeach
</div>

<style type="text/css">
    @media all {
        .page-break	{ display: none; }
    }

    @media print {
        .page-break	{ display: block; page-break-before: always; }
    }
</style>
