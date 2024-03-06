<div class="col-lg-12 receipt-master-body">
    @php $totalpayable=0; @endphp
    @foreach($student as $data)
    <table class="table-receipt mg-t-10 bd-2 bd">
        <tr>
            <td><b>Admission No.</b></td><td><b>:</b></td><td>{{$data->admission_no}}</td>
            <td><b>Class/Course-Section</b></td><td><b>:</b></td><td>{{$data->CourseSection()}}</td>
            <td><b>Academic Year</b></td><td><b>:</b></td><td>{{$data->SessionName()}}</td>
        </tr>
        <tr>
            <td><b>Student Name</b></td><td><b>:</b></td><td>{{$data->fullName()}}</td>
            <td><b>Gender</b></td><td><b>:</b></td><td>{{ucwords($data->student->gender)}}</td>
            <td><b>DOB</b></td><td><b>:</b></td><td>@if($data->student->dob){{nowdate($data->student->dob,'d-F-Y')}}@endif</td>
        </tr>
        <tr>
            <td><b>Father's Name</b></td><td><b>:</b></td><td>{{$data->FatherName()}}</td>
            <td><b>Mother's Name</b></td><td><b>:</b></td><td>{{$data->MotherName()}}</td>
            <td><b>Contact No.</b></td><td><b>:</b></td><td>{{$data->student->contact_no}}</td>
        </tr>
        <tr>
            <td colspan="9" class="p-0 m-0" >
                <table class="table-receipt table-bordered p-0 m-0">
                    <thead class="bg-light">
                    <tr>
                        <th class="text-center wd-5p">S.No.</th>
                        <th class="wd-30p">Fee Head</th>
                        <th>Description</th>
                        <th class="wd-20p text-right">Amount</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                     $slno=0;
                     $studentfeerecord = studentfeerecord(studentparameter($data),$feeuptodate, $feepayid);
                     //dd($studentfeerecord);
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
                        <th class="text-right">{{numberformat($feeamount)}}</th>
                    </tr>

                    @endif
                    @endforeach
                    </tbody>
                    <tfoot class="bg-light">
                    <tr>
                        <td colspan="3" class="text-right"><b>Fee Payable :</b></td>
                        <td class="text-right"><b>@if(isset($studentfeerecord[5]['feepayable'])){{numberformat($studentfeerecord[5]['feepayable'])}}@endif</b></td>
                    </tr>
                    </tfoot>
                </table>
            </td>
        </tr>
    </table>
    @endforeach

    <table class="table-receipt table-bordered mg-t-10">
        <thead class="bg-light tx-14">
        <tr>
            <td class="text-right"><b>Total Fee Payable : </b></td>
            <td class="wd-20p text-right"><b>{{numberformat($totalpayable)}}</b></td>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td valign="top">
                <b>IN WORDS :</b> {{strtoupper(\App\Helper\NumberInWords::convertwords($totalpayable))}}<br/>
                <b>NOTE :</b><br/>
            </td>
            <td valign="bottom" class="text-right bd-0 bd wd-20p text-center"><div class="pd-t-50"><b>Account's Signature</b></div></td>
        </tr>
        <tr>
            <td colspan="2" class="text-center"><b>Powered By : DIGI SHIKSHA Ver. 3.0 | www.digishiksha.in</b></td>
        </tr>
        </tbody>
    </table>
</div>
