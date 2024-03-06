<form action="{{url('MasterAdmin/Staff/EditSkillAndKnowledge/'.$skillandknowledge->id.'/edit')}}" method="POST" enctype="multipart/form-data" id="selectForm2"
      data-parsley-validate="" novalidate="">
    <div class="modal-body pd-sm-t-0 pd-sm-b-20 pd-sm-x-5">
        {{ csrf_field() }}
        <div class="row p-0 m-0">
            <div class="col-lg-7">
                <label>Staff Skill and Knowledge <sup>*</sup> : </label>
                <input type="text" id="skill_name" name="skill_name" autocomplete="off"
                     value="{{$skillandknowledge->skill_name}}"  class="form-control input-sm" placeholder="Enter Staff Skill and Knowledge like(Computer Knowledge)" required="">
            </div>
            <div class="col-lg-5">
                <label>Status <sup>*</sup> :
                    <table>
                        <tr>
                            <td><input type="radio" name="status" value="enable" @if($skillandknowledge->status=="enable") checked @endif></td><td>Enable</td>
                            <td><input type="radio" name="status" value="disable" @if($skillandknowledge->status=="disable") checked @endif></td><td>Disable</td>
                        </tr>
                    </table>
                </label>
            </div>
        </div>
    </div>
    <div class="modal-footer pd-x-20 pd-y-15">
        <button type="button" class="btn btn-white float-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
        <button type="submit" class="btn btn-primary float-right"> <i class="fa fa-plus"></i> Save</button>
    </div>
</form>

