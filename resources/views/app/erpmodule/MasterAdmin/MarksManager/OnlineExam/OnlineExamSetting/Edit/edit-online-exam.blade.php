<form action="{{url('/MasterAdmin/MarksManager/EditOnlineExam/'.$onlineexam->id.'/edit')}}" method="POST" enctype="multipart/form-data" id="selectForm2"
      data-parsley-validate="" novalidate="">
    <div class="modal-body pd-sm-t-0 pd-sm-b-20 pd-sm-x-5">
        {{ csrf_field() }}
        <div class="row p-0 m-0">
            <div class="col-lg-6">
                <label>Exam Name <sup>*</sup> : </label>
                <input type="text" id="exam_name" name="exam_name" autocomplete="off"
                       class="form-control input-sm" value="{{$onlineexam->exam_name}}" placeholder="Enter Online Exam Name" required="">
            </div>
            <div class="col-lg-6">
                <label>Exam Type <sup>*</sup> : </label>
                <table>
                    <tr>
                        <td><input type="radio" name="exam_type" value="general" @if($onlineexam->exam_type=="general") checked @endif></td><td class="pd-l-5">General</td>
                        <td class="pd-l-10"><input type="radio" name="exam_type" value="subject" @if($onlineexam->exam_type=="subject") checked @endif></td><td class="pd-l-5">Subject Specific</td>
                    </tr>
                </table>
            </div>
            <div class="col-lg-6">
                <label>Start Date <sup>*</sup> : </label>
                <input type="text" id="start_date" name="start_date" @if(isset($onlineexam->start_date))value="{{nowdate($onlineexam->start_date,'d-m-Y')}}"@endif autocomplete="off"
                       class="form-control date input-sm" placeholder="dd-mm-yyyy" required="">
            </div>
            <div class="col-lg-6">
                <label>End Date <sup>*</sup> : </label>
                <input type="text" id="end_date" name="end_date" @if(isset($onlineexam->end_date))value="{{nowdate($onlineexam->end_date,'d-m-Y')}}"@endif autocomplete="off"
                       class="form-control date input-sm" placeholder="dd-mm-yyyy" required="">
            </div>
            <div class="col-lg-6">
                <label>Maximum Time (Minutes) <sup>*</sup> : </label>
                <input type="text" id="duration" name="duration" value="{{$onlineexam->duration}}" autocomplete="off"
                       class="form-control input-sm" required="">
            </div>
            <div class="col-lg-6">
                <label>Pass Percentage (%) <sup>*</sup> : </label>
                <input type="text" id="pass_marks" name="pass_marks" value="{{$onlineexam->pass_marks}}" autocomplete="off"
                       class="form-control input-sm" required="">
            </div>
            <div class="col-lg-6">
                <label>Exam Format <sup>*</sup> : </label>
                <table>
                    <tr>
                        <td><input type="radio" name="exam_format" value="objective" @if($onlineexam->exam_format=="objective") checked @endif></td><td class="pd-l-5">Objective</td>
                        <td class="pd-l-10"><input type="radio" name="exam_format" value="hybrid" @if($onlineexam->exam_format=="hybrid") checked @endif></td><td class="pd-l-5">Hybrid</td>
                    </tr>
                </table>
            </div>
            <div class="col-lg-6">
                <label>Subject <sup>*</sup> : </label>
                @include('component.subject-import',['class'=>'form-control','selectid'=>$onlineexam->subject_id])
            </div>
        </div>
    </div>
    <div class="modal-footer pd-x-20 pd-y-15">
        <button type="button" class="btn btn-white float-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
        <button type="submit" class="btn btn-primary float-right"> <i class="fa fa-edit"></i> Update</button>
    </div>
</form>

