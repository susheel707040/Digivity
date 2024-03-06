<div class="container-fluid  pd-b-10 m-0 row">
    @php
    $foottotalsum=['totalfee'=>0,'totalconcession'=>0,'totallatefee'=>0,'totalfeepayable'=>0]
    @endphp
    @foreach($student as $data)
    <div class="col-lg-6 pd-l-10 pd-r-5">
     <table class="table-receipt bd-1 mg-t-5 bd tx-10">
         <thead>
         <tr class="bg-primary-light tx-12">
             <th colspan="6">{{$data->fullName()}} Fee Details :</th>
         </tr>
         <tr>
             <td><b>Admission No.</b></td><td><b>:</b></td><td>{{$data->admission_no}}</td>
             <td><b>Course</b></td><td><b>:</b></td><td>{{$data->CourseSection()}}</td>
         </tr>
         <tr>
             <td><b>Student Name</b></td><td><b>:</b></td><td><span class="badge badge-warning">{{$data->fullName()}}</span></td>
             <td><b>Father's Name</b></td><td><b>:</b></td><td><span class="badge badge-danger">{{$data->FatherName()}} <span class="tx-9">({{$data->student->contact_no}})</span></span></td>

         </tr>
         <tr>
             <td><b>Address</b></td><td><b>:</b></td><td colspan="4">{{$data->Address()}}</td>
         </tr>
         <tr>
             <td><b>Transport</b></td><td><b>:</b></td><td>{{$data->TransportName()}}</td>
             <td><b>Concession</b></td><td><b>:</b></td><td>{{$data->ConcessionName()}}</td>
         </tr>
         <tr>
             <td><b>Fee Upto Month</b></td><td><b>:</b></td><td><span class="badge badge-success">{{nowdate($feeuptodate,'d-F-Y')}}</span></td>
             <td><b>Last Fee Paid</b></td><td><b>:</b></td><td><span class="badge badge-primary">@if($data->LastFeePaidDate()){{nowdate($data->LastFeePaidDate(),'d-F-Y')}}@endif</span></td>
         </tr>
         </thead>
     </table>
      <table class="table-receipt table-bordered tx-10">
            <thead class="bg-light">
            <tr>
                <th>Fee Head</th>
                <th>Description</th>
                <th class="text-right">Fee Amount</th>
                <th class="text-right">Concession</th>
                <th class="text-right">Late Fee</th>
                <th class="text-right bg-success-light">Total Fee</th>
            </tr>
            </thead>
            @php
            $totalarr=['feeamount'=>0,'concession'=>0,'latefee'=>0,'totalpayable'=>0];
            $studentfeerecord = studentfeerecord(studentparameter($data),$feeuptodate, $feepayid);
            @endphp

            <tbody>
            @foreach($studentfeerecord[0] as $data)

            @if(count($data['select_pay_instalment_print']))

            @php
             $data['select_pay_instalment_amount'] ? $feeamount=array_sum($data['select_pay_instalment_amount']) : $feeamount=0;
             $data['select_pay_instalment_concession'] ? $feeconcession=array_sum($data['select_pay_instalment_concession']) : $feeconcession=0;
             $data['select_pay_instalment_late_fee'] ? $feelatefee=array_sum($data['select_pay_instalment_late_fee']) : $feelatefee=0;
             $feepayableamount=($feeamount-$feeconcession+$feelatefee);
             $totalarr['feeamount'] +=$feeamount;
             $totalarr['concession'] +=$feeconcession;
             $totalarr['latefee'] +=$feelatefee;
             $totalarr['totalpayable'] +=$feepayableamount;

            $foottotalsum['totalfee'] +=$feeamount;
            $foottotalsum['totalconcession'] +=$feeconcession;
            $foottotalsum['totallatefee'] +=$feelatefee;
            $foottotalsum['totalfeepayable'] +=$feepayableamount;
            @endphp

            <tr>
                <td>{{$data['fee_head']}}</td>
                <td>@if(count($data['select_pay_instalment_print'])){{implode(",",$data['select_pay_instalment_print'])}}@else {{"--"}} @endif</td>
                <td class="text-right">{{numberformat($feeamount)}}</td>
                <td class="text-right">{{numberformat($feeconcession)}}</td>
                <td class="text-right">{{numberformat($feelatefee)}}</td>
                <td class="text-right bg-success-light">{{numberformat($feepayableamount)}}</td>
            </tr>

            @endif

            @endforeach
            </tbody>
          <tfoot class="bg-light tx-bold">
          <tr>
              <td colspan="2" class="text-right">Total Fee Payable :</td>
              @foreach($totalarr as $total)
              <td class="text-right">{{numberformat($total)}}</td>
              @endforeach
          </tr>
          </tfoot>
       </table>
    </div>
    @endforeach
</div>
<div class="container-fluid modal-footer aligned-left justify-content-between pd-x-20 pd-y-10">
    <table class="float-left">
        <tr>
            <td class="text-right"><b>Total Fee Amount </b><br/><span class="tx-12">{{numberformat($foottotalsum['totalfee'])}}</span></td>
            <td class="pd-l-25 text-right"><b>Total Concession </b><br/><span class="tx-12">{{numberformat($foottotalsum['totalconcession'])}}</span></td>
            <td class="pd-l-25 text-right"><b>Total Late Fee </b><br/><span class="tx-12">{{numberformat($foottotalsum['totallatefee'])}}</span></td>
            <td class="pd-l-25 text-right"><b>Total Fee Payable </b><br/><span class="badge badge-success tx-13">{{numberformat($foottotalsum['totalfeepayable'])}}</span></td>
            <td class="pd-l-25 wd-300">
                <b>In Words</b><br/>
                <span class="tx-10">{{strtoupper(\App\Helper\NumberInWords::convertwords($foottotalsum['totalfeepayable']))}}</span>
            </td>
        </tr>
    </table>
    <button type="button" class="btn btn-outline-primary tx-12"><i class="fa fa-print"></i> Fee Estimate Receipt Print</button>
    <button type="button" class="btn btn-white float-right tx-12" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
</div>
