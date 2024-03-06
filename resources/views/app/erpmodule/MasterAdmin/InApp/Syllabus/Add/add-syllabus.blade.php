<form class="container-fluid" action="{{url('MasterAdmin/App/CreateSyllabus')}}" method="POST" enctype="multipart/form-data"
      data-parsley-validate="" novalidate="">
{{csrf_field()}}
    <div class="modal-body pd-sm-t-0 pd-sm-b-20 pd-sm-x-5">
        <div class="row p-0 m-0">
            <div class="col-lg-7 pd-t-10 row m-0">
                <div class="col-lg-4">
                    <label><b>Priority</b></label>
                    <select name="priority" required class="form-control">
                        @for($i=1;$i<=100;$i++)
                            <option>{{$i}}</option>
                        @endfor
                    </select>
                </div>
                <div class="col-lg-4">
                    <label><b>Course <sup>*</sup> :</b></label>
                    @include('components.course-import',['name'=>'course_id','required'=>'required'])
                </div>
                <div class="col-lg-4">
                    <label><b>Subject <span class="text-gray">(Optional)</span> :</b></label>
                    @include('components.subject-import',['name'=>'subject_id'])
                </div>
                <div class="col-lg-12">
                    <label><b>Syllabus Title/Heading <sup>*</sup>:</b></label>
                    <input type="text" required name="syllabus_title" placeholder="Enter Syllabus Title/Heading" class="form-control">
                </div>
                <div class="col-lg-12">
                    <label><b>Syllabus Details <span class="text-gray">(Optional)</span> :</b></label>
                    <textarea class="form-control" name="syllabus_details" placeholder="Enter Syllabus Details" style=" height:180px; "></textarea>
                </div>
                <div class="col-lg-4">
                    <label>Show on</label>
                    <table>
                        <tr>
                            <td><input type="checkbox" name="show_app" value="yes" checked></td><td class="pd-l-3">Mobile App</td>
                            <td class="pd-l-10"><input type="checkbox" name="show_website" value="yes" checked></td><td class="pd-l-3">Website</td>
                        </tr>
                    </table>
                </div>
                <div class="col-lg-4">
                    <label><b>Status <sup>*</sup> :</b></label>
                    <table>
                        <tr>
                            <td><input type="radio" name="status" value="yes" checked></td><td class="pd-l-3">Active</td>
                            <td class="pd-l-10"><input type="radio" name="status" value="no"></td><td class="pd-l-3">Inactive</td>
                        </tr>
                    </table>
                </div>
                <div class="col-lg-4 pd-l-0">
                    <label><b>Syllabus Icon <span class="text-gray">(Optional)</span> :</b></label>
                    <input type="file" name="icon" id="syllabusIconInput" class="form-control" onchange="previewImage()">
                    <br>
                    <img id="syllabusIconPreview" src="#" alt="Syllabus Icon Preview" style="display: none; max-width: 20%; height: auto;">
                </div>
            </div>
            <script>
         function previewImage() {
        var syllabusIconInput = document.getElementById('syllabusIconInput');
        var syllabusIconPreview = document.getElementById('syllabusIconPreview');

        var file = syllabusIconInput.files[0];
         var reader = new FileReader();

         reader.onload = function(e) {
        syllabusIconPreview.src = e.target.result;
        syllabusIconPreview.style.display = 'block';
    }

    reader.readAsDataURL(file);
}
        </script>
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
        <button type="submit" class="btn btn-primary float-right"><i class="fa fa-plus"></i> Upload Syllabus</button>
    </div>
</form>
