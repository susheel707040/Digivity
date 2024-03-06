
<div class="col-12 p-0 m-0 d-flex">
    <table class="float-right" style=" width:100%; ">
        <tr>
            <td>
                <div class="avatar avatar-xxl">
                    @if(isset($staffrecord) && !empty($staffrecord->profile_img))
                        <img id="stafff_previewImage" height="90px" name="profile_img" src="{{ url('uploads/staff_image/' . $staffrecord->profile_img) }}">
                    @else
                        <img id="stafff_previewImage" height="90px" name="profile_img" src="{{ url('/assets/images/user_no_image.png') }}">
                    @endif
                </div>
            </td>
            <td class="pd-l-10" v-align="top"><label class="pd-b-5"><b>Staff/Employee Photo :</b> </label> <input
                    class="tx-12 form-control input-sm"
                    type="file" onchange="staffpreview()" name="profile_img" id="staffuploadImage">
            </td>
        </tr>
    </table>
</div>


<script>
    function staffpreview() {
        var staffpreview = document.getElementById('stafff_previewImage');
        var file    = document.getElementById('staffuploadImage').files[0];
        var reader  = new FileReader();

        reader.onloadend = function () {
            staffpreview.src = reader.result;
        }

        if (file) {
            reader.readAsDataURL(file);
        } else {
            staffpreview.src = "{{ url('assets/images/no-image-available.png') }}";
        }
    }
</script>

<div class="row pd-0 m-0">
    <div class="col-6 p-0 m-0">
        <label>Joining Date <sup>*</sup> :</label>
        <input type="text" required="" autocomplete="off" name="joining_date" id="joining_date" placeholder="dd-mm-yyyy"
               value="@if(isset($staffrecord)){{nowdate($staffrecord->joining_date,'d-m-Y')}}@else{{nowdate('','d-m-Y')}}@endif" class="date form-control input-sm" >
    </div>
    <div class="col-6  m-0 pd-r-3">
        <label>Employee ID/No. <sup>*</sup> :</label>
        <input type="text" required="" @if(!isset($staffrecord)&&(!isset($student->admission_no))&&FormNoGenerate('admission_no')) @if(FormNoGenerate('staff_no')->should_be=="auto") readonly style="background:whitesmoke; " @endif @endif autocomplete="off" name="staff_no" id="staff_no" placeholder="Enter Employee No."
               value="@if(isset($staffrecord->staff_no)){{$staffrecord->staff_no}}@else{{FormNoGenerate('staff_no')->GetNo()}}@endif" class="form-control input-sm">
    </div>
</div>

<div class="row pd-0 m-0">
    <div class="col-6 p-0 m-0">
        <label>Date of Retire :</label>
        <input type="text" autocomplete="off" name="date_of_retire" id="date_of_retire" placeholder="dd-mm-yyyy"
               value="@if(isset($staffrecord->date_of_retire)){{nowdate($staffrecord->date_of_retire,'d-m-Y')}}@endif" class="date form-control input-sm">
    </div>
    <div class="col-6  m-0 pd-r-3">
        <label>Date of Extend :</label>
        <input type="text" autocomplete="off" name="date_of_extend" id="date_of_extend" placeholder="dd-mm-yyyy"
               value="@if(isset($staffrecord->date_of_extend)){{nowdate($staffrecord->date_of_extend,'d-m-Y')}}@endif"    class="date form-control input-sm">
    </div>
</div>



<div class="row pd-0 m-0">

<div class="col-6 p-0 m-0">
    <label>Profession Type  :</label>
    @php $selectprofessiontype=""; if(isset($staffrecord)){$selectprofessiontype=$staffrecord->profession_type_id;} @endphp
    @include('components.Staff.profession-import',['selectid'=>$selectprofessiontype])
</div>

    <div class="col-6  m-0 pd-r-3">
        <label>Staff Type <sup>*</sup> :</label>
        @include('components.Staff.staff-type-import',['required'=>'required'])
    </div>
</div>

<div class="row pd-0 m-0">
<div class="col-6 p-0 m-0">
    <label>Department <sup>*</sup> :</label>
    @php $selectdepartment=""; if(isset($staffrecord)){$selectdepartment=$staffrecord->department_id;} @endphp
    @include('components.Staff.department-import',['required'=>'required','selectid'=>$selectdepartment])
</div>

<div class="col-6  m-0 pd-r-3">
    <label>Designation <sup>*</sup> :</label>
    @php $selectdesignation=""; if(isset($staffrecord)){$selectdesignation=$staffrecord->designation_id;} @endphp
    @include('components.Staff.designation-import',['selectid'=>$selectdesignation])
</div>
</div>

<div class="row pd-0 m-0">
    <div class="col-6 p-0 m-0">
        <label>Show in Transport <sup>*</sup> :</label>
        <table>
            <tr>
               <td><input type="radio" name="show_in_transport" id="show_in_transport" value="yes" @if(isset($staffrecord->show_in_transport)&&($staffrecord->show_in_transport=="yes")) checked @endif></td><td class="pd-l-5">YES</td>
               <td class="pd-l-10"><input type="radio" name="show_in_transport" id="show_in_transport" value="no" @if(isset($staffrecord->show_in_transport)&&($staffrecord->show_in_transport=="no")) checked @endif></td><td class="pd-l-5">NO</td>
           </tr>
       </table>
    </div>

    <div class="col-6  m-0 pd-r-3">
        <label>Financial Session <sup>*</sup> :</label>
        @php $selectfinancial=""; if(isset($staffrecord->financial_id)){$selectfinancial=$staffrecord->financial_id;} @endphp
        @include('components.GlobalSetting.financial-year-import',['required'=>'required','selectid'=>$selectfinancial])
    </div>
    </div>


    <div class="row p-0 m-0">
        <div class="col-6 p-0 m-0">
        <label>Shift <span class="tx-11 text-gray">(optional)</span> :</label>
        @php $selectshift=""; if(isset($staffrecord->shift_id)){$selectshift=$staffrecord->shift_id;}
    @endphp
        @include('components.GlobalSetting.integrate-module-import',['selectid'=>$selectshift])
    </div>


{{-- <div class="col-12 p-0 m-0"> --}}
    {{-- <label>Transport <span class="tx-11 text-gray">(optional)</span> :</label> --}}
    {{-- @php $selecttransport=""; if(isset($staffrecord->transport_id)){$selecttransport=$staffrecord->transport_id;}  @endphp --}}
    {{-- @include('component.Transport.assign-transport-route-list',['class'=>'form-control select-search input-sm','selectid'=>$selecttransport]) --}}
{{-- </div> --}}

{{-- <div class="col-12 p-0 m-0"> --}}
    {{-- <label>Hostel <span class="tx-11 text-gray">(optional)</span> :</label> --}}
    {{-- @php $selecthostel=""; if(isset($staffrecord->hostel_id)){$selecthostel=$staffrecord->hostel_id;} @endphp --}}
    {{-- <select id="hostel_id" name="hostel_id" class="form-control input-sm"> --}}
        {{-- <option value="0">---Select---</option> --}}
    {{-- </select> --}}
{{-- </div> --}}

{{-- Shift option shifted in above div --}}


<div class="col-6  m-0 pd-r-3">
    <label>Integrate Module  <span class="tx-11 text-gray">(optional)</span> :</label>
    @php $intgmodule=""; if(isset($staffrecord->integrated_id)){$intgmodule=$staffrecord->integrated_id;} @endphp
    @include('components.GlobalSetting.integrate-module-import',['selectid'=>$intgmodule])
</div>
</div>
