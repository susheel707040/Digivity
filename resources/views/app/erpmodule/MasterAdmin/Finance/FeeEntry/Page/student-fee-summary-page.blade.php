@if(count($studentidarr)==1)
    @php

        $height=array("100px","350px");
        $studentrecord = studentshortlist(['student_id' => $studentid])->shift();
        $studentfeerecord = studentfeerecord(studentparameter($studentrecord),$feeuptodate, $feepayid);
        $studentpaymenthistory=collect(feecollectionlist(['student_id'=>$studentid]))->first();
       $studentacledger=0;
       if($studentrecord->ac_ledger_no){$studentacledger=$studentrecord->ac_ledger_no; }
    @endphp
    @if(isset($studentrecord))
        @include('erpmodule.MasterAdmin.Finance.FeeEntry.Page.student-info-and-fee-collection-structure',['studentacledger'=>$studentacledger])
    @endif
@else

    @foreach($studentidarr as $studentid)
        @php

            $height=array("140px","350px");
            $studentrecord = studentshortlist(['student_id' => $studentid])->shift();
            if(isset($studentrecord)){
            $studentfeerecord = studentfeerecord(studentparameter($studentrecord),$feeuptodate,$feepayid);
            $studentpaymenthistory=collect(feecollectionlist(['student_id'=>$studentid]))->first();
            $studentacledger=0;
            if($studentrecord->ac_ledger_no){$studentacledger=$studentrecord->ac_ledger_no; }
            }
        @endphp
        @if(isset($studentrecord))
            @if($loop->iteration==1)
                <div class="col-lg-12 pd-t-6 row bd-2 bd-b pd-b-3 mg-b-2">
                    <table class="float-left tx-13">
                        <tr>
                            <td><a loader-disable="true" href="{{url('/MasterAdmin/Finance/FeeEstimateReceipt/'.$studentrecord->student_id.'/'.$studentacledger.'/'.$feeuptodate.'/'.$feepayid.'/Print')}}" target="_blank"><button type="button" class="badge btn-outline-primary pd-3 pd-l-10 pd-r-10 tx-12 mg-t-3"><i class="fa fa-print"></i> Fee Estimate Receipt Print</button></a></td>
                            <td class="pd-l-10"><button type="button" class="badge btn-outline-success pd-3 cursor-pointer pd-l-10 pd-r-10 tx-12 mg-t-3 custom-model-btn" url="{{url('/MasterAdmin/Finance/FeeDetailsPreview/'.$studentrecord->admission_no.'/'.$studentacledger.'/'.$feeuptodate.'/'.$feepayid.'/Preview')}}" model-title="Fee Details Preview" model-title-info="Student Fee Details Preview" model-class="modal-xl"><i class="fa fa-eye"></i> Fee Details Preview</button></td>
                        </tr>
                    </table>
                </div>
            @endif


            <div class="modal fade" id="StudentModels_{{$studentid}}" tabindex="-1" role="dialog" aria-hidden="true">
                <div id="modal-dialog" class="modal-dialog modal-dialog-centered modal-xl" role="document">
                    <div class="modal-content" >
                        <div class="modal-header pd-y-10 pd-x-10 pd-sm-x-20">
                            <a href="#" role="button" class="close pos-absolute t-15 r-15" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </a>
                            <div class="media align-items-center">
                                <span class="tx-color-03 d-none d-sm-block"><i class="fa fa-list fa-lg"></i></span>
                                <div class="media-body mg-sm-l-20">
                                    <h4 class="tx-20 tx-sm-15 mg-b-1" id="model-title"><b>Student Details & Fee Details</b></h4>
                                    <p class="tx-10 tx-color-03 mg-b-0" id="model-title-info">Student Details and Student Fee Structure Detail</p>
                                </div>
                            </div><!-- media -->
                        </div><!-- modal-header -->
                        <div class="modal-body pd-l-10 pd-sm-t-0 pd-sm-b-0 pd-sm-x-0">
                            @include('erpmodule.MasterAdmin.Finance.FeeEntry.Page.student-info-and-fee-collection-structure')
                        </div>
                    </div><!-- modal-content -->
                </div><!-- modal-dialog -->
            </div><!-- modal -->

            <div class="col-lg-12 tx-10 mg-b-2 bg-gray-50 p-1 bd bd-1 rounded-5">
                <table cellpadding="0" cellspacing="0" class="p-0 m-0 container-fluid">
                    <tr>
                        <td class="pd-l-5 wd-80">
                            <div class="avatar avatar-xl  d-none d-sm-block"><img src="{{$studentrecord->ProfileImage()}}"
                                                                                  class="rounded-circle bd-2 bd" alt=""></div>
                        </td>
                        <td class="pd-l-10 pd-r-10">
                            <table cellpadding="0" cellspacing="0" class="p-0 m-0">
                                <tr>
                                    <td><b>Admission No.</b></td>
                                    <td class="pd-l-5 pd-r-5"><b>:</b></td>
                                    <td><span url="{{url('MasterAdmin/StudentInformation/ModalEditStudentView/'.$studentrecord->student_id.'/view')}}" model-title="Edit Student Detail" model-class="modal-xxl" model-title-info="Edit Student Detail" class="custom-model-btn cursor-pointer"><u class="text-primary">{{$studentrecord->admission_no}} <i class="fa fa-edit"></i></u></span>
                                        <span class="pd-l-15"><b>AC Ledger No. : {{$studentrecord->ac_ledger_no}}</b></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>Student Name</b></td>
                                    <td class="pd-l-5 pd-r-5"><b>:</b></td>
                                    <td><span class="badge tx-11 m-0 pd-2 text-capitalize badge-warning"><b>{{$studentrecord->student->first_name}} {{$studentrecord->student->middle_name}} {{$studentrecord->student->last_name}}</b></span></td>
                                </tr>
                                <tr>
                                    <td><b>Course - Section</b></td>
                                    <td class="pd-l-5 pd-r-5"><b>:</b></td>
                                    <td class="text-capitalize">{{$studentrecord->course->course}} - {{$studentrecord->section->section}} (2019-2020)</td>
                                </tr>
                                <tr>
                                    <td><b>Father Name</b></td>
                                    <td class="pd-l-5 pd-r-5"><b>:</b></td>
                                    <td class="text-capitalize"><span class="badge tx-11 m-0 badge-danger"
                                                                      style="padding:1.3px; "><b>{{$studentrecord->student->father_name}}</b> <span class="tx-8">({{$studentrecord->student->contact_no}})</span></span></td>
                                </tr>
                                <tr>
                                    <td><b>Transport</b></td><td class="pd-l-5 pd-r-5"><b>:</b></td>
                                    <td>{{$studentrecord->TransportName()}}</td>
                                </tr>
                            </table>
                        </td>
                        <td class="pd-l-10 wd-100 pd-r-10 pd-t-0 pd-b-0 bd-l bd-1">
                            <table cellspacing="0" cellpadding="0" class="table p-0 m-0 table-borderless">
                                @if($studentpaymenthistory)
                                    <tr>
                                        <td class="text-danger p-0 m-0">
                                            <b>Last Fee Receipt ({{date('d-m-Y',strtotime($studentpaymenthistory->receipt_date))}})<br/> Balance : {{currency()}} {{$studentpaymenthistory->balance}}</b>
                                        </td>
                                    </tr>
                                @endif
                                <tr>
                                    <td class="p-0 m-0">@include('erpmodule.MasterAdmin.Finance.FeeEntry.Page.fee-action-button')</td>
                                </tr>
                                <tr>
                                    <td class="text-center p-0 m-0">
                                <span class="badge badge-dark container-fluid pd-l-10 pd-r-10 pd-t-5 mg-t-5 pd-b-5 tx-12 cursor-pointer custom-model-btn" url="{{url('MasterAdmin/Finance/StudentFeeHeadConcession/'.$studentid.'/'.request()->route('feeuptodate').'/'.request()->route('feepayid').'/index')}}" model-title="Create Fee Head Concession" model-class="modal-xl" model-title-info="Create Fee Head Concession"><i
                                        class="fa fa-percentage"></i> Add Discount</span>
                                    </td>
                                </tr>
                            </table>

                        </td>
                        <td class="pd-l-10 pd-r-10 wd-25p bd-l bd-1">
                            <table cellpadding="0" cellspacing="0" class="container-fluid tx-10 p-0 m-0">
                                <tr class="text-danger">
                                    <td class="wd-90"><b>Sub Total</b></td>
                                    <td class="pd-l-5 pd-r-5"><b>:</b></td>
                                    <td class="text-right"><b> <span class="subtotal_tx_{{$studentid}}">{{numberformat($studentfeerecord[1]['subtotal'])}}</span></b></td>
                                </tr>
                                <tr>
                                    <td><b>Concession</b></td>
                                    <td class="pd-l-5 pd-r-5"><b>:</b></td>
                                    <td class="text-right"><b><span class="totalconcession_tx_{{$studentid}}">{{numberformat($studentfeerecord[2]['concessiontotal'])}}</span></b></td>
                                </tr>
                                <tr>
                                    <td><b>Late/Fine Fee</b></td>
                                    <td class="pd-l-5 pd-r-5"><b>:</b></td>
                                    <td class="text-right"><b><span class="totalfine_tx_{{$studentid}}">{{numberformat($studentfeerecord[3]['finetotal'])}}</span></b></td>
                                </tr>
                                <tr class="text-success">
                                    <td><b>Excess Amount</b></td>
                                    <td class="pd-l-5 pd-r-5"><b>:</b></td>
                                    <td class="text-right"><b><span class="excess_tx_{{$studentid}}">0.00</span></b></td>
                                </tr>
                                <tr>
                                    <td><b>Fee Payable</b></td>
                                    <td class="pd-l-5 pd-r-5"><b>:</b></td>
                                    <td class="text-right"><b><span class="badge badge-warning tx-11 pd-r-0 font-weight-bold totalpayable_tx_{{$studentid}}">{{numberformat($studentfeerecord[5]['feepayable'])}}</span></b></td>
                                </tr>
                            </table>
                        </td>
                        <td class="pd-l-5 text-center wd-50 bd-l bd-1">
                            <button type="button" href="#StudentModels_{{$studentid}}" data-toggle="modal" class="btn btn-dark pd-l-15 text-center btn-icon"><i class="fa fa-clone"></i>
                            </button>
                        </td>
                    </tr>
                </table>
            </div>
        @endif
    @endforeach
@endif

