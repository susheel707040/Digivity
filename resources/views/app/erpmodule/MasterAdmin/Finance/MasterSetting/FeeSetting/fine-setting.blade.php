@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Finance</li>
            <li class="breadcrumb-item active" aria-current="page">Fee Setting</li>
            <li class="breadcrumb-item active" aria-current="page">Fine Setting</li>
        </ol>
    </nav>
    <div class="col-lg-12 p-0 m-0 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-cog"></i> Fee Fine (Late Fee) Setting</b></div>
            <form  action="{{url('MasterAdmin/Finance/CreateFineSetting')}}" method="POST" enctype="multipart/form-data" id="selectForm2"
                   data-parsley-validate="" novalidate="">
                {{csrf_field()}}
            <div class="panel-body pd-b-10 row">
                <div class="col-lg-10 p-0 m-0">
                <div class="col-lg-12 bd-b bd-1">
                    <table class="col-lg-8 mx-auto mg-t-10 mg-b-10">
                        <tr>
                            <td class="wd-15p"><b>Fee Group</b></td>
                            <td><b><sup>*</sup> :</b></td>
                            <td>
                                <select id="fee_group_id" class="form-control">
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
                      <input type="hidden" name="fee_group_id" value="{{request()->route('feegroupid')}}">
                @foreach(feeheadlist(['type'=>'late-fee']) as $data)
                    @if(count(feeheadinstalmentlist(['fee_head_id'=>$data->id])))
                        @php
                        $finesettingarr=collect($finesetting)->where('fee_head_id',$data->id)->toArray();
                        $feeheadmaxfinelimit=array_column($finesettingarr, 'fine_max_limit');
                        @endphp

                        <div class="col-lg-8 mx-auto p-2 mg-t-10">
                            <div class="col-lg-12 pd-0">
                                <div class="card mg-b-0 mx-auto p-0 ">
                                    <div class="card-header pd-t-2 pd-b-2 bg-gray-100">
                                        <table class="tx-12">
                                            <tr>
                                                <td class="tx-14">
                                                    <input type="hidden" readonly="readonly" name="fee_head_id[]" id="fee_head_id" value="{{$data->id}}">
                                                    <b>{{$data->fee_head}} @if($data->type) <span class="badge badge-success">{{ucfirst($data->type)}}</span> @endif</b>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="card-body pd-5 m-0 flex-fill">
                                        <table class="table table-bordered bd bd-1 mt-10 text-center mx-auto">
                                            <thead>
                                            <tr>
                                                <th>Fee Head Maximum Fine Limit</th>
                                                <th>
                                                    <input type="text" name="fee_head_{{$data->id}}_fine_max_limit"  class="form-control1 text-right input-sm wd-80" value="@if(count($finesettingarr)){{$feeheadmaxfinelimit[0]}}@else{{"0"}}@endif">
                                                </th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <thead class="bg-light">
                                            <tr>
                                                <th>Instalment</th>
                                                <th>Type
                                                    <a tabindex="0" class="btn-popovers-type" role="button" data-trigger="focus" data-placement="top"><i class="fa fa-info-circle"></i></a>
                                                </th>
                                                <th>Maximum Fine Amount</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                        @foreach(feeheadinstalmentlist(['fee_head_id'=>$data->id]) as $data1)
                                        @php
                                            $finesettinginstalment=collect($finesettingarr)->where('instalment_id',$data1->instalment_id)->shift();
                                        @endphp

                                            <tr>
                                                <td>
                                                    {{$data1->print_name}}
                                                    <input type="hidden" name="fee_head_{{$data->id}}_instalment_id[]" value="{{$data1->instalment_id}}">
                                                </td>
                                                <td>
                                                    <select name="fine_type_{{$data->id}}_{{$data1->instalment_id}}_id" class="form-control1 p-1 fine_type_{{$data->id}}_id input-sm">
                                                        <option value="day" @if(isset($finesettinginstalment['fine_type'])&&$finesettinginstalment['fine_type']=="day") selected @endif>Day</option>
                                                        <option value="month" @if(isset($finesettinginstalment['fine_type'])&&$finesettinginstalment['fine_type']=="month") selected @endif>Month</option>
                                                        <option value="once" @if(isset($finesettinginstalment['fine_type'])&&$finesettinginstalment['fine_type']=="once") selected @endif>Once</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="text" autocomplete="off" name="max_fine_limit_{{$data->id}}_{{$data1->instalment_id}}_id"  value="@if(isset($finesettinginstalment['instalment_max_limit'])){{$finesettinginstalment['instalment_max_limit']}}@else{{"0"}}@endif" class="form-control1 max_fine_limit_{{$data->id}}_id text-right wd-80  input-sm">
                                                </td>
                                            </tr>
                                        @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>


                        </div>
                    @endif
                @endforeach
                </div>
                <div class="col-lg-2 vhr pd-t-15 text-center">
                    <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-check"></i> Save & Update</button>
                    @if(count($finesetting))
                    <a href="{{url('MasterAdmin/Finance/RemoveFineSetting/'.request()->route('feegroupid').'/delete')}}">
                    <button type="button" class="btn btn-danger mg-t-15 btn-block"><i class="fa fa-trash"></i> Remove</button>
                    </a>
                    @endif
                </div>
                @endif
            </div>
            </form>
        </div>
    </div>
    <script type="text/javascript">
        $(function() {
            'use strict'
            $('[data-toggle="popover"]').popover();
        });

        $('.btn-popovers-type').popover({
            template: '<div class="popover popover-primary" role="tooltip"><div class="arrow"></div> <h3 class="popover-header"></h3> <div class="popover-body"></div></div>'
        })

        $("#continueBtn").click(function () {
            if ($("#fee_group_id").val() != 0) {
                window.location.assign('/MasterAdmin/Finance/FineSetting/' + $("#fee_group_id").val() + '/search');
            } else {
                window.location.assign('/MasterAdmin/Finance/FineSetting');
            }
        });

        $(".fine_type").on("change",function(){
            $("."+$(this).attr("selectclass")) .val($(this).val());
        });
        $(".fine,.max_fine_limit").on('keyup',function () {
            $("."+$(this).attr("selectclass")) .val($(this).val());
        });


    </script>
@endsection


