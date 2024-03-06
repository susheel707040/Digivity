<div class="col-md-12 m-0">
    <ul class="nav nav-line tx-12 pd-l-5 " id="myTab5" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" style=" padding: 5px 0px;" id="home-tab5" data-toggle="tab"
               href="#home5" role="tab"
               aria-controls="home" aria-selected="true"><i class="fa fa-male"></i> Father Information</a>
        </li>
    </ul>
    <div class="row p-0 m-0">
        <div class="col-md-9 p-0 m-0">
            <div class="row p-0 m-0">
                <div class="col-4 pd-l-1">
                    <label>Father Name <sup>*</sup> :</label>
                    <input type="text"  autocomplete="off" placeholder="Enter Father Name"
                           @if(isset($student->student->father_name)) value="{{$student->student->father_name}}" @endif class="form-control father-name father-name1 input-sm">
                </div>
                <div class="col-4 pd-l-1">
                    <label>Mobile Number <span class="tx-11 text-gray">(optional)</span> :</label>
                    <input type="text" maxlength="10" name="father_mobile_no" autocomplete="off" placeholder="Enter Mobile Number"
                           @if(isset($student->student->father_mobile_no))value="{{$student->student->father_mobile_no}}"@endif"  class="form-control input-sm">
                </div>
                <div class="col-4 pd-l-1 m-0">
                    <label>Email Address <span class="tx-11 text-gray">(optional)</span> :</label>
                    <input type="text" name="father_email_id" autocomplete="off" placeholder="Enter Email Address"
                           value="@if(isset($student->student->father_email_id)){{$student->student->father_email_id}}@endif"  class="form-control input-sm">
                </div>

                <div class="col-4 pd-l-1">
                    <label>Qualification <span class="tx-11 text-gray">(optional)</span> :</label>
                    <input type="text" name="father_qualification" autocomplete="off" placeholder="Enter Qualification"
                           value="@if(isset($student->student->father_qualification)){{$student->student->father_qualification}}@endif"  class="form-control input-sm">
                </div>

                <div class="col-4 pd-l-1">
                    <label>Annual Income <span class="tx-11 text-gray">(optional)</span> :</label>
                    <input type="text" name="father_annual_income" autocomplete="off" placeholder="Enter Annual Income"
                           value="@if(isset($student->student->father_annual_income)){{$student->student->father_annual_income}}@endif"  class="form-control input-sm">
                </div>
                <div class="col-4 pd-l-1">
                    <label>Aadhar Card No. <span class="tx-11 text-gray">(optional)</span> :</label>
                    <input type="text" name="father_aadhar_card_no" autocomplete="off" placeholder="Enter Aadhar Card No."
                           value="@if(isset($student->student->father_aadhar_card_no)){{$student->student->father_aadhar_card_no}}@endif"   class="form-control input-sm">
                </div>


                <div class="col-4 pd-l-1">
                    <label>Profession <span class="tx-11 text-gray">(optional)</span> :</label>
                    <select name="father_profession" class="form-control input-sm">
                        <option value="">---Select---</option>
                    </select>
                </div>
                <div class="col-4 pd-l-1">
                    <label>Designation <span class="tx-11 text-gray">(optional)</span> :</label>
                    <select name="father_designation" class="form-control input-sm">
                        <option value="">---Select---</option>
                    </select>
                </div>
                <div class="col-4 pd-l-1">
                    <label>Organization Name<span class="tx-11 text-gray">(optional)</span> :</label>
                    <input type="text" name="father_organization_name" autocomplete="off" placeholder="Enter Organization Name"
                           value="@if(isset($student->student->father_organization_name)){{$student->student->father_organization_name}}@endif" class="form-control input-sm">
                </div>
                <div class="col-lg-5 pd-l-1">
                    <label>Organization Address <span class="tx-11 text-gray">(optional)</span> :</label>
                    <input type="text" name="father_organization_address" autocomplete="off" placeholder="Enter Organization Address"
                           value="@if(isset($student->student->father_organization_address)){{$student->student->father_organization_address}}@endif" class="form-control input-sm">
                </div>
                <div class="col-4 pd-l-1">
                    <label>Org. Phone<span class="tx-11 text-gray"> (optional)</span> :</label>
                    <input type="text" name="father_organization_phone" autocomplete="off" placeholder="Enter Organization Phone"
                           value="@if(isset($student->student->father_organization_phone)){{$student->student->father_organization_phone}}@endif" class="form-control input-sm">
                </div>

                <div class="col-3 pd-l-1">
                    <label>Parent Status <span class="tx-11 text-gray"> (optional)</span></label>
                    <select name="parent_status" class="form-control input-sm">
                        <option value="">---Select---</option>
                    </select>
                </div>

            </div>
        </div>
        <div class="col-md-3 pd-t-5">
            <table class="mx-auto">
                <tr>
                    <td>
                        <div class="avatar avatar-xxl">
                            @if(isset($student) && !empty($school->father_photo))
                            <img id="fatherpreviewImage" height="90px" name="father_photo" src="{{url('uploads/father_photo/' .$student->father_photo)}}">
                            @else
                           <img id="fatherpreviewImage" height="90px" name="father_photo" src="{{url('assets/images/no-image-available.png')}}">
                           @endif
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="pd-l-10" v-align="top"><label class="pd-b-5"><b>Father Photo :</b> </label>
                        <input class="form-control tx-12" name="father_photo" onchange="fatherpreview()" type="file" id="fatheruploadImage"></td>
                </tr>
            </table>
        </div>
    </div>
    <script>
        function fatherpreview() {
            var fatherpreview = document.getElementById('fatherpreviewImage');
            var file    = document.getElementById('fatheruploadImage').files[0];
            var reader  = new FileReader();

            reader.onloadend = function () {
                fatherpreview.src = reader.result;
            }

            if (file) {
                reader.readAsDataURL(file);
            } else {
                fatherpreview.src = "{{ url('assets/images/no-image-available.png') }}";
            }
        }
    </script>
    <ul class="nav nav-line tx-12 pd-l-5 " id="myTab5" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" style=" padding: 5px 0px;" id="home-tab5" data-toggle="tab"
               href="#home5" role="tab"
               aria-controls="home" aria-selected="true"><i class="fa fa-female"></i> Mother Information</a>
        </li>
    </ul>

    <div class="row p-0 m-0">
        <div class="col-md-9 p-0 m-0">
            <div class="row p-0 m-0">
                <div class="col-4 pd-l-1">
                    <label>Mother Name  :</label>
                    <input type="text" autocomplete="off" placeholder="Enter Mother Name"
                           value="@if(isset($student->student->mother_name)){{$student->student->mother_name}}@endif"   class="form-control mother-name mother-name1 input-sm">
                </div>
                <div class="col-4 pd-l-1">
                    <label>Mobile Number <span class="tx-11 text-gray">(optional)</span> :</label>
                    <input type="text" data-parsley-minlength="10" data-parsley-minlength-message="minlength ten number" data-parsley-type="digits" data-parsley-type-message="only numbers" maxlength="10" name="mother_mobile_no" autocomplete="off" placeholder="Enter Mobile Number"
                           value="@if(isset($student->student->mother_mobile_no)){{$student->student->mother_mobile_no}}@endif"   class="form-control input-sm">
                </div>
                <div class="col-4 pd-l-1 m-0">
                    <label>Email Address <span class="tx-11 text-gray">(optional)</span> :</label>
                    <input type="text" name="mother_email_id" autocomplete="off" placeholder="Enter Email Address"
                           value="@if(isset($student->student->mother_email_id)){{$student->student->mother_email_id}}@endif"  class="form-control input-sm">
                </div>

                <div class="col-4 pd-l-1">
                    <label>Qualification <span class="tx-11 text-gray">(optional)</span> :</label>
                    <input type="text" name="mother_qualification" autocomplete="off" placeholder="Enter Qualification"
                           value="@if(isset($student->student->mother_qualification)){{$student->student->mother_qualification}}@endif"   class="form-control input-sm">
                </div>

                <div class="col-4 pd-l-1">
                    <label>Annual Income <span class="tx-11 text-gray">(optional)</span> :</label>
                    <input type="text" name="mother_annual_income" autocomplete="off" placeholder="Enter Annual Income"
                           value="@if(isset($student->student->mother_annual_income)){{$student->student->mother_annual_income}}@endif"  class="form-control input-sm">
                </div>
                <div class="col-4 pd-l-1">
                    <label>Aadhar Card No. <span class="tx-11 text-gray">(optional)</span> :</label>
                    <input type="text" name="mother_aadhar_card_no" autocomplete="off" placeholder="Enter Aadhar Card No."
                           value="@if(isset($student->student->mother_aadhar_card_no)){{$student->student->mother_aadhar_card_no}}@endif"  class="form-control input-sm">
                </div>


                <div class="col-4 pd-l-1">
                    <label>Profession <span class="tx-11 text-gray">(optional)</span> :</label>
                    <select class="form-control input-sm" name="mother_profession">
                        <option value="">---Select---</option>
                    </select>
                </div>
                <div class="col-4 pd-l-1">
                    <label>Designation <span class="tx-11 text-gray">(optional)</span> :</label>
                    <select name="mother_designation" class="form-control input-sm">
                        <option value="">---Select---</option>
                    </select>
                </div>
                <div class="col-4 pd-l-1">
                    <label>Organization Name<span class="tx-11 text-gray">(optional)</span> :</label>
                    <input type="text" autocomplete="off" name="mother_organization_name" placeholder="Enter Organization Name"
                           value="@if(isset($student->student->mother_organization_name)){{$student->student->mother_organization_name}}@endif"  class="form-control input-sm">
                </div>
                <div class="col-lg-5 pd-l-1">
                    <label>Organization Address <span class="tx-11 text-gray">(optional)</span> :</label>
                    <input type="text" name="mother_organization_address" autocomplete="off" placeholder="Enter Organization Address"
                           value="@if(isset($student->student->mother_organization_address)){{$student->student->mother_organization_address}}@endif" class="form-control input-sm">
                </div>
                <div class="col-4 pd-l-1">
                    <label>Org. Phone<span class="tx-11 text-gray"> (optional)</span> :</label>
                    <input type="text" name="mother_organization_phone" autocomplete="off" placeholder="Enter Organization Phone"
                           value="@if(isset($student->student->mother_organization_phone)){{$student->student->mother_organization_phone}}@endif" class="form-control input-sm">
                </div>
                <div class="col-3 pd-l-1">
                    <label>Anniversary Date <span class="tx-11 text-gray"></span> :</label>
                    <input type="text" name="anniversary_date" autocomplete="off" placeholder="Enter Ann. Date (dd-mm-yyyy)"
                           value="@if(isset($student->student->anniversary_date)){{$student->student->anniversary_date}}@endif"  class="form-control input-sm">
                </div>


            </div>
        </div>
        <div class="col-md-3 pd-t-5">
            <table class="mx-auto">
                <tr>
                    <td>
                        <div class="avatar avatar-xxl">
                            @if(isset($student) && !empty($school->mother_photo))
                            <img id="motherpreviewImage" height="90px" name="mother_photo" src="{{url('uploads/mother_photo/' .$student->mother_photo)}}">
                            @else
                            <img id="motherpreviewImage" height="90px" name="mother_photo" src="{{url('assets/images/no-image-available.png')}}">
                            @endif
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="pd-l-10" v-align="top"><label class="pd-b-5"><b>Mother Photo :</b> </label>
                        <input class="form-control tx-12" id="motheruploadImage" name="mother_photo" onchange="motherpreview()" type="file"></td>
                </tr>
            </table>
        </div>
    </div>

    <script>
        function motherpreview() {
            var motherpreview = document.getElementById('motherpreviewImage');
            var file    = document.getElementById('motheruploadImage').files[0];
            var reader  = new FileReader();

            reader.onloadend = function () {
                motherpreview.src = reader.result;
            }

            if (file) {
                reader.readAsDataURL(file);
            } else {
                motherpreview.src = "{{ url('assets/images/no-image-available.png') }}";
            }
        }
    </script>


    <ul class="nav nav-line tx-12 pd-l-5 " id="myTab5" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" style=" padding: 5px 0px;" id="home-tab5" data-toggle="tab"
               href="#home5" role="tab"
               aria-controls="home" aria-selected="true"><i class="fa fa-users"></i> Local Guardian Information</a>
        </li>
    </ul>

    <div class="row p-0 m-0">
        <div class="col-md-9 p-0 m-0">
            <div class="row p-0 m-0">
                <div class="col-4 pd-l-1">
                    <label>Relation <span class="tx-11 text-gray">(optional)</span></label>
                    <input type="text" name="local_guardian_relation" autocomplete="off" placeholder="Enter Relation"
                           class="form-control input-sm">
                </div>
                <div class="col-4 pd-l-1">
                    <label>Local Guardian Name <span class="tx-11 text-gray">(optional)</span></label>
                    <input type="text"  autocomplete="off" placeholder="Enter Local Guardian Name"
                           class="form-control input-sm">
                </div>
                <div class="col-4 pd-l-1">
                    <label>Mobile Number <span class="tx-11 text-gray">(optional)</span> :</label>
                    <input type="text" name="local_guardian_mobile_no" autocomplete="off" placeholder="Enter Mobile Number"
                           class="form-control input-sm">
                </div>
                <div class="col-4 pd-l-1 m-0">
                    <label>Email Address <span class="tx-11 text-gray">(optional)</span> :</label>
                    <input type="text" name="local_guardian_email_id" autocomplete="off" placeholder="Enter Email Address"
                           class="form-control input-sm">
                </div>

                <div class="col-4 pd-l-1">
                    <label>Qualification <span class="tx-11 text-gray">(optional)</span> :</label>
                    <input type="text" name="local_guardian_qualification" autocomplete="off" placeholder="Enter Qualification"
                           class="form-control input-sm">
                </div>

                <div class="col-4 pd-l-1">
                    <label>Annual Income <span class="tx-11 text-gray">(optional)</span> :</label>
                    <input type="text" name="local_guardian_annual_income" autocomplete="off" placeholder="Enter Annual Income"
                           class="form-control input-sm">
                </div>
                <div class="col-4 pd-l-1">
                    <label>Aadhar Card No. <span class="tx-11 text-gray">(optional)</span> :</label>
                    <input type="text" name="local_guardian_aadhar_card_no" autocomplete="off" placeholder="Enter Aadhar Card No."
                           class="form-control input-sm">
                </div>


                <div class="col-4 pd-l-1">
                    <label>Profession <span class="tx-11 text-gray">(optional)</span> :</label>
                    <select class="form-control input-sm" name="local_guardian_profession">
                        <option value="">---Select---</option>
                    </select>
                </div>
                <div class="col-4 pd-l-1">
                    <label>Designation <span class="tx-11 text-gray">(optional)</span> :</label>
                    <select class="form-control input-sm" name="local_guardian_designation">
                        <option value="">---Select---</option>
                    </select>
                </div>
                <div class="col-4 pd-l-1">
                    <label>Organization Name<span class="tx-11 text-gray">(optional)</span> :</label>
                    <input type="text" name="local_guardian_org_name" autocomplete="off" placeholder="Enter Organization Name"
                           class="form-control input-sm">
                </div>
                <div class="col-lg-5 pd-l-1">
                    <label>Organization Address <span class="tx-11 text-gray">(optional)</span> :</label>
                    <input type="text" name="local_guardian_org_address" autocomplete="off" placeholder="Enter Organization Address"
                           class="form-control input-sm">
                </div>
                <div class="col-3 pd-l-1">
                    <label>Org. Phone<span class="tx-11 text-gray"> (optional)</span> :</label>
                    <input type="text" name="local_guardian_org_phone" autocomplete="off" placeholder="Enter Org. Phone"
                           class="form-control input-sm">
                </div>

            </div>
        </div>
        <div class="col-md-3 pd-t-5">
            <table class="mx-auto">
                <tr>
                    <td>
                        <div class="avatar avatar-xxl">
                            @if(isset($student) && !empty($school->local_guardian_photo))
                            <img id="guardianpreviewImage" height="90px" name="local_guardian_photo" src="{{url('uploads/local_guardian_photo/' .$student->local_guardian_photo)}}">
                            @else
                            <img id="guardianpreviewImage" height="90px" name="local_guardian_photo" src="{{url('assets/images/no-image-available.png')}}">
                            @endif
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="pd-l-10" v-align="top"><label class="pd-b-5"><b>Local Guardian Photo :</b> </label>
                        <input class="form-control tx-12"  name="local_guardian_photo" onchange="guardianpreview()" id="guardianuploadImage" type="file"></td>
                </tr>
            </table>
        </div>
    </div>
</div>
<script>
    function guardianpreview() {
        var guardianpreview = document.getElementById('guardianpreviewImage');
        var file    = document.getElementById('guardianuploadImage').files[0];
        var reader  = new FileReader();

        reader.onloadend = function () {
            guardianpreview.src = reader.result;
        }

        if (file) {
            reader.readAsDataURL(file);
        } else {
            guardianpreview.src = "{{ url('assets/images/no-image-available.png') }}";
        }
    }
</script>

