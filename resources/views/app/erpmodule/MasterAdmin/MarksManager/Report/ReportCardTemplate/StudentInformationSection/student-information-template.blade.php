 <table class="table bd-1 bd">
       <tr>
           <td><b>Class/Course :</b></td><td><b>:</b></td><td>{{$data->CourseSection()}}</td>
           <td><b>Admission No.</b></td><td><b>:</b></td><td>{{$data->admission_no}}</td>
           <td><b>Roll No.</b></td><td><b>:</b></td><td>{{$data->roll_no}}</td>
           <td rowspan="4" class="text-center">
               <div class="avatar avatar-xxl mx-auto"><img src="{{$data->ProfileImage()}}" class="rounded" alt=""></div>
           </td>
       </tr>
        <tr>
            <td><b>Student Name</b></td><td><b>:</b></td><td>{{ucwords($data->fullName())}}</td>
            <td><b>Gender</b></td><td><b>:</b></td><td>{{ucwords($data->student->gender)}}</td>
            <td><b>Date of Birth</b></td><td><b>:</b></td><td>@if($data->dob()){{nowdate($data->dob(),'d-M-Y')}}@endif</td>
        </tr>
        <tr>
            <td><b>Father's Name</b></td><td><b>:</b></td><td>{{$data->FatherName()}}</td>
            <td><b>Mother's Name</b></td><td><b>:</b></td><td>{{$data->MotherName()}}</td>
            <td><b>Contact Number</b></td><td><b>:</b></td><td>{{$data->student->contact_no}}</td>
        </tr>
        <tr>
            <td><b>Address</b></td><td><b>:</b></td><td colspan="4">{{$data->Address()}}</td>
            <td><b>Attendance</b></td><td><b>:</b></td><td>0/<b>0</b> <b>(0%)</b></td>
        </tr>
    </table>
