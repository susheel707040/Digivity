@extends('layouts.MasterLayout')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Certificate</li>
            <li class="breadcrumb-item active" aria-current="page">Certificate Reports</li>
        </ol>
    </nav>

    <div class="col-lg-12 pd-l-0 pd-r-0 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i>Certificate Reports</b></div>
            <div class="panel-body pd-b-0 row">
                <form action="" method="POST">
                    {{csrf_field()}}
                <div class="col-lg-12 pd-l-0 pd-b-20 row m-0">
                    <div class="col-lg-2">
                        <label>Certificate No. :</label>
                        <input type="text" name="certificate_no" value="{{request()->get('certificate_no')}}" placeholder="Enter Certificate No." class="form-control1">
                    </div>
                    <div class="col-lg-2">
                        <label>Certificate Issue From Date :</label>
                        <input type="text" placeholder="dd-mm-yyyy" class="form-control1 date">
                    </div>
                    <div class="col-lg-2">
                        <label>Certificate Issue To Date :</label>
                        <input type="text" placeholder="dd-mm-yyyy" class="form-control1 date">
                    </div>
                    <div class="col-lg-3">
                        <label>Certificate :</label>
                        @include('component.GlobalSetting.Certificate.certificate-import',['selectid'=>request()->get('certificate_id')])
                    </div>
                    <div class="col-lg-1">
                        <label>Status :</label>
                        <select class="form-control1">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                    <div class="clearfix col-lg-12"></div>
                    <div class="col-lg-2">
                        <label>Class/Course :</label>
                        @include('component.course-import',['selectid'=>request()->get('course_id')])
                    </div>
                    <div class="col-lg-2">
                        <label>Section :</label>
                        @include('component.section-import',['selectid'=>request()->get('section_id')])
                    </div>
                    <div class="col-lg-2">
                        <label>Admission No. :</label>
                        <input type="text" name="admission_no" autocomplete="off" value="{{request()->get('admission_no')}}" placeholder="Enter Admission No." class="form-control1">
                    </div>
                    <div class="col-lg-4">
                        <label>Student :</label>
                        @include('component.student-list-import',['selectid'=>request()->get('student_id')])
                    </div>
                    <div class="col-lg-2">
                        <button type="submit" class="btn btn-primary mg-t-20"><i class="fa fa-search"></i> Get Result</button>
                    </div>
                </div>
                </form>


                <div class="col-lg-12 pd-l-0 bd-1 bd-t pd-b-20 row m-0">
                    <table class="table table-bordered mg-t-10">
                        <thead class="bg-light">
                        <tr>
                            <th class="text-center"><input type="checkbox"></th>
                            <th>Sl.No.</th>
                            <th class="text-center">Admission No.</th>
                            <th class="text-center">Class/Course-Section</th>
                            <th>Student</th>
                            <th>Father Name</th>
                            <th>Contact No.</th>
                            <th class="text-center">Certificate No.</th>
                            <th class="text-center">Certificate Issue Date</th>
                            <th>Issue Certificate</th>
                            <th class="text-center">Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($certificate as $data)

                        <tr>
                            <td class="text-center"><input type="checkbox"></td>
                            <td class="text-center">{{$loop->iteration}}</td>
                            <td class="text-center">@if(isset($data->student->admission_no)) {{$data->student->admission_no}} @endif</td>
                            <td class="text-center">@if(isset($data->student)) {{$data->student->CourseSection()}} @endif</td>
                            <td>@if(isset($data->student)) {{$data->student->fullName()}} @endif</td>
                            <td>@if(isset($data->student)) {{$data->student->FatherName()}} @endif</td>
                            <td>@if(isset($data->student->student->contact_no)) {{$data->student->student->contact_no}} @endif</td>
                            <td class="text-center">{{$data->certificate_no}}</td>
                            <td class="text-center">@if(isset($data->issue_date)) {{nowdate($data->issue_date,'d-M-Y')}} @endif</td>
                            <td><span class="badge badge-success">{{$data->CertificateName()}}</span></td>
                            <td>
                                <div class="container-fluid col-hide dropdown pd-t-3 pd-b-3 text-right">
                                    <button class="badge container-fluid pd-t-7 pd-b-7 border-primary tx-11 dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Quick Action</button>
                                    <div class="dropdown-menu bg-light dropdown-menu-right shadow-lg tx-12" x-placement="bottom-start" style="position:absolute; will-change: transform; top: 0px; left: 0;  transform: translate3d(0px, 25px, 0px);">
                                        <a target="_blank" loader-disable="true" href="{{url('MasterAdmin/Certificate/StudentCertificate/'.$data->id.'/edit')}}"><li class="dropdown-item" url=""><i class="fa fa-edit"></i> Edit Detail</li></a>
                                        <a target="_blank" loader-disable="true" href="{{url('MasterAdmin/Certificate/StudentCertificate/'.$data->id.'/print')}}"><li class="dropdown-item" url=""><i class="fa fa-print"></i> Print Certificate</li></a>
                                        <a target="_blank" loader-disable="true" href="{{url('MasterAdmin/Certificate/CertificateView/'.$data->id.'/preview')}}"><li class="dropdown-item" url=""><i class="fa fa-file"></i> Preview Certificate</li></a>
                                        <a target="_blank" loader-disable="true" href="{{url('MasterAdmin/Certificate/StudentCertificate/'.$data->id.'/pdf')}}"><li class="dropdown-item" url=""><i class="fa fa-file-pdf"></i> Download Pdf</li></a>
                                        <a target="_blank" class="tx-danger" loader-disable="true" href="{{url('MasterAdmin/Certificate/StudentCertificate/'.$data->id.'/remove')}}"><li class="dropdown-item text-danger" url=""><i class="fa fa-trash"></i> Remove</li></a>
                                    </div>
                                </div>
                        </tr>
                        @endforeach
                        </tbody>

                    </table>
                </div>


            </div>
        </div>
    </div>
@endsection
