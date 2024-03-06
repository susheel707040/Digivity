<form class="container-fluid" action="{{url('MasterAdmin/App/EditSyllabus/'.$syllabus->id.'/edit')}}" method="POST" enctype="multipart/form-data"
      data-parsley-validate="" novalidate="">
    {{csrf_field()}}
    <div class="modal-body pd-sm-t-0 pd-sm-b-20 pd-sm-x-5">
        <div class="row p-0 m-0">
            <div class="col-lg-7 pd-t-10 row m-0">
                <div class="col-lg-4">
                    <label><b>Priority</b></label>
                    <select name="priority" required class="form-control">
                        @for($i=1;$i<=100;$i++)
                            <option @if($syllabus->priority==$i) selected @endif>{{$i}}</option>
                        @endfor
                    </select>
                </div>
                <div class="col-lg-4">
                    <label><b>Course <sup>*</sup> :</b></label>
                    @include('components.course-import',['name'=>'course_id','required'=>'required','selectid'=>$syllabus->course_id])
                </div>
                <div class="col-lg-4">
                    <label><b>Subject <span class="text-gray">(Optional)</span> :</b></label>
                    @include('components.subject-import',['name'=>'subject_id','selectid'=>$syllabus->subject_id])
                </div>
                <div class="col-lg-12">
                    <label><b>Syllabus Title/Heading <sup>*</sup>:</b></label>
                    <input type="text" value="{{$syllabus->syllabus_title}}" required name="syllabus_title" placeholder="Enter Syllabus Title/Heading" class="form-control">
                </div>
                <div class="col-lg-12">
                    <label><b>Syllabus Details <span class="text-gray">(Optional)</span> :</b></label>
                    <textarea class="form-control" name="syllabus_details" placeholder="Enter Syllabus Details" style=" height:180px; ">{{$syllabus->syllabus_details}}</textarea>
                </div>
                <div class="col-lg-4">
                    <label>Show on</label>
                    <table>
                        <tr>
                            <td><input type="checkbox" name="show_app" value="yes" @if($syllabus->show_app=="yes") checked @endif></td><td class="pd-l-3">Mobile App</td>
                            <td class="pd-l-10"><input type="checkbox" name="show_website" value="yes" @if($syllabus->show_website=="yes") checked @endif></td><td class="pd-l-3">Website</td>
                        </tr>
                    </table>
                </div>
                <div class="col-lg-4">
                    <label><b>Status <sup>*</sup> :</b></label>
                    <table>
                        <tr>
                            <td><input type="radio" name="status" value="yes" @if($syllabus->status=="yes") checked @endif></td><td class="pd-l-3">Active</td>
                            <td class="pd-l-10"><input type="radio" name="status" value="no" @if($syllabus->status=="no") checked @endif></td><td class="pd-l-3">Inactive</td>
                        </tr>
                    </table>
                </div>
                <div class="col-lg-4 pd-l-0">
                    <label><b>Syllabus Icon <span class="text-gray">(Optionals)</span> :</b></label>
                    <input type="file" name="icon" id="syllabusIconeditInput" class="form-control" onchange="previewEditImage()">
                    <br>
                    <?php if(isset($syllabus->icon)): ?>
                    <img id="syllabusIconEditPreview"  name="icon" src="{{ url('uploads/syllabus_icon_image/' . $syllabus->icon) }}" alt="Syllabus Icon Preview" style="display: none; max-width: 20%; height: auto;">
                    <?php endif; ?>
                </div>
            </div>
            <script>
                function previewEditImage() {
               var syllabusIconeditInput = document.getElementById('syllabusIconeditInput');
               var syllabusIconEditPreview = document.getElementById('syllabusIconEditPreview');

               var file = syllabusIconeditInput.files[0];
                var reader = new FileReader();

                reader.onload = function(e) {
                syllabusIconEditPreview.src = e.target.result;
                syllabusIconEditPreview.style.display = 'block';
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
