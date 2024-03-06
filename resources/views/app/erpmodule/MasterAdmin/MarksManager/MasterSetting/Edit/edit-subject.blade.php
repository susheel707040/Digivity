<form action="{{url('MasterAdmin/MarksManager/EditExamSubject/'.$examsubject->id.'/edit')}}" method="POST"
      data-parsley-validate="" novalidate="">
    <div class="modal-body pd-sm-t-0 pd-sm-b-20 pd-sm-x-5">
        {{ csrf_field() }}
        <div class="row p-0 m-0">
            <div class="col-lg-6">
                <label>Group <span class="text-gray">(Optional)</span> : </label>
                <div class="input-group">
                    @include('component.MarksManager.subject-group-import',['class'=>'form-control input-sm','selectid'=>$examsubject->group_id])
                    <div class="input-group-append">
                        <a href="{{url('/MasterAdmin/MarksManager/DefineSubjectGroup')}}"><button type="button" class="btn btn-outline-primary ml-2"><i class="fa fa-plus"></i> Add</button></a>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <label>Subject Name <sup>*</sup> : </label>
                <input type="text" id="subject_name" value="{{$examsubject->subject_name}}" name="subject_name" autocomplete="off"
                       class="form-control input-sm" placeholder="Enter Subject Name" required="">
            </div>
            <div class="col-lg-6">
                <label>Alias <span class="text-gray">(Optional)</span> : </label>
                <input type="text" id="alias" name="alias" value="{{$examsubject->alias}}" autocomplete="off"
                       class="form-control input-sm" placeholder="Enter Alias">
            </div>
            <div class="col-lg-6">
                <label>Subject Code <span class="text-gray">(Optional)</span> : </label>
                <input type="text" id="subject_code" value="{{$examsubject->subject_code}}" name="subject_code" autocomplete="off"
                       class="form-control input-sm" placeholder="Enter Subject Code">
            </div>
            <div class="col-lg-6">
                <label>Description <span class="text-gray">(Optional)</span> : </label>
                <textarea class="form-control" name="description" placeholder="Enter Description">{{$examsubject->description}}</textarea>
            </div>
            <div class="col-lg-6">
                <label>Is Active  <sup>*</sup> : </label>
                <div class="clearfix pd-t-5"></div>
                <span><input type="radio" name="is_active" value="0" @if($examsubject->is_active==0) checked @endif> Yes</span>
                <span class="pd-l-10"><input type="radio" name="is_active" value="1" @if($examsubject->is_active==1) checked @endif> No</span>
            </div>
        </div>
    </div>
    <div class="modal-footer pd-x-20 pd-y-15">
        <button type="button" class="btn btn-white float-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
        <button type="submit" class="btn btn-primary float-right"> <i class="fa fa-edit"></i> Update</button>
    </div>
</form>

