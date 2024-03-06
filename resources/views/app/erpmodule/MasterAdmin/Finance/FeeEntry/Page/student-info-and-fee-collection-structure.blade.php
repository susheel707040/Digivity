<div class="row m-0 pd-b-0 pd-l-5 tx-11 pd-t-0 pd-r-5 rounded-0">
    <div class="col-lg-12 p-0 bd-b bd-2 rounded-0 mg-t-2 text-right">
        <table class="float-left tx-13">
            <tr>
                <td><a loader-disable="true" href="{{url('/MasterAdmin/Finance/FeeEstimateReceipt/'.$studentrecord->student_id.'/'.$studentacledger.'/'.$feeuptodate.'/'.$feepayid.'/Print')}}" target="_blank"><button type="button" class="badge btn-outline-primary pd-3 pd-l-10 pd-r-10 tx-12 mg-t-3"><i class="fa fa-print"></i> Fee Estimate Receipt Print</button></a></td>
                <td class="pd-l-10"><button type="button" class="badge btn-outline-success pd-3 cursor-pointer pd-l-10 pd-r-10 tx-12 mg-t-3 custom-model-btn" url="{{url('/MasterAdmin/Finance/FeeDetailsPreview/'.$studentrecord->admission_no.'/'.$studentacledger.'/'.$feeuptodate.'/'.$feepayid.'/Preview')}}" model-title="Fee Details Preview" model-title-info="Student Fee Details Preview" model-class="modal-xl"><i class="fa fa-eye"></i> Fee Details Preview</button></td>

            </tr>
        </table>
        <table class="float-right">
            <tr>
                <td class="pd-r-20">
                    <div hidden studentid="{{$studentrecord->student_id}}" model-title="Add Student Special Concession" model-class="modal-xl"
                         model-title-info="Student Receipt Fee Head & Late Fee Concession" class="badge special-concession badge-dark container-fluid pd-l-10 pd-r-10 pd-t-5 mg-t-0 pd-b-5 tx-12 cursor-pointer"><i
                            class="fa fa-percentage"></i> Add Special Discount</div>
                    <div url="{{url('MasterAdmin/Finance/StudentFeeHeadConcession/'.$studentid.'/'.request()->route('feeuptodate').'/'.request()->route('feepayid').'/index')}}" model-title="Create Fee Head Concession" model-class="modal-xl" model-title-info="Create Fee Head Concession" class="badge special-concession badge-dark container-fluid pd-l-10 pd-r-10 pd-t-5 mg-t-0 pd-b-5 tx-12 cursor-pointer custom-model-btn">
                        <i class="fa fa-percentage"></i> Add Concession/Late Fee
                    </div>

                </td>
                <td>@include('erpmodule.MasterAdmin.Finance.FeeEntry.Page.fee-action-button')</td>
            </tr>
        </table>

    </div>
    <div class="col-lg-5 pd-l-0 pd-r-5 pd-t-3 m-0">
        <ul class="nav nav-line pd-l-5 " id="myTab5" role="tablist">
            <li class="nav-item"><a class="nav-link active" style=" padding:1px 0px;"><i class="fa fa-user"></i> <b class="tx-12">STUDENT INFORMATION</b></a></li>
        </ul>
        <table cellpadding="0" cellspacing="0" class="container-fluid mg-t-3">
            <tr>
                <td class="text-center">
                    <div class="avatar mx-auto avatar-xl d-none d-sm-block"><img src="{{$studentrecord->ProfileImage()}}"
                                                                                 class="rounded-circle bd-2 bd" alt=""></div>
                </td>
                <td class="pd-l-10 pd-r-10">
                    <input type="hidden" class="studentids" value="{{$studentrecord->student_id}}">
                    <input type="hidden" name="student_{{$studentrecord->student_id}}_course_id" value="{{$studentrecord->course_id}}">
                    <input type="hidden" name="student_{{$studentrecord->student_id}}_section_id" value="{{$studentrecord->section_id}}">
                    <table cellpadding="0" cellspacing="0" class="p-0 m-0">
                        <tr>
                            <td class="wd-80"><b>Admission No.</b></td><td class="pd-l-5 pd-r-5"><b>:</b></td><td><span url="{{url('MasterAdmin/StudentInformation/ModalEditStudentView/'.$studentrecord->student_id.'/view')}}" model-title="Edit Student Detail" model-class="modal-xxl" model-title-info="Edit Student Detail" class="custom-model-btn"><u class="text-primary cursor-pointer">{{$studentrecord->admission_no}} <i class="fa fa-edit fa-sm"></i></u></span>
                                <span class="pd-l-15"><b>Ledger No. :</b> <span class="badge badge-success">{{$studentrecord->ac_ledger_no}}</span></span>
                            </td>
                        </tr>
                        <tr>
                            <td><b>Student Name</b></td><td class="pd-l-5 pd-r-5"><b>:</b></td><td><span class="badge tx-11 student_name_{{$studentrecord->student_id}} badge-warning"><b>{{$studentrecord->fullName()}}</b></span></td>
                        </tr>
                        <tr>
                            <td><b>Class/Course</b></td><td class="pd-l-5 pd-r-5"><b>:</b></td><td><span class="course_name_{{$studentrecord->student_id}}">{{$studentrecord->CourseSection()}}</span></td>
                        </tr>
                        <tr>
                            <td><b>Father Name</b></td><td class="pd-l-5 pd-r-5"><b>:</b></td><td><span class="badge tx-11 m-0 badge-danger" style="padding:1.3px; "><b>{{$studentrecord->FatherName()}}</b></span></td>
                        </tr>
                        <tr>
                            <td><b>Mobile No. </b></td><td class="pd-l-5 pd-r-5"><b>:</b></td><td><b>{{$studentrecord->student->contact_no}}</b></td>
                        </tr>
                        <tr>
                            <td><b>Address </b></td><td class="pd-l-5 pd-r-5"><b>:</b></td><td class="tx-8"><b>{{$studentrecord->student->residence_address}}</b></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
    <div class="col-lg-7 vhr pd-l-5 pd-t-3 pd-r-0 m-0">
        <ul class="nav nav-line pd-l-0 " id="myTab5" role="tablist">
            <li class="col-4 pd-l-5 nav-item">
                <a class="nav-link active" style=" padding:1px 0px;"><b class="tx-11"><i class="fa fa-rupee-sign"></i> FEE PAID
                        HISTORY</b> </a>
            </li>
            @if($studentpaymenthistory)
                <li class="col-8 text-right"><b class="text-danger tx-10">
                        Last Fee Receipt <span class="tx-11">({{date('d-m-Y',strtotime($studentpaymenthistory->receipt_date))}})</span> Balance :
                        <span class="tx-11">{{currency()}} {{$studentpaymenthistory->balance}}</span></b>
                </li>
            @endif
        </ul>
        <div class="col-l-12 p-0 m-0" style="height:{{$height[0]}}; overflow:auto;  ">
            <table class="table-small tx-10 table-bordered mg-t-1">
                <thead class="bg-light">
                <tr>
                    <th class="text-center">Recpt. Date</th>
                    <th class="text-center"><b>Recpt. No.</b></th>
                    <th class="text-right"><b>Fee Payable</b></th>
                    <th class="text-center">Instalment</th>
                    <th class="text-right"><b>Paid Amt.</b></th>
                    <th class="text-right"><b>Bal</b></th>
                    <th class="text-center"><b>Status</b></th>
                    <th class="text-center"><b>Action</b></th>
                </tr>
                </thead>
                <tbody>
                @foreach(feecollectionlist(['student_id'=>$studentid]) as $data)
                    @php
                        $instalment="";
                        $feecollectioninstalment=feecollectioninstalmentgrouplist(['fee_collection_id'=>$data->id]);
                        if(isset($feecollectioninstalment)&&(is_array($feecollectioninstalment))){
                        $instalment=implode(', ',array_column($feecollectioninstalment,'instalment_unique_id'));
                        }
                    @endphp
                    <tr @if($data->receipt_status=="cancel") class="bg-pink-light" @endif>
                        <td class="text-center">{{date("d-M-Y",strtotime($data->receipt_date))}}</td>
                        <td class="text-center"><span url="{{url('/MasterAdmin/Finance/FeeReceiptPreview/'.$data->id.'/'.$studentid.'/preview')}}" class="text-primary cursor-pointer custom-model-btn" model-title="Fee Receipt Preview" model-class="modal-lg" model-title-info="Student Fee Receipt Preview & History"><u><b>{{$data->receipt_id}}</b></u><i class="fa fa-eye"></i></span></td>
                        <td class="text-right">{{$data->fee_payable}}</td>
                        <td class="text-center wd-15p">{{ucwords($instalment)}}</td>
                        <td class="text-right">{{$data->paid_amount}}</td>
                        <td class="text-right">{{$data->balance}}</td>
                        <td class="text-center"><span class="badge text-capitalize
                         @if($data->receipt_status=="paid") badge-success
                         @elseif($data->receipt_status=="unpaid") badge-warning
                         @elseif($data->receipt_status=="cancel") badge-danger @endif">{{$data->receipt_status}}</span></td>
                        <td class="text-center text-primary">@if($data->receipt_status=="paid")<a href="{{url('MasterAdmin/Finance/Receipt/'.$data->id.'/'.$data->receipt_group_token_id.'/Print')}}" loader-disable="true" target="_blank"><u>PRINT</u></a>@endif</td>
                    </tr>
                @endforeach
                @if(!count(feecollectionlist(['student_id'=>$studentid])))
                    <tr>
                        <td colspan="7" class="text-center text-danger"><b>Record No Found!</b></td>
                    </tr>
                @endif
                </tbody>
                <tfoot>
                <tr class="bg-success-light tx-12 font-weight-bold">
                    <td colspan="4" class="text-right"><b>Total Paid</b></td>
                    <td class="text-right">@php try{ echo numberformat(collect(feecollectionlist(['student_id'=>$studentid]))->where('receipt_status','paid')->sum('paid_amount')); }catch (\Exception $e){ echo numberformat(0);}@endphp</td>
                    <td colspan="3"></td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <div class="col-lg-12 pd-l-0 pd-r-0 pd-t-2 m-0 bd-t bd-1">
        <ul class="nav nav-line pd-l-0 " id="myTab5" role="tablist">
            <li class="nav-item col-4 pd-l-5">
                <a class="nav-link active" style=" padding: 1px 0px;"><b><i class="fa fa-rupee-sign"></i>FEE STRUCTURE</b></a>
            </li>
            <li class="col-4 text-right"></li>
        </ul>
        <div class="col-l-12 p-0 m-0"><!-- height : 135px;-->
            @foreach($studentfeerecord[0] as $data)
                @if(count($data['fee_head_all_instalment']))
                    @php $row=0; $trackid=$studentid."_".$data['fee_head_id']."_".$data['fee_structure_id']; @endphp
                    <input type="hidden" class="trackid student_{{$studentid}}_track_id" value="{{$trackid}}">
                    <div class="col-lg-12 bd-1 bd pd-l-5 pd-r-5 mg-t-2 mg-b-2">
                        <label class="tx-12"><b>{{$data['fee_head']}}
                                <input type="hidden" name="fee_head_{{$data['fee_head_id']}}_name" value="{{$data['fee_head']}}">
                                <span class="text-primary tx-10">{{$data['fee_head_amount']}} @if(isset($data['fee_structure_instalment_amount'])&&($data['fee_structure_instalment_amount'])) <b>(Per Fee {{max($data['fee_structure_instalment_amount'])}}) @endif </b></span></b></label>
                        <table>

                            <tr>
                                @foreach($data['fee_head_all_instalment'] as $instalment)
                                    @if(in_array($instalment,$data['fee_head_instalment']))
                                        @php $row++; @endphp
                                        <td class="pd-l-2"><input type="checkbox" name="stud_{{$studentid}}_stru_{{$data['fee_structure_id']}}_fee_{{$data['fee_head_id']}}_instalment_id[]" studentid="{{$studentid}}"
                                                                  data-position="@if(isset($data['fee_head_instalment_start_date'][$instalment])){{strtotime($data['fee_head_instalment_start_date'][$instalment])}}@else{{'0'}}@endif"
                                                                  data-amount="@if(isset($data['fee_structure_instalment_amount'][$instalment])){{$data['fee_structure_instalment_amount'][$instalment]-$data['fee_head_instalment_concession'][$instalment]+$data['fee_head_instalment_late_fee'][$instalment]}}@else{{0}}@endif"
                                                                  class="fee_instalment @if(isset($data['select_pay_instalment_amount'][$instalment])) fee_instalment_{{$trackid}} @endif f_i_check_{{$trackid}}_{{$instalment}}"
                                                                  value="{{$instalment}}"
                                                                  @if(in_array($instalment,$data['select_pay_instalment'])) checked @endif>
                                        </td>
                                        <td class="pd-l-2 pd-r-5">
                                            <p class="tx-10 m-0 lh--9 text-success p-0"><b>@if(isset($data['fee_structure_instalment_amount'][$instalment])){{$data['fee_structure_instalment_amount'][$instalment]}}@else{{"0"}}@endif</b></p>
                                            <p class="m-0 lh-lg-1 font-weight-bold">{{$data['fee_head_instalment_print'][$instalment]}}</p>
                                            <input class="f_i_{{$trackid}} f_i_{{$trackid}}_{{$instalment}}"
                                                   value="{{$instalment}}" type="hidden" autocomplete="off" readonly="readonly">
                                            <input class="f_i_s_{{$trackid}}_{{$instalment}}"
                                                   value="{{$data['fee_head_instalment_sequence'][$instalment]}}" type="hidden"
                                                   autocomplete="off" readonly="readonly">
                                            <input class="f_i_p_{{$trackid}}_{{$instalment}}"
                                                   value="@if(isset($data['fee_head_instalment_print'][$instalment])){{$data['fee_head_instalment_print'][$instalment]}}@else{{""}}@endif" type="hidden"
                                                   autocomplete="off" readonly="readonly">
                                            <input class="f_i_a_{{$trackid}}_{{$instalment}}"
                                                   value="@if(isset($data['fee_structure_instalment_amount'][$instalment])){{$data['fee_structure_instalment_amount'][$instalment]}}@else{{"0"}}@endif"
                                                   type="hidden" autocomplete="off" readonly="readonly">
                                            <input class="f_i_c_{{$trackid}}_{{$instalment}}"
                                                   value="@if(isset($data['fee_head_instalment_concession'][$instalment])){{$data['fee_head_instalment_concession'][$instalment]}}@else{{"0"}}@endif"
                                                   type="hidden" autocomplete="off" readonly="readonly">
                                            <input class="f_i_f_{{$trackid}}_{{$instalment}}"
                                                   value="@if(isset($data['fee_head_instalment_late_fee'][$instalment])){{$data['fee_head_instalment_late_fee'][$instalment]}}@else{{"0"}}@endif"
                                                   type="hidden" autocomplete="off" readonly="readonly">
                                        </td>
                                    @else
                                        <td><input type="checkbox" checked disabled></td><td class="pd-l-2 text-danger pd-r-5"><b>{{$data['fee_head_instalment_print'][$instalment]}}</b></td>
                                    @endif
                                @endforeach
                            </tr>
                        </table>
                    </div>
                @endif
            @endforeach

            <table class="table-small table-bordered mg-t-1">
                <thead class="bg-light">
                <tr>
                    <th class="text-center">#</th>
                    <th><b>Fee Head</b></th>
                    <th class="text-right"><b>Fee Amount</b></th>
                    <th class="text-center"><b>Pay Qty.</b></th>
                    <th class="wd-35p"><b>Description</b></th>
                    <th class="text-right">Sub Total</th>
                    <th class="text-right"><b>Discount</b></th>
                    <th class="text-right"><b>Late Fee</b></th>
                    <th class="text-right"><b>Amount</b></th>
                </tr>
                </thead>
                <tbody>

                @foreach($studentfeerecord[0] as $data)
                    @if(count($data['fee_head_all_instalment']))
                        @php $trackid=$studentid."_".$data['fee_head_id']."_".$data['fee_structure_id']; @endphp
                        @foreach($data['fee_head_instalment'] as $instalment)
                            <input class="i_f_i_{{$trackid}} i_f_i_{{$trackid}}_{{$instalment}}"
                                   value="@if(isset($data['select_pay_instalment'][$instalment])){{$data['select_pay_instalment'][$instalment]}}@endif"
                                   type="hidden" autocomplete="off" readonly="readonly">
                            <input name="i_f_i_s_{{$trackid}}_{{$instalment}}" class="i_f_i_s_{{$trackid}} i_f_i_s_{{$trackid}}_{{$instalment}}"
                                   value="@if(isset($data['fee_head_instalment_sequence'][$instalment])){{$data['fee_head_instalment_sequence'][$instalment]}}@endif"
                                   type="hidden" autocomplete="off" readonly="readonly">
                            <input name="i_f_i_p_{{$trackid}}_{{$instalment}}" class="i_f_i_p_{{$trackid}} i_f_i_p_{{$trackid}}_{{$instalment}}"
                                   value="@if(isset($data['select_pay_instalment_print'][$instalment])){{$data['select_pay_instalment_print'][$instalment]}}@endif"
                                   type="hidden" autocomplete="off" readonly="readonly">
                            <input name="i_f_i_a_{{$trackid}}_{{$instalment}}" class="i_f_i_a_{{$trackid}} i_f_i_a_{{$trackid}}_{{$instalment}}"
                                   value="@if(isset($data['select_pay_instalment_amount'][$instalment])){{$data['select_pay_instalment_amount'][$instalment]}}@else{{"0"}}@endif"
                                   type="hidden" autocomplete="off" readonly="readonly">
                            <input name="i_f_i_c_{{$trackid}}_{{$instalment}}" class="i_f_i_c_{{$trackid}} i_f_i_c_{{$trackid}}_{{$instalment}}"
                                   value="@if(isset($data['select_pay_instalment_concession'][$instalment])){{$data['select_pay_instalment_concession'][$instalment]}}@else{{"0"}}@endif"
                                   type="hidden" autocomplete="off" readonly="readonly">
                            <input name="i_f_i_f_{{$trackid}}_{{$instalment}}" class="i_f_i_f_{{$trackid}} i_f_i_f_{{$trackid}}_{{$instalment}}"
                                   value="@if(isset($data['select_pay_instalment_late_fee'][$instalment])){{$data['select_pay_instalment_late_fee'][$instalment]}}@else{{"0"}}@endif"
                                   type="hidden" autocomplete="off" readonly="readonly">
                        @endforeach

                        <tr>
                            <td class="text-center"><input type="checkbox" studentid="{{$studentid}}" name="student_{{$studentid}}_fee_structure_id[]" class="fee_head_id_check fee_head_id_{{$trackid}}_check" trackid="{{$trackid}}" value="{{$data['fee_structure_id']}}" @if($data['fee_instalment_count']) checked @endif>
                                <input type="hidden" name="student_{{$studentid}}_fee_head_{{$data['fee_structure_id']}}_id" value="{{$data['fee_head_id']}}">
                                <input type="hidden" name="student_{{$studentid}}_fee_head_{{$data['fee_structure_id']}}_priority" value="{{$data['fee_head_sequence']}}">
                                <input type="hidden" name="student_{{$studentid}}_custom_fee_{{$data['fee_structure_id']}}_id" value="{{$data['custom_fee_id']}}">
                            </td>
                            <td>{{$data['fee_head']}}</td>
                            <td class="text-right">{{$data['fee_head_amount']}}</td>
                            <td class="text-center"><span class="f_qty_{{$trackid}}">{{$data['fee_instalment_count']}}</span></td>
                            <td><span class="f_print_{{$trackid}}">{{implode(',',$data['select_pay_instalment_print'])}}</span></td>
                            <td class="text-right"><span class="f_subtotal_{{$studentid}} f_subtotal_{{$trackid}}">{{array_sum($data['select_pay_instalment_amount'])}}</span></td>
                            <td class="text-right"><span class="f_concession_{{$studentid}} f_concession_{{$trackid}}">{{array_sum($data['select_pay_instalment_concession'])}}</span></td>
                            <td class="text-right"><span class="f_fine_{{$studentid}} f_fine_{{$trackid}}">{{array_sum($data['select_pay_instalment_late_fee'])}}</span></td>
                            <td class="text-right"><span class="f_total_{{$studentid}} f_total_{{$trackid}}">{{((array_sum($data['select_pay_instalment_amount'])-array_sum($data['select_pay_instalment_concession']))+array_sum($data['select_pay_instalment_late_fee']))}}</span></td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
                @php
                    $totalarr['subtotal'] +=$studentfeerecord[1]['subtotal'];
                    $totalarr['concessiontotal'] +=$studentfeerecord[2]['concessiontotal'];
                    $totalarr['finetotal'] +=$studentfeerecord[3]['finetotal'];
                    $totalarr['excesstotal'] +=$studentfeerecord[4]['excesstotal'];
                    $totalarr['feepayable'] +=$studentfeerecord[5]['feepayable'];
                @endphp
                <thead class="bg-light">
                <tr>
                    <th colspan="5" class="text-right"><b>Total Payable :</b></th>
                    <th class="text-right bg-success-light"><b><span
                                class="subtotal_tx subtotal_tx_{{$studentid}}">{{$studentfeerecord[1]['subtotal']}}</span></b>
                    </th>
                    <th class="text-right bg-success-light"><b><span
                                class="totalconcession_tx totalconcession_tx_{{$studentid}}">{{$studentfeerecord[2]['concessiontotal']}}</span></b>
                    </th>
                    <th class="text-right bg-success-light"><b><span
                                class="totalfine_tx totalfine_tx_{{$studentid}}">{{$studentfeerecord[3]['finetotal']}}</span></b>
                    </th>
                    <th class="text-right bg-success-light"><b><span
                                class="totalpayable_tx totalpayable_tx_{{$studentid}}">{{$studentfeerecord[5]['feepayable']}}</span></b>
                    </th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
