@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Finance</li>
            <li class="breadcrumb-item active" aria-current="page">Fee Setting</li>
            <li class="breadcrumb-item active" aria-current="page">Fee Structure</li>
        </ol>
    </nav>

    <div class="col-lg-12 p-0 m-0 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-rupee-sign"></i> Fee Structure</b></div>
            <div class="panel-body pd-b-10 row">
                <div class="col-lg-12">
                    <table class="col-lg-6 mx-auto mg-t-10 mg-b-10">
                        <tr>
                            <td class="wd-15p"><b>Fee Group</b></td>
                            <td><b><sup>*</sup> :</b></td>
                            <td>
                                <select name="fee_group_id" id="fee_group_id" class="form-control">
                                    <option value="">---Select---</option>
                                    @foreach(feegrouplist([]) as $data)
                                        <option value="{{$data->id}}"
                                                @if(request()->route('feegroupid')==$data->id) selected @endif>{{$data->fee_group}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="wd-20p pd-l-10">
                                <button type="button" id="continueBtn" class="btn btn-primary">Continue <i
                                        class="fa fa-angle-right"></i></button>
                            </td>
                        </tr>
                    </table>
                </div>
                @if(request()->route('feegroupid'))
                    <form  action="{{url('MasterAdmin/Finance/CreateFeeStructure')}}" method="POST" enctype="multipart/form-data" id="selectForm2"
                           data-parsley-validate="" novalidate="">
                        {{csrf_field()}}
                    <input type="hidden" name="fee_group_id" id="fee_group_id" value="{{request()->route('feegroupid')}}">
                        <div class="col-lg-12 bd-1 bd-t pd-t-10">
                        @foreach(feeheadlist(['fee_custom'=>'no']) as $data)
                            @if(count(feeheadinstalmentlist(['fee_head_id'=>$data->id])))
                                @php
                                    $feestructures=collect($feestructure)->where('fee_head_id',$data->id)->shift();
                                @endphp
                            <div class="col-lg-12 pd-0">
                                <div class="card mg-b-10 mx-auto p-0 ">
                                    <div class="card-header pd-t-2 pd-b-2 bg-gray-100">
                                        <table class="tx-12">
                                            <tr>
                                                <td><input type="checkbox" name="fee_head_id[]" id="fee_head_id" value="{{$data->id}}" @if($feestructures['fee_head_id']==$data->id) checked @endif>
                                                <input type="hidden" name="fee_type_{{$data->id}}_id" value="{{$data->type}}">
                                                </td>
                                                <td class="pd-l-5"><b>{{$data->fee_head}} @if($data->type) <span class="badge badge-success">{{ucfirst($data->type)}}</span> @endif</b></td>
                                                <td class="pd-l-15 pd-r-5 text-center">|</td>
                                                <td class="pd-l-10"><b>Fee Applicable <sup>*</sup>:</b></td>
                                                <td class="pd-l-10"><input type="radio" name="fee_applicable_{{$data->id}}_id" value="" @if($feestructures['fee_applicable']==null) checked @endif @if(!isset($feestructures['fee_applicable'])) checked @endif></td><td class="pd-l-5">All Student</td>
                                                @foreach(admissionisnewstatuslist() as $data1)
                                                <td class="pd-l-10"><input type="radio" name="fee_applicable_{{$data->id}}_id" value="{{$data1->alias}}" @if($feestructures['fee_applicable']==$data1->alias) checked @endif></td><td class="pd-l-5">{{$data1->admission_status}}</td>
                                                @endforeach
                                                <td class="pd-l-15 pd-r-5 text-center">|</td>
                                                <td class="pd-l-10"><b>All Instalment Fee Amount :</b></td><td><input type="text" placeholder="Amount" textclass="fee_amount_{{$data->id}}_id" class="form-control1 all-fee-amount wd-80 text-right input-sm"></td>
                                            </tr>
                                        </table>
                                    </div>

                                    <div class="card-body pd-10 m-0 flex-fill">
                                        <table cellspacing="0" cellpadding="0" class="tx-12">
                                            <tr>
                                                @foreach(feeheadinstalmentlist(['fee_head_id'=>$data->id]) as $data1)
                                                    @php
                                                    $feeheadstructureinstalment=collect($feestructures['feestructureinstalment'])->where('instalment_id',$data1->instalment_id)->shift();
                                                    @endphp
                                                    <td><input type="hidden" name="instalment_{{$data->id}}_id[]" value="{{$data1->instalment_id}}"><label class="container-fluid pd-t-0 pd-b-0"><b>{{$data1->print_name}}</b></label></td>
                                                    <td class="pd-l-4 pd-r-10">
                                                        <input type="text" value="@if(isset($feeheadstructureinstalment['fee_amount'])){{$feeheadstructureinstalment['fee_amount']}}@else{{'0'}}@endif" name="fee_amount_{{$data->id}}_{{$data1->instalment_id}}_id" class="form-control1 fee_amount_{{$data->id}}_id text-right wd-60 input-sm">
                                                    </td>
                                                @endforeach
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                                @endif
                        @endforeach
                    </div>

                    <div class="col-lg-12 bd-1 bd-t pd-t-10">
                        <a href="{{url('MasterAdmin/Finance/DefineFeeStructure')}}">
                        <button type="button" class="btn btn-white float-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button></a>
                        <button class="btn btn-primary float-right"><i class="fa fa-check"></i> Submit</button>
                    </div>
                    </form>
                @endif

            </div>
        </div>
    </div>
    <script type="text/javascript">
        $("#continueBtn").click(function () {
            if ($("#fee_group_id").val() != 0) {
                window.location.assign('/MasterAdmin/Finance/DefineFeeStructure/' + $("#fee_group_id").val() + '/search');
            } else {
                window.location.assign('/MasterAdmin/Finance/DefineFeeStructure');
            }
        });

        $(".all-fee-amount").on('keyup',function(){
         $("."+$(this).attr('textclass')).val($(this).val());
        });
    </script>
@endsection
