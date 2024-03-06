@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Finance</li>
            <li class="breadcrumb-item active" aria-current="page">Student Assign Account Ledger</li>
        </ol>
    </nav>
    <div class="col-lg-12 p-0 m-0 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-plus"></i> Student Assign Concession</b></div>
            <div class="panel-body pd-b-0 row">
                <form  class="container-fluid" action="{{url('MasterAdmin/Finance/StudentAssignConcession')}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                    <div class="col-lg-12 pd-b-15 pd-l-0 pd-r-0 pd-t-10 m-0 row">
                        <div class="col-lg-2">
                            <label><b>Class/Course :</b></label>
                            @include('components.course-import',['selectid'=>request()->get('course_id')])
                        </div>
                        <div class="col-lg-1 pd-l-0 pd-r-0">
                            <label><b>Section  :</b></label>
                            @include('components.section-import',['selectid'=>request()->get('section_id')])
                        </div>
                        <div class="col-lg-3">
                            <label><b>Student Group By List :</b></label>
                            <table>
                                <tr>
                                    <td><input type="checkbox" name="father_group" value="yes" @if(request()->get('father_group')=="yes") checked @endif @if(!request()->get('father_group')) checked @endif></td><td class="pd-l-5">Father Name</td>
                                    <td class="pd-l-5"><input name="mother_group" value="yes" type="checkbox"  @if(request()->get('mother_group')=="yes") checked @endif></td><td class="pd-l-5">Mother Name</td>
                                    <td class="pd-l-5"><input name="contact_group" value="yes" type="checkbox" @if(request()->get('contact_group')=="yes") checked @endif @if(!request()->get('contact_group')) checked @endif></td><td class="pd-l-5">Mobile No.</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-lg-2">
                            <label><b>Sibling Wise List :</b></label>
                            <table>
                                <tr>
                                    <td><input type="radio" name="sibling_group" value="yes" ></td><td class="pd-l-5">Yes</td>
                                    <td class="pd-l-10"><input type="radio" name="sibling_group" value="no" checked></td><td class="pd-l-5">No</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-lg-2 pd-l-0 pd-r-10">
                            <label>Import File <span class="text-gray">(Optional)</span> :</label>
                            <input type="file" name="import_file" class="form-control input-sm">
                        </div>
                        <div class="col-lg-1 p-0">
                            <button class="btn mg-t-15 wd-100 btn-primary">Continue <i class="fa fa-angle-right"></i></button>
                        </div>
                        <div class="col-lg-12 pd-t-10">
                            <a href="{{url('ImportFileFormat/StudentConcession.xlsx')}}" loader-disable="true" download="" target="_blank" class="text-danger"><b><u><i class="fa fa-file-excel"></i> Download Student Concession File Format</u></b></a>
                        </div>
                    </div>
                </form>


                @if(request()->get('_token'))
                    <form class="container-fluid" action="{{url('MasterAdmin/Finance/CreateStudentAssignConcession')}}" method="POST">
                      {{csrf_field()}}
                        <div class="col-lg-12 pd-b-15 pd-t-15 pd-l-0 pd-r-0 m-0 bd-1 bd-t row">
                            <div class="col-lg-10 pd-l-0">
                                <table class="table table-bordered bd bd-1">
                                    <thead class="bg-light">
                                    <tr>
                                        <th class="text-center"><input type="checkbox" class="CheckAll" value="checkbox1"></th>
                                        <th class="text-center">Admission No.</th>
                                        <th>Student Name</th>
                                        <th>Course - Section</th>
                                        <th>Father Name</th>
                                        <th>Mother Name</th>
                                        <th>Contact No.</th>
                                        <th class="wd-20p">Address</th>
                                        <th class="text-center">Concession Type</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($studentgroup as $group=>$student)
                                        <tr class="bg-primary-light">
                                            <td colspan="9"><b>Group By : </b> {{$group}}</td>
                                        </tr>
                                        @foreach($student as $data)
                                            @php
                                                $select="id";
                                                $concession=$data->fee_concession_id;
                                                if(count($importdata)){
                                                $result=collect($importdata)->where('admission_no',$data->admission_no)->shift();
                                                if(isset($result['fee_concession'])){
                                                $concession=$result['fee_concession'];
                                                $select="concession_type";
                                                }
                                                }
                                            @endphp
                                            <tr>
                                                <td class="text-center"><input type="checkbox" name="student_id[]"  class="checkbox1"  value="{{$data->id}}" @if(isset($result['admission_no'])) checked @endif></td>
                                                <td class="text-center">{{$data->admission_no}}</td>
                                                <td>{{$data->fullName()}}</td>
                                                <td class="text-center">{{$data->CourseSection()}}</td>
                                                <td>{{$data->FatherName()}}</td>
                                                <td>{{$data->MotherName()}}</td>
                                                <td>{{$data->student->contact_no}}</td>
                                                <td>{{$data->Address()}}</td>
                                                <td class="text-center">
                                                @include('components.Finance.concession-type-import',['name'=>'student_'.$data->id.'_concession_type_id','selectid'=>$concession,'select'=>$select])
                                                 </td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="col-lg-2 pd-r-0">
                                <button type="submit" class="btn btn-block btn-primary btn-lg"><i class="fa fa-check"></i> Assign</button>
                            </div>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection
