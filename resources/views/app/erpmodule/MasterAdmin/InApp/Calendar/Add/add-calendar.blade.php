<form action="{{url('MasterAdmin/App/CreateCalendar')}}" method="POST" enctype="multipart/form-data"
      id="selectForm2" data-parsley-validate="" novalidate="">
{{ csrf_field() }}
    <div class="modal-body pd-sm-t-0 pd-sm-b-10 pd-sm-x-5">
        <div class="row p-0 m-0">
            <div class="col-lg-7 pd-t-5 row m-0">
                <div class="col-lg-4">
                    <label><b>Calendar Type <sup>*</sup> :</b></label>
                    @include('components.InApp.calendar-type-import',['required'=>'required','class'=>'form-control'])
                </div>
                <div class="col-lg-4">
                    <label><b>Event for <sup>*</sup> :</b></label>
                    <table>
                        <tr>
                            <td><input type="radio" name="type" value="all" checked></td><td class="pd-l-5" >Both</td>
                            <td class="pd-l-10"><input type="radio" name="type" value="student"></td><td class="pd-l-5">Student</td>
                            <td class="pd-l-10"><input type="radio" name="type" value="staff"></td><td class="pd-l-5">Staff</td>
                        </tr>
                    </table>
                </div>
                <div class="col-lg-4">
                    <label><b>Reminder Notification :</b></label>
                    <table>
                        <tr>
                            <td><input type="checkbox" name="reminder_text_sms" value="yes"></td><td class="pd-l-2">Text SMS</td>
                            <td class="pd-l-5"><input type="checkbox" name="reminder_email" value="yes"></td><td class="pd-l-2">Email</td>
                            <td class="pd-l-5"><input type="checkbox" name="reminder_app" value="yes" checked></td><td class="pd-l-2">App</td>
                        </tr>
                    </table>
                </div>
                <div class="col-lg-6 pd-t-5">
                    <label><b>Start Date <sup>*</sup> :</b></label>
                    <table cellspacing="0" cellpadding="0" class="table m-0 p-0  table-borderless">
                        <tr>
                            <td class="wd-60p pd-l-0"><input type="text" id="StartDate" required name="start_date" value="{{nowdate('','d-m-Y')}}" class="form-control date" placeholder="dd-mm-yyyy"></td>
                            <td><input type="text" id="start_time" class="form-control" name="start_time" placeholder="hh:ii:ss"></td>
                        </tr>
                    </table>
                </div>
                <div class="col-lg-6 pd-t-5">
                    <label><b>End Date <sup>*</sup> :</b></label>
                    <table cellspacing="0" cellpadding="0" class="table m-0 p-0 table-borderless">
                        <tr>
                            <td class="wd-60p pd-l-0"><input type="text" name="end_date" id="EndDate" required value="{{nowdate('','d-m-Y')}}" class="form-control date" placeholder="dd-mm-yyyy"></td>
                            <td><input type="text" id="end_time" class="form-control" name="end_time" placeholder="hh:ii:ss"></td>
                        </tr>
                    </table>
                </div>
                <div class="col-lg-12">
                    <label><b>Event Title/Heading <sup>*</sup> :</b></label>
                    <input type="text" required name="calendar_title" placeholder="Enter Event Title/Heading" class="form-control">
                </div>
                <div class="col-lg-12">
                    <label><b>Event Details <span class="text-gray">(Optional)</span>:</b></label>
                    <textarea class="form-control" name="calendar_details" style=" height:150px; " placeholder="Enter Event Details"></textarea>
                </div>
                <div class="col-lg-4">
                    <label><b>Show on <sup>*</sup> :</b></label>
                    <table>
                        <tr>
                            <td><input type="checkbox" name="show_app" value="yes" checked></td><td class="pd-l-5">Mobile App</td>
                            <td class="pd-l-10"><input type="checkbox" name="show_website" value="yes" checked></td><td class="pd-l-5">Website</td>
                        </tr>
                    </table>
                </div>

                <div class="col-lg-4">
                    <label><b>Status <sup>*</sup> :</b></label>
                    <table>
                        <tr>
                            <td><input type="checkbox" name="status" value="yes" checked></td><td class="pd-l-5">Active</td>
                            <td class="pd-l-10"><input type="checkbox" name="status" value="no" checked></td><td class="pd-l-5">In-Active</td>
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
        <button type="submit" class="btn btn-primary float-right"><i class="fa fa-plus"></i> Save Event</button>
    </div>
</form>
