
<div class="col-12 p-0 m-0 d-flex">
    <table class="float-right" style=" width:100%; ">
        <tr>
            <td>
                <div class="avatar avatar-xxl">
                    @if(isset($student) && !empty($school->profile_img))
                    <img id="student_previewImage" height="90px" name="profile_img" src="{{ url('uploads/student_profile_image/' .$school->profile_img) }}">
                    @else
                    <img id="student_previewImage" height="90px" name="profile_img" src="{{ url('assets/images/no-image-available.png') }}">
                    @endif
                </div>
            </td>
            <td class="pd-l-10" v-align="top"><label class="pd-b-5"><b>Student Photo :</b> </label>
                <input class="tx-12 form-control" onchange="studentpreview()" name="profile_img" type="file" id="studentuploadImage">
            </td>
        </tr>
    </table>
</div>
<script>
    function studentpreview() {
        var studentpreview = document.getElementById('student_previewImage');
        var file    = document.getElementById('studentuploadImage').files[0];
        var reader  = new FileReader();

        reader.onloadend = function () {
            studentpreview.src = reader.result;
        }

        if (file) {
            reader.readAsDataURL(file);
        } else {
            studentpreview.src = "{{ url('assets/images/no-image-available.png') }}";
        }
    }
</script>

<div class="row pd-0 m-0">
    <div class="col-6 p-0 m-0">
        <label>Admission Date <sup>*</sup> :</label>
        <input type="text" required="" autocomplete="off" name="admission_date" id="admission_date" placeholder="dd-mm-yyyy"
               value="@if(isset($student->student->admission_date)){{\Carbon\Carbon::createFromDate($student->student->admission_date)->format('d-m-Y')}}@else{{date('d-m-Y')}}@endif" class="date form-control input-sm">
        @if(request()->get('pros_no')) <input type="hidden" name="prospectus_id" value="{{request()->get('pros_no')}}"> @endif
    </div>

    <div class="col-6  m-0 pd-r-3">
        <label>Admission No. <sup>*</sup> :</label>
        <input type="text" required="" autocomplete="off"  name="admission_no" id="admission_no" style="width:136px;" @if((!isset($student->admission_no))&&FormNoGenerate('admission_no')) @if(FormNoGenerate('admission_no')->should_be=="auto") readonly style="background:whitesmoke; " @endif @endif placeholder="Enter Admission No."
            @if(isset($student->admission_no)) value="{{$student->admission_no}}" @endif @if((!isset($student->admission_no))&&FormNoGenerate('admission_no')) value="{{FormNoGenerate('admission_no')->GetNo()}}" @endif  class="form-control input-sm">
    </div>
</div>


<div class="row pd-0 m-0">
    <div class="col-12 p-0 m-0">
        <label>Form No./Sr. No. :</label>
    <table>
        <tr>
            <td>
                <input type="text" autocomplete="off"  name="form_no" id="form_no" @if((!isset($student->form_no))&&FormNoGenerate('sr_no')) @if(FormNoGenerate('sr_no')->should_be=="auto") readonly style="background:whitesmoke; " @endif @endif placeholder="Enter From No./Sr. No."
                       @if((isset($student->form_no))||(isset($student->pros_no))) value="@if($student->form_no){{$student->form_no}}@else{{$student->pros_no}}@endif" @endif @if(((!isset($student->form_no))||(!isset($student->pros_no)))&&FormNoGenerate('sr_no')) value="{{FormNoGenerate('sr_no')->GetNo()}}" @endif  class="form-control input-sm">
            </td>
            <td>
                <input type="hidden" name="prospectus_id" @if((isset($student->pros_no)))value="{{$student->id}}"@endif>
                <button type="button" url="{{url('MasterAdmin/StudentInformation/ProspectusSearch')}}" model-class="modal-xl" model-title="Prospectus Search" model-title-info="Student Prospectus Sale Search" class="btn btn-primary btn-sm mx-3 rounded-5 custom-model-btn">
                    <i class="fa fa-search"></i>
                    Search
                </button>
            </td>
        </tr>
    </table><br>
    </div>
    <div class="col-12  m-0 pd-0">
        <label>Roll No. <span class="tx-11 text-gray">(optional)</span> :</label>
        <input type="text" value="@if(isset($student->roll_no)){{$student->roll_no}}@endif" autocomplete="off"  name="roll_no" id="roll_no" placeholder="Enter Roll No." class="form-control input-sm">
    </div>
</div><br>

<div class="row pd-0 m-0">
    <div class="col-6 p-0 m-0">
        <label>Class/Course <sup>*</sup> :</label>
        @include('components.course-import',['name'=>'course_id','required'=>'required','class'=>'form-control input-sm select-box','selectid'=>$student?$student->course_id:null,'data'=>['for'=>'section_id','this_id'=>'course_id','request_ids'=>'course_id','get'=>'sectionlist']])
    </div>
    <div class="col-6 m-0  pd-r-3">
        <label>Section <sup>*</sup> :</label>
        <select id="section_id" required="" name="section_id" class="form-control input-sm">
            <option value="">---Select---</option>
            @foreach(sectionlist([]) as $data)
                <option value="{{$data->section_id}}"
                        @if(isset($student->section_id)&&($student->section_id==$data->section_id)) selected @endif>{{$data->section->section}}</option>
            @endforeach
        </select>
    </div>
</div><br>

<div class="row pd-0 m-0">

    <div class="col-6 pd-0 m-0">
        <label>Board <sup>*</sup> :</label><br>
        <select id="board_id" required="" name="board_id" class="form-control input-sm">
            <option value="">---Select---</option>
            @foreach(boardselectlist() as $data)
                <option value="{{$data->id}}"
                        @if(isset($student->board_id)&&($student->board_id==$data->id)) selected @else @if($data->default_at=="yes") selected @endif @endif>{{$data->board_name}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-6  m-0 pd-r-3">
        <label>House <span class="tx-11 text-gray">(optional)</span> :</label>
        <select id="house_id" name="house_id" class="form-control input-sm">
            <option value="">---Select---</option>
            @foreach(houseselectlist() as $data)
                <option value="{{$data->id}}"
                        @if(isset($student->house_id)&&($student->house_id==$data->id)) selected @else  @if($data->default_at=="yes") selected @endif @endif>{{$data->house}}</option>
            @endforeach
        </select>
    </div>
</div><br>
<div class="row pd-0 m-0">
    <div class="col-6 p-0 m-0">
        <label>Academic Session <sup>*</sup> :</label>
        <select id="academic_id" required="" name="academic_id" class="form-control input-sm">
            <option value="">---Select---</option>
            @foreach(academicyearlist([]) as $data)
                <option value="{{$data->id}}"
                        @if(isset($student->academic_id)&&($student->academic_id==$data->id)) selected @else @if($data->id==Auth()->user()->academic_id) selected @endif @endif>{{$data->academic_session}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-6  m-0 pd-r-3">
        <label>Financial Session <sup>*</sup> :</label>
        <select id="financial_id" required="" name="financial_id" class="form-control input-sm">
            <option value="">---Select---</option>
            @foreach(financialyearlist([]) as $data)
                <option value="{{$data->id}}"
                        @if(isset($student->financial_id)&&($student->financial_id==$data->id)) selected @else @if($data->id==Auth()->user()->financial_id) selected @endif @endif>{{$data->financial_session}}</option>
            @endforeach
        </select>
    </div>
</div><br>
<div class="col-12 p-0 m-0">
    <label>Fee Concession <span class="tx-11 text-gray">(optional)</span> :</label>
    <select id="fee_concession_id" name="fee_concession_id" class="form-control input-sm">
        <option value="">---Select---</option>
        @foreach(concessiontypelist([]) as $data)
            <option value="{{$data->id}}"
                    @if(isset($student->fee_concession_id)&&($student->fee_concession_id==$data->id)) selected @endif>{{$data->concession_type}}</option>
        @endforeach
    </select>
</div><br>
<div class="col-12 p-0 m-0">
    <label>Transport <span class="tx-11 text-gray">(optional)</span> :</label>
    <select id="transport_id" name="transport_id" class="form-control select-search input-sm">
        <option value="">---Select---</option>
        @foreach(routerelationlist() as $data)
        <option value="{{$data->id}}"
                @if(isset($student->transport_id) && ($student->transport_id == $data->id)) selected @endif>
            @if ($data->route && $data->routestop && $data->vehicle)
                {{$data->route->route}} - {{$data->routestop->route_stop}} - {{$data->vehicle->registration_no}} ({{$data->vehicle->vehicle_name}})
            @else
                <!-- Handle the case where $data->route, $data->routestop, or $data->vehicle is null -->
                N/A
            @endif
        </option>
    @endforeach

    </select>
</div><br>
<div class="col-12 p-0 m-0">
    <label>Hostel <span class="tx-11 text-gray">(optional)</span> :</label>
    <select id="hostel_id" name="hostel_id" class="form-control input-sm">
        <option value="0" @if(isset($student->hostel_id)&&($student->hostel_id=="0")) selected @endif>---Select---</option>
    </select>
</div>

<script>
    function preview() {
        var preview = document.getElementById('previewImage');
        var file    = document.getElementById('uploadImage').files[0];
        var reader  = new FileReader();

        reader.onloadend = function () {
            preview.src = reader.result;
        }

        if (file) {
            reader.readAsDataURL(file);
        } else {
            preview.src = "{{ url('assets/images/no-image-available.png') }}";
        }
    }
</script>
