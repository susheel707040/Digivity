@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Fee Entry</li>
            <li class="breadcrumb-item active" aria-current="page">Fee Receipt Modify</li>
        </ol>
    </nav>
    <div class="col-lg-12 p-0 m-0 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-edit"></i> Fee Receipt Modify</b></div>
            <div class="panel-body pd-l-0 pd-r-0 row">
                <form class="container-fluid" action="{{url('MasterAdmin/Finance/ChequeBounceEntry')}}" method="POST">
                    <div class="col-lg-12 search-section pd-l-0 pd-b-15 m-0 row">
                        <div class="col-lg-2">
                            <label><b>Receipt No. :</b></label>
                            <input type="text" id="receipt_no" @if(request()->get('receipt_no'))value="{{request()->get('receipt_no')}}"@endif placeholder="Enter Receipt No." class="form-control input-sm">
                        </div>
                        <div class="col-lg-2 pd-l-0">
                            <button type="button" class="btn mg-t-25 btn_continue btn-primary">Continue <i class="fa fa-angle-right"></i></button>
                        </div>
                        <div class="col-lg-12"><span class="alert-msg text-danger"></span></div>
                    </div>
                </form>

                @if(isset($feecollection))
                @foreach($feecollection as $item)
                <form action="{{url('MasterAdmin/Finance/EditFeeReceiptModify/'.$item->id.'/modify')}}" class="container-fluid" method="POST" data-parsley-validate novalidate>
                {{csrf_field()}}
                <input type="hidden" readonly name="old_receipt_record" value="{{json_encode($feecollection)}}">
                <input type="hidden" readonly name="modify_date" value="{{nowdate('','Y-m-d')}}">
                <div class="col-lg-12 m-0 pd-l-0 bd-1 pd-r-0 bd-t row">
                    <div class="col-lg-4 mg-t-20 mg-b-20 pd-t-10 rounded-5 bg-light pd-b-10">
                        @include('component.Student.student-left-record-import',['studentid'=>$feecollection->student_id])
                    </div>
                    <div class="col-lg-8 mg-t-0 mg-b-10 pd-t-20 pd-r-0 pd-b-10">
                        <div class="card shadow-none">
                            <div class="card-header bg-gray-100"><i class="fa fa-info"></i> <b>Modify Receipt Information </b>
                            </div>
                            <div class="card-body pd-10 pd-t-10 pd-b-0 tx-11 m-0 flex-fill">
                                <table class="table pd-b-0 mg-b-0 bd-1 bd">
                                    <tr>
                                        <td><b>Receipt ID</b></td>
                                        <td><b>:</b></td>
                                        <td><input type="text" value="{{$feecollection->id}}" readonly="readonly" class="form-control1 cursor-not-allowed bg-light text-center wd-100"></td>
                                        <td><b>Receipt No.</b></td>
                                        <td><b>:</b></td>
                                        <td><input type="text" value="{{$feecollection->receipt_id}}" readonly="readonly" class="form-control1 cursor-not-allowed bg-light text-center wd-100"></td>
                                        <td><b>Receipt Date</b></td>
                                        <td><b>:</b></td>
                                        <td><input type="text" name="receipt_date" value="{{nowdate($feecollection->receipt_date,'d-m-Y')}}" placeholder="dd-mm-yyyy" class="form-control1 date wd-100" required></td>
                                    </tr>
                                    <tr>
                                        <td><b>Sub Total</b></td>
                                        <td><b>:</b></td>
                                        <td><input type="text" readonly="readonly" value="{{$feecollection->sub_total}}" class="form-control1 cursor-not-allowed bg-light text-right wd-100"></td>
                                        <td><b>Concession</b></td>
                                        <td><b>:</b></td>
                                        <td><input type="text" readonly="readonly" value="{{$feecollection->concession_total}}" class="form-control1 cursor-not-allowed bg-light text-right wd-100"></td>
                                        <td><b>Late Fee</b></td>
                                        <td><b>:</b></td>
                                        <td><input type="text" readonly="readonly" value="{{$feecollection->fine_total}}" class="form-control1 cursor-not-allowed bg-light text-right wd-100"></td>
                                    </tr>
                                    <tr>
                                        <td><b>Total Payable</b></td>
                                        <td><b>:</b></td>
                                        <td><input type="text" readonly="readonly" value="{{$feecollection->fee_payable}}" class="form-control1 cursor-not-allowed bg-light text-right wd-100"></td>
                                        <td><b>Paid</b></td>
                                        <td><b>:</b></td>
                                        <td><input type="text" readonly="readonly" value="{{$feecollection->paid_amount}}" class="form-control1 cursor-not-allowed bg-light text-right wd-100"></td>
                                        <td><b>Balance</b></td>
                                        <td><b>:</b></td>
                                        <td><input type="text" readonly="readonly" value="{{$feecollection->balance}}" class="form-control1 cursor-not-allowed bg-light text-right wd-100"></td>
                                    </tr>
                                    <tr>
                                        <td><b>Entry Mode </b></td><td><b>:</b></td>
                                        <td>
                                            <select name="entry_mode" class="form-control1 input-sm">
                                                <option>{{ucfirst($feecollection->entry_mode)}}</option>
                                            </select>
                                        </td>
                                        <td><b>Online Transaction</b></td><td><b>:</b></td>
                                        <td><input type="text" name="online_transaction_no" value="{{$feecollection->online_transaction_no}}" class="form-control1 wd-100"></td>
                                        <td><b>Online Status</b></td><td><b>:</b></td>
                                        <td>
                                            <select name="online_status" class="form-control1 input-sm wd-100">
                                                <option>{{ucfirst($feecollection->online_status)}}</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>Paymode</b></td>
                                        <td><b>:</b></td>
                                        <td>@include('components.Finance.paymode-import',['selectid'=>$feecollection->paymode_id])</td>
                                        <td><b>Instrument No.</b></td>
                                        <td><b>:</b></td>
                                        <td><input type="text" name="instrument_no" placeholder="Instrument No." value="{{$feecollection->instrument_no}}" class="form-control1 wd-100"></td>
                                        <td><b>Instrument Date</b></td>
                                        <td><b>:</b></td>
                                        <td><input type="text" name="instrument_date" placeholder="dd-mm-yyyy" @if($feecollection->instrument_date) value="{{nowdate($feecollection->instrument_date,'d-m-Y')}}" @endif class="form-control1 date wd-100"></td>
                                    </tr>
                                    <tr>
                                        <td><b>Receipt Status</b></td><td><b>:</b></td>
                                        <td>
                                            <select readonly="readonly" @if($feecollection->receipt_status=="paid") class="form-control1 input-sm bg-success-light" @elseif($feecollection->receipt_status=="unpaid")  class="form-control1 input-sm bg-warning-light"  @elseif($feecollection->receipt_status=="cancel")  class="form-control1 input-sm bg-danger-light"  @endif>
                                                <option>{{ucfirst($feecollection->receipt_status)}}</option>
                                            </select>
                                        </td>
                                        <td><b>Bank</b></td>
                                        <td><b>:</b></td>
                                        <td colspan="4">
                                           <select name="bank" class="form-control1">
                                               <option value="">---Select---</option>
                                           </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>Fee Remark :</b></td>
                                        <td><b>:</b></td>
                                        <td>
                                            <textarea name="fee_remark" autocomplete="off" class="form-control" placeholder="Enter Remark">{{$feecollection->fee_remark}}</textarea>
                                        </td>
                                        <td><b>Modify Reason <sup>*</sup></b></td> <td><b>:</b></td>
                                        <td colspan="4">
                                            <textarea class="form-control" name="modify_reason" placeholder="Enter modify reason" required></textarea>
                                        </td>
                                    </tr>
                                </table>
                                <div class="row m-0 m-0">
                                <div class="col-lg-9">

                                </div>
                                <div class="col-lg-3 mg-t-10 pd-r-0 ">
                                    <button class="btn btn-primary tx-13 mg-t-0 btn-block"><i class="fa fa-edit"></i>Update </button>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
                @endforeach
               @endif
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            $(".btn_continue").click(function () {
                if($("#receipt_no").val()!=0){
                    window.location.assign('/MasterAdmin/Finance/FeeReceiptModify?receipt_no='+$("#receipt_no").val());
                    loader('block');
                    return false;
                }
                if($("#receipt_no").val()==0){
                    $("#receipt_no").focus();
                    $(".alert-msg").html('Please enter receipt number');
                }
            });
        });
    </script>
@endsection
