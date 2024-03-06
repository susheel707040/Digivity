<form action="{{url('MasterAdmin/MarksManager/EditExamType/'.$examtype->id.'/edit')}}" method="POST"
      data-parsley-validate="" novalidate="">
    <div class="modal-body pd-sm-t-0 pd-sm-b-20 pd-sm-x-5">
        {{ csrf_field() }}
        <div class="row p-0 m-0">
            <div class="col-lg-6">
                <label>Position <sup>*</sup> : </label>
                <input type="text" id="position" value="{{$examtype->position}}" name="position" autocomplete="off"
                       class="form-control input-sm" placeholder="Enter Position" required="">
            </div>
            <div class="col-lg-6">
                <label>Exam Type <sup>*</sup> : </label>
                <input type="text" id="exam_type" value="{{$examtype->exam_type}}" name="exam_type" autocomplete="off"
                       class="form-control input-sm" placeholder="Enter Exam Type" required="">
            </div>
            <div class="col-lg-12 tx-11 text-danger text-left pd-t-5"><b>Exam Type Example :</b> 1. Scholastic | 2. Co-Scholastic | 3. Discipline | 4. Activity | 5. Height & Weight</div>
            <div class="col-lg-6">
                <label>Alias <span class="text-gray">(Optional)</span> : </label>
                <input type="text" id="alias" name="alias" autocomplete="off"
                       class="form-control input-sm" value="{{$examtype->alias}}" placeholder="Enter Alias">
            </div>
            <div class="col-lg-6">
                <label>Integrate With <sup>*</sup> : </label>
                @include('component.MarksManager.integrate-with-import',['class'=>'form-control','required'=>'required','selectid'=>$examtype->integrate])
            </div>
            <div class="col-lg-6">
                <label>Description <span class="text-gray">(Optional)</span> : </label>
                <textarea class="form-control" name="description" placeholder="Enter Description">{{$examtype->description}}</textarea>
            </div>
            <div class="col-lg-6">
                <label>Is Active  <sup>*</sup> : </label>
                <div class="clearfix pd-t-5"></div>
                <span><input type="radio" name="is_active" value="0" @if($examtype->is_active==0) checked @endif> Yes</span>
                <span class="pd-l-10"><input type="radio" name="is_active" value="1" @if($examtype->is_active==1) checked @endif> No</span>
            </div>
        </div>
    </div>
    <div class="modal-footer pd-x-20 pd-y-15">
        <button type="button" class="btn btn-white float-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
        <button type="submit" class="btn btn-primary float-right"> <i class="fa fa-edit"></i> Update</button>
    </div>
</form>

