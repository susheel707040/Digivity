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
            <div class="panel-heading"><b><i class="fa fa-rupee-sign"></i> Assign Fee Concession Setting</b></div>
            <div class="panel-body pd-b-10 row">
                <div class="col-lg-12 bd-b bd-1">
                <table class="col-lg-7 mx-auto mg-t-10 mg-b-10">
                    <tr>
                        <td class="wd-20p"><b>Concession Type</b></td>
                        <td><b><sup>*</sup> :</b></td>
                        <td>
                            <select  id="concession_type_id" class="form-control">
                                <option value="">---Select---</option>
                                @foreach(concessiontypelist([]) as $data)
                                    <option value="{{$data->id}}"
                                            @if(request()->route('concessiontype')==$data->id) selected @endif>{{$data->concession_type}}</option>
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
                    @if(request()->route('concessiontype'))
                    <form class="container-fluid" action="{{url('MasterAdmin/Finance/CreateConcessionSetting')}}" method="POST" enctype="multipart/form-data" id="selectForm2"
                          data-parsley-validate="" novalidate="">
                        {{csrf_field()}}
                        <input type="hidden" name="concession_type_id" value="{{request()->route('concessiontype')}}">
                <div class="col-lg-12 mg-t-10">+
                    <table class="table bd bd-1 tx-12">
                        <tbody>
                        @foreach($feehead as $data)
                        @if(count($data->feeheadinstalment))
                        @php
                            $feeconcessionrecord=collect($feeheadconcession)->where('fee_head_id',$data->id)->toArray();
                        @endphp

                        <tr class="bg-light">
                            <td class="tx-13">
                                <table class="table-borderless p-0 m-0">
                                    <tr>
                                        <td class="pd-l-20 m-0"><input type="checkbox" name="fee_head_id[]" value="{{$data->id}}" @if(count($feeconcessionrecord)) checked @endif> <b>{{$data->fee_head}}</b></td>
                                        <td class="pd-l-30"><b>All Fee Head Instalment Concession :</b></td>
                                        <td class="wd-20"></td>
                                        <td class="p-0 m-0">
                                            <select class="form-control all_concession_type input-sm" selectclass="concession_type_{{$data->id}}">
                                                <option value="p">%</option>
                                                <option value="f">Fixed</option>
                                            </select>
                                        </td>
                                        <td class="p-0 m-0">
                                            <input type="text" value="0" class="form-control all_concession text-right wd-70 input-sm" selectclass="concession_{{$data->id}}">
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                             <table cellpadding="0" cellspacing="0" class="table-borderless p-0 m-0">
                                 <tr>
                                    @if($feeconcessionrecord != null)


                                     @foreach($data->feeheadinstalment as $data1)
                                    @php
                                        $feeinstalmentconcession=collect($feeconcessionrecord)->where('instalment_id',$data1->instalment_id)->shift()
                                    @endphp
                                     <td class="pd-l-1 text-center pd-r-0 p-0 m-0"><b>{{$data1->print_name}}</b>
                                      <input type="hidden" name="instalment_{{$data->id}}_id[]" value="{{$data1->instalment_id}}">
                                     <table class="mg-l-5">
                                         <tr>
                                             <td class="p-0 m-0">
                                                 <select name="concession_type_{{$data->id}}_{{$data1->instalment_id}}_id" class="form-control concession_type_{{$data->id}} wd-40 input-sm">
                                                     <option value="p" @if($feeinstalmentconcession['concession_type']=="p") selected @endif>%</option>
                                                     <option value="f" @if($feeinstalmentconcession['concession_type']=="f") selected @endif>Fixed</option>
                                                 </select>
                                             </td>
                                             <td class="p-0 m-0">
                                                 <input type="text" name="concession_{{$data->id}}_{{$data1->instalment_id}}_id" value="@if($feeinstalmentconcession['concession']){{$feeinstalmentconcession['concession']}}@else{{"0"}}@endif" class="form-control concession_{{$data->id}} text-right wd-50 input-sm">
                                             </td>
                                         </tr>
                                     </table>
                                     </td>
                                     @endforeach
                                     @endif
                             </table>
                            </td>
                        </tr>
                        @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-lg-12">
                    <button type="button" class="btn btn-white "><i class="fa fa-times"></i> Close</button>
                    <button type="submit" class="btn btn-primary float-right"><i class="fa fa-check"></i> Submit</button>
                </div>
                </form>
                @endif
            </div>
        </div>
    </div>
<script type="text/javascript">
   $("#continueBtn").click(function () {
       if($("#concession_type_id").val()!=0)
       {
           window.location.assign('/MasterAdmin/Finance/ConcessionSetting/'+$("#concession_type_id").val()+'/search');
       }else
       {
           window.location.assign('/MasterAdmin/Finance/ConcessionSetting');
       }
   })
    $(".all_concession_type").on("change",function(){
      $("."+$(this).attr("selectclass")) .val($(this).val());
    });
    $(".all_concession").on('keyup',function () {
        $("."+$(this).attr("selectclass")) .val($(this).val());
    });

</script>
@endsection
