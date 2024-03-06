<form action="{{url('MasterAdmin/StudentInformation/StoreCertificateFields')}}" enctype="multipart/form-data" method="POST">
    {{csrf_field()}}
    <input type="hidden" name="student_id" value="{{request()->route('studentrecord')->student_id}}">
    <input type="hidden" name="certificate_id" value="{{request()->route('certificate')->id}}">
    <input type="hidden" name="integrate" value="{{request()->route('certificate')->integrate}}">
    <input type="hidden" name="certificate_for" value="student">
    <div class="col-lg-12 row p-0 m-0">
        <div class="col-lg-10 row m-0 pd-l-0 pd-r-0 pd-b-20">
            <div class="col-lg-12 pd-l-0 bd-1 bd-b">
                <table class="table bd-1 bd mg-t-10 pd-b-0 mg-b-10 bg-light">
                    <tr>
                        <td rowspan="4" class="text-center">
                            <div class="avatar avatar-xxl mx-auto"><img src="{{$studentrecord->ProfileImage()}}" class="rounded-circle bd-3 bd" alt=""></div>
                        </td>
                        <td><b>Admission No.</b></td><td><b>:</b></td><td>{{$studentrecord->admission_no}}</td>
                        <td><b>Class/Course-Section</b></td><td><b>:</b></td><td>{{$studentrecord->CourseSection()}}</td>
                        <td><b>Academic Session</b></td><td><b>:</b></td><td>{{$studentrecord->SessionName()}}</td>
                    </tr>
                    <tr>
                        <td><b>Student Name</b></td><td><b>:</b></td><td><span class="badge badge-warning tx-uppercase">{{$studentrecord->fullName()}}</span></td>
                        <td><b>Father's Name</b></td><td><b>:</b></td><td><span class="badge-danger badge tx-uppercase">{{$studentrecord->FatherName()}}</span></td>
                        <td><b>Contact No.</b></td><td><b>:</b></td><td>{{$studentrecord->student->contact_no}}</td>
                    </tr>
                    <tr>
                        <td><b>Address</b></td><td><b>:</b></td>
                        <td colspan="7">{{$studentrecord->Address()}}</td>
                    </tr>
                    <tr>
                        <td class="tx-12"><b>Certificate</b></td><td><b>:</b></td><td colspan="7"><span class="badge badge-success tx-12">{{$certificate->certificate_name}}</span></td>
                    </tr>
                </table>
            </div>

            <div class="col-lg-3">
                <label><b>Sl.No. :</b></label>
                <input type="text" name="sl_no" autocomplete="off" class="form-control" placeholder="Enter Sl.No.">
            </div>
            <div class="col-lg-3">
                <label><b>TC/Certificate No. :</b></label>
                <input type="text" name="certificate_no" autocomplete="off" class="form-control" placeholder="Enter Certificate No.">
            </div>
            <div class="col-lg-3">
                <label><b>Certificate Generate Date :</b></label>
                <input type="text" name="issue_date" autocomplete="off" class="form-control date" value="{{nowdate('','d-m-Y')}}" placeholder="dd-mm-yyyy">
            </div>
            <div class="col-lg-12 clearfix"></div>
            @if(isset($certificateintegrateform)&&($certificateintegrateform))
                @php
                    try {
                       $formfields=unserialize($certificateintegrateform->input);
                    }catch (\Exception $e){
                        $formfields=[];
                    }
                @endphp
                @foreach($formfields as $key=>$value)
                    <div @if(isset($value[6])&&$value[6]) class="{{$value[6]}}" @else class="col-lg-3" @endif>
                        @if(isset($value[0]))<label>{{$value[0]}} :</label>@endif
                        {{form_fields($input_type='text',$class=null,$require=null,$value,$studentrecord)}}
                    </div>
                @endforeach
            @endif

        </div>
        <div class="col-lg-2 pd-r-5 vhr">
            <button type="submit" class="btn btn-primary mg-t-10 mg-b-10 tx-13 btn-block">Save & Generate Certificate</button>
            <button type="button" class="btn btn-info mg-t-20 tx-13 btn-block"><i class="fa fa-eye"></i> Preview</button>
        </div>
    </div>
</form>
@php
    function form_fields($input_type=null,$class=null,$require=null,$value=null,$studentrecord=null){

        $inputvalue="";
        try {
            $inputvalue=strtr($value[4], $studentrecord->parameters());
        }catch (\Exception $e){}
        if(isset($value[1])&&($value[1]=="Select Box")){
            echo "<select name='$value[4][]' class='form-control1 select-search' multiple> ";
            if(isset($value[3])&&($value[3])){
                $valuearr=explode(",",$value[3]);
                foreach ($valuearr as $fieldvalue){
                   echo "<option>$fieldvalue</option>";
                }
            }
            echo "</select>";
        }else{
        echo "<input type='text' name='$value[4]' autocomplete='off' value='$inputvalue' placeholder='Enter $value[0]' class='form-control $value[2]' >";
        }
    }
@endphp
