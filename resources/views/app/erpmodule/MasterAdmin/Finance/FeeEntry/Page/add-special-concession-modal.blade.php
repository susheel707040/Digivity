<div class="col-lg-12 row m-0 pd-l-5 pd-r-5">
    <div class="col-lg-9">
    <table class="table table-bordered mg-t-5">
        <thead class="bg-success-light">
        <tr>
            <td colspan="1" class="text-right"><b>Total :</b></td>
            <td><span class="sc_subtotal_total tx-bold">@if(isset($studentfee["feesubtotal"])){{$studentfee["feesubtotal"]}}@endif</span></td>
            <td><span class="sc_concession_total tx-bold">@if(isset($studentfee["feeconcessiontotal"])){{$studentfee["feeconcessiontotal"]}}@endif</span></td>
            <td><span class="sc_latefee_total tx-bold">@if(isset($studentfee["feefinetotal"])){{$studentfee["feefinetotal"]}}@endif</span></td>
            <td><span class="sc_balance_total tx-bold">@if(isset($studentfee["feepayable"])){{$studentfee["feepayable"]}}@endif</span></td>
        </tr>
        </thead>
        <thead class="bg-light">
        <tr>
            <th>Fee Name/Instalment</th>
            <th>Fee Amount</th>
            <th>Concession</th>
            <th>Late Fee</th>
            <th>Balance</th>
        </tr>
        </thead>
    <tbody>
    @php $total=['subtotal'=>0,'concession'=>0,'latefee'=>0,'balance'=>0] @endphp
 @foreach($studentfee["student_".$studentid."_fee_structure_id"] as $feestructureid)
     @if(isset($studentfee["student_".$studentid."_fee_head_".$feestructureid."_id"]))

         @php $feeheadid=$studentfee["student_".$studentid."_fee_head_".$feestructureid."_id"]; @endphp

     @if(isset($studentfee["stud_".$studentid."_stru_".$feestructureid."_fee_".$feeheadid."_instalment_id"]))
        @php $instalment_count=count($studentfee["stud_".$studentid."_stru_".$feestructureid."_fee_".$feeheadid."_instalment_id"]); @endphp

        @if($instalment_count>1)
            <tr class="bg-light">
                <td><b>{{$studentfee["fee_head_".$feeheadid."_name"]}}</b></td>
                <td><b>All Instalment</b></td>
                <td><input type='text' placeholder="For all" style="width:70px;"></td>
                <td><input type='text' placeholder="For all" style="width:70px;"></td>
                <td></td>
            </tr>
        @endif

        @foreach($studentfee["stud_".$studentid."_stru_".$feestructureid."_fee_".$feeheadid."_instalment_id"] as $instalmentid)

             @php
                 $feeamount=0;
                 if(isset($studentfee["i_f_i_a_".$studentid."_".$feeheadid."_".$feestructureid."_".$instalmentid.""])){
                 $feeamount=$studentfee["i_f_i_a_".$studentid."_".$feeheadid."_".$feestructureid."_".$instalmentid.""];
                 $total['subtotal'] +=$feeamount;
                 }
                 $feeconcession=0;
                 if(isset($studentfee["i_f_i_c_".$studentid."_".$feeheadid."_".$feestructureid."_".$instalmentid.""])){
                 $feeconcession=$studentfee["i_f_i_c_".$studentid."_".$feeheadid."_".$feestructureid."_".$instalmentid.""];
                 $total['concession'] +=$feeconcession;
                 }
                 $latefee=0;
                 if(isset($studentfee["i_f_i_f_".$studentid."_".$feeheadid."_".$feestructureid."_".$instalmentid.""])){
                 $latefee=$studentfee["i_f_i_f_".$studentid."_".$feeheadid."_".$feestructureid."_".$instalmentid.""];
                 $total['latefee'] +=$latefee;
                 }
                 $totalbalance=(($feeamount+$latefee)-$feeconcession);
                 $total['balance'] +=$totalbalance;

                 $trackid=$studentid."_".$feeheadid."_".$feestructureid."_".$instalmentid;
             @endphp
             <input type="hidden" readonly class="sc_track_id" value="{{$trackid}}">
     <tr>
         <td><b>{{$studentfee["fee_head_".$feeheadid."_name"]}} - @if(isset($studentfee["i_f_i_p_".$studentid."_".$feeheadid."_".$feestructureid."_".$instalmentid.""])){{$studentfee["i_f_i_p_".$studentid."_".$feeheadid."_".$feestructureid."_".$instalmentid.""]}}@endif</b></td>
         <td><input type="text" readonly class="sc_subtotal sc_subtotal_{{$trackid}}" trackid="{{$trackid}}"  class="form-control1 text-center bd-0" style="width:70px; background-color: whitesmoke; border:1px solid gray; cursor: not-allowed;" feeamount="{{$feeamount}}" value="{{$feeamount}}"></td>
         <td><input type="text" class="sc_concession sc_concession_{{$trackid}}" trackid="{{$trackid}}"  class="form-control1 text-center " onkeypress="javascript:return isNumber(event)" style="width:70px; border:1px solid gray;" oldval="{{$feeamount}}" concession="{{$feeconcession}}" value="{{$feeconcession}}"></td>
         <td><input type="text" class="sc_latefee sc_latefee_{{$trackid}}" trackid="{{$trackid}}" class="form-control1 text-center " onkeypress="javascript:return isNumber(event)" style="width:70px; border:1px solid gray;" oldval="0" latefee="{{$latefee}}" value="{{$latefee}}"></td>
         <td><input type="text" readonly class="sc_balance sc_balance_{{$trackid}}" trackid="{{$trackid}}" class="form-control1 text-center bg-light" style="width:70px; background-color: whitesmoke; cursor: not-allowed; border:1px solid gray;" value="{{$totalbalance}}"></td>
     </tr>

         @endforeach
      @endif
     @endif
 @endforeach
    </tbody>
        <tfoot class="bg-success-light">
        <tr>
            <td colspan="1" class="text-right"><b>Total :</b></td>
            <td><span class="sc_subtotal_total tx-bold">{{$total['subtotal']}}</span></td>
            <td><span class="sc_concession_total tx-bold">{{$total['concession']}}</span></td>
            <td><span class="sc_latefee_total tx-bold">{{$total['latefee']}}</span></td>
            <td><span class="sc_balance_total tx-bold">{{$total['balance']}}</span></td>
        </tr>
        </tfoot>
    </table>
    </div>

    <div class="col-lg-3 pd-l-5 pd-r-5 text-center">
        <button type="button" id="concession_apply_btn" studentid="{{$studentid}}" class="btn btn-primary mg-t-5 btn-block btn-sm"><i class="fa fa-check"></i> Apply</button>
        <button type="button" id="concession_reset_btn" studentid="{{$studentid}}" class="btn btn-danger mg-t-20 btn-block btn-sm"><i class="fa fa-exchange"></i> Reset</button>
    <div class="col-lg-12 text-left mg-t-10 pd-l-0 pd-r-0">
        <label>Remark :</label>
        <textarea class="form-control" style=" height:200px; " placeholder="Enter Remark"></textarea>
    </div>
    </div>
</div>
