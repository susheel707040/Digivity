<div class="col-md-12">
    <ul class="nav nav-line tx-12 pd-l-5 " id="myTab5" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" style="padding:5px 0px;" id="home-tab5" data-toggle="tab"
               href="#home5" role="tab"
               aria-controls="home" aria-selected="true"><i class="fa fa-rupee-sign"></i> Bank Information</a>
        </li>
    </ul>
    <div class="row p-0 m-0">
        <div class="col-4 pd-l-1">
            <label>Paymode <span class="tx-11 text-gray">(optional)</span> :</label>
            @php $selectpaymode=""; if(isset($staffrecord->paymode_id)){$selectpaymode=$staffrecord->paymode_id;} @endphp
            @include('components.Finance.paymode-import',['selectid'=>$selectpaymode])
        </div>

        <div class="col-4 pd-l-1">
            <label>Account No. <span class="tx-11 text-gray">(optional)</span> :</label>
            <input type="text" autocomplete="off" placeholder="Enter Account Number"
                   id="account_number" name="account_number" value="@if(isset($staffrecord->account_number)){{$staffrecord->account_number}}@endif" class="form-control input-sm">
        </div>

        <div class="col-4 pd-l-1">
            <label>Account Name <span class="tx-11 text-gray">(optional)</span> :</label>
            <input type="text" autocomplete="off" placeholder="Enter Account Name"
                   id="account_name" name="account_name" value="@if(isset($staffrecord->account_name)){{$staffrecord->account_name}}@endif" class="form-control input-sm">
        </div>

        <div class="col-3 pd-l-1">
            <label>IFSC Code  <span class="tx-11 text-gray">(optional)</span> :</label>
            <input type="text" autocomplete="off" placeholder="Enter IFSC Code"
                   id="ifsc_code" name="ifsc_code" value="@if(isset($staffrecord->ifsc_code)){{$staffrecord->ifsc_code}}@endif" class="form-control input-sm">
        </div>
        <div class="col-4 pd-l-1">
            <label>Bank Name  <span class="tx-11 text-gray">(optional)</span> :</label>
            @php $selectbank=""; if(isset($staffrecord->bank_name)){$selectbank=$staffrecord->bank_name;} @endphp
            @include('components.bank-import',['name'=>'bank_name','class'=>'form-control select-search input-sm wd-200','selectid'=>$selectbank])
        </div>
        <div class="col-5 pd-l-1">
            <label>Bank Location  <span class="tx-11 text-gray">(optional)</span> :</label>
            <input type="text" autocomplete="off" placeholder="Enter Bank Location"
                   id="bank_location" name="bank_location" value="@if(isset($staffrecord->bank_location)){{$staffrecord->bank_location}}@endif"  class="form-control input-sm">
        </div>
        <div class="col-3 pd-l-1">
            <label>Generate Salary :</label>
            <table>
                <tr>
                    <td><input type="radio" name="generate_salary" value="yes" @if(isset($staffrecord->generate_salary)&&($staffrecord->generate_salary=="yes")) checked @endif @if(!isset($staffrecord->generate_salary)) checked @endif></td><td class="pd-l-5">Yes</td>
                    <td class="pd-l-10"><input name="generate_salary" value="no" type="radio" @if(isset($staffrecord->generate_salary)&&($staffrecord->generate_salary=="no")) checked @endif></td><td class="pd-l-5">No</td>
                </tr>
            </table>
        </div>
        <div class="col-3 pd-l-1">
            <label>Salary To Bank :</label>
            <table>
                <tr>
                    <td><input type="radio" name="salary_to_bank" value="yes" @if(isset($staffrecord->salary_to_bank)&&($staffrecord->salary_to_bank=="yes")) checked @endif @if(!isset($staffrecord->salary_to_bank)) checked @endif></td><td class="pd-l-5">Yes</td>
                    <td class="pd-l-10"><input name="salary_to_bank" value="no" type="radio" @if(isset($staffrecord->salary_to_bank)&&($staffrecord->salary_to_bank=="no")) checked @endif></td><td class="pd-l-5">No</td>
                </tr>
            </table>
        </div>
        <div class="col-3 pd-l-1">
            <label>Gratuity Code  <span class="tx-11 text-gray">(optional)</span> :</label>
            <input type="text" autocomplete="off" placeholder="Enter Gratuity Code"
                   id="gratuity_code" name="gratuity_code" value="@if(isset($staffrecord->gratuity_code)){{$staffrecord->gratuity_code}}@endif" class="form-control input-sm">
        </div>
        <div class="col-3 pd-l-1">
            <label>Status  <span class="tx-11 text-gray">(optional)</span> :</label>
            <select name="emp_status" id="emp_status" class="form-control inout-sm">
                <option>Probation</option>
                <option>Probation1</option>
                <option>Probation2</option>
                <option>Contract</option>
                <option>Confirmed</option>
                <option>Permanent</option>
                <option>Adhoc</option>
                <option>Temprory</option>
            </select>
        </div>
    </div>
</div>


<div class="col-md-12">
    <ul class="nav nav-line tx-12 pd-l-5 " id="myTab5" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" style="padding:5px 0px;" id="home-tab5" data-toggle="tab"
               href="#home5" role="tab"
               aria-controls="home" aria-selected="true"><i class="fa fa-rupee-sign"></i> Salary Information</a>
        </li>
    </ul>
    <div class="row p-0 m-0">
        <div class="col-3 pd-l-1">
            <label>PF No. <span class="tx-11 text-gray">(optional)</span> :</label>
            <input type="text" autocomplete="off" placeholder="Enter PF No."
                   id="pf_no" name="pf_no" value="@if(isset($staffrecord->pf_no)){{$staffrecord->pf_no}}@endif" class="form-control input-sm">
        </div>

        <div class="col-3 pd-l-1">
            <label>Pan No. <span class="tx-11 text-gray">(optional)</span> :</label>
            <input type="text" autocomplete="off" placeholder="Enter PAN No."
                   id="pan_no" name="pan_no" value="@if(isset($staffrecord->pan_no)){{$staffrecord->pan_no}}@endif" class="form-control input-sm">
        </div>

        <div class="col-3 pd-l-1">
            <label>ESI No. <span class="tx-11 text-gray">(optional)</span> :</label>
            <input type="text" autocomplete="off" placeholder="Enter ESI No."
                   id="esi_no" name="esi_no" value="@if(isset($staffrecord->esi_no)){{$staffrecord->esi_no}}@endif" class="form-control input-sm">
        </div>

        <div class="col-3 pd-l-1">
            <label>UAN No. <span class="tx-11 text-gray">(optional)</span> :</label>
            <input type="text" autocomplete="off" placeholder="Enter UAN No."
                   id="uan_no" name="uan_no" value="@if(isset($staffrecord->uan_no)){{$staffrecord->uan_no}}@endif" class="form-control input-sm">
        </div>

        <div class="col-3 pd-l-1">
            <label>Dispensary <span class="tx-11 text-gray">(optional)</span> :</label>
            <input type="text" autocomplete="off" placeholder="Enter Dispensary"
                   id="dispensary" name="dispensary" value="@if(isset($staffrecord->dispensary)){{$staffrecord->dispensary}}@endif" class="form-control input-sm">
        </div>

        <div class="col-3 pd-l-1">
            <label>Nominee Name  <span class="tx-11 text-gray">(optional)</span> :</label>
            <input type="text" autocomplete="off" placeholder="Enter Nominee Name "
                   id="nominee_name" name="nominee_name" value="@if(isset($staffrecord->nominee_name)){{$staffrecord->nominee_name}}@endif" class="form-control input-sm">
        </div>

        <div class="col-3 pd-l-1">
            <label>Nominee Relation :</label>
            <input type="text" autocomplete="off" placeholder="Enter Nominee Relation  "
                   id="nominee_relation" name="nominee_relation" value="@if(isset($staffrecord->nominee_relation)){{$staffrecord->nominee_relation}}@endif" class="form-control input-sm">
        </div>

        <div class="col-3 pd-l-1">
            <label>Eligibility for Pension :</label>
            <table>
                <tr>
                    <td><input type="radio" name="pension" id="pension" value="yes" @if(isset($staffrecord->pension)&&($staffrecord->pension=="yes")) checked @endif></td><td class="pd-l-5">Yes</td>
                    <td class="pd-l-10"><input type="radio" name="pension" id="pension" value="no" @if(isset($staffrecord->pension)&&($staffrecord->pension=="no")) checked @endif @if(!isset($staffrecord->pension)) checked @endif></td><td class="pd-l-5">NO</td>
                </tr>
            </table>
        </div>
    </div>

    </div>


<div class="col-md-12">
    <ul class="nav nav-line tx-12 pd-l-5 " id="myTab5" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" style="padding:5px 0px;" id="home-tab5" data-toggle="tab"
               href="#home5" role="tab"
               aria-controls="home" aria-selected="true"><i class="fa fa-list"></i> Other Information</a>
        </li>
    </ul>

    <div class="row p-0 m-0">
        <div class="col-3 pd-l-1">
            <label>Biometric Machine No. :</label>
            <input type="text" autocomplete="off" placeholder="Enter Machine No."
                   id="machine_no" name="machine_no" value="@if(isset($staffrecord->machine_no)){{$staffrecord->machine_no}}@endif" class="form-control input-sm">
        </div>
        <div class="col-3 pd-l-1">
            <label>RFID No. :</label>
            <input type="text" autocomplete="off" placeholder="Enter RFID No."
                   id="rfid_no" name="rfid_no" value="@if(isset($staffrecord->rfid_no)){{$staffrecord->rfid_no}}@endif" class="form-control input-sm">
        </div>
        <div class="col-3 pd-l-1">
            <label>GPS Tracking No. :</label>
            <input type="text" autocomplete="off" placeholder="Enter GPS Tracking No."
                   id="gps_no" name="gps_no" value="@if(isset($staffrecord->gps_no)){{$staffrecord->gps_no}}@endif" class="form-control input-sm">
        </div>
        <div class="col-3 pd-l-1">
            <label>Attendance Punch Required <span class="tx-5">(Daily)</span>:</label>
            <select id="attendance" class="form-control input-sm" name="attendance">
                @for($i=1;$i<10;$i++)
                <option value="{{$i}}" @if(isset($staffrecord->attendance)&&($staffrecord->attendance==$i)) selected @endif>{{$i}}</option>
                @endfor
            </select>
        </div>
    </div>

</div>
