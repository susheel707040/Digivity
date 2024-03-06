<form action="{{url('MasterAdmin/App/EditHomework/'.$homework->id.'/edit')}}" method="POST" enctype="multipart/form-data"
      id="selectForm2" data-parsley-validate="" novalidate="">
    {{ csrf_field() }}
    <div class="modal-body pd-sm-t-0 pd-sm-b-20 pd-sm-x-5">
        <div class="row p-0 m-0">
            <div class="col-lg-7 pd-t-10 row m-0">
                <div class="col-lg-4">
                    <label><b>Course <sup>*</sup> : </b></label>
                    @include('components.course-import',['selectid'=>$homework->course_id,'class'=>'form-control','required'=>'required'])
                </div>
                <div class="col-lg-4">
                    <label><b>Section <sup>*</sup> : </b></label>
                    @include('components.section-import',['selectid'=>$homework->section_id,'class'=>'form-control','required'=>'required'])
                </div>
                <div class="col-lg-4">
                    <label><b>Homework Date <sup>*</sup> : </b></label>
                    <input type="text" required name="hw_date" value="@if($homework->hw_date){{nowdate($homework->hw_date,'d-m-Y')}}@else{{nowdate('','d-m-Y')}}@endif" class="form-control date input-sm">
                </div>
                <div class="col-lg-4">
                    <label><b>Subject :</b></label>
                    @php
                        $search=[];
                        if(($homework->course_id)&&($homework->section_id)){
                            $search=['course_id'=>$homework->course_id,'section_id'=>$homework->section_id];
                        }
                    @endphp
                    @include('components.subject-import',['class'=>'form-control','selectid'=>$homework->subject_id,'subjectwithcourse'=>1,'search'=>$search])

                </div>
                <div class="col-lg-8">
                    <label><b>Homework Title :</b></label>
                    <input type="text" name="hw_title" value="{{$homework->hw_title}}" placeholder="Enter Homework Title" class="form-control">
                </div>
                <div class="col-lg-12">
                    <label><b>Homework :</b></label>
                    <textarea placeholder="Enter Homework" name="homework" class="form-control" style=" height:200px; ">{{$homework->homework}}</textarea>
                </div>
                <div class="col-lg-9">
                    <label><b>Homework Communication <sup>*</sup> :</b></label>
                    <table>
                        <tr>
                            <td><input type="checkbox" name="with_app" value="yes" @if($homework->with_app=="yes") checked @endif></td>
                            <td class="pd-l-5">Mobile App</td>
                            <td class="pd-l-10"><input type="checkbox" value="yes" name="with_text_sms" @if($homework->with_text_sms=="yes") checked @endif></td>
                            <td class="pd-l-5">Text SMS</td>
                            <td class="pd-l-10"><input type="checkbox" value="yes" name="with_email" @if($homework->with_email=="yes") checked @endif></td>
                            <td class="pd-l-5">Email</td>
                            <td class="pd-l-10"><input type="checkbox" value="yes" name="with_website" @if($homework->with_website=="yes") checked @endif></td>
                            <td class="pd-l-5">Website</td>
                        </tr>
                    </table>
                </div>
                <div class="col-lg-3">
                    <label><b>Status :</b></label>
                    <table>
                        <tr>
                            <td><input type="radio" name="status" value="yes" @if($homework->status=="yes") checked @endif></td><td class="pd-l-5">Yes</td>
                            <td class="pd-l-10"><input type="radio" name="status" value="no" @if($homework->status=="no") checked @endif></td><td class="pd-l-5">No</td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="col-lg-5 pl-0  pd-t-10">
                <div class="card">
                    <div class="card-header bg-gray-100"><b><i class="fa fa-file"></i> Upload Attachment Files (png,jpeg,jpg,gif,pdf,doc & etc.)</b> </div>
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
        <button type="submit" class="btn btn-primary float-right"><i class="fa fa-plus"></i> Update Homework</button>
    </div>
</form>

