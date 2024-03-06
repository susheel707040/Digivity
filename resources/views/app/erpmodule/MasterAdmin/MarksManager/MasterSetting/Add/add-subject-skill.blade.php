<form action="{{url('MasterAdmin/MarksManager/StoreExamSubjectSkill')}}" method="POST"
      data-parsley-validate="" novalidate="">
    <div class="modal-body pd-sm-t-0 pd-sm-b-20 pd-sm-x-5">
        {{ csrf_field() }}
        <div class="row p-0 m-0">
            <div class="col-lg-6">
                <label>Subject Skill <sup>*</sup> : </label>
                <input type="text" id="skill_name" name="skill_name" autocomplete="off"
                       class="form-control input-sm" placeholder="Enter Subject Skill Name" required="">
            </div>
            <div class="col-lg-6">
                <label>Position <sup>*</sup> : </label>
                <input type="text" id="position" name="position" autocomplete="off"
                       class="form-control input-sm" placeholder="Enter Position" required>
            </div>
            <div class="col-lg-12">
                <label>Description <span class="text-gray">(Optional)</span> : </label>
                <textarea class="form-control" name="description" placeholder="Enter Description"></textarea>
            </div>
            <div class="col-lg-6">
                <label>Printable in Report Card  <sup>*</sup> : </label>
                <div class="clearfix pd-t-5"></div>
                <span><input type="radio" name="print" value="yes" checked> Yes</span>
                <span class="pd-l-10"><input type="radio" name="print" value="no"> No</span>
            </div>
            <div class="col-lg-6">
                <label>Is Active  <sup>*</sup> : </label>
                <div class="clearfix pd-t-5"></div>
                <span><input type="radio" name="is_active" value="0" checked> Yes</span>
                <span class="pd-l-10"><input type="radio" name="is_active" value="1"> No</span>
            </div>
        </div>
    </div>
    <div class="modal-footer pd-x-20 pd-y-15">
        <button type="button" class="btn btn-white float-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
        <button type="submit" class="btn btn-primary float-right"> <i class="fa fa-plus"></i> Save</button>
    </div>
</form>

