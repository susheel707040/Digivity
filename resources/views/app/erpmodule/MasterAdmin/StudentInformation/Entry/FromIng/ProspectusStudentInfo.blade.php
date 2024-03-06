<ul class="nav nav-line tx-12 pd-l-5 " id="myTab5" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" style=" padding: 5px 0px;" id="home-tab5" data-toggle="tab"
           href="#home5" role="tab"
           aria-controls="home" aria-selected="true"><i class="fa fa-user"></i> Student
            Information</a>
    </li>
</ul>
<div class="row p-0 m-0">
    <div class="col-4 pd-l-1">
        <label>First Name <sup>*</sup> :</label>
        <input type="text" autocomplete="off" placeholder="Enter First Name"
               name="first_name" id="first_name" @if(isset($studentprospectus->first_name)) value="{{$studentprospectus->first_name}}" @endif  class="form-control input-sm" required="">
    </div>
    <div class="col-4 pd-l-1">
        <label>Middle Name <span class="tx-11 text-gray">(optional)</span> :</label>
        <input type="text" autocomplete="off" placeholder="Enter Middle Name"
               id="middle_name" name="middle_name" @if(isset($studentprospectus->middle_name)) value="{{$studentprospectus->middle_name}}" @endif class="form-control input-sm">
    </div>
    <div class="col-4 pd-l-1 m-0">
        <label>Last Name <span class="tx-11 text-gray">(optional)</span> :</label>
        <input type="text" autocomplete="off" placeholder="Enter Last Name"
               id="last_name" name="last_name" @if(isset($studentprospectus->last_name)) value="{{$studentprospectus->last_name}}" @endif class="form-control input-sm">
    </div>

    <div class="col-4 pd-l-1 m-0">
        <label>Gender <sup>*</sup> :</label><br>
        @php $selectgender=""; if(isset($studentprospectus->gender)){$selectgender=$studentprospectus->gender;} @endphp
        @include('components.GlobalSetting.gender-import',['required'=>'required','selectid'=>$selectgender])
    </div>

    <div class="col-4 pd-l-1 m-0">
        <label>Date of Birth <span class="tx-11 text-gray">(optional)</span> :</label>
        <input type="text" autocomplete="off" placeholder="Enter Date of Birth (dd-mm-yyyy)"
               name="dob" id="dob" @if(isset($studentprospectus->dob)) value="{{$studentprospectus->dob}}" @endif  class="date form-control input-sm">
    </div>

    <div class="col-4 pd-l-1 m-0">
        <label>Aadhar Card No. <span class="tx-11 text-gray">(optional)</span> :</label>
        <input type="text" autocomplete="off" placeholder="Enter Aadhar Card No."
               name="aadhar_no" id="aadhar_no" @if(isset($studentprospectus->aadhar_no)) value="{{$studentprospectus->aadhar_no}}" @endif class="form-control input-sm">
    </div>

</div>


<ul class="nav nav-line tx-12 pd-l-5 " id="myTab5" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" style=" padding: 5px 0px;" id="home-tab5" data-toggle="tab"
           href="#home5" role="tab"
           aria-controls="home" aria-selected="true"><i class="fa fa-users"></i> Parents
            Information</a>
    </li>
</ul>
<div class="row p-0 m-0">
    <div class="col-4 pd-l-1">
        <label>Father Name <sup>*</sup> :</label>
        <input type="text" autocomplete="off" placeholder="Enter Father Name"
               name="father_name" id="father_name" @if(isset($studentprospectus->father_name)) value="{{$studentprospectus->father_name}}" @endif class="form-control input-sm" required="">
    </div>
    <div class="col-4 pd-l-1">
        <label>Qualification <span class="tx-11 text-gray">(optional)</span> :</label>
        <input type="text" autocomplete="off" placeholder="Enter Qualification"
               name="f_qualification" id="f_qualification" @if(isset($studentprospectus->f_qualification)) value="{{$studentprospectus->f_qualification}}" @endif class="form-control input-sm">
    </div>
    <div class="col-4 pd-l-1 m-0">
        <label>Annual Income <span class="tx-11 text-gray">(optional)</span> :</label>
        <input type="text" autocomplete="off" placeholder="Enter Annual Income"
               id="f_annual_income" name="f_annual_income" @if(isset($studentprospectus->f_annual_income)) value="{{$studentprospectus->f_annual_income}}" @endif class="form-control input-sm">
    </div>
</div>
<div class="row p-0 m-0">
    <div class="col-4 pd-l-1">
        <label>Mother Name <sup>*</sup> :</label>
        <input type="text" autocomplete="off" placeholder="Enter Mother Name"
               name="mother_name" id="mother_name" @if(isset($studentprospectus->mother_name)) value="{{$studentprospectus->mother_name}}" @endif  class="form-control input-sm">
    </div>
    <div class="col-4 pd-l-1">
        <label>Qualification <span class="tx-11 text-gray">(optional)</span> :</label>
        <input type="text" autocomplete="off" placeholder="Enter Qualification"
               name="m_qualification" id="m_qualification" @if(isset($studentprospectus->m_qualification)) value="{{$studentprospectus->m_qualification}}" @endif class="form-control input-sm">
    </div>
    <div class="col-4 pd-l-1 m-0">
        <label>Annual Income <span class="tx-11 text-gray">(optional)</span> :</label>
        <input type="text" autocomplete="off" placeholder="Enter Annual Income"
               id="m_annual_income" name="m_annual_income" @if(isset($studentprospectus->m_annual_income)) value="{{$studentprospectus->m_annual_income}}" @endif   class="form-control input-sm">
    </div>
</div>

<ul class="nav nav-line tx-12 pd-l-5 " id="myTab5" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" style=" padding: 5px 0px;" id="home-tab5" data-toggle="tab"
           href="#home5" role="tab"
           aria-controls="home" aria-selected="true"><i class="fa fa-envelope"></i> Communication/Contact
            Information</a>
    </li>
</ul>

<div class="row p-0 m-0">
    <div class="col-4 pd-l-1">
        <label>Contact Person Name <span class="tx-11 text-gray">(optional)</span>  :</label>
        <input type="text" autocomplete="off" placeholder="Enter Person Name"
               id="person_name" name="person_name" @if(isset($studentprospectus->person_name)) value="{{$studentprospectus->person_name}}" @endif  class="form-control input-sm">
    </div>
    <div class="col-4 pd-l-1">
        <label>Mobile Number <sup>*</sup> :</label>
        <input type="text" data-parsley-minlength="10" data-parsley-minlength-message="minlength ten number" data-parsley-type="digits" data-parsley-type-message="only numbers" maxlength="10" autocomplete="off" placeholder="Enter Mobile Number"
               name="mobile_no" id="mobile_no" @if(isset($studentprospectus->mobile_no)) value="{{$studentprospectus->mobile_no}}" @endif class="form-control input-sm" required="">
    </div>
    <div class="col-4 pd-l-1 m-0">
        <label>Email Address <span class="tx-11 text-gray">(optional)</span> :</label>
        <input type="text" autocomplete="off" placeholder="Enter Email Address"
               id="email_id" name="email_id" @if(isset($studentprospectus->email_id)) value="{{$studentprospectus->email_id}}" @endif class="form-control input-sm">
    </div>
</div>

<ul class="nav nav-line tx-12 pd-l-5 " id="myTab5" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" style=" padding: 5px 0px;" id="home-tab5" data-toggle="tab"
           href="#home5" role="tab"
           aria-controls="home" aria-selected="true"><i class="fa fa-envelope"></i> Address
            Information</a>
    </li>
</ul>

<div class="row p-0 m-0">
    <div class="col-6 pd-l-1">
        <label>Residence Address <span class="tx-11 text-gray">(optional)</span> : </label><br>
        <textarea autocomplete="off" class="form-control input-sm w-100" required
                  id="residence_address" name="residence_address" placeholder="Enter Residence Address">@if(isset($studentprospectus->residence_address)){{$studentprospectus->residence_address}}@endif</textarea>
    </div>


    <div class="col-6 pd-l-1">
        <label>Permanent Address <span class="tx-11 text-gray">(optional)</span> : </label><br>
        <textarea autocomplete="off" class="form-control input-sm w-100" required
                  id="permanent_address" name="permanent_address"  placeholder="Enter Permanent Address">@if(isset($studentprospectus->permanent_address)){{$studentprospectus->permanent_address}}@endif</textarea>
    </div>

    <div class="col-3 pd-l-1">
        <label>Landmark <span class="tx-11 text-gray">(optional)</span> : </label>
        <input type="text" autocomplete="off" class="form-control input-sm"
               id="landmark" name="landmark" @if(isset($studentprospectus->landmark)) value="{{$studentprospectus->landmark}}" @endif placeholder="Enter Near By Landmark">
    </div>


    <div class="col-3 pd-l-1">
        <label>City <span class="tx-11 text-gray">(optional)</span> : </label>
        <input type="text" autocomplete="off" class="form-control input-sm"
               id="city" name="city" @if(isset($studentprospectus->city)) value="{{$studentprospectus->city}}" @endif  placeholder="Enter City Name">
    </div>

    <div class="col-3 pd-l-1">
        <label>Pincode <span class="tx-11 text-gray">(optional)</span> : </label>
        <input type="text" autocomplete="off" class="form-control input-sm"
               id="pincode" name="pincode" @if(isset($studentprospectus->pincode)) value="{{$studentprospectus->pincode}}" @endif placeholder="Enter Pincode">
    </div>

    <div class="col-3 pd-l-1">
        <label>State <span class="tx-11 text-gray">(optional)</span> : </label>
        <input type="text" autocomplete="off" class="form-control input-sm"
               id="state" name="state" @if(isset($studentprospectus->state)) value="{{$studentprospectus->state}}" @endif placeholder="Enter State">
    </div>
</div>

