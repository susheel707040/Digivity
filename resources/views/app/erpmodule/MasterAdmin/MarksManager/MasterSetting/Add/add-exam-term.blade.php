<form action="{{url('MasterAdmin/MarksManager/StoreExamTerm')}}" method="POST"
      data-parsley-validate="" novalidate="">
    <div class="modal-body pd-sm-t-0 pd-sm-b-20 pd-sm-x-5">
        {{ csrf_field() }}
        <div class="row p-0 m-0">
            <div class="col-lg-6">
                <label>Position <sup>*</sup> : </label>
                <input type="text" id="position" name="position" autocomplete="off"
                       class="form-control input-sm" placeholder="Enter Position" required="">
            </div>
            <div class="col-lg-6">
                <label>Exam Term <sup>*</sup> : </label>
                <input type="text" id="exam_term" name="exam_term" autocomplete="off"
                       class="form-control input-sm" placeholder="Enter Exam Term" required="">
            </div>
            <div class="col-lg-6">
                <label>Alias <span class="text-gray">(Optional)</span> : </label>
                <input type="text" id="alias" name="alias" autocomplete="off"
                       class="form-control input-sm" placeholder="Enter Alias">
            </div>
            <div class="col-lg-6">
                <label>Description <span class="text-gray">(Optional)</span> : </label>
                <textarea class="form-control" name="description" placeholder="Enter Description"></textarea>
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

