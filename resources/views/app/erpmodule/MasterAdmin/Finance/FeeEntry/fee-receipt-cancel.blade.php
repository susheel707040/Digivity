@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Fee Entry</li>
            <li class="breadcrumb-item active" aria-current="page">Fee Receipt Cancel Entry</li>
        </ol>
    </nav>
    <div class="col-lg-12 p-0 m-0 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-plus"></i> Fee Receipt Cancel Entry</b></div>
            <div class="panel-body pd-b-0 row">
                <form class="container-fluid" action="{{url('MasterAdmin/Finance/ChequeBounceEntry')}}" method="POST">
                    <div class="col-lg-12 pd-l-0 pd-r-0 m-0 pd-t-10 pd-b-20 row">
                        <div class="col-lg-2">
                            <label><b>Receipt ID/No. :</b></label>
                            <input type="text" id="receipt_no" @if(request()->route('receiptno'))value="{{request()->route('receiptno')}}"@endif placeholder="Enter Receipt No." class="form-control input-sm">
                        </div>
                        <div class="col-lg-2 pd-l-0">
                            <button type="button" class="btn mg-t-25 btn_continue btn-primary">Continue <i class="fa fa-angle-right"></i></button>
                        </div>
                        <div class="col-lg-12"><span class="alert-msg text-danger"></span></div>
                    </div>
                </form>


                @if(isset($feecollection))
                <div class="col-lg-12 m-0 p-0 bd-1 bd-t row">
                    <div class="col-lg-4 mg-t-20 mg-b-15 pd-t-15 rounded-5 bg-light pd-b-10">
                        @include('component.Student.student-left-record-import',['studentid'=>$feecollection->student_id])
                    </div>
                    <div class="col-lg-8 mg-t-0 mg-b-10 pd-t-20 pd-r-0 pd-b-10">
                        <div class="card shadow-none">
                            <div class="card-header bg-gray-100"><i class="fa fa-info"></i> <b>Receipt Information </b>
                            </div>
                            <div class="card-body pd-10 pd-t-10 pd-b-0 tx-13 m-0 flex-fill">
                                <table class="table pd-b-0 mg-b-0 bd-1 bd tx-12">
                                    <tr>
                                        <td><b>Receipt ID.</b></td>
                                        <td><b>:</b></td>
                                        <td>{{$feecollection->id}}</td>
                                        <td><b>Receipt No.</b></td>
                                        <td><b>:</b></td>
                                        <td>{{$feecollection->receipt_id}}</td>
                                        <td><b>Receipt Date</b></td>
                                        <td><b>:</b></td>
                                        <td>{{nowdate($feecollection->receipt_date,'d-F-Y')}}</td>
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
                                        <td><b>Paymode</b></td>
                                        <td><b>:</b></td>
                                        <td>{{$feecollection->PaymodeName()}}</td>
                                        <td><b>Instrument No.</b></td>
                                        <td><b>:</b></td>
                                        <td>{{$feecollection->instrument_no}}</td>
                                        <td><b>Instrument Date</b></td>
                                        <td><b>:</b></td>
                                        <td>@if(isset($feecollection->instrument_date)){{nowdate($feecollection->instrument_date,'d-F-y')}}@endif</td>
                                    </tr>
                                    <tr>
                                        <td><b>Receipt Status</b></td><td><b>:</b></td>
                                        <td>
                                            <span class="badge @if($feecollection->receipt_status=="paid") badge-success @elseif($feecollection->receipt_status=="unpaid") badge-warning @elseif($feecollection->receipt_status=="cancel") badge-danger @endif">{{ucfirst($feecollection->receipt_status)}}</span>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <form action="{{url('/MasterAdmin/Finance/CancelFeeReceipt/'.$feecollection->id.'/entry')}}" class="container-fluid" method="POST">
                            {{csrf_field()}}
                            <input type="hidden" name="cancel_date" value="{{nowdate('','Y-m-d')}}">
                            <div class="card shadow-none mg-t-10">
                                <div class="card-header bg-gray-100"><i class="fa fa-info"></i> <b>Fee Receipt Cancel Entry </b></div>
                                <div class="card-body pd-10 pd-t-5 pd-b-0 tx-13 m-0 row flex-fill">
                                    <div class="col-lg-9 p-0 m-0">
                                        <table class="table table-borderless pd-b-0 mg-b-0">
                                            <tr>
                                                <td class="wd-200"><b>Receipt Status <sup>*</sup></b></td>
                                                <td class="wd-5"><b>:</b></td>
                                                <td>
                                                    <select name="receipt_status" class="form-control1 input-sm wd-150" required>
                                                        <option value="paid" @if($feecollection->receipt_status=="paid") selected @endif>Paid</option>
                                                        <option value="unpaid" @if($feecollection->receipt_status=="unpaid") selected @endif>Un-Paid</option>
                                                        <option value="cancel" @if($feecollection->receipt_status=="cancel") selected @endif>Cancel</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="wd-200"><b>Receipt Cancel Reason <sup>*</sup></b></td>
                                                <td class="wd-5"><b>:</b></td>
                                                <td><textarea placeholder="Receipt Cancel Reason" name="reason" class="form-control" required></textarea></td>
                                            </tr>
                                            <tr>
                                                <td><b>Attachment <span class="text-gray">(Optional)</span></b></td>
                                                <td class="wd-5"><b>:</b></td>
                                                <td><input name="attach_file" type="file"></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-lg-3 vhr">
                                        <button class="btn btn-primary mg-t-0 btn-block"><i class="fa fa-edit"></i>Update</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
                    @endif
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            $(".btn_continue").click(function () {
                if($("#receipt_no").val()!=0){
                    window.location.assign('/MasterAdmin/Finance/CancelFeeReceipt/'+$("#receipt_no").val()+'/search');
                    loader('block');
                    return false;
                }
                if($("#receipt_no").val()==0){
                    $("#receipt_no").focus();
                    $(".alert-msg").html('Please enter any one receipt number');
                }
            });
        });
    </script>
@endsection
