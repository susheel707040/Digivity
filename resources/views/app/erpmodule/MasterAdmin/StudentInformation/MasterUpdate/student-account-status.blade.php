<div class="container">
    <div class="row m-0 p-0">
        <div class="col-lg-12 bd-b bd-1">
            <table class="wd-100p mg-t-10 mg-b-10">
                <tr>
                    <td rowspan="4" class="wd-100">
                        <div class="avatar mx-auto avatar-xl d-none d-sm-block">
                            <img src="{{url('uploads/student_profile_image/' .$studentrecord->profile_img)}}" class="rounded-circle bd-2 bd" alt="">
                        </div>
                    </td>
                    <td class="wd-100"><b>Admission No.</b></td><td><b>:</b></td><td>{{$studentrecord->admission_no}}</td>
                </tr>
                <tr>
                    <td><b>Class/Course</b></td><td><b>:</b></td><td>{{$studentrecord->CourseSection()}}</td>
                </tr>
                <tr>
                    <td><b>Student Name</b></td><td><b>:</b></td><td>{{$studentrecord->fullName()}}</td>
                </tr>
                <tr>
                    <td><b>Father's Name</b></td><td><b>:</b></td><td>{{$studentrecord->FatherName()}}</td>
                </tr>
            </table>
        </div>

        <form class="studentstatusupdate container-fluid" action="{{url('MasterAdmin/StudentInformation/StudentStatus/'.$studentrecord->id.'/Update')}}" method="POST">
           {{csrf_field()}}
            <div class="col-lg-12">
            <table cellpadding="2" cellspacing="2" class="wd-100p mg-t-10 mg-b-10">
                <tr>
                    <td class="wd-150"><b>Account Status</b></td><td><b>:</b></td>
                    <td>
                        <select name="status" id="status" class="form-control" required>
                            <option value="{{$status}}">{{ucfirst($status)}}</option>
                            <option value='inactive'>Inactive</option>
                        </select>
                    </td>
                </tr>
                @if($status=="inactive")
                <tr>
                    <td><b>Inactive Date</b></td><td><b>:</b></td>
                    <td><input type="text" name="inactive_date" id="inactive_date" class="form-control date" value="{{nowdate('','Y-m-d')}}"></td>
                </tr>
                @endif
                <tr>
                    <td><b>Remark</b></td><td><b>:</b></td>
                    <td>
                        <textarea class="form-control" name="remark" placeholder="Enter Remark"></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" class="text-right">
                        <button type="button" onclick="StudentStatus()" class="btn btn-primary btn-lg mg-t-10"><i class="fa fa-check"></i>Update</button>
                    </td>
                </tr>
            </table>
        </div>
        </form>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script type="text/javascript">
    function StudentStatus() {
    Swal.fire({
        title: "Are you sure?",
        text: "Are you sure, you want to Student " + $("#status").val(),
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            var result = formrequest('form.studentstatusupdate', "{{url('MasterAdmin/StudentInformation/StudentStatus/'.$studentrecord->id.'/Update')}}", 'POST');
            if (result) {
                $(".student-id-" + result['studentid']).hide();
                Alert(result);
                $("#CustomModels").modal('hide');
            }
        }
    });
}

</script>
