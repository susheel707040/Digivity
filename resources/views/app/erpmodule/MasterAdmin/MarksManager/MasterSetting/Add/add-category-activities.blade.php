<form @if(isset($examsubject)&&($examsubject->id)) action="{{url('MasterAdmin/MarksManager/EditExamSubjectActivities/'.$examsubject->id.'/edit')}}" @else action="{{url('MasterAdmin/MarksManager/StoreExamSubject')}}" @endif method="POST"
      data-parsley-validate="" novalidate="">
    <div class="modal-body pd-sm-t-0 pd-sm-b-20 pd-sm-x-5">
        {{ csrf_field() }}
        <input type="hidden" name="integrate" readonly="readonly" value="activities">
        <div class="row p-0 m-0">
            <div class="col-lg-6">
                <label>Group <span class="text-gray">(Optional)</span> : </label>
                <div class="input-group">
                    @php $selectid=0; if(isset($examsubject)){$selectid=$examsubject->group_id;} @endphp
                    @include('components.MarksManager.subject-group-import',['class'=>'form-control input-sm','selectid'=>$selectid])
                    <div class="input-group-append">
                        <a href="{{url('/MasterAdmin/MarksManager/DefineSubjectGroup')}}"><button type="button" class="btn btn-outline-primary ml-2"><i class="fa fa-plus"></i> Add</button></a>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <label>Subject Activities Name <sup>*</sup> : </label>
                <input type="text" id="subject_name" @if(isset($examsubject)) value="{{$examsubject->subject_name}}" @endif name="subject_name" autocomplete="off"
                       class="form-control input-sm" placeholder="Enter Subject Activities Name" required="">
            </div>

            <div class="col-lg-6">
                <label>Alias <span class="text-gray">(Optional)</span> : </label>
                <input type="text" id="alias" name="alias" autocomplete="off"
                       class="form-control input-sm" @if(isset($examsubject)) value="{{$examsubject->alias}}" @endif placeholder="Enter Alias">
            </div>

            <div class="col-lg-6">
                <label>Subject Code <span class="text-gray">(Optional)</span> : </label>
                <input type="text" id="subject_code" name="subject_code" autocomplete="off"
                       class="form-control input-sm" @if(isset($examsubject)) value="{{$examsubject->subject_code}}" @endif placeholder="Enter Subject Code">
            </div>

            <div class="col-lg-12">
                <label>Description <span class="text-gray">(Optional)</span> : </label>
                <textarea class="form-control" name="description" placeholder="Enter Description"> @if(isset($examsubject)){{$examsubject->description}}@endif</textarea>
            </div>
            <div class="col-lg-6">
                <label>Is Active  <sup>*</sup> : </label>
                <div class="clearfix pd-t-5"></div>
                <span><input type="radio" name="is_active" value="0" @if(isset($examsubject)&&($examsubject->is_active==0)) checked @endif @if(!isset($examsubject)) checked @endif> Yes</span>
                <span class="pd-l-10"><input type="radio" name="is_active" value="1" @if(isset($examsubject)&&($examsubject->is_active==1)) checked @endif> No</span>
            </div>
        </div>
    </div>
    <div class="modal-footer pd-x-20 pd-y-15">
        <button type="button" class="btn btn-white float-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
        <button type="submit" class="btn btn-primary float-right"> @if(isset($examsubject)&&($examsubject->id)) <i class="fa fa-pen"></i> Update @else <i class="fa fa-plus"></i> Save @endif</button>
    </div>
</form>
