@php
    $student=collect(studentshortlist(['student_id'=>$studentid]))->first();
@endphp
@if(isset($student))
    <input type="hidden" name="student_id" value="{{$student->student_id}}">
<table class="table table-borderless tx-11 m-0">
    <tr>
        <td rowspan="3"><div class="avatar avatar-xl "><img src="{{url('uploads/student_profile_image/' .$student->profile_img)}}" class="rounded-circle bd-3 bd" alt=""></div></td>
        <td><b>Admission No.</b></td><td>:</td><td>{{$student->admission_no}}</td>
        <td><b>Session</b></td><td>:</td><td>{{$student->SessionName()}}</td>
    </tr>
    <tr>
        <td><b>Student Name</b></td><td>:</td><td><span class="badge badge-success">{{$student->FullName()}}</span></td>
        <td><b>Class/Course</b></td><td>:</td><td>{{$student->CourseSection()}}</td>
    </tr>
    <tr>
        <td><b>Father Name</b></td><td>:</td><td><span class="badge badge-danger">{{$student->FatherName()}}</span></td>
        <td><b>Contact No.</b></td><td>:</td><td>{{$student->student->contact_no}}</td>
    </tr>
</table>
@endif
