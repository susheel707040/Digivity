@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="{{url('/home')}}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{url('/MasterAdmin/StudentInformation/index')}}">Student Information</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Student Generate Certificate</li>
        </ol>
    </nav>

    <div class="col-lg-12 p-0 m-0">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-certificate"></i> Student Generate Certificate</b></div>
            <div class="panel-body tx-12 pd-b-15 row">
            <form action="{{url('/MasterAdmin/StudentInformation/GenerateCertificate')}}" method="POST">
             {{csrf_field()}}
            <div class="col-lg-12 row p-0 m-0">
                <div class="col-lg-2">
                    <label>Class/Course :</label>
                    @include('component.course-import',['class'=>'form-control','selectid'=>request()->get('course_id')])
                </div>
                <div class="col-lg-1 pd-l-0 pd-r-0">
                    <label>Section :</label>
                    @include('component.section-import',['class'=>'form-control','selectid'=>request()->get('section_id')])
                </div>
                <div class="col-lg-2">
                    <label>Admission No. :</label>
                <input type="text" name="admission_no" value="{{request()->get('admission_no')}}" placeholder="Admission No." class="form-control">
                </div>
                <div class="col-lg-3">
                    <label>Student :</label>
                    @include('component.student-list-import',['class'=>'form-control select-search','selectid'=>request()->get('student_id')])
                </div>
                <div class="col-lg-2">
                    <label>Certificate :</label>
                    @include('component.GlobalSetting.Certificate.certificate-import',['class'=>'form-control','selectid'=>request()->get('certificate_id'),'required'=>'required'])
                </div>
                <div class="col-lg-2">
                    <button type="submit" class="btn btn-primary rounded-50 mg-t-20">Continue <i class="fa fa-arrow-right"></i></button>
                </div>
                <div class="col-lg-12"><span class="text-primary"><u><i class="fa fa-search"></i> Advance Search</u></span></div>
                </div>
            </form>

             @if(request()->get('_token'))
             <div class="col-lg-12 bd-t mg-t-5 bd-1">
                 <table id="example2" class="table table-bordered mg-t-5 tx-11">
                     <thead class="bg-light">
                     <tr>
                         <th class="text-center">S.No.</th>
                         <th class="text-center">Admission No.</th>
                         <th>Class/Course</th>
                         <th>Student Name</th>
                         <th>Father</th>
                         <th>Contact No.</th>
                         <th class="text-center">Generate Certificate History</th>
                         <th class="text-center">Generate Certificate</th>
                     </tr>
                     </thead>

                     <tbody>
                     @foreach($student as $data)
                     <tr>
                         <td class="text-center">{{$loop->iteration}}</td>
                         <td class="text-center ">{{$data->admission_no}}</td>
                         <td>{{$data->CourseSection()}}</td>
                         <td>{{$data->fullName()}}</td>
                         <td>{{$data->FatherName()}}</td>
                         <td>{{$data->student->contact_no}}</td>
                         <td></td>
                         <td class="text-center">
                             @if(isset($certificate))
                             <a target="_blank" loader-disable="true" href="{{url('/MasterAdmin/StudentInformation/GenerateCertificate/'.$data->id.'/'.$certificate->id.'/preview')}}"><button type="button" class="btn btn-sm btn-warning"><i class="fa fa-certificate"></i> Generate  {{$certificate->certificate_name}} </button></a>
                             @endif
                         </td>
                     </tr>
                     @endforeach
                     </tbody>
                 </table>
             </div>
                 @endif
             </div>
        </div>
    </div>




@endsection
