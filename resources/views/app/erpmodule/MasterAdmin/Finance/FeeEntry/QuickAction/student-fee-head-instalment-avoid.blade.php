<form action="{{url('MasterAdmin/Finance/AddFeeHeadInstalmentAvoid/'.$student->student_id.'/create')}}" method="POST" enctype="multipart/form-data" id="selectForm2"
      data-parsley-validate="" novalidate="">
    {{csrf_field()}}
<div class="col-lg-12">
    @include('component.Student.student-short-table-record',['student'=>$student])
    <table class="table tx-12 table-bordered mg-t-10">
        @foreach($studentfeestructure[0] as $data)
            @php
                $feeheadinstalmentavoidarr=collect($feeheadinstalmentavoid)->where('foreign_fee_head_id',$data['foreign_fee_head_id'])->shift();
            @endphp
            <thead class="bg-light">
            <tr><th><b>{{$data['fee_head']}}</b>
                <input type="hidden" autocomplete="off" name="fhi_{{$student->student_id}}_foreign_fee_head_id[]" value="{{$data['foreign_fee_head_id']}}" readonly="readonly">
                <input type="hidden" autocomplete="off" name="fhi_{{$data['foreign_fee_head_id']}}_fee_head_id" value="{{$data['fee_head_id']}}" readonly="readonly">
                </th></tr>
            </thead>
            <tbody>
            <tr>
                <td class="pd-t-0 pd-b-5 m-0">
                    @foreach($data['fee_head_full_instalment'] as $data1)
                        <table cellspacing="0" cellpadding="0" class="pd-l-2 pd-r-2 pd-t-0 pd-b-0 mg-l-5 float-left table-borderless">
                            <tr>
                                <td class="pd-r-0"><input value="{{$data1}}" @if(isset($feeheadinstalmentavoidarr)) @if(in_array($data1,explode(",",$feeheadinstalmentavoidarr['instalment_id']))) checked @endif @endif name="fee_head_{{$data['foreign_fee_head_id']}}_instalment_id_avoid[]" type="checkbox"></td><td class="pd-0"><b>{{$data['fee_head_instalment_print'][$data1]}}</b></td>
                            </tr>
                        </table>
                    @endforeach
                </td>
            </tr>
            </tbody>
        @endforeach
    </table>
</div>
<div class="modal-footer pd-x-20 pd-y-15">

    <button type="button" class="btn btn-white float-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
    <button type="submit" class="btn btn-primary float-right"> <i class="fa fa-plus"></i> Apply</button>
</div>
</form>
