@php $keyid=rand(111111,9999999); @endphp
<div id="{{$keyid}}" class="col-lg-12 m-0 p-0">
    @if($feehead)
    @if(count(feeheadinstalmentlist(['fee_head_id'=>$feehead->id])))
            <div class="card mg-b-10 mx-auto p-0 ">
                <div class="card-header pd-t-2 pd-b-2 bg-gray-100">

                    <table class="tx-12">
                        <tr>
                            <td>
                                <input type="hidden" readonly="readonly" name="key_id[]" value="{{$keyid}}">
                                <input type="hidden" readonly="readonly" name="fee_head_id_{{$keyid}}" id="fee_head_id" value="{{$feehead->id}}">
                                <input type="hidden" readonly="readonly" name="fee_type_{{$keyid}}_id" value="{{$feehead->type}}">
                            </td>
                            <td class="pd-l-0"><b>{{$feehead->fee_head}} @if($feehead->type) <span class="badge badge-success">{{ucfirst($feehead->type)}}</span> @endif</b></td>
                            <td class="pd-l-15 pd-r-5 text-center">|</td>
                            <td class="pd-l-10"><b>Fee Applicable <sup>*</sup>:</b></td>
                            <td class="pd-l-5">
                                @include('component.GlobalSetting.is-new-status',['all'=>1,'name'=>"fee_applicable_".$keyid."_id"])
                            </td>
                            <td class="pd-l-15 pd-r-5 text-center">|</td>
                            <td class="pd-l-10"><b>Admission Category <sup>*</sup>:</b></td>
                            <td class="pd-l-5">
                                @include('component.GlobalSetting.admission-category-import',['all'=>1,'name'=>"admission_category_".$keyid."_id"])
                            </td>
                            <td class="pd-l-15 pd-r-5 text-center">|</td>
                            <td class="pd-l-10"><b>All Instalment Fee Amount :</b></td><td><input type="text" onkeypress="javascript:return isNumber(event)" placeholder="Amount" textclass="fee_amount_{{$keyid}}_id" class="form-control1 all-fee-amount wd-80 text-right input-sm"></td>
                        </tr>
                    </table>
                    <span data-keyid="{{$keyid}}" class="pos-absolute fee-structure-remove-btn cursor-pointer text-danger" style="right:10px; top:8px;"><i class="fa fa-trash"></i></span>
                </div>

                <div class="card-body pd-10 m-0 flex-fill">
                    <table cellspacing="0" cellpadding="0" class="tx-12">
                        <tr>
                            @foreach(feeheadinstalmentlist(['fee_head_id'=>$feehead->id]) as $data1)
                                <td><input type="hidden" name="instalment_{{$keyid}}_id[]" value="{{$data1->instalment_id}}"><label class="container-fluid pd-t-0 pd-b-0"><b>{{$data1->print_name}}</b></label></td>
                                <td class="pd-l-4 pd-r-10">
                                    <input type="text" onkeypress="javascript:return isNumber(event)" value="@if(isset($feeheadstructureinstalment['fee_amount'])){{$feeheadstructureinstalment['fee_amount']}}@else{{'0'}}@endif" name="fee_amount_{{$keyid}}_{{$data1->instalment_id}}_id" class="form-control1 fee_amount_{{$keyid}}_id text-right wd-60 input-sm">
                                </td>
                            @endforeach
                        </tr>
                    </table>
                </div>
            </div>
    @endif
  @endif
</div>