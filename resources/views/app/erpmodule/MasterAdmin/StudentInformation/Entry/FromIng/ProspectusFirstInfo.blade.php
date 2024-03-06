<div class="col-12 p-0 m-0 d-flex">
    <table class="float-right" style="width:100%;">
        <tr>
            <td>
        <div class="avatar avatar-xxl">
         @if(isset($studentprospectus) && !empty($studentprospectus->student_photo))
            <img  id="prspectuspreviewImage" height="90px" name="student_photo" src="{{ url('uploads/prospectuus_image/' . $studentprospectus->student_photo) }}">
        </div>
                @else
                <img  id="prspectuspreviewImage" height="90px" name="student_photo" src="{{ url('assets/images/no-image-available.png') }}">
                @endif

            </td>

            <td class="pd-l-10" v-align="top"><label class="pd-b-5"><b>Student Photo :</b> </label>
            <input class="form-control input-sm tx-12" onchange="prospectuspreview()" name="student_photo"  id="prospectusuploadImage" type="file"></td>
        </tr>
    </table>
</div>
<script>
    function prospectuspreview() {
        var prospectuspreview = document.getElementById('prspectuspreviewImage');
        var file    = document.getElementById('prospectusuploadImage').files[0];
        var reader  = new FileReader();

        reader.onloadend = function () {
            prospectuspreview.src = reader.result;
        }

        if (file) {
            reader.readAsDataURL(file);
        } else {
            prospectuspreview.src = "{{ url('assets/images/no-image-available.png') }}";
        }
    }
</script>


<div class="row pd-b-4 m-0">
    <div class="col-6 p-0 m-0">
        <label>Reg No./ Pros No. <sup>*</sup> :</label>
        <input type="text" autocomplete="off" name="pros_no" id="pros_no" @if((!isset($studentprospectus->pros_no))&&FormNoGenerate('prospectus_no')) @if(FormNoGenerate('prospectus_no')->should_be=="auto") readonly style="background:whitesmoke; " @endif @endif
               @if((!isset($studentprospectus->pros_no))&&FormNoGenerate('prospectus_no')) value="{{FormNoGenerate('prospectus_no')->GetNo()}}" @endif @if(isset($studentprospectus->pros_no)) value="{{$studentprospectus->pros_no}}" @endif placeholder="Enter Reg No./ Pros No." class="form-control input-sm" required="">
    </div>
    <div class="col-6 pd-l-15 pd-r-0 m-0">
        <label>Date <sup>*</sup> :</label>
        <input type="text" id="apply_date" name="admission_date" placeholder="Date (dd-mm-yyyy)" @if(isset($studentprospectus->admission_date)) value="{{nowdate($studentprospectus->admission_date,'d-m-Y')}}" @else value="{{nowdate('','d-m-Y')}}"  @endif class="date form-control input-sm w-100" required="">
    </div>
</div><br>

<div class="col-12 p-0 m-0">
    <label>Reference :</label>
    <input name="reference" id="reference" @if(isset($studentprospectus->reference)) value="{{$studentprospectus->reference}}" @endif type="text" placeholder="Enter Reference" class="form-control input-sm">
</div>

<div class="col-12 p-0 m-0">
    <label>Admission Type  :</label>
    <select id="admission_type_id" name="admission_type_id" class="form-control input-sm" required="">
        <option value="">---Select---</option>
        @foreach(admissiontypeselectlist() as $data)
            <option value="{{$data->id}}"
                    @if($data->default_at=="yes") selected @endif>{{$data->admission_type}}</option>
        @endforeach
    </select>
</div><br>

<div class="col-12 p-0 m-0">
    <label>Class/Course <sup>*</sup> :</label>
    @php $selectcourse=""; if(isset($studentprospectus->course_id)){$selectcourse=$studentprospectus->course_id;} @endphp
    @include('components.course-import',['required'=>'required','selectid'=>$selectcourse])
</div><br>

    <div class="col-12  m-0 p-0">
        <label>Board <sup>*</sup> :</label>
        <select id="board_id" name="board_id" class="form-control input-sm" required="">
            <option value="">---Select---</option>
            @foreach(boardselectlist() as $data)
                <option value="{{$data->id}}"
                        @if($data->default_at=="yes") selected @endif>{{$data->board_name}}</option>
            @endforeach
        </select>
    </div><br>
<div class="row p-0 m-0">
    <div class="col-6 p-0 m-0">
        <label>Academic Year <sup>*</sup> :</label>
        <select name="academic_id" id="academic_id" class="form-control input-sm" required="">
            <option value="">---Select---</option>
            @foreach(academicyearlist([]) as $data)
                <option value="{{$data->id}}"
                        @if($data->id==Auth()->user()->academic_id) selected @endif>{{$data->academic_session}}</option>
            @endforeach
        </select>
    </div>

    <div class="col-6  m-0 pd-r-3">
        <label>Financial Year <sup>*</sup> :</label>
        <select id="financial_id" required="" name="financial_id" class="form-control input-sm" required="">
            <option value="">---Select---</option>
            @foreach(financialyearlist([]) as $data)
                <option value="{{$data->id}}"
                        @if($data->id==Auth()->user()->financial_id) selected @endif>{{$data->financial_session}}</option>
            @endforeach
        </select>
    </div><br>

    <div class="col-12 col-12 p-0 m-0">
        <label>Transport :</label>
        <input type="text" class="form-control" name="transport_id" @if(isset($studentprospectus->transport_id)) value="{{$studentprospectus->transport_id}}" @endif placeholder="Enter Transport Location">
    </div>
</div>


