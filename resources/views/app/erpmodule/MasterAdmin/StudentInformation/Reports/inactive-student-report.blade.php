@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Student Information</li>
            <li class="breadcrumb-item active" aria-current="page">Reports</li>
            <li class="breadcrumb-item active" aria-current="page">Inactive Student Details</li>
        </ol>
    </nav>


    <div class="col-lg-12 p-0 m-0">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i> Student Credentials Report</b></div>
            <div class="panel-body pd-b-0 row">
                <form class="container-fluid" action="{{url('MasterAdmin/StudentInformation/InactiveStudentList')}}" method="POST">
                    {{csrf_field()}}
                    <div class="col-lg-12 row m-0 pd-l-0 pd-r-0 pd-b-15">
                        <div class="col-lg-2 pd-l-0 pd-r-5">
                            <label>Admission No. :</label>
                            <input type="text" value="{{request()->get('pros_no')}}" name="pros_no" autocomplete="off" class="form-control input-sm" placeholder="Admission No.">
                        </div>
                        <div class="col-lg-1 pd-l-5 pd-r-5 mg-r-25">
                            <label>Class/Course :</label>
                            @include('components.course-import',['selectid'=>request()->get('course_id')])
                        </div>
                        <div class="col-lg-1 pd-l-5 pd-r-5 mg-r-65">
                            <label>Section :</label>
                            @include('components.section-import',['selectid'=>request()->get('section_id')])
                        </div>
                        <div class="col-lg-1 pd-l-5 pd-r-5 mg-r-25">
                            <label>Is New :</label>
                            @include('components.GlobalSetting.is-new-status',['selectid'=>request()->get('is_new'),'selectnull'=>1])
                        </div>
                        <div class="col-lg-1 pd-l-0 pd-r-5 mg-r-50">
                            <label>Username :</label>
                            <input type="text" value="{{request()->get('username')}}" name="username" autocomplete="off" class="form-control" placeholder="Username">
                        </div>
                        <div class="col-lg-2 pd-l-0 pd-r-5">
                            <label>Student Name :</label>
                            <input type="text" value="{{request()->get('student_name')}}" name="student_name" autocomplete="off" class="form-control" placeholder="Enter Student Name">
                        </div>
                        <div class="col-lg-2 pd-l-0 pd-r-5">
                            <label>Contact No. :</label>
                            <input type="text" value="{{request()->get('contact_no')}}" name="contact_no" autocomplete="off" class="form-control" placeholder="Enter Contact No.">
                        </div>
                        <div class="col-lg-2 pd-l-5 pd-r-5" style="margin-left:590px">
                            <button type="submit" class="btn btn-primary btn-xs mg-t-20 rounded-5"><i class="fa fa-search"></i> Get Result</button>
                        </div>
                    </div>
                </form>


                    <div class="col-lg-12 bd-t bd-1 pd-t-10 pd-l-0 pd-r-0"><span class="float-right">@include('layouts.actionbutton.action-button-verticle')</span></div>
                    <div class="col-lg-12 pd-l-0 pd-r-0 ">
                        <table id="example2" class="table datatable table-bordered tx-11">
                            <thead class="bg-light">
                            <tr>
                                <th class="text-center"><input type="checkbox" class="CheckAll" value="checkbox1"></th>
                                <th class="text-center">Sl.No.</th>
                                <th class="text-center">Admission Date</th>
                                <th class="text-center">Admission No.</th>
                                <th>Class/Course</th>
                                <th>Student Name</th>
                                <th>Father Name</th>
                                <th>Contact No.</th>
                                <th>Residence Address</th>
                                <th>Inactive Date</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($student as $data)
                                <tr class="student-id-{{$data->id}}">
                                    <td class="text-center"><input type="checkbox" class="checkbox1" value="{{$data->student_id}}"></td>
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td class="text-center">{{nowdate($data->student->admission_date,'d-M-Y')}}</td>
                                    <td class="text-center">{{$data->admission_no}}</td>
                                    <td>{{$data->CourseSection()}}</td>
                                    <td>{{$data->fullName()}}</td>
                                    <td>{{$data->FatherName()}}</td>
                                    <td>{!! \App\Helper\MobileNumberValidate::validate($data->student->contact_no) !!}</td>
                                    <td class="wd-20p">{{$data->student->residence_address}}</td>
                                    <td>@if(isset($data->inactive_date)){{nowdate($data->inactive_date,'d-m-Y')}}@endif</td>
                                    <td class="text-center"><button url="{{url('MasterAdmin/StudentInformation/StudentAccount/'.$data->id.'/active')}}" model-title="Student Account Status Update" model-class="" model-title-info="Student Account Status Active Update" class="btn btn-success btn-sm custom-model-btn"><i class="fa fa-check"></i> Update </button></td>
                                </tr>
                            @endforeach
                         </tbody>
                    </table>
                 </div>
            </div>
        </div>
    </div>
@endsection
