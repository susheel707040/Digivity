@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">Finance/Account</li>
            <li class="breadcrumb-item" aria-current="page">Reports</li>
            <li class="breadcrumb-item active" aria-current="page">Student Fee Collection Ledger Report</li>
        </ol>
    </nav>

    <div class="col-lg-12  p-0 m-0 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i> Student Fee Collection Ledger Report</b></div>
            <div class="panel-body tx-11 pd-b-5 row">
                <div class="col-lg-12 pd-l-0 pd-r-0 pd-b-10 row m-0">
                    <div class="col-lg-2 pd-l-5 pd-r-5">
                        <label>Class/Course :</label>
                        @include('components.course-import',['selectid'=>request()->get('course_id')])
                    </div>
                    <div class="col-lg-2 pd-l-5 pd-r-5">
                        <label>Section :</label>
                        @include('components.section-import',['selectid'=>request()->get('section_id')])
                    </div>
                    <div class="col-lg-2 pd-l-5 pd-r-5">
                        <label><b>Fee Head :</b></label>
                        @include('components.Finance.fee-head-import',['selectid'=>request()->get('fee_head_id'),'search'=>['type'=>'opening-balance']])
                    </div>
                    <div class="col-lg-2 pd-l-5 pd-r-5">
                        <button type="submit" class="btn btn-primary rounded-50 mg-t-20"><i class="fa fa-search"></i> Get Result</button>
                    </div>
                </div>


                <div class="col-lg-12 p-0 m-0 bd-1 bd-t">
                    <table class="table table-bordered mg-t-10">
                        <thead class="bg-light">
                        <tr>
                            <th colspan="5">Student Details</th>
                            @foreach($feehead as $data1)
                            <th>{{$data1->fee_head}}</th>
                            @endforeach
                        </tr>
                        <tr>
                            <th>Sl.No</th>
                            <th>Adm. No</th>
                            <th>Class/Course</th>
                            <th>Student</th>
                            <th>Father</th>
                            <!--fee head-->
                            @foreach($feehead as $data1)
                                <th></th>
                            @endforeach
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($student as $data)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$data->admission_no}}</td>
                            <td>{{$data->CourseSection()}}</td>
                            <td>{{$data->fullName()}}</td>
                            <td>{{$data->FatherName()}}</td>

                            <!--fee head-->
                            @foreach($feehead as $data1)
                                <td></td>
                            @endforeach

                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>


@endsection
