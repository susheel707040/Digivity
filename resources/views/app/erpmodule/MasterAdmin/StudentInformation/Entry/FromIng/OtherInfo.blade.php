<div class="col-md-12 p-0 m-0">
    <ul class="nav nav-line tx-12 pd-l-5 " id="myTab5" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" style=" padding: 5px 0px;" id="home-tab5" data-toggle="tab"
               href="#home5" role="tab"
               aria-controls="home" aria-selected="true"><i class="fa fa-building"></i> Previous School Information</a>
        </li>
    </ul>
    @for($i=1;$i<3;$i++)
        <div class="row p-0 m-0">
            <div class="col-md-4 pd-l-1">
                <label>School Name :</label><br>
                <input type="text" autocomplete="off" placeholder="Enter School Name"
                       name="school_name[]" id="school_name" class="form-control input-sm">
            </div>
            <div class="col-md-4 pd-l-1">
                <label>Board :</label><br>
                <input type="text" autocomplete="off" placeholder="Enter Board Name"
                       name="board[]" id="board" class="form-control input-sm">
            </div>
            <div class="col-md-4 pd-l-1">
                <label>Class :</label><br>
                <input type="text" autocomplete="off" placeholder="Enter Class Name"
                       name="class[]" id="class"  class="form-control input-sm">
            </div>
        </div>
        <div class="row p-0 m-0">
            <div class="col-md-4 pd-l-1">
                <label>Year :</label><br>
                <input type="text" autocomplete="off" placeholder="Enter Year"
                       name="year[]" id="year" class="form-control input-sm">
            </div>
            <div class="col-md-4 pd-l-1">
                <label>Percentage (%) :</label><br>
                <input type="text" autocomplete="off" placeholder="Enter Percentage (%)"
                       name="percentage[]" id="percentage" class="form-control input-sm">
            </div>

        </div><br>
    @endfor

    <ul class="nav nav-line tx-12 pd-l-5 " id="myTab5" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" style=" padding: 5px 0px;" id="home-tab5" data-toggle="tab"
               href="#home5" role="tab"
               aria-controls="home" aria-selected="true"><i class="fa fa-info"></i> Student Other Information</a>
        </li>
    </ul><br>

    <div class="row p-0 m-0">
        <div class="col-md-3 pd-l-1">
            <label>Stream :</label>
            @include('components.GlobalSetting.stream-import',['selectid'=>$student ? $student->student->stream : ""])
        </div>
        <div class="col-md-9">
            <label>Optional Subject</label><Br/>
            <select multiple name="subject_id[]" class="form-control select-search input-sm">
                <option value="">---Select---</option>
                @foreach(subjectlist([]) as $data)
                    <option value="{{$data->id}}" @if(isset($student->subject_id)&&(in_array($data->id,explode(",",$student->subject_id)))) selected @endif>{{$data->subject_name}} @if(isset($data->subject_code)) ({{$data->subject_code}})@endif</option>
                @endforeach
            </select>
        </div>

    </div>


    <ul class="nav nav-line tx-12 pd-l-5 " id="myTab5" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" style=" padding: 5px 0px;" id="home-tab5" data-toggle="tab"
               href="#home5" role="tab"
               aria-controls="home" aria-selected="true"><i class="fa fa-phone"></i> Emergency Contact Information</a>
        </li>
    </ul>

    <div class="row p-0 m-0">
        <div class="col-md-4 pd-l-1">
            <label>Person Name :</label><br>
            <input type="text" autocomplete="off" placeholder="Enter Person Name"
                   id="emergency_person_name" value="@if(isset($student->student->emergency_person_name)){{$student->student->emergency_person_name}}@endif" name="emergency_person_name"  class="form-control input-sm">
        </div>
        <div class="col-md-4 pd-l-1">
            <label>Mobile Number :</label><br>
            <input type="text" autocomplete="off" placeholder="Enter Mobile No."
                   id="emergency_mobile_no" value="@if(isset($student->student->emergency_mobile_no)){{$student->student->emergency_mobile_no}}@endif"   class="form-control emergency_mobile_no input-sm">
        </div>
        <div class="col-md-4 pd-l-1">
            <label>Email Address :</label><br>
            <input type="text" autocomplete="off" placeholder="Enter Email ID"
                   id="emergency_email_id" value="@if(isset($student->student->emergency_email_id)){{$student->student->emergency_email_id}}@endif" name="emergency_email_id"  class="form-control input-sm">
        </div>

    </div>
    <div class="row p-0 m-0">
        <div class="col-md-4 pd-l-1">
            <label>Address :</label><br>
            <input type="text" autocomplete="off" placeholder="Enter Address"
                   id="emg_address" name="emg_address" value="@if(isset($student->student->emg_address)){{$student->student->emg_address}}@endif" class="form-control input-sm">
        </div>
        <div class="col-md-4 pd-l-1">
            <label>Relation :</label><br>
            <input type="text" autocomplete="off" placeholder="Enter Relation"
                   id="emg_relation" name="emg_relation" value="@if(isset($student->student->emg_relation)){{$student->student->emg_relation}}@endif"  class="form-control input-sm">
        </div>

    </div>


    <ul class="nav nav-line tx-12 pd-l-5 " id="myTab5" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" style=" padding: 5px 0px;" id="home-tab5" data-toggle="tab"
               href="#home5" role="tab"
               aria-controls="home" aria-selected="true"><i class="fa fa-users"></i> Student Staff Relation Information</a>
        </li>
    </ul><br>

    <div class="row p-0 m-0">
        <div class="col-md-4 pd-l-1">
            <label>Staff Designation :</label>
            <select id="staff_designation" name="staff_designation" class="form-control input-sm">
                <option value="">---Select---</option>
                @foreach(satffdesignationlist() as $data)
                    <option value="{{$data->id}}">{{$data->designation}}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-4 pd-l-1">
            <label>Staff Name :</label>
            <select id="staff_id" name="staff_id" class="form-control input-sm">
                <option value="">---Select---</option>
            </select>
        </div>
    </div>

    <ul class="nav nav-line tx-12 pd-l-5 " id="myTab5" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" style=" padding: 5px 0px;" id="home-tab5" data-toggle="tab"
               href="#home5" role="tab"
               aria-controls="home" aria-selected="true"><i class="fa fa-plus"></i> Medical Information</a>
        </li>
    </ul>

    <div class="row p-0 m-0">
        <div class="col-md-4 pd-l-1">
            <label>Medical History :</label>
            <input type="text" autocomplete="off" placeholder="Enter Medical History"
                   id="medical_history" name="medical_history" value="@if(isset($student->student->medical_history)){{$student->student->medical_history}}@endif" class="form-control input-sm">
        </div>

        <div class="col-md-4 pd-l-1">
            <label>Allergies :</label><br>
            <input type="text" autocomplete="off" placeholder="Enter Allergies"
                   id="allergie" name="allergie" value="@if(isset($student->student->allergie)){{$student->student->allergie}}@endif" class="form-control input-sm">
        </div>

        <div class="col-md-4 pd-l-1">
            <label>Family Doctor Name :</label>
            <input type="text" autocomplete="off" placeholder="Enter Family Doctor Name"
                   id="family_doctor_name" name="family_doctor_name" value="@if(isset($student->student->family_doctor_name)){{$student->student->family_doctor_name}}@endif"  class="form-control input-sm">
        </div>

        <div class="col-md-4 pd-l-1">
            <label>Family Doctor Phone :</label>
            <input type="text" autocomplete="off" placeholder="Enter Family Doctor Phone"
                   id="family_doctor_phone" name="family_doctor_phone" value="@if(isset($student->student->family_doctor_phone)){{$student->student->family_doctor_phone}}@endif" class="form-control input-sm">
        </div>
        <div class="col-md-4 pd-l-1">
            <label>Family Doctor Address :</label>
            <input type="text" autocomplete="off" placeholder="Enter Family Doctor Address"
                   id="family_doctor_address" name="family_doctor_address" value="@if(isset($student->student->family_doctor_address)){{$student->student->family_doctor_address}}@endif"  class="form-control input-sm">
        </div>
        <div class="col-md-12 pd-l-1">
            <label>Other Medical Note :</label>
            <textarea id="other_medical_info" name="other_medical_info" class="form-control" placeholder="Enter Other Medical Note">@if(isset($student->student->other_medical_info)){{$student->student->other_medical_info}}@endif</textarea>
        </div>
    </div>

</div>
