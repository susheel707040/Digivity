<div class="row p-0 m-0">
    <div class="col-4 pd-l-1">
        <label>First Name <sup>*</sup> :</label>
        <table class="container-fluid p-0 m-0">
            <tr>
                <td>
                    @include('components.GlobalSetting.title-import')
                </td>
                <td>
                    <input type="text" required="" autocomplete="off" placeholder="Enter First Name"
                         value="@if(isset($staffrecord->first_name)){{$staffrecord->first_name}}@endif"  id="first_name" name="first_name" class="form-control input-sm">
                </td>
            </tr>
        </table>
    </div>
    <div class="col-4 pd-l-1">
        <label>Middle Name <span class="tx-11 text-gray">(optional)</span> :</label>
        <input type="text" autocomplete="off" placeholder="Enter Middle Name"
               value="@if(isset($staffrecord->middle_name)){{$staffrecord->middle_name}}@endif"  id="middle_name" name="middle_name" class="form-control input-sm">
    </div>
    <div class="col-4 pd-l-1 m-0">
        <label>Last Name <span class="tx-11 text-gray">(optional)</span> :</label>
        <input type="text" autocomplete="off" placeholder="Enter Last Name"
               value="@if(isset($staffrecord->last_name)){{$staffrecord->last_name}}@endif"  id="last_name" name="last_name" class="form-control input-sm">
    </div>
</div>

<div class="row p-0 m-0">
    <div class="col-2 pd-l-1">
        <label>Gender <sup>*</sup> :</label>
        @php $selectgender=""; if(isset($staffrecord->gender)){$selectgender=$staffrecord->gender;} @endphp
        @include('components.GlobalSetting.gender-import',['required'=>'required','selectid'=>$selectgender])
    </div>

    <div class="col-3 pd-l-1">
        <label>Blood Group <span class="tx-11 text-gray">(optional)</span> :</label>
        @php $selectbloodgroup=""; if(isset($staffrecord->blood_group)){$selectbloodgroup=$staffrecord->blood_group;} @endphp
        @include('components.GlobalSetting.blood-group-import',['selectid'=>$selectbloodgroup])
    </div>

    <div class="col-3 pd-l-1 m-0">
        <label>Date Of Birth <span class="tx-11 text-gray">(optional)</span> :</label>
        <input type="text" autocomplete="off" placeholder="Enter Dob (dd-mm-yyyy)"
               value="@if(isset($staffrecord->dob)){{nowdate($staffrecord->dob,'d-m-Y')}}@endif"   id="dob" name="dob" class="date form-control input-sm">
    </div>
    <div class="col-4 pd-l-1 m-0">
        <label>Date of Anniversary <span class="tx-11 text-gray">(optional)</span> :</label>
        <input type="text" autocomplete="off" placeholder="Enter Date of Anniversary (dd-mm-yyyy)"
               value="@if(isset($staffrecord->doa)){{nowdate($staffrecord->doa,'d-m-Y')}}@endif"  id="doa" name="doa" class="date form-control input-sm">
    </div>
</div>


<div class="row p-0 m-0">

    <div class="col-3 pd-l-1">
        <label>Nationality <span class="tx-11 text-gray">(optional)</span> :</label>
        @php $selectnationality=""; if(isset($staffrecord->nationality_id)){$selectnationality=$staffrecord->nationality_id;} @endphp
        @include('components.GlobalSetting.nationality-import',['name'=>'nationality_id','selectid'=>$selectnationality])
    </div>

    <div class="col-3 pd-l-1">
        <label>Religion <span class="tx-11 text-gray">(optional)</span> :</label>
        @php $selectreligion=""; if(isset($staffrecord->religion_id)){$selectreligion=$staffrecord->religion_id;} @endphp
        @include('components.GlobalSetting.religion-import',['name'=>'religion_id','selectid'=>$selectreligion])
    </div>

    <div class="col-3 pd-l-1">
        <label>Category <span class="tx-11 text-gray">(optional)</span> :</label>
        @php $selectcategory=""; if(isset($staffrecord->category_id)){$selectcategory=$staffrecord->category_id;} @endphp
        @include('components.GlobalSetting.category-import',['selectid'=>$selectcategory])
    </div>

    <div class="col-3 pd-l-1">
        <label>Caste <span class="tx-11 text-gray">(optional)</span> :</label>
        @php $selectcaste=""; if(isset($staffrecord->caste_id)){$selectcaste=$staffrecord->caste_id;} @endphp
        @include('components.GlobalSetting.caste-import',['name'=>'caste_id','selectid'=>$selectcaste])
    </div>

</div>

<div class="row p-0 m-0">
    <div class="col-3 pd-l-1">
        <label>Aadhaar No. <span class="tx-11 text-gray">(optional)</span> :</label>
        <input type="text" autocomplete="off" placeholder="Enter Aadhaar No."
         value="@if(isset($staffrecord->aadhaar_no)){{$staffrecord->aadhaar_no}}@endif"  id="aadhaar_no" name="aadhaar_no" class="form-control input-sm">
    </div>
    <div class="col-3 pd-l-1">
        <label>PAN No. <span class="tx-11 text-gray">(optional)</span> :</label>
        <input type="text" autocomplete="off" placeholder="Enter PAN No."
               value="@if(isset($staffrecord->pan_no)){{$staffrecord->pan_no}}@endif"  id="pan_no" name="pan_no" class="form-control input-sm">
    </div>
    <div class="col-3 pd-l-1 m-0">
        <label>License No. <span class="tx-11 text-gray">(optional)</span> :</label>
        <input type="text" autocomplete="off" placeholder="Enter License No."
               value="@if(isset($staffrecord->license_no)){{$staffrecord->license_no}}@endif"  id="license_no" name="license_no" class="form-control input-sm">
    </div>
    <div class="col-3 pd-l-1 m-0">
        <label>Passport No. <span class="tx-11 text-gray">(optional)</span> :</label>
        <input type="text" autocomplete="off" placeholder="Enter Passport No."
               value="@if(isset($staffrecord->passport_no)){{$staffrecord->passport_no}}@endif"  id="passport_no" name="passport_no" class="form-control input-sm">
    </div>
</div>

<ul class="nav nav-line tx-12 pd-l-5 " id="myTab5" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" style=" padding: 5px 0px;" id="home-tab5" data-toggle="tab"
           href="#home5" role="tab"
           aria-controls="home" aria-selected="true"><i class="fa fa-envelope"></i> Communication Information</a>
    </li>
</ul>
<div class="row p-0 m-0">
<div class="col-4 pd-l-1">
    <label class="tx-12">Mobile Number (Primary) <sup>*</sup> :</label>
    <input type="text" autocomplete="off" placeholder="Enter Mobile Number"
           value="@if(isset($staffrecord->contact_no)){{$staffrecord->contact_no}}@endif" name="contact_no" id="contact_no"  required="" class="form-control input-sm">
</div>

<div class="col-4 pd-l-1">
    <label>Alt Mobile Number <span class="tx-11 text-gray">(optional)</span> :</label>
    <input type="text" autocomplete="off" id="alt_mobile_no" name="alt_mobile_no" placeholder="Enter Alt Mobile Number "
           value="@if(isset($staffrecord->alt_mobile_no)){{$staffrecord->alt_mobile_no}}@endif" class="form-control input-sm">
</div>

<div class="col-4 pd-l-1">
    <label class="tx-12">Email ID <span
            class="tx-11 text-gray">(optional)</span> :</label>
    <input type="text" autocomplete="off" placeholder="Enter Email ID"
           value="@if(isset($staffrecord->email)){{$staffrecord->email}}@endif" name="email" id="email"  class="form-control input-sm">
</div>
</div>

<ul class="nav nav-line tx-12 pd-l-5 " id="myTab5" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" style=" padding: 5px 0px;" id="home-tab5" data-toggle="tab"
           href="#home5" role="tab"
           aria-controls="home" aria-selected="true"><i class="fa fa-map-marked"></i> Family Information</a>
    </li>
</ul>

<div class="row p-0 m-0">
    <div class="col-4 pd-l-1">
        <label class="tx-12">Father Name <sup>*</sup> :</label>
        <input type="text" autocomplete="off" placeholder="Enter Father Name"
               value="@if(isset($staffrecord->father_name)){{$staffrecord->father_name}}@endif" name="father_name" id="father_name"  required="" class="form-control input-sm">
    </div>

    <div class="col-4 pd-l-1">
        <label>Mother Name <span class="tx-11 text-gray">(optional)</span> :</label>
        <input type="text" autocomplete="off" id="mother_name" name="mother_name" placeholder="Enter Mother Name"
               value="@if(isset($staffrecord->mother_name)){{$staffrecord->mother_name}}@endif"  class="form-control input-sm">
    </div>

    <div class="col-4 pd-l-1">
        <label class="tx-12">Father Mobile No. <span
                class="tx-11 text-gray">(optional)</span> :</label>
        <input type="text" autocomplete="off" placeholder="Enter Father Mobile Number"
               value="@if(isset($staffrecord->father_mobile_no)){{$staffrecord->father_mobile_no}}@endif" name="father_mobile_no" id="father_mobile_no"  class="form-control input-sm">
    </div>
</div>


<div class="row p-0 m-0">
    <div class="col-4 pd-l-1">
        <label class="tx-12">Marital Status <span class="tx-11 text-gray">(optional)</span> :</label>
        <select name="marital_status" id="marital_status" class="form-control input-sm">
            <option>Married</option>
            <option>Unmarried</option>
            <option>Others</option>
        </select>
    </div>

    <div class="col-4 pd-l-1">
        <label>Spouse Name <span class="tx-11 text-gray">(optional)</span> :</label>
        <input type="text" autocomplete="off" id="spouse_name" name="spouse_name" placeholder="Enter Spouse Name "
               value="@if(isset($staffrecord->spouse_name)){{$staffrecord->spouse_name}}@endif"   class="form-control input-sm">
    </div>

    <div class="col-4 pd-l-1">
        <label class="tx-12">Spouse Mobile No. <span
                class="tx-11 text-gray">(optional)</span> :</label>
        <input type="text" autocomplete="off" placeholder="Enter Spouse Mobile Number"
               value="@if(isset($staffrecord->spouse_mobile_no)){{$staffrecord->spouse_mobile_no}}@endif" name="spouse_mobile_no" id="spouse_mobile_no"  class="form-control input-sm">
    </div>
</div>




<ul class="nav nav-line tx-12 pd-l-5 " id="myTab5" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" style=" padding: 5px 0px;" id="home-tab5" data-toggle="tab"
           href="#home5" role="tab"
           aria-controls="home" aria-selected="true"><i class="fa fa-map-marked"></i> Address Information</a>
    </li>
</ul>


<div class="row p-0 m-0">
    <div class="col-6 pd-l-1">
        <label>Residence Address : </label>
        <textarea autocomplete="off" class="form-control input-sm"
                  id="residence_address" name="residence_address" placeholder="Enter Residence Address">@if(isset($staffrecord->residence_address)){{$staffrecord->residence_address}}@endif</textarea>
    </div>

    <div class="col-6 pd-l-1">
        <label>Permanent Address <span class="tx-11 text-gray">(optional)</span> : </label>
        <textarea autocomplete="off" class="form-control input-sm"
                  id="permanent_address" name="permanent_address" placeholder="Enter Permanent Address">@if(isset($staffrecord->permanent_address)){{$staffrecord->permanent_address}}@endif</textarea>
    </div>

    <div class="col-3 pd-l-1">
        <label>Landmark <span class="tx-11 text-gray">(optional)</span> : </label>
        <input type="text" autocomplete="off" class="form-control input-sm"
              value="@if(isset($staffrecord->landmark)){{$staffrecord->landmark}}@endif" id="landmark" name="landmark"  placeholder="Enter Near By Landmark">
    </div>


    <div class="col-3 pd-l-1">
        <label>City <span class="tx-11 text-gray">(optional)</span> : </label>
        <input type="text" autocomplete="off" class="form-control input-sm"
              value="@if(isset($staffrecord->city)){{$staffrecord->city}}@endif" id="city" name="city" placeholder="Enter City Name">
    </div>

    <div class="col-3 pd-l-1">
        <label>Pincode <span class="tx-11 text-gray">(optional)</span> : </label>
        <input type="text" autocomplete="off" class="form-control input-sm"
               value="@if(isset($staffrecord->pincode)){{$staffrecord->pincode}}@endif"  id="pincode" name="pincode"  placeholder="Enter Pincode">
    </div>

    <div class="col-3 pd-l-1">
        <label>State <span class="tx-11 text-gray">(optional)</span> : </label>
        <input type="text" autocomplete="off" class="form-control input-sm"
               value="@if(isset($staffrecord->state)){{$staffrecord->state}}@endif"  id="state" name="state" placeholder="Enter State">
    </div>

</div>


