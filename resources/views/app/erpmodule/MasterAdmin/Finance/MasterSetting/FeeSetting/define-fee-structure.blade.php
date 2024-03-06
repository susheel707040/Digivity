@extends('layouts.MasterLayout')
@section('content')

@section('ModelTitle','Fee Head')
@section('ModelTitleInfo','Select Fee Head')
@section('AddModelPage')
    @include('app.erpmodule.MasterAdmin.Finance.MasterSetting.FeeSetting.fee-structure-modal-index')
@endsection


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
                    <form class="container-fluid" action="{{url('MasterAdmin/Finance/CreateFeeStructure')}}" method="POST" enctype="multipart/form-data" id="selectForm2"
                           data-parsley-validate="" novalidate="">
                        {{csrf_field()}}
                    <input type="hidden" name="fee_group_id" id="fee_group_id" value="{{request()->route('feegroupid')}}">
                        <div id="json_data" class="col-lg-12 bd-1 bd-t pd-t-10">

                            @foreach($feestructure as $data)
                                <div class="col-lg-12 m-0 p-0">

                                    @if($data->feehead)
                                        @if(count(feeheadinstalmentlist(['fee_head_id'=>$data->feehead->id])))
                                            <div class="card mg-b-10 mx-auto p-0 ">
                                                <div class="card-header pd-t-2 pd-b-2 bg-gray-100">

                                                    @php $keyid=rand(111111,9999999); @endphp

                                                    <table class="tx-12">
                                                        <tr>
                                                            <td>
                                                                <input type="hidden" readonly="readonly" name="key_id[]" value="{{$keyid}}">
                                                                <input type="hidden" readonly="readonly" name="fee_head_id_{{$keyid}}" id="fee_head_id" value="{{$data->feehead->id}}">
                                                                <input type="hidden" readonly="readonly" name="fee_type_{{$keyid}}_id" value="{{$data->feehead->type}}">
                                                                <input type="hidden" readonly="readonly" name="fee_structure_{{$keyid}}_id" value="{{$data->id}}">
                                                            </td>
                                                            <td class="pd-l-0"><b>{{$data->feehead->fee_head}} @if($data->feehead->type) <span class="badge badge-success">{{ucfirst($data->feehead->type)}}</span> @endif</b></td>
                                                            <td class="pd-l-15 pd-r-5 text-center">|</td>
                                                            <td class="pd-l-10"><b>Fee Applicable <sup>*</sup>:</b></td>
                                                            <td class="pd-l-5">
                                                                @include('component.GlobalSetting.is-new-status',['all'=>1,'name'=>"fee_applicable_".$keyid."_id",'selectid'=>$data->fee_applicable])
                                                            </td>
                                                            <td class="pd-l-15 pd-r-5 text-center">|</td>
                                                            <td class="pd-l-10"><b>Admission Category <sup>*</sup>:</b></td>
                                                            <td class="pd-l-5">
                                                                @include('component.GlobalSetting.admission-category-import',['all'=>1,'name'=>"admission_category_".$keyid."_id",'selectid'=>$data->admission_category])
                                                            </td>
                                                            <td class="pd-l-15 pd-r-5 text-center">|</td>
                                                            <td class="pd-l-10"><b>All Instalment Fee Amount :</b></td><td><input type="text" placeholder="Amount" onkeypress="javascript:return isNumber(event)" textclass="fee_amount_{{$keyid}}_id" class="form-control1 all-fee-amount wd-80 text-right input-sm"></td>
                                                        </tr>
                                                    </table>
                                                    <span data-href="{{url('/MasterAdmin/Finance/RemoveFeeStructure/'.$data->id.'')}}" class="pos-absolute fee-structure-remove cursor-pointer text-danger" style="right:10px; top:8px;"><i class="fa fa-trash"></i></span>
                                                </div>

                                                <div class="card-body pd-10 m-0 flex-fill">
                                                    <table cellspacing="0" cellpadding="0" class="tx-12">
                                                        <tr>
                                                            @foreach(feeheadinstalmentlist(['fee_head_id'=>$data->feehead->id]) as $data1)

                                                                @php
                                                                    $instalmentamt=0;
                                                                    //fee structure fee amount set
                                                                    try { $instalmentamt=collect($data->feestructureinstalment)->where('instalment_id',$data1->instalment_id)->first()->fee_amount; }catch (\Exception $e){}
                                                                @endphp

                                                                <td><input type="hidden" name="instalment_{{$keyid}}_id[]" value="{{$data1->instalment_id}}"><label class="container-fluid pd-t-0 pd-b-0"><b>{{$data1->print_name}}</b></label></td>
                                                                <td class="pd-l-4 pd-r-10">
                                                                    <input type="text" onkeypress="javascript:return isNumber(event)" value="@if(isset($instalmentamt)){{$instalmentamt}}@else{{'0'}}@endif" name="fee_amount_{{$keyid}}_{{$data1->instalment_id}}_id" class="form-control1 fee_amount_{{$keyid}}_id text-right wd-60 input-sm">
                                                                </td>
                                                            @endforeach
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                </div>

                            @endforeach
                    </div>

                        <div class="col-lg-12 mb-2">
                            <button type="button" href="#addModels" data-toggle="modal" class="btn rounded-5 btn-info"><i class="fa fa-plus"></i> Add New</button>
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

@section('js')
    <script type="text/javascript">
        $("#continueBtn").click(function () {
            loader("block");
            if ($("#fee_group_id").val() != 0) {
                window.location.assign('/MasterAdmin/Finance/DefineFeeStructure/' + $("#fee_group_id").val() + '/search');
            } else {
                window.location.assign('/MasterAdmin/Finance/DefineFeeStructure');
            }
        });

        $("#continue-fee-btn").click(function (){
            var feehead=$("#fee_head_id").val();
            if(feehead==0){
                swal("Opps!", "Please select Fee Head", "error");
                $("#fee_head_id").focus();
                return false;
            }else{
                loader('block');
                var url="{{url('/MasterAdmin/Finance/FeeStructureIndex')}}/"+feehead;
                formrequestajax('',url,'POST').success(function(data){
                    if(data==0){
                        swal("Opps!", "Sorry, Fee head instalment not found, Please first create instalment", "error");
                        $("#fee_head_id").val(''); $("#sequence").val('');
                    }else
                    if(data!=0) {
                        $("#json_data").append(data);
                        $("#fee_head_id").val('');  $("#sequence").val('');
                        $("#addModels").modal('hide');

                        $(".all-fee-amount").on('keyup',function(){
                            $("."+$(this).attr('textclass')).val($(this).val());
                        });

                        $(".fee-structure-remove-btn").click(function (){
                            swal({
                                title: "Are you sure?",text: "Once deleted, you will not be able to recover this element!",icon: "warning",buttons: true,dangerMode: true,
                            }).then((willDelete) => {
                                    if (willDelete) { $("#"+$(this).data('keyid')).remove(); }
                            });
                            return false;
                        });

                    }
                    loader('none');
                    return false;
                    // treat the READUSERS data returned
                }).fail(function(sender, message, details){
                    swal("Opps!", "Sorry, something went wrong!", "error");
                    return false;
                });
            }
        });

        $(".all-fee-amount").on('keyup',function(){
            $("."+$(this).attr('textclass')).val($(this).val());
        });

        $(".fee-structure-remove").click(function (){
            swal({
                title: "Are you sure?",text: "Once deleted, you will not be able to recover this fee structure!",icon: "warning",buttons: true,dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) { loader('block'); window.location.assign($(this).data('href')); }
            });
        });
    </script>
@endsection

@endsection
