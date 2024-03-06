@php
isset($student->is_new) ?  $isnew=$student->is_new : $isnew=0;
@endphp
<div class="row p-0 m-0">
    <div class="col-3 pd-l-1">
        <label><b>Admission Type <span class="tx-11 text-gray">(optional)</span> :</b></label>
        <select id="admission_type_id" name="admission_type_id" class="form-control input-sm">
            <option value="">---Select---</option>
            @foreach(admissiontypeselectlist() as $data)
                <option value="{{$data->id}}"
                        @if(isset($student->admission_type_id)&&($student->admission_type_id==$data->id)) selected else @if($data->default_at=="yes") selected @endif @endif>{{$data->admission_type}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-2 pd-l-1">
        <label><b>Is New <sup>*</sup> :</b></label>
        @include('components.GlobalSetting.is-new-status',['selectid'=>$isnew,'required'=>'required'])
    </div>
    <div class="col-7 pd-l-0 pd-r-0 d-flex">
        <br/>
        <label>
        <label><b>Is Ewa <sup>*</sup> :</b></label>
            <table class="mg-t-0">
                <tr>
                    <td class="pd-l-5"><input id="is_ewa" name="is_ewa" value="yes" type="radio" @if(isset($student->is_ewa)&&($student->is_ewa=="yes")) checked @endif></td>
                    <td class="pd-l-5">Yes</td>
                    <td class="pd-l-10"><input type="radio" id="is_ewa"  value="no" name="is_ewa" @if(isset($student->is_ewa)) @if($student->is_ewa=="no") checked @endif @else checked @endif></td>
                    <td class="pd-l-5">No</td>

                    <td class="pd-l-30">Sibling :</td>
                    <td class="pd-l-5"><input type="radio" name="is_sibling" id="is_sibling" value="yes" @if(isset($student->is_sibling)&&($student->is_sibling=="yes")) checked @endif></td>
                    <td class="pd-l-5">Yes</td>
                    <td class="pd-l-10"><input type="radio" value="no" id="is_sibling" name="is_sibling" @if(isset($student->is_sibling)) @if($student->is_sibling=="no") checked @endif @else checked @endif></td>
                    <td class="pd-l-5">No</td>

                    <td class="pd-l-30">Is Active :</td>
                    {{-- <td class="pd-l-5"><input type="checkbox" value="active" name="status" id="status" @if(isset($student->status)) @if($student->status=="active") checked @else @endif @else checked @endif></td> --}}
                    <td class="pd-l-5"><input type="radio" name="status" id="status_yes" value="active"  @if(!isset($student->status) || $student->status == "yes") checked @endif ></td>
                    <td class="pd-l-5">Yes</td>
                    <td class="pd-l-5"><input type="radio" name="status" id="status_no" value="inactive" @if(isset($student->status) && $student->status == "no") checked @endif ></td>
                    <td class="pd-l-5">No</td>
                </tr>
            </table>
        </label>
    </div>
</div>

<div class="row p-0 m-0">
    <div class="col-4 pd-l-1">
        <label><b>First Name <sup>*</sup> :</b></label><br>
        <input type="text" required="" autocomplete="off" placeholder="Enter First Name"
              id="first_name" value="@if(isset($student->student->first_name)){{$student->student->first_name}}@endif" name="first_name" class="form-control input-sm">
    </div>
    <div class="col-4 pd-l-1">
        <label><b>Middle Name <span class="tx-11 text-gray">(optional)</span> :</b></label>
        <input type="text" autocomplete="off" placeholder="Enter Middle Name"
              id="middle_name" value="@if(isset($student->student->middle_name)){{$student->student->middle_name}}@endif" name="middle_name" class="form-control input-sm">
    </div>
    <div class="col-4 pd-l-1 m-0">
        <label><b>Last Name <span class="tx-11 text-gray">(optional)</span> :</b></label>
        <input type="text" autocomplete="off" placeholder="Enter Last Name"
             id="last_name" name="last_name" value="@if(isset($student->student->last_name)){{$student->student->last_name}}@endif"  class="form-control input-sm">
    </div>
</div>

<div class="row p-0 m-0">
    <div class="col-4 pd-l-1">
       <label><b>Date Of Birth :</b></label><br>
        <input type="text" autocomplete="off"  placeholder="yyyy-m-d"
         id="dob" name="dob" value="@if(isset($student->student->dob)){{$student->student->dob}}@endif"  class="date form-control input-sm">
    </div>
    <div class="col-4 pd-l-1">
        <label><b>Age :</b></label><br>
        <input type="text" id="age" name="age" value="0y-0m-0d" readonly autocomplete="off" class="form-control input-sm ">
    </div>
    <div class="col-4 pd-l-1 m-0">
        <label><b>Gender  <sup>*</sup>  :</b></label><br>
        <select id="gender" name="gender" class="form-control input-sm" required>
            <option value="">---Select---</option>
            @foreach($genderlist as $data)
                <option value="{{$data}}" @if(isset($student->student->gender)&&($student->student->gender==$data)) selected @endif>{{ucfirst($data)}}</option>
            @endforeach
        </select>
       </div>
   </div>

   <script>
    // Add event listener to date of birth input field
    document.getElementById('dob').addEventListener('change', function() {
        // Get the entered date of birth
        var dob = new Date(this.value);

        // Calculate age
        var today = new Date();
        var age = today.getFullYear() - dob.getFullYear();
        var month = today.getMonth() - dob.getMonth();
        var day = today.getDate() - dob.getDate();

        // Adjust age and month if the current date is before the birth month or date
        if (month < 0 || (month === 0 && today.getDate() < dob.getDate())) {
            age--;
            month = 12 + month; // Add 12 months to the month difference
        }

        // Update age field
        document.getElementById('age').value = age + 'y-' + month + 'm-' + day + 'd';
    });
</script>

<div class="row p-0 m-0">

    <div class="col-4 pd-l-1">
        <label>Blood Group <span class="tx-11 text-gray">(optional)</span> :</label><br>
        @include('components.GlobalSetting.blood-group-import',['selectid'=>$student ? $student->student->blood_group : ""])
    </div>

    <div class="col-4 pd-l-1">
        <label>Nationality <span class="tx-11 text-gray">(optional)</span> :</label><br>
        @include('components.GlobalSetting.nationality-import',['selectid'=>$student ? $student->student->stream : ""])
    </div>
    <div class="col-4 pd-l-1">
        <label>Religion <span class="tx-11 text-gray">(optional)</span> :</label><br>
        @include('components.GlobalSetting.religion-import',['selectid'=>$student ? $student->student->religion : ""])
    </div>
</div>

<div class="row p-0 m-0">
    <div class="col-4 pd-l-1">
        <label>Category <span class="tx-11 text-gray">(optional)</span> :</label><br>
        @include('components.GlobalSetting.category-import',['selectid'=>$student ? $student->category_id : ""])
    </div>

    <div class="col-4 pd-l-1">
        <label>Caste <span class="tx-11 text-gray">(optional)</span> :</label><br>
        @include('components.GlobalSetting.caste-import',['selectid'=>$student ? $student->student->caste : ""])
    </div>

    <div class="col-4 pd-l-1">
        <label>Parish <span class="tx-11 text-gray">(optional)</span> :</label><br>
        @include('components.GlobalSetting.parish-import',['name'=>'parish_id','required'=>'required','class'=>'form-control input-sm select-box','selectid'=>$student?$student->parish_id:null,'data'=>['for'=>'section_id','this_id'=>'parish_id','request_ids'=>'parish_id','get'=>'parishlist']])
    </div>
</div><br>


<div class="row p-0 m-0">
    <div class="col-3 pd-l-1">
        <label>Aadhar Card No. <span class="tx-11 text-gray">(optional)</span> :</label>
        <input type="text" autocomplete="off" placeholder="Enter Aadhar Card No."
              id="aadhar_card_no" value="@if(isset($student->student->aadhar_card_no)){{$student->student->aadhar_card_no}}@endif" name="aadhar_card_no" class="form-control input-sm">
    </div>

    <div class="col-3 pd-l-1">
        <label>Birth Certificate No. <span class="tx-11 text-gray">(optional)</span> :</label>
        <input type="text" autocomplete="off" placeholder="Enter Birth Certificate No."
              id="birth_certificate_no" value="@if(isset($student->student->birth_certificate_no)){{$student->student->birth_certificate_no}}@endif" name="birth_certificate_no" class="form-control input-sm">
    </div>

    <div class="col-3 pd-l-1">
        <label>RFID No. <span class="tx-11 text-gray">(optional)</span> :</label>
        <input type="text" autocomplete="off" placeholder="Enter RFID No."
             id="rfid_no" value="@if(isset($student->student->rfid_no)){{$student->student->rfid_no}}@endif" name="rfid_no"  class="form-control input-sm">
    </div>
    <div class="col-3 pd-l-1">
        <label>GPS Tracking No. <span class="tx-11 text-gray">(optional)</span> :</label>
        <input type="text" autocomplete="off" placeholder="Enter GPS Tracking No."
        id="gps_tracking_no" value="@if(isset($student->student->gps_tracking_no)){{$student->student->gps_tracking_no}}@endif" name="gps_tracking_no"  class="form-control input-sm">
    </div>
</div>

<ul class="nav nav-line tx-12 pd-l-5 " id="myTab5" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" style=" padding: 5px 0px;" id="home-tab5" data-toggle="tab"
           href="#home5" role="tab"
           aria-controls="home" aria-selected="true"><i class="fa fa-users"></i> Parents Information</a>
    </li>
</ul>

<div class="row p-0 m-0">
    <div class="col-4 pd-l-1">
        <label class="tx-12">Father Name <sup>*</sup> :</label><br/>
        <input type="text" required="" name="father_name" autocomplete="off" placeholder="Enter Father Name"
               @if(isset($student->student->father_name)) value="{{$student->student->father_name}}" @endif  class="form-control father-name input-sm">
    </div>

    <div class="col-4 pd-l-1">
        <label class="tx-12">Mother Name <span class="tx-11 text-gray">(optional)</span>  :</label>
        <input type="text" name="mother_name" autocomplete="off" placeholder="Enter Mother Name"
               @if(isset($student->student->mother_name)) value="{{$student->student->mother_name}}" @endif  class="form-control mother-name input-sm">
    </div>

    <div class="col-4 pd-l-1">
        <label class="tx-12">Local Parent Name <span class="tx-11 text-gray">(optional)</span>  :</label>
        <input type="text" name="local_guardian_name" autocomplete="off" placeholder="Enter Local Guardian Name"
               value="@if(isset($student->student->local_guardian_name)){{$student->student->local_guardian_name}}@endif"  class="form-control input-sm">
    </div>

</div>


<ul class="nav nav-line tx-12 pd-l-5 " id="myTab5" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" style=" padding: 5px 0px;" id="home-tab5" data-toggle="tab"
           href="#home5" role="tab"
           aria-controls="home" aria-selected="true"><i class="fa fa-envelope"></i> Communication
            Information</a>
    </li>
</ul>

<div class="row p-0 m-0">
    <div class="col-4 pd-l-1">
        <label class="tx-12">Preferred Mobile No. For School SMS <sup>*</sup> :</label>
        <input type="text" autocomplete="off" data-parsley-minlength="10" data-parsley-minlength-message="minlength ten number" data-parsley-type="digits" data-parsley-type-message="only numbers" maxlength="10" placeholder="Enter Mobile Number For School SMS"
               @if(isset($student->student->contact_no)) value="{{$student->student->contact_no}}" @endif  @if(isset($student->student->mobile_no)) value="{{$student->student->mobile_no}}" @endif   name="contact_no" id="contact_no"  required="" class="form-control input-sm">
    </div>

    <div class="col-4 pd-l-1">
        <label class="tx-12">Preferred Email For Email SMS<span
                class="tx-11 text-gray">(optional)</span> :</label>
        <input type="text" autocomplete="off" placeholder="Enter Preferred Email For Email SMS"
             name="email" id="email" value="@if(isset($student->student->email)){{$student->student->email}}@endif" class="form-control input-sm">
    </div>

    <div class="col-4 pd-l-1">
        <label>Emergency Contact No. <span class="tx-11 text-gray">(optional)</span> :</label>
        <input type="text" autocomplete="off" name="emergency_mobile_no" placeholder="Enter Emergency Contact No."
               class="form-control input-sm" value="@if(isset($student->student->emergency_mobile_no)){{$student->student->emergency_mobile_no}}@endif">
    </div>
</div>


<ul class="nav nav-line tx-12 pd-l-5 " id="myTab5" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" style=" padding: 5px 0px;" id="home-tab5" data-toggle="tab"
           href="#home5" role="tab"
           aria-controls="home" aria-selected="true"><i class="fa fa-map"></i> Address Information</a>
    </li>
</ul>

<div class="row p-0 m-0">
    <div class="col-6 pd-l-1">
        <label>Residence Address : </label><br>
        <textarea autocomplete="off" class="form-control input-sm"
                 id="residence_address" name="residence_address" placeholder="Enter Residence Address">@if(isset($student->student->residence_address)){{$student->student->residence_address}}@endif</textarea>
    </div>

    <div class="col-6 pd-l-1">
        <label>Permanent Address <span class="tx-11 text-gray">(optional)</span> : </label><br>
        <textarea autocomplete="off" class="form-control input-sm"
              id="permanent_address" name="permanent_address" placeholder="Enter Permanent Address">@if(isset($student->student->permanent_address)){{$student->student->permanent_address}}@endif</textarea>
    </div>

    <div class="col-3 pd-l-1">
        <label>Landmark <span class="tx-11 text-gray">(optional)</span> : </label>
        <input type="text" autocomplete="off" class="form-control input-sm"
             id="landmark" name="landmark" value="@if(isset($student->student->landmark)){{$student->student->landmark}}@endif" placeholder="Enter Near By Landmark">
    </div>


    <div class="col-3 pd-l-1">
        <label>City <span class="tx-11 text-gray">(optional)</span> : </label>
        <input type="text" autocomplete="off" class="form-control input-sm"
              id="city" name="city" value="@if(isset($student->student->city)){{$student->student->city}}@endif" placeholder="Enter City Name">
    </div>

    <div class="col-3 pd-l-1">
        <label>Pincode <span class="tx-11 text-gray">(optional)</span> : </label>
        <input type="text" autocomplete="off" class="form-control input-sm"
             id="pin_code" name="pin_code" value="@if(isset($student->student->pin_code)){{$student->student->pin_code}}@endif" placeholder="Enter Pincode">
    </div>

    <div class="col-3 pd-l-1">
        <label>State <span class="tx-11 text-gray">(optional)</span> : </label>
        <input type="text" autocomplete="off" class="form-control input-sm"
              id="state" name="state" value="@if(isset($student->student->state)){{$student->student->state}}@endif" placeholder="Enter State">
    </div>
</div>
<script type="text/javascript">
    $(".father-name,.father-name1").on('keyup',function(){
        $(".father-name").val($(this).val());
    });
    $(".mother-name,.mother-name1").on('keyup',function () {
        $(".mother-name").val($(this).val());
    });
    $('.emergency_mobile_no').on('keyup',function () {
        $(".emergency_mobile_no").val($(this).val());
    });
</script>
