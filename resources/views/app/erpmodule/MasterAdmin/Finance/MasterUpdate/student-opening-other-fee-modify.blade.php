@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item " aria-current="page">Finance</li>
            <li class="breadcrumb-item " >Master Update</li>
            <li class="breadcrumb-item active" aria-current="page">Student Opening & Other Fee Modify</li>
        </ol>
    </nav>

    <div class="col-lg-12 p-0 m-0 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-edit"></i> Student Opening & Other Fee Modify</b></div>
            <div class="panel-body pd-b-0 row">
                <form class="col-lg-12 m-0 p-0" action="{{url('MasterAdmin/Finance/form-control')}}" method="POST">
                 {{csrf_field()}}
                <div class="col-lg-12 pd-b-20 pd-l-0 pd-r-0 row m-0">
                    <div class="col-lg-2">
                        <label>Class/Course :</label>
                        @include('components.course-import',['selectid'=>request()->get('course_id')])
                    </div>
                    <div class="col-lg-2">
                        <label>Admission No. :</label>
                        <input type="text" class="form-control" autocomplete="off" name="admission_no" placeholder="Enter Admission No.">
                    </div>
                    <div class="col-lg-4">
                        <label>Student :</label>
                        @include('components.student-list-import',['selectid'=>request()->get('student_id')])
                    </div>
                    <div class="col-lg-2">
                        <button class="btn btn-primary mg-t-20"><i class="fa fa-search"></i> Get Result</button>
                    </div>
                </div>
                </form>

                @if(request()->get('_token'))
                <div class="col-lg-12 row m-0 bd-1 bd-t">
                    <div class="col-lg-10 pd-l-0">
                        <table class="table table-bordered mg-t-10">
                            <thead class="bg-light">
                            <tr>
                                <th>Sl.No.</th>
                                <th><input type="checkbox" name="structure_id[]" value=""></th>
                                <th>Fee Head</th>
                                <th>Instalment</th>
                                <th>Fee Amount</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="col-lg-2 pd-r-0">
                        <button type="submit" class="btn btn-primary btn-lg btn-block mg-t-10"><i class="fa fa-edit"></i>Update</button>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection
