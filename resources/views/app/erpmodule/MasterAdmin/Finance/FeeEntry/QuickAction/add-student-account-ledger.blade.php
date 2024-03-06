<form action="{{url('MasterAdmin/Finance/AddStudentACledgerNo/'.$student->id.'/create')}}" method="POST" enctype="multipart/form-data" id="selectForm2"
      data-parsley-validate="" novalidate="">
    {{csrf_field()}}
<div class="col-lg-12 pd-b-20">
@include('component.Student.student-short-table-record')
    <table class="col-lg-7 mx-auto mg-t-20">
        <tr>
            <td class="wd-30p"><b>Account Ledger No. :</b></td>
            <td class="wd-35p"><input type="text" value="{{$student->ac_ledger_no}}" name="ac_ledger_no" autocomplete="off" placeholder="Enter Account Ledger Number" class="form-control input-sm"></td>
            <td class="wd-35p pd-l-20">
                @if($student->ac_ledger_no)
                    <a href="{{url('MasterAdmin/Finance/RemoveStudentACledgerNo/'.$student->id.'/remove')}}">
                        <button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Remove AC Ledger No.</button>
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


