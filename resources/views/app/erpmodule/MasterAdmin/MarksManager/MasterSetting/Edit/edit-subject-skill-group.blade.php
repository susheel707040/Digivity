<form action="{{url('MasterAdmin/MarksManager/EditExamSubjectSkillGroup/'.$examsubjectskillgroup->id.'/edit')}}" method="POST"
      data-parsley-validate="" novalidate="">
    <div class="modal-body pd-sm-t-0 pd-sm-b-20 pd-sm-x-5">
        {{ csrf_field() }}
        <div class="row p-0 m-0">
            <div class="col-lg-6">
                <label>Subject Skill Group <sup>*</sup> : </label>
                <input type="text" id="skill_group_name" name="skill_group_name" value="{{$examsubjectskillgroup->skill_group_name}}" autocomplete="off"
                       class="form-control input-sm" placeholder="Enter Subject Skill Group Name" required="">
            </div>
            <div class="col-lg-6">
                <label>Position <sup>*</sup> : </label>
                <input type="text" id="position" name="position" value="{{$examsubjectskillgroup->position}}" autocomplete="off"
                       class="form-control input-sm" placeholder="Enter Position" required>
            </div>
            <div class="col-lg-12">
                <label>Description <span class="text-gray">(Optional)</span> : </label>
                <textarea class="form-control" name="description" placeholder="Enter Description">{{$examsubjectskillgroup->description}}</textarea>
            </div>
            <div class="col-lg-6">
                <label>Printable in Report Card  <sup>*</sup> : </label>
                <div class="clearfix pd-t-5"></div>
                <span><input type="radio" name="print" value="yes" @if($examsubjectskillgroup->print=="yes") checked @endif> Yes</span>
                <span class="pd-l-10"><input type="radio" name="print" value="no" @if($examsubjectskillgroup->print=="no") checked @endif> No</span>
            </div>
            <div class="col-lg-6">
                <label>Is Active  <sup>*</sup> : </label>
                <div class="clearfix pd-t-5"></div>
                <span><input type="radio" name="is_active" value="0" @if($examsubjectskillgroup->is_active=="0") checked @endif> Yes</span>
                <span class="pd-l-10"><input type="radio" name="is_active" value="1" @if($examsubjectskillgroup->is_active=="1") checked @endif> No</span>
            </div>
        </div>
    </div>
    <div class="modal-footer pd-x-20 pd-y-15">
        <button type="button" class="btn btn-white float-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
        <button type="submit" class="btn btn-primary float-right"> <i class="fa fa-edit"></i> Update</button>
    </div>
</form>

