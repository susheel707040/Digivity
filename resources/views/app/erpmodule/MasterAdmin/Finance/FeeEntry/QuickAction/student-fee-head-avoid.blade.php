<form action="{{url('MasterAdmin/Finance/AddFeeHeadAvoid/'.$student->id.'/create')}}" method="POST" enctype="multipart/form-data" id="selectForm2"
      data-parsley-validate="" novalidate="">
    {{csrf_field()}}
<div class="col-lg-12">
    @include('component.Student.student-short-table-record',['student'=>$student])
    <table class="table tx-12 table-bordered mg-t-10">
        <thead class="bg-light">
        <tr>
            <th class="text-center"><input type="checkbox" id="checkAll" value="checkbox1"></th>
            <th><b>Fee Head</b></th>
        </tr>
        </thead>
        <tbody>
        @php
        $countfeeheadavoid=0;
        @endphp
        @foreach($studentfeestructure[0] as $data)
            <tr>
                <td class="text-center wd-5p"><input type="checkbox" class="checkbox1" @if(in_array($data['foreign_fee_head_id'],explode(",",$student->fee_head_id_avoid))) @php $countfeeheadavoid +=1; @endphp checked @endif value="{{$data['foreign_fee_head_id']}}" name="fee_head_id_avoid[]"></td>
                <td>{{$data['fee_head']}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<div class="modal-footer pd-x-20 pd-y-15">
    @if($countfeeheadavoid)
    <a href="{{url('MasterAdmin/Finance/RemoveFeeHeadAvoid/'.$student->id.'/remove')}}"><button type="button" class="btn btn-danger float-left"><i class="fa fa-trash"></i> Fee Head Avoid Remove Permanently</button></a>@endif
    <button type="button" class="btn btn-white float-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
    <button type="submit" class="btn btn-primary float-right"> <i class="fa fa-plus"></i> Apply</button>
</div>
</form>

