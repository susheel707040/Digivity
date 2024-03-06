<form action="{{url('/MasterAdmin/Timetable/EditTimetable/'.$timetable->id.'/edit')}}" method="POST" enctype="multipart/form-data" id="selectForm2"
      data-parsley-validate="" novalidate="">
    <div class="modal-body pd-sm-t-0 pd-sm-b-20 pd-sm-x-5">
        {{ csrf_field() }}
        <div class="row p-0 m-0">
            <div class="col-lg-6">
                <label>Timetable Name <sup>*</sup> : </label>
                <input type="text" id="timetable" name="timetable" autocomplete="off"
                       class="form-control input-sm" value="{{$timetable->timetable}}" placeholder="Enter Timetable Name" required="">
            </div>
            <div class="col-lg-6 mg-t-25">
                <label>Default Active <sup>*</sup> : <input type="checkbox" value="yes" name="default_at"
                                                            id="default_at" @if($timetable->default_at=="yes") checked @endif></label>
            </div>
        </div>
    </div>
    <div class="modal-footer pd-x-20 pd-y-15">
        <button type="button" class="btn btn-white float-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
        <button type="submit" class="btn btn-primary float-right"> <i class="fa fa-edit"></i> Update</button>
    </div>
</form>

