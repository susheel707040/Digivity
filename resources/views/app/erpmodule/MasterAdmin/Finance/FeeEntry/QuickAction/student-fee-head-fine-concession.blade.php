<form action="{{url('MasterAdmin/Finance/AddStudentFeeHeadFineConcession/'.$student->student_id.'/create')}}" method="POST"
      enctype="multipart/form-data" id="selectForm2"
      data-parsley-validate="" novalidate="">
    {{csrf_field()}}
    <div class="col-lg-12">
        @include('component.Student.student-short-table-record',['student'=>$student])
        <table class="table tx-12 table-bordered mg-t-10">
            @foreach($studentfeestructure[0] as $data)
                @php
                    $feefineconcessiondata=collect($studentfeeheadfineconcession)->where('foreign_fee_head_id',$data['foreign_fee_head_id']);
                @endphp
                <thead class="bg-light">
                <tr><th><b>
                            <input type="checkbox" name="foreign_{{$student->student_id}}_fee_head_id[]" value="{{$data['foreign_fee_head_id']}}" @if(count($feefineconcessiondata)) checked @endif>
                            <input type="hidden" readonly="readonly" name="fee_head_{{$student->student_id}}_{{$data['foreign_fee_head_id']}}_id" value="{{$data['fee_head_id']}}">
                            {{$data['fee_head']}}
                        </b></th></tr>
                </thead>
                <tbody>
                <tr>
                    <td class="pd-t-0 pd-b-5 m-0">
                @foreach($data['fee_head_all_instalment'] as $data1)
                    @php
                        $feefineconcessiondata=collect($studentfeeheadfineconcession)->where('foreign_fee_head_id',$data['foreign_fee_head_id'])->where('instalment_id',$data1)->shift();
                    @endphp
                            <table cellspacing="0" cellpadding="0" class="pd-l-2 pd-r-2 pd-t-0 pd-b-0 mg-l-10 float-left table-borderless">
                                <tr>
                                    <td class="p-0 m-0 text-center text-capitalize" colspan="2">
                                        <input type="hidden" name="student_{{$student->student_id}}_{{$data['foreign_fee_head_id']}}_instalment_id[]" value="{{$data1}}">
                                        <b>{{$data['fee_head_instalment_print'][$data1]}}</b></td>
                                    <td class="p-0 m-0 text-center"><b>Status</b></td>
                                </tr>
                                <tr>
                                    <td class="p-0 m-0">
                                        <select name="student_{{$student->student_id}}_{{$data['foreign_fee_head_id']}}_{{$data1}}_concession_type" class="form-control1 input-sm p-0 m-0 wd-40">
                                            <option value="f" @if(isset($feefineconcessiondata->concession_type)) @if($feefineconcessiondata->concession_type=="f")) selected @endif @endif>Fixed</option>
                                            <option value="p" @if(isset($feefineconcessiondata->concession_type)) @if($feefineconcessiondata->concession_type=="p")) selected @endif @endif>%</option>
                                        </select>
                                    </td>
                                    <td class="p-0 m-0"><input type="text" value="@if(isset($feefineconcessiondata->concession)){{$feefineconcessiondata->concession}}@else{{"0"}}@endif" name="student_{{$student->student_id}}_{{$data['foreign_fee_head_id']}}_{{$data1}}_concession" autocomplete="off" class="form-control1 text-center input-sm p-0 m-0 wd-40" value="0"></td>
                                    <td class="p-0 m-0 text-center">
                                        <select name="student_{{$student->student_id}}_{{$data['foreign_fee_head_id']}}_{{$data1}}_status" class="form-control1 ">
                                            <option value="no" @if(isset($feefineconcessiondata->instalment_avoid)) @if($feefineconcessiondata->instalment_avoid=="no")) selected @endif @endif>Enable</option>
                                            <option value="yes" @if(isset($feefineconcessiondata->instalment_avoid)) @if($feefineconcessiondata->instalment_avoid=="yes")) selected @endif @endif>Disable</option>
                                        </select>
                                    </td>
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
        @if(count($studentfeeheadfineconcession))
            <a href="{{url('MasterAdmin/Finance/RemoveStudentFeeHeadInstalmentFineConcession/'.$student->student_id.'/remove')}}">
                <button type="button" class="btn btn-danger float-right"> <i class="fa fa-trash"></i> Remove Student Fee Head Concession</button></a>
        @endif
        <button type="button" class="btn btn-white float-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
        <button type="submit" class="btn btn-primary float-right"> <i class="fa fa-plus"></i> Apply</button>
    </div>
</form>
