<form action="{{url('MasterAdmin/Finance/AddStudentConcession/'.$student->id.'/create')}}" method="POST" enctype="multipart/form-data" id="selectForm2"
      data-parsley-validate="" novalidate="">
    {{csrf_field()}}
<div class="col-lg-12 pd-b-20">
@include('component.Student.student-short-table-record')
    <table class="col-lg-7 mx-auto tx-12 mg-t-10">
        <tr>
            <td class="wd-20p"><b>Concession Type <sup>*</sup> :</b></td>
            <td>
                <select name="fee_concession_id" required class="form-control input-sm">
                    <option value="">---Select---</option>
                    @foreach(concessiontypelist([]) as $data)
                        <option value="{{$data->id}}" @if($student->fee_concession_id==$data->id) selected @endif>{{$data->concession_type}}</option>
                    @endforeach
                </select>
            </td>
            <td class="wd-35p pd-l-20">
                @if($student->fee_concession_id)
                    <a href="{{url('MasterAdmin/Finance/RemoveStudentConcession/'.$student->id.'/remove')}}">
                <button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Remove Concession</button>
                    </a>
                @endif
            </td>
        </tr>
    </table>
</div>
<div class="modal-footer pd-x-20 pd-y-15">
    <button type="button" class="btn btn-white float-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
    <button type="submit" class="btn btn-primary float-right"> <i class="fa fa-plus"></i> Apply</button>
</div>
</form>
