<form @if(isset($examsubject)&&($examsubject->id)) action="{{url('MasterAdmin/MarksManager/EditExamSubjectGroup/'.$examsubject->id.'/edit')}}" @else action="{{url('MasterAdmin/MarksManager/StoreExamSubject')}}" @endif method="POST"
      data-parsley-validate="" novalidate="">
    <div class="modal-body pd-sm-t-0 pd-sm-b-20 pd-sm-x-5">
        {{ csrf_field() }}
        <input type="hidden" name="define" readonly="readonly" value="parent">
        <input type="hidden" name="integrate" readonly="readonly" value="none">
        <div class="row p-0 m-0">
            <div class="col-lg-6">
                <label>Subject Group <sup>*</sup> : </label>
                <input type="text" id="subject_name" name="subject_name" autocomplete="off"
                     @if(isset($examsubject)&&($examsubject)) value="{{$examsubject->subject_name}}" @endif  class="form-control input-sm" placeholder="Enter Subject Group" required="">
            </div>
            <div class="col-lg-6">
                <label>Is Active  <sup>*</sup> : </label>
                <div class="clearfix pd-t-5"></div>
                <span><input type="radio" name="is_active" value="0" @if(isset($examsubject)&&($examsubject->is_active=="0")) checked @endif @if(!isset($examsubject)) checked @endif> Yes</span>
                <span class="pd-l-10"><input type="radio" name="is_active" value="1" @if(isset($examsubject)&&($examsubject->is_active=="1")) checked @endif> No</span>
            </div>
        </div>
    </div>
    <div class="modal-footer pd-x-20 pd-y-15">
        <button type="button" class="btn btn-white float-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
        <button type="submit" class="btn btn-primary float-right"> @if(isset($examsubject)&&($examsubject->id)) <i class="fa fa-edit"></i> Update @else <i class="fa fa-plus"></i> Save @endif</button>
    </div>
</form>

