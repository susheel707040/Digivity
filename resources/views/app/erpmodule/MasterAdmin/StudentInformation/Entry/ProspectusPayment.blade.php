@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="{{url('/home')}}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Student Information</li>
            <li class="breadcrumb-item active" aria-current="page">Prospectus Entry</li>
            <li class="breadcrumb-item active" aria-current="page">Prospectus Payment</li>
        </ol>
    </nav>
    <div class="panel panel-default">
        <div class="panel-heading"><b><i class="fa fa-rupee-sign"></i> Prospectus Payment</b></div>
        <div class="panel-body pd-b-15 tx-13">
            <form class="" action="{{url('MasterAdmin/StudentInformation/ProspectusPaymentCollection')}}" method="POST"  data-parsley-validate="" novalidate="">
                {{csrf_field()}}
                <div class="row pd-0 m-0">
                    <div class="col-lg-10 m-0 pd-l-5 pd-r-5 row">
                        @if(isset($studentprospectus))
                            <input type="hidden" class="course_id" name="course_id" value="{{$studentprospectus->course_id}}">
                            <input type="hidden" name="receiptgroupid" value="{{time()}}">
                            <input type="hidden" name="prospectus_id" value="{{$studentprospectus->id}}">


                            <table class="table bd-1 bd bg-light mg-b-10 mg-t-10 tx-12">
                                <tbody>
                                <tr>
                                    <td><b>Reg No./ Pros No.</b></td><td><b>:</b></td><td>{{$studentprospectus->pros_no}}</td>
                                    <td><b>Date</b></td><td><b>:</b></td><td>{{nowdate($studentprospectus->admission_date,'d-F-Y')}}</td>
                                    <td><b>Reference</b></td><td><b>:</b></td><td>{{ucwords($studentprospectus->reference)}}</td>
                                    <td rowspan="5" class="wd-150"><div class="avatar avatar-xxl mx-auto"><img src="{{url('uploads/prospectuus_image/' .$studentprospectus->student_photo)}}" class="rounded-circle bd bd-3" alt=""></div></td>
                                </tr>
                                <tr>
                                    <td><b>Admission Type</b></td><td><b>:</b></td><td>{{$studentprospectus->AdmissionTypeName()}}</td>
                                    <td><b>Course</b></td><td><b>:</b></td><td>{{$studentprospectus->CourseName()}}</td>
                                    <td><b>Academic Year</b></td><td><b>:</b></td><td>{{$studentprospectus->AcademicYearName()}}</td>
                                </tr>
                                <tr>
                                    <td><b>Student Name</b></td><td><b>:</b></td><td><span class="badge badge-warning tx-13 tx-bold">{{$studentprospectus->fullName()}}</span></td>
                                    <td><b>Gender</b></td><td><b>:</b></td><td>{{ucwords($studentprospectus->gender)}}</td>
                                    <td><b>Date of Birth</b></td><td><b>:</b></td><td>@if($studentprospectus->dob){{nowdate($studentprospectus->dob,'d-F-Y')}}@else {{"N/A"}} @endif</td>
                                </tr>
                                <tr>
                                    <td><b>Father's Name</b></td><td><b>:</b></td><td>{{ucwords($studentprospectus->father_name)}}</td>
                                    <td><b>Mother's Name</b></td><td><b>:</b></td><td>{{ucwords($studentprospectus->mother_name)}}</td>
                                    <td><b>Contact No.</b></td><td><b>:</b></td><td>{{$studentprospectus->mobile_no}}</td>
                                </tr>
                                <tr>
                                    <td><b>Address</b></td><td><b>:</b></td><td colspan="4">{{$studentprospectus->Address()}}</td>
                                    <td><b>Payment Status  hhh</b></td><td><b>:</b></td><td>@if($studentprospectus->pay_status=="paid")<span class="badge badge-success tx-bold">Paid</span> @elseif($studentprospectus->pay_status=="pending")<span class="badge badge-warning tx-bold">Pending</span> @elseif($studentprospectus->pay_status=="cancel")<span class="badge badge-warning tx-bold">Cancel</span> @endif</td>
                                </tr>
                                </tbody>
                            </table>

                            <div class="col-lg-12 pd-l-0">
                                <div class="panel shadow-none panel-default">
                                    <div class="panel-heading bg-light"><b><i class="fa fa-list"></i> Fee Structure</b></div>
                                    <div class="panel-body bd-1 bd-t pd-b-0 row">
                                        <table class="tx-12 table table-bordered mg-t-10 mg-b-5">
                                            <thead class="bg-light">
                                            <tr>
                                                <th class="text-center">S.No.</th>
                                                <th class="text-center"><input type="checkbox" class="CheckAll" value="checkbox1" checked></th>
                                                <th>Fee Head</th>
                                                <th>Description</th>
                                                <th class="text-center">Concession</th>
                                                <th class="text-right">Fee Amount</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @php $total=['totalpayable'=>0] @endphp
                                            @forelse($feestructure as $data)

                                                @if(isset($data->feeheadinstalment))

                                                    @foreach($data->feeheadinstalment as $data1)
                                                        @php
                                                            $instalmentamount=0;
                                                            if(isset($data->feestructureinstalment)){
                                                            $feeinstalmentamount=collect($data->feestructureinstalment)->where('instalment_id',$data1->instalment_id)->first();
                                                            $instalmentamount=$feeinstalmentamount->fee_amount;
                                                            $total['totalpayable'] +=$instalmentamount;
                                                            }
                                                        @endphp
                                                        <tr>
                                                            <td class="text-center">{{$loop->iteration}}
                                                                <input type="hidden" name="fee_head_{{$data->id}}_id" value="{{$data->feehead->id}}">
                                                                <input type="hidden" name="fee_head_priority_{{$data->id}}_id" value="{{$data->feehead->priority}}">
                                                                <input type="hidden" name="custom_fee_{{$data->id}}_id" value="">
                                                            </td>
                                                            <td class="text-center"><input type="checkbox" name="fee_structure_id[]" value="{{$data->id}}" class="checkbox1" checked></td>
                                                            <td>@if(isset($data->feehead->fee_head)) {{$data->feehead->fee_head}} @endif</td>
                                                            <td>
                                                                <input type="hidden" name="fee_head_{{$data->id}}_instalment_id[]" value="{{$data1->instalment_id}}">
                                                                <input type="hidden" name="fee_head_{{$data->id}}_instalment_{{$data1->instalment_id}}_priority" value="{{$data1->sequence}}">
                                                                <input type="hidden" name="fee_head_{{$data->id}}_instalment_{{$data1->instalment_id}}_print_name" value="{{$data1->print_name}}">
                                                                <input type="hidden" name="fee_head_{{$data->id}}_instalment_{{$data1->instalment_id}}_amount" value="{{$instalmentamount}}">
                                                                {{$data1->print_name}}</td>
                                                            <td class="text-center"><input type="text" value="0" name="fee_head_{{$data->id}}_instalment_{{$data1->instalment_id}}_concession" fee_head_id="{{$data->id}}" feeheadamt="{{$instalmentamount}}" class="form-control concession_entry text-center wd-80"></td>
                                                            <td class="wd-100 text-center"><input type="text" value="{{$instalmentamount}}" id="fee_head_amt_{{$data->id}}" class="form-control text-right cursor-not-allowed bg-light"></td>
                                                        </tr>
                                                    @endforeach

                                                @endif

                                            @empty
                                                <tr>
                                                    <td colspan="5" class="tx-danger text-center"><b>Sorry, No Fee Head Found!</b></td>
                                                </tr>
                                            @endforelse
                                            </tbody>
                                            <tfoot class="bg-light tx-12 tx-bold">
                                            <tr>
                                                <td colspan="4" class="text-right">Total Payable</td>
                                                <td class="text-center"><span id="total_concession">0</span></td>
                                                <td class="text-right"><span id="total_payable">{{numberformat($total['totalpayable'])}}</span></td>
                                            </tr>
                                            </tfoot>
                                        </table>
                                        <p><b>In Words :</b> {{\App\Helper\NumberInWords::convertwords($total['totalpayable'])}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 pd-l-0 pd-r-3">
                                <div class="panel shadow-none panel-default">
                                    <div class="panel-heading bg-light"><b><i class="fa fa-rupee-sign"></i> Fee Collection</b></div>
                                    <div class="panel-body bd-1 bd-t pd-b-10 row">

                                        <div class="col-6 pd-l-0 pd-r-5">
                                            <label>Counter <sup>*</sup>:</label>
                                            <select class="form-control">
                                                <option>---Select---</option>
                                                <option value='1' >Counter 1</option>
                                            </select>
                                        </div>

                                        <div class="col-6 pd-l-5 pd-r-5">
                                            <label>Entry Mode <sup>*</sup>:</label>
                                            <select name="entry_mode" class="form-control" required>
                                                <option value="school">School</option>
                                                <option value="bank">Bank</option>
                                                <option value="online">Online</option>
                                            </select>
                                        </div>

                                        <div class="col-6 pd-l-0 pd-r-5">
                                            <label>Payment Date <sup>*</sup>:</label>
                                            <input type="text" autocomplete="off" name="receipt_date" placeholder="dd-mm-yyyy" value="{{nowdate('','d-m-Y')}}" class="form-control date" required>
                                        </div>

                                        <div class="col-6 pd-l-5 pd-r-5">
                                            <label>Paymode <sup>*</sup>:</label>
                                            @include('components.Finance.paymode-import',['required'=>'required'])
                                        </div>

                                        <div class="col-6 pd-l-0 pd-r-5">
                                            <label>Instrument No <span class="text-gray">(Optional)</span> :</label>
                                            <input type="text" autocomplete="off" name="instrument_no" placeholder="Enter Instrument No." class="form-control">
                                        </div>

                                        <div class="col-6 pd-l-5 pd-r-5">
                                            <label>Instrument Date <span class="text-gray">(Optional)</span> :</label>
                                            <input type="text" autocomplete="off" name="instrument_date" placeholder="dd-mm-yyyy" class="form-control date">
                                        </div>

                                        <div class="col-6 pd-l-0 pd-r-5">
                                            <label>Bank <span class="text-gray">(Optional)</span> :</label>
                                            @include('components.bank-import',['class'=>'form-control select-search'])
                                        </div>

                                        <div class="col-6 pd-l-5 pd-r-5">
                                            <label>Total Fee Payable :</label>
                                            <input type="text" name="fee_payable" autocomplete="off" readonly id="total_fee_payable" placeholder="Enter Fee Payable" value="{{numberformat($total['totalpayable'])}}" class="form-control cursor-not-allowed text-right bg-warning-light">
                                        </div>

                                        <div class="col-6 pd-l-5 pd-r-5">
                                            <label>Paid Amount :</label>
                                            <input type="text" autocomplete="off" name="paid_amount" readonly='readonly' id="paid_amt" value="{{numberformat($total['totalpayable'])}}" placeholder="Enter Paid Amount" class="form-control text-right bg-success-light">
                                        </div>

                                        <div class="col-6 pd-l-5 pd-r-5">
                                            <label>Balance :</label>
                                            <input type="text" autocomplete="off" name="balance" id="due_amt" dueamt="{{$total['totalpayable']}}" value="0" readonly="" placeholder="Enter Balance Amount" class="form-control text-right cursor-not-allowed" style=" background-color:#F2D7D5;">
                                        </div>

                                        <div class="col-12 pd-l-5 pd-r-5">
                                            <label>Concession Remark <span class="text-gray">(Optional)</span>:</label>
                                            <input type="text" name="concession_remark" class="form-control" placeholder="Enter Fee Concession Remark">
                                        </div>

                                        <div class="col-12 pd-l-5 pd-r-5">
                                            <label>Fee Remark <span class="text-gray">(Optional)</span>:</label>
                                            <input type="text" name="fee_remark" class="form-control" placeholder="Enter Fee Remark">
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="col-lg-2 ">
                        <button hidden type="button" class="btn btn-block btn-outline-danger mg-t-10 btn-sm rounded-pill">Search Prospectus
                            <i class="fa fa-search"></i></button>
                        <button hidden type="button" class="btn btn-block btn-outline-primary mg-t-10 btn-sm rounded-pill">Preview
                            <i class="fa fa-arrows-alt"></i></button>
                        <button type="submit" class="btn btn-block btn-outline-success mg-t-10 tx-bold btn-lg rounded-pill">Collect Payment
                            <i class="fa fa-check"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script type="text/javascript">
        $(".concession_entry").keyup(function () {
            var fee_head_id=$(this).attr('fee_head_id');
            var concession=$(this).val();
            var feeamt=$(this).attr('feeheadamt');

            $("#fee_head_amt_" + fee_head_id).val(feeamt - concession);
            var payable = feeamt - concession;
            $("#total_concession").text(concession);

            $("#total_fee_payable").val(payable);
            $("#total_payable").text(payable);
            $("#paid_amt").val(payable);
        });

        $("#paid_amt").keyup(function () {
            var paidamt=$(this).val();
            var dueamt=$("#due_amt").attr('dueamt');
            $("#due_amt").val(dueamt-paidamt-$("#total_concession").text());

        });
    </script>

@endsection
