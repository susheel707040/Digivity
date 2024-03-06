<form action="{{url('MasterAdmin/App/CreateAssignment')}}" method="POST" enctype="multipart/form-data"
      id="selectForm2" data-parsley-validate="" novalidate="">
    {{ csrf_field() }}
    <div class="modal-body pd-sm-t-0 pd-sm-b-10 pd-sm-x-5">
        <div class="row p-0 m-0">
            <div class="col-lg-7 pd-t-5 row m-0">
                <div class="col-lg-4">
                    <label><b>Assigment For <sup>*</sup> :</b></label>
                    <table>
                        <tr>
                            <td><input type="radio" name="type" value="all" checked></td><td class="pd-l-5">All Student</td>
                            <td class="pd-l-10"><input type="radio" name="type"  value="student"></td><td class="pd-l-5">Student</td>
                        </tr>
                    </table>
                </div>
                <div class="col-lg-4">
                    <label><b>Course <sup>*</sup> :</b></label>
                    @include('components.course-import',['name'=>'course_id'])
                </div>
                <div class="col-lg-4">
                    <label><b>Section <sup>*</sup> :</b></label>
                    @include('components.section-import',['name'=>'section_id'])
                </div>
                <div class="col-lg-4">
                    <label><b>Subject <sup>*</sup> :</b></label>
                    @include('components.subject-import',['name'=>'subject_id','required'=>'required'])
                </div>
                <div class="col-lg-8">
                    <label><b>Submit To Teacher <span class="text-gray">(Optional)</span> :</b></label>
                    @include('components.staff-import',['name'=>'staff_id'])
                </div>
                <div class="col-lg-4">
                    <label><b>Assignment Date <sup>*</sup> :</b></label>
                    <input type="text" name="assignment_date" value="{{nowdate('','d-m-Y')}}" class="form-control date">
                </div>
                <div class="col-lg-4">
                    <label><b>Assigned on <sup>*</sup> :</b></label>
                    <input type="text" name="assigned_date" value="{{nowdate('','d-m-Y')}}" class="form-control date">
                </div>
                <div class="col-lg-4">
                    <label><b>To be Submitted <sup>*</sup> :</b></label>
                    <input type="text" name="submitted_date" value="{{nowdate('','d-m-Y')}}" class="form-control date">
                </div>
                <div class="col-lg-12">
                    <label><b>Assignment Title/Heading <sup>*</sup> :</b></label>
                    <input type="text" name="assignment_title" required placeholder="Enter Assignment Heading" class="form-control">
                </div>
                <div class="col-lg-12">
                    <label><b>Assignment <sup>*</sup> :</b></label>
                    <textarea class="form-control" required name="assignment" placeholder="Enter Assignment" style=" height:180px; "></textarea>
                </div>
                <div class="col-lg-6">
                    <label><b>Show Start Date <span class="text-gray">(Optional)</span> :</b></label>
                    <input type="text" name="show_date_time" class="form-control" placeholder="dd-mm-yyyy hh:ii:ss">
                </div>
                <div class="col-lg-6">
                    <label><b>Show End Date <span class="text-gray">(Optional)</span> :</b></label>
                    <input type="text" name="end_date_time" class="form-control" placeholder="dd-mm-yyyy hh:ii:ss">
                </div>
                <div class="col-lg-9">
                    <label><b>Assignment Communication <sup>*</sup> :</b></label>
                    <table>
                        <tr>
                            <td><input type="checkbox" name="with_app" value="yes" checked></td>
                            <td class="pd-l-5">Mobile App</td>
                            <td class="pd-l-10"><input type="checkbox" value="yes" name="with_text_sms"></td>
                            <td class="pd-l-5">Text SMS</td>
                            <td class="pd-l-10"><input type="checkbox" value="yes" name="with_email"></td>
                            <td class="pd-l-5">Email</td>
                            <td class="pd-l-10"><input type="checkbox" value="yes" name="with_website" checked></td>
                            <td class="pd-l-5">Website</td>
                        </tr>
                    </table>
                </div>
                <div class="col-lg-3">
                    <label><b>Status :</b></label>
                    <table>
                        <tr>
                            <td><input type="radio" name="status" value="yes" checked></td>
                            <td class="pd-l-5">Yes</td>
                            <td class="pd-l-10"><input type="radio" name="status" value="no"></td>
                            <td class="pd-l-5">No</td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="col-lg-5 pl-0  pd-t-10">
                <div class="card">
                    <div class="card-header bg-gray-100"><b><i class="fa fa-file"></i> Upload Attachment Files
                            (png,jpeg,jpg,gif,pdf,doc & etc.)</b></div>
                    <div class="card-body pd-5 pd-t-10 pd-b-0 tx-13 m-0 flex-fill">
                        @include('components.FileUploader.file-uploader')
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="modal-footer pd-x-20 pd-y-15">
        <button type="button" class="btn btn-white float-left" data-dismiss="modal"><i class="fa fa-times"></i>
            Close
        </button>
        <button type="submit" class="btn btn-primary float-right"><i class="fa fa-plus"></i> Upload Assignment</button>
    </div>
</form>
