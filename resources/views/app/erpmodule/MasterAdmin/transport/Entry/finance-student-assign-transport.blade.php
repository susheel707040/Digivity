<form action="{{url('MasterAdmin/Transport/FinanceStudentAssignTransport/'.$student->id.'/store')}}" method="POST" enctype="multipart/form-data" id="selectForm2"
      class="parsley-style-1" data-parsley-validate="" novalidate="">
    {{csrf_field()}}
<div class="col-lg-12 pd-b-20">
@include('component.Student.student-short-table-record')
<div class="row">
    <div class="col-lg-12 tx-12">
        <table class="mg-t-20">
            <tr>
                <td class="wd-12p text-left"><b>Transport Start Date :</b></td>
                <td class=" wd-150 pd-l-10"><input type="text" name="transport_start_date" autocomplete="off" placeholder="dd-mm-YYYY" class="form-control date input-sm" value="@if(!empty($student->transport_start_date)){{\App\Helper\DateFormat::datenumeric($student->transport_start_date)}}@else{{date('d-m-Y')}}@endif"></td>
                <td class="wd-12p pd-l-10 text-center"><b>Route :</b></td>
                <td class="pd-l-10">
                   @include('component.Transport.assign-transport-route-list',['class'=>'form-control select-search input-sm','id'=>'transport_id','name'=>'transport_id','selectid'=>$student->transport_id, 'other'=>0])
                </td>
                <td class="wd-12p text-left pd-l-10"><b>Transport Status :</b></td>
                <td class="wd-12p text-left mg-l-10 pd-l-10">
                    <input name="transport_status" id="active" value="active" type="radio" checked>
                    <label class="align-text-bottom" for="active">Active</label>
                    <input name="transport_status" id="inactive" value="inactive" type="radio">
                    <label class="align-text-bottom" for="inactive">Inactive</label>
                </td>
                @if($student->transport_id)
                <td class="pd-l-15"><input type="checkbox" id="transport_stop" name="transport_stop" value="yes"></td><td class="pd-l-5"><b>Transport Stop</b></td>
                    <div class="transport-stop-date" style=" display:none; ">
                    <td class="wd-12p pd-l-20 text-center text-danger"><b>Transport Stop Date :</b></td>
                    <td class=" wd-150 "><input type="text" name="transport_stop_date" autocomplete="off" class="form-control date input-sm" placeholder="dd-mm-YYYY" value="@if($student->transport_stop_date){{\App\Helper\DateFormat::datenumeric($student->transport_stop_date)}}@else{{""}}@endif"></td>
                    </div>
                @endif
            </tr>
        </table>
    </div>
    <div class="col-lg-12 tx-12">
        <div class="card shadow-none mg-t-20">
            <div class="card-header bg-gray-100"><b><i class="fa fa-bus"></i> Transport Fee Installment Disable</b>
                <table class="float-right"><tbody><tr><td><input type="checkbox" id="CheckAll" value="checkbox1"></td><td class="pd-l-5"><b>Select All</b></td></tr></tbody></table>
            </div>
            <div class="card-body pd-l-10 pd-r-10 pd-b-5 pd-t-0 pd-b-0 m-0 flex-fill">
                @if($feeheadinstalment)
                   @php
                   $feeheadinstalmentavoid=collect(feeheadinstalmentavoid(['student_id'=>$student->student_id,'foreign_fee_head_id'=>$feeheadinstalment->id]))->shift();
                   if($feeheadinstalmentavoid){
                       $intalmentavoid=explode(",",$feeheadinstalmentavoid->instalment_id);
                   }else{
                       $intalmentavoid=array();
                   }
                   @endphp
                <table>
                    <tr>
                        <td colspan="20" class="pd-t-10"><b>{{$feeheadinstalment->fee_head}} :</b>
                        <input type="hidden" readonly="readonly" name="fee_head_id" value="{{$feeheadinstalment->id}}">
                        </td>
                    </tr>
                    <tr>
                        @foreach($feeheadinstalment->feeheadinstalment as $data)
                        <td class="wd-20"><input type="checkbox" name="instalment_id[]" class="checkbox1" value="{{$data->instalment_id}}" @if(in_array($data->instalment_id,$intalmentavoid)) checked @endif></td><td class="pd-l-0 pd-r-10">{{$data->print_name}}</td>
                        @endforeach
                    </tr>
                </table>
                 @endif
            </div>
        </div>
    </div>
</div>
</div>
<div class="modal-footer pd-x-20 pd-y-15">
    @if($student->transport_id)
    <a href="{{url('MasterAdmin/Transport/StudentRouteRemove/'.$student->id.'/remove')}}"><button type="button" class="btn btn-danger float-left"><i class="fa fa-trash"></i> Transport Remove Permanently</button></a>
    @endif
    <button type="button" class="btn btn-white float-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
    <button type="submit" class="btn btn-primary float-right"> @if($student->transport_id)<i class="fa fa-edit"></i> Update @else <i class="fa fa-plus"></i> Assign @endif</button>
</div>
</form>
