@php $row=0; @endphp
@foreach($student as $data)
    @php $row++; @endphp

    <div class="col-lg-12 p-0 mg-b-10">
        <div class="col-lg-12 bd-1 bd p-0 m-0">@include('Print.print-page-header',['header'=>1,'footer'=>0])</div>
        <table class="table bd bd-1">
            <thead>
            <tr>
                <th colspan="8" class="text-center bg-light tx-15"><b>Exam Hall Ticket (Academic Session : {{$data->SessionName()}})</b></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><b>Class/Course</b></td><td><b>:</b></td><td>{{$data->course->course}}</td>
                <td><b>Section</b></td><td><b>:</b></td><td>{{$data->section->section}}</td>
                <td rowspan="4" class="wd-100 text-center"><div class="avatar bd-3 bd avatar-xxl"><img src="{{$data->ProfileImage()}}" class="rounded-circle" alt=""></div></td>
                <td rowspan="6" class="wd-30p bd bd-1 p-1 m-0" style="vertical-align:top;">
                    <table class="table-receipt table-bordered">
                        <thead class="bg-light">
                        <tr>
                            <th colspan="2" class="text-center tx-14"><b>Exam Datesheet</b></th>
                        </tr>
                        <tr>
                            <th>Subject</th>
                            <th>Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td colspan="2" class="text-center"><b>Exam Datesheet No Found!</b></td>
                        </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td><b>Admission No.</b></td><td><b>:</b></td><td>{{$data->admission_no}}</td>
                <td><b>Academic Session</b></td><td><b>:</b></td><td>{{$data->SessionName()}}</td>
            </tr>
            <tr>
                <td><b>Student Name</b></td><td><b>:</b></td><td>{{$data->fullName()}}</td>
                <td><b>Date of Birth</b></td><td><b>:</b></td><td>@if($data->dob()){{nowdate($data->dob(),'d-M-Y')}}@endif</td>
            </tr>
            <tr>
                <td><b>Father Name</b></td><td><b>:</b></td><td>{{$data->FatherName()}}</td>
                <td><b>Contact No.</b></td><td><b>:</b></td><td>{{$data->student->contact_no}}</td>
            </tr>
            <tr>
                <td><b>Address</b></td><td><b>:</b></td><td colspan="5">{{$data->Address()}}</td>
            </tr>
            <tr>
                <td colspan="2" class="ht-80 text-center align-bottom" ><b>Guardian Signature</b></td>
                <td colspan="2" class="ht-80 bd-1 bd-l text-center align-bottom" ><b>Teacher Signature</b></td>
                <td colspan="3" class="ht-80 bd-1 bd-l text-center align-bottom" ><b>Principal Signature</b></td>
            </tr>
            </tbody>
        </table>
    </div>
    @if($row==3)
        @php $row=0; @endphp
    <h1></h1>
    @endif
@endforeach
