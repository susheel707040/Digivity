<form action="{{url('MasterAdmin/GlobalSetting/EditClass/'.$course->id.'/edit')}}" method="POST" enctype="multipart/form-data" id="selectForm2"
      class="parsley-style-1" data-parsley-validate="" novalidate="">

    <div class="modal-body pd-sm-t-0 pd-sm-b-20 pd-sm-x-5">
        {{ csrf_field() }}
        <div class="row p-0 m-0">
            <div class="col-lg-6">
                <label>Wing : </label>
                <select id="wing_id" name="wing_id" class="form-control input-sm">
                    <option value="">---Select---</option>
                    @foreach($wing as $data)
                        <option value="{{$data->id}}"  @if(!is_null($course->wing) ? $data->id==$course->wing->id : null) selected @endif>{{$data->wing}}</option>
                    @endforeach
                </select>
            </div>


            <div class="col-lg-6">
                <label>Sequence <sup>*</sup> : </label>
                <select id="sequence" name="sequence" class="form-control input-sm">
                    <option value="0">---Select---</option>
                    @for($i=1;$i<=50;$i++)
                        <option value="{{$i}}" @if($i==$course->sequence) selected @endif>{{$i}}</option>
                    @endfor
                </select>
            </div>

            <div class="col-lg-6">
                <label>Class/Course <sup>*</sup> :</label>
                <input type="text" id="course" value="{{$course->course}}" autocomplete="off" name="course" placeholder="Enter Class/Course Name" class="form-control input-sm">
            </div>

            <div class="col-lg-6">
                <label>Class/Course Code :</label>
                <input type="text" id="course_code" value="{{$course->course_code}}"  required autocomplete="off" name="course_code" placeholder="Enter Class/Course Name Code" class="form-control input-sm">
            </div>

            <div class="col-lg-6">
                <label>Full Name : </label>
                <input type="text" id="full_name" value="{{$course->full_name}}"  autocomplete="off" name="full_name" placeholder="Enter Class/Course Full Name" class="form-control input-sm">
            </div>

            <div class="col-lg-6">
                <label>TC Full Name :</label>
                <input type="text" autocomplete="off" value="{{$course->tc_name}}"   id="tc_name" name="tc_name" placeholder="Enter Class/Course Name" class="form-control input-sm">
            </div>


        </div>
    </div>
    <div class="modal-footer pd-x-20 pd-y-15">
        <button type="button" class="btn btn-white float-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancel
        </button>
        <button type="submit" class="btn btn-primary float-right"><i class="fa fa-pen"></i> Update</button>
    </div>
</form>

