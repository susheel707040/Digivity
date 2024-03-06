<div class="col-lg-12">
@if(isset($studentrecord))
<table class="table-small bd bd-1 bg-light mg-t-5 mg-b-5">
    <tr>
        <td rowspan="4" class="wd-10p text-center">
            <div class="avatar avatar-lg">
                @if(isset($studentrecord) && !empty($studentrecord->profile_img))
                <img  height="90px" name="profile_img" src="{{ url('uploads/student_profile_image/' .$studentrecord->profile_img) }}">
                @else
                <img  height="90px" name="profile_img" src="{{ url('assets/images/no-image-available.png') }}">
                @endif

        </div>
        </td>
        <td class="wd-15p"><b>Admission No.</b></td><td class="wd-10"><b>:</b></td><td>{{$studentrecord->admission_no}}</td>
        <td class="wd-15p"><b>Class/Course</b></td><td class="wd-10"><b>:</b></td><td>{{$studentrecord->CourseSection()}}</td>
    </tr>
    <tr>
        <td><b>Student Name</b></td><td><b>:</b></td><td>{{$studentrecord->fullName()}}</td>
        <td><b>Gender</b></td><td><b>:</b></td><td>{{ucwords($studentrecord->student->gender)}}</td>
    </tr>
    <tr>
        <td><b>Father Name</b></td><td><b>:</b></td><td>{{$studentrecord->FatherName()}}</td>
        <td><b>Contact No.</b></td><td><b>:</b></td><td>{{$studentrecord->student->contact_no}}</td>
    </tr>
    <tr>
        <td><b>Mother Name</b></td><td><b>:</b></td><td>{{$studentrecord->MotherName()}}</td>
        <td><b>Status</b></td><td><b>:</b></td><td>@if($studentrecord->status=="active") <span class="badge badge-success">Active</span> @else <span class="badge badge-danger">Inactive</span> @endif</td>
    </tr>
</table>

<div class="col-lg-12 pd-l-0 pd-r-0">
 <form class="student_document" action="" method="POST" enctype="multipart/form-data">

 <input type="hidden" name="student_id" value="{{$studentrecord->student_id}}">
 <table class="table table-bordered">
     <thead class="bg-light">
     <tr>
         <th class="text-center">S.No.</th>
         <th>Document Name</th>
         <th>Document Number</th>
         <th>Document Attachment</th>
         <th>Action</th>
     </tr>
     </thead>
     <tbody>
     @foreach($document as $data)
     <tr>
         <td class="text-center"><b>{{$loop->iteration}}</b></td>
         <td>
             <input type="hidden" value="{{$data->id}}" name="document_id[]">
             <input type="hidden" value="{{$data->document_type}}" name="document_type_{{$data->id}}">
             {{$data->document_type}}</td>
         <td><input type="text" autocomplete="off" name="document_no_{{$data->id}}" placeholder="Enter Document Number" class="form-control1" required></td>
         <td><input type="file" id="document_file_{{$data->id}}" name="document_file_{{$data->id}}" class="form-control1"></td>
         <td>
            <button type="button" class="btn btn-success btn-xs rounded-5"><i class="fa fa-eye"></i></button>
             <button type="button" class="btn btn-dark btn-xs rounded-5"><i class="fa fa-download"></i></button>
           <button type="button" class="btn btn-danger btn-xs rounded-5"><i class="fa fa-trash"></i></button>
         </td>
     </tr>
     @endforeach
     </tbody>
 </table>
     <div class="col-lg-12 pd-l-0 pd-r-0 mg-t-10 pd-b-20">
         <button type="button" class="btn btn-warning document-remove-submit" onclick="removeDocuments()"><i class="fa fa-trash"></i> Remove All Documents</button>
         <button type="button" class="btn btn-primary document-upload-submit float-right" onclick="uploadDocument()"><i class="fa fa-upload"></i> Upload</button>
     </div>
 </form>
</div>
@endif
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
    function uploadDocument() {
        var fileInput = document.getElementById('document_file_{{$data->id}}');
        var selectedFile = fileInput.files[0];

        if (!selectedFile) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Please choose a document to upload!',
            });
            return;
        }
        setTimeout(function() {
            Swal.fire({
                icon: 'success',
                title: 'Document Submitted!',
                text: 'Ducument Upload Successfully.',
                timer: 2000,
                showConfirmButton: false
            });
        }, 1000);
    }
</script>
<script type="text/javascript">
    $(".document-upload-submit").click(function (){
        loader('block');
       var result=formrequest('.student_document','/MasterAdmin/StudentInformation/UploadStudentDocument','POST');
       if(result['result']==1){
           Alert(result);
           $("#CustomModels").modal('hide');
       }else{
           Alert(result);
           $("#CustomModels").modal('hide');
       }
        loader('none');
    });

</script>
<script>
    function removeDocuments() {
        var studentId = 123; // Replace with the actual student ID
        var documentIds = "1,2,3"; // Replace with the actual document IDs
        // You may need to fetch the document IDs dynamically based on your application logic

        $.ajax({
            type: "GET",
            url: "{{ route('document.remove', ['studentid' => ':studentid', 'documentids' => ':documentids']) }}".replace(':studentid', studentId).replace(':documentids', documentIds),
            success: function(response) {
                // Handle success response here
                console.log(response);
                // You can update the UI or show a message to the user indicating success
            },
            error: function(xhr, status, error) {
                // Handle error response here
                console.error(xhr.responseText);
                // You can update the UI or show a message to the user indicating failure
            }
        });
    }
</script>