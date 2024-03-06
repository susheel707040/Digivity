<form class="container-fluid" action="{{url('MasterAdmin/App/EditDownload/'.$download->id.'/edit')}}" method="POST" enctype="multipart/form-data"
      data-parsley-validate="" novalidate="">
    {{csrf_field()}}
    <div class="modal-body pd-sm-t-0 pd-sm-b-20 pd-sm-x-5">
        <div class="row p-0 m-0">
            <div class="col-lg-4">
                <label><b>Download For  <sup>*</sup>:</b></label>
                <table>
                    <tr>
                        <td><input type="radio" name="type" value="all" @if($download->type=="all") checked @endif></td><td class="pd-l-3">All</td>
                        <td class="pd-l-10"><input type="radio" name="type" value="student" @if($download->type=="student") checked @endif></td><td class="pd-l-3">Student</td>
                        <td class="pd-l-10"><input type="radio" name="type" value="staff" @if($download->type=="staff") checked @endif></td><td class="pd-l-3">Staff</td>
                    </tr>
                </table>
            </div>
            <div class="col-lg-4">
                <label><b>Course <span class="text-gray">(Optional)</span> :</b></label>
                @include('components.course-import',['selectid'=>$download->course_id])
            </div>
            <div class="col-lg-4">
                <label><b>Section <span class="text-gray">(Optional)</span></b></label>
                @include('components.section-import',['selectid'=>$download->section_id])
            </div>
            <div class="col-lg-8">
                <label><b>Download Title <sup>*</sup> :</b></label>
                <input type="text" name="download_title" value="{{$download->download_title}}" placeholder="Enter Download Title" class="form-control input-sm">
            </div>
            <div class="col-lg-4">
                <label><b>Create Date <sup>*</sup>:</b></label>
                <input type="text" name="upload_date" value="{{$download->upload_date}}" placeholder="dd-mm-yyyy" value="{{nowdate('','d-m-Y')}}" class="form-control date input-sm">
            </div>
            <div class="col-lg-12">
                <label><b>Download Details <span class="text-gray">(Optional)</span>:</b></label>
                <textarea class="form-control" name="download_details" placeholder="Enter Download Details" style=" height:200px; ">{{$download->download_details}}</textarea>
            </div>
            <div class="col-lg-5">
                <label><b>Attachment File <sup>*</sup> :</b></label>
                <input type="file" name="file_name" class="form-control input-sm">
            </div>
            <div class="col-lg-4">
                <label><b>Show <sup>*</sup> :</b></label>
                <table>
                    <tr>
                        <td><input type="checkbox" name="show_app" value="yes" @if($download->show_app=="yes") checked @endif></td><td class="pd-l-5">Mobile App</td>
                        <td class="pd-l-10"><input name="show_website" type="checkbox" value="yes" @if($download->show_website=="yes") checked @endif></td><td class="pd-l-5">Website</td>
                    </tr>
                </table>
            </div>
            <div class="col-lg-3">
                <label><b>Status <sup>*</sup> :</b></label>
                <table>
                    <tr>
                        <td><input type="radio" name="status" value="yes" @if($download->status=="yes") checked @endif></td><td>Active</td>
                        <td><input type="radio" name="status" value="no" @if($download->status=="no") checked @endif></td><td>Inactive</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="modal-footer pd-x-20 pd-y-15">
        <button type="button" class="btn btn-white float-left" data-dismiss="modal"><i class="fa fa-times"></i>
            Close
        </button>
        <button type="submit" class="btn btn-primary float-right"><i class="fa fa-plus"></i> Upload Download</button>
    </div>

</form>
