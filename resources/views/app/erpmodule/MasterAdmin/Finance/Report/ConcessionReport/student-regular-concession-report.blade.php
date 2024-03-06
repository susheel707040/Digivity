@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">Finance/Account</li>
            <li class="breadcrumb-item" aria-current="page">Reports</li>
            <li class="breadcrumb-item active" aria-current="page">Student Regular Concession Report</li>
        </ol>
    </nav>

    <div class="col-lg-12 p-0 m-0 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i> Student Regular Concession Report</b></div>
            <div class="panel-body pd-b-10 row">

                <div class="col-lg-12 row pd-l-0 pd-r-0 m-0">
                    <div class="col-lg-2">
                        <label>Class/Course</label>
                        @include('components.course-import')
                    </div>
                    <div class="col-lg-2">
                        <label>Section</label>
                        @include('components.section-import')
                    </div>
                    <div class="col-lg-2">
                        <label>Concession Type</label>
                        @include('components.Finance.concession-type-import')
                    </div>
                    <div class="col-lg-2">
                        <button type="submit" class="btn btn-primary mg-t-20"><i class="fa fa-search"></i> Get Result</button>
                    </div>
                </div>

                <div class="col-lg-12 row mg-l-0 mg-r-0 bd-t bf-1 mg-t-20">
                    <div class="col-lg-12 pd-r-0 text-right">@include('layouts.actionbutton.action-button-verticle')</div>
                    <div class="col-lg-12 pd-r-0 pd-l-0">
                    <table id="example2" class="table datatable table-bordered mg-t-10">
                        <thead class="bg-light">
                        <tr>
                            <th class="text-center">Sl.No.</th>
                            <th class="text-center">Adm. No.</th>
                            <th class="text-center">Class/Course</th>
                            <th>Student Name</th>
                            <th>Father</th>
                            <th>Contact No.</th>
                            <th>Concession Type/Name</th>
                            <th class="text-center col-hide">Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($student as $data)
                        <tr>
                            <td class="text-center">{{$loop->iteration}}</td>
                            <td class="text-center">{{$data->admission_no}}</td>
                            <td class="text-center">{{$data->CourseSection()}}</td>
                            <td>{{$data->fullName()}}</td>
                            <td>{{$data->FatherName()}}</td>
                            <td>{{$data->student->contact_no}}</td>
                            <td>{{$data->ConcessionName()}}</td>
                            <td class="text-center col-hide">
                                <a href="" class="text-danger"><i class="fa fa-trash"></i> Remove</a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>

                    </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
