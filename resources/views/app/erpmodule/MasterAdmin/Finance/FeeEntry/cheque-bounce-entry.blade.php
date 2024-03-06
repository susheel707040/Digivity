@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Fee Entry</li>
            <li class="breadcrumb-item active" aria-current="page">Cheque Bounce Entry</li>
        </ol>
    </nav>
    <div class="col-lg-12 p-0 m-0 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-plus"></i> Cheque Bounce Entry</b></div>
            <div class="panel-body pd-b-0 row">
                    <div class="col-lg-12 search-section pd-b-15 m-0 row">
                        <div class="col-lg-2">
                            <label><b>Receipt ID/No. :</b></label>
                            <input type="text" id="receipt_no" @if(request()->route('receiptno'))value="{{request()->route('receiptno')}}"@endif placeholder="Enter Receipt No." class="form-control input-sm">
                        </div>
                        <div class="col-lg-2 pd-l-0">
                            <button type="button" class="btn mg-t-25 btn_continue btn-primary">Continue <i class="fa fa-angle-right"></i></button>
                        </div>
                       <div class="col-lg-12"><span class="alert-msg text-danger"></span></div>
                    </div>
                @if(isset($feecollection))
                <div class="col-lg-12 m-0 p-0 bd-1 bd-t row">
                    <div class="col-lg-4 mg-t-20 mg-b-20 pd-t-15 rounded-5 bg-light pd-b-10">
                        @include('component.Student.student-left-record-import',['studentid'=>$feecollection->student_id])
                    </div>
                    <div class="col-lg-8 mg-t-0 mg-b-10 pd-t-20 pd-r-0  pd-b-10">
                        <div class="card shadow-none">
                            <div class="card-header bg-gray-100"><i class="fa fa-info"></i> <b>Receipt Information </b></div>
                            <div class="card-body pd-10 pd-t-10 pd-b-0 tx-13 m-0 flex-fill">
                                @include('component.Finance.receipt-short-details-table',['feecollection'=>$feecollection])
                            </div>
                        </div>
                        <form action="{{url('MasterAdmin/Finance/ChequeBounceEntry/'.$feecollection->id.'/'.$feecollection->student_id.'/entry')}}" method="POST" data-parsley-validate="" novalidate="">
                        {{csrf_field()}}
                            <div class="card shadow-none mg-t-10">
                            <div class="card-header bg-gray-100"><i class="fa fa-info"></i> <b>Cheque Bounce Entry </b></div>
                            <div class="card-body pd-10 pd-t-5 pd-b-0 tx-13 m-0 row flex-fill">
                                <div class="col-lg-9 p-0 m-0">
                                    <table class="table table-borderless pd-b-0 mg-b-0">
                                        <tr>
                                            <td class="wd-200"><b>Cheque Bounce Reason <sup>*</sup></b></td><td class="wd-5"><b>:</b></td>
                                            <td><textarea name="reason" placeholder="Enter Cheque Bounce Reason" class="form-control" required></textarea></td>
                                        </tr>
                                        <tr>
                                            <td><b>Attachment <span class="text-gray">(Optional)</span></b></td><td class="wd-5"><b>:</b></td>
                                            <td><input type="file"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="p-0 m-0">
                                                <table cellpadding="0" cellspacing="0">
                                                    <tr>
                                                        <td class="wd-300">
                                                            <label><b>Fee Head :</b></label>
                                                            <select name="fee_head_id" class="form-control1 input-sm" required>
                                                               @foreach(feeheadlist(['type'=>'cheque-bounce-charge']) as $data)
                                                                   <option value="{{$data->id}}">{{$data->fee_head}}</option>
                                                               @endforeach
                                                            </select>
                                                        </td>
                                                        <td class="wd-200">
                                                            <label><b>Cheque Bounce Charge :</b></label>
                                                            <input type="text" name="fee_amount" autocomplete="off" class="form-control1 text-right" value="0">
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-lg-3 pd-r-5 vhr">
                                    <button type="submit" class="btn btn-primary mg-t-0 btn-block"><i class="fa fa-plus"></i> Submit</button>
                                    <a href="{{url('MasterAdmin/Finance/ChequeBounceEntry')}}">
                                    <button type="button" class="btn btn-danger mg-t-20 btn-block">Close <i class="fa fa-times"></i></button></a>
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
                    window.location.assign('/MasterAdmin/Finance/ChequeBounceEntry/'+$("#receipt_no").val()+'/search');
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

