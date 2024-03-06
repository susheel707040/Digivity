<form class="container-fluid" action="{{url('MasterAdmin/App/CreateNotice')}}" method="POST" enctype="multipart/form-data"
      data-parsley-validate="" novalidate="">
    {{csrf_field()}}
<div class="modal-body pd-sm-t-0 pd-sm-b-20 pd-sm-x-5">
    <div class="row p-0 m-0">
        <div class="col-lg-7 pd-t-10 row m-0">
            <div class="col-lg-4">
                <label><b>Notice For <sup>*</sup> :</b></label>
                <table>
                    <tr>
                        <td><input type="radio" name="type" value="all"></td><td class="pd-l-5">All</td>
                        <td class="pd-l-10"><input type="radio"name="type" value="student" checked></td><td class="pd-l-5">Student</td>
                        <td class="pd-l-10"><input type="radio" name="type" value="staff"></td><td class="pd-l-5">Staff</td>
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
            <div class="col-lg-12">
                <label class="container-fluid"><b>Student <span class="text-gray">(Optional)</span> :</b></label>
                @include('components.student-list-import')
            </div>

            <div class="col-lg-4">
                <label><b>Notice Date <sup>*</sup> :</b></label>
                <input type="text" placeholder="dd-mm-yyyy" name="notice_date" required value="{{nowdate('','d-m-Y')}}" class="form-control date">
            </div>

            <div class="col-lg-8">
                <label><b>Notice Title/Heading <sup>*</sup> :</b></label>
                <input type="text" name="notice_title" required placeholder="Enter Notice Title/Heading" class="form-control">
            </div>
            <div class="col-lg-12">
                <label><b>Notice <sup>*</sup>:</b></label>
                <textarea class="form-control" name="notice" required placeholder="Enter Notice" style=" height:200px; "></textarea>
            </div>

            <div class="col-lg-5">
                <label class="pd-t-5"><b>Show Notice Date Time <span class="text-gray">(Optional)</span> :</b></label>
                <input type="text" name="show_date_time" placeholder="dd-mm-yyyy hh:ii:ss"  class="form-control date">
            </div>

            <div class="col-lg-5">
                <label class="pd-t-5"><b>End Notice Date Time <span class="text-gray">(Optional)</span> :</b></label>
                <input type="text" name="end_date_time" placeholder="dd-mm-yyyy hh:ii:ss"  class="form-control date">
            </div>

            <div class="col-lg-9">
                <label class="pd-t-5"><b>Notice Communication <sup>*</sup> :</b></label>
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
                <label class="pd-t-5"><b>Status <sup>*</sup> :</b></label>
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
        <div class="col-lg-5 pl-0 pd-t-10">
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
    <button type="submit" class="btn btn-primary float-right"><i class="fa fa-plus"></i> Upload Notice</button>
</div>
</form>
