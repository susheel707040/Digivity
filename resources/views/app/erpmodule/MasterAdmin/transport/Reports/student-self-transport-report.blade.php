@extends('layouts.MasterLayout')
@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="#">Transport</a></li>
            <li class="breadcrumb-item active" aria-current="page">Student Self/Without Transport Report</li>
        </ol>
    </nav>

    <div class="col-lg-12 p-0 m-0">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i> Student Self/Without Transport Report</b></div>
            <div class="panel-body p-0 m-0 row">
                <form action="{{url('MasterAdmin/Transport/StudentSelfTransportReport')}}" method="POST">
                {{csrf_field()}}
                    <div class="col-lg-12 row pd-b-10">
                    <div class="col-lg-2 pd-r-5">
                       <label>Class/Course :</label>
                        @include('components.course-import',['selectid'=>request()->get('course_id')])
                    </div>
                    <div class="col-lg-2 p-l-5 pd-r-5">
                        <label>Section :</label>
                        @include('components.section-import',['selectid'=>request()->get('section_id')])
                    </div>
                    <div class="col-lg-2 p-l-5 pd-r-5">
                        <label>Is New Status :</label>
                        @include('components.GlobalSetting.is-new-status',['selectnull'=>1,'selectid'=>request()->get('is_new')])
                    </div>
                    <div class="col-lg-2 p-l-5 pd-r-5">
                        <label>Residence Address :</label>
                        <input type="text" name="residence_address" value="{{request()->get('residence_address')}}" placeholder="Enter Address" class="form-control">
                    </div>
                    <div class="col-lg-2 p-l-5 pd-r-5">
                        <button class="btn btn-primary rounded-50 mg-t-20"><i class="fa fa-search"></i> Get Result</button>
                    </div>
                    <div class="col-lg-12"><u class="text-primary"><span><i class="fa fa-search"></i> Advance Search</span></u></div>
                </div>
                </form>

                <div class="col-lg-12 row m-0 pd-b-10 bd-t bd-1">
                    <div class="col-lg-12 p-0 m-0 text-right">
                        @include('layouts.actionbutton.action-button-verticle',['sms'=>1])
                    </div>
                 <table id="example2" class="table table-bordered tx-11 mg-t-10">
                     <thead class="bg-light">
                     <tr>
                         <th class="text-center">S.No.</th>
                         <th class="text-center"><input type="checkbox"></th>
                         <th class="text-center">Admission No.</th>
                         <th class="text-center">Class/Course</th>
                         <th>Student Name</th>
                         <th>Gender</th>
                         <th>Father</th>
                         <th>Mother</th>
                         <th>Contact No.</th>
                         <th>Address</th>
                         <th class="text-center">Is New Status</th>
                         <th class="text-center">Action</th>
                     </tr>
                     </thead>

                     <tbody>
                     @foreach($student as $data)
                     <tr>
                         <td class="text-center">{{$loop->iteration}}</td>
                         <td class="text-center"><input type="checkbox"></td>
                         <td class="text-center">{{$data->admission_no}}</td>
                         <td class="text-center">{{$data->CourseSection()}}</td>
                         <td>{{$data->fullName()}}</td>
                         <td>{{ucwords($data->student->gender)}}</td>
                         <td>{{$data->FatherName()}}</td>
                         <td>{{$data->MotherName()}}</td>
                         <td>{{$data->student->contact_no}}</td>
                         <td>{{$data->Address()}}</td>
                         <td class="text-center">@if($data->is_new=="new") <span class="badge badge-success">New</span> @elseif($data->is_new=="old") <span class="badge badge-warning">Old</span> @else <span class="badge badge-warning">{{ucwords($data->is_new)}}</span> @endif</td>
                         <td></td>
                     </tr>
                     @endforeach
                     </tbody>


                 </table>
                </div>

            </div>
        </div>
    </div>

@endsection
