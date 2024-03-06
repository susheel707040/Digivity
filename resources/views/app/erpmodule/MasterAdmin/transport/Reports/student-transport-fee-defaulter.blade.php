@extends('layouts.MasterLayout')
@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="#">Transport</a></li>
            <li class="breadcrumb-item active" aria-current="page">Student Transport Fee Defaulter Report</li>
        </ol>
    </nav>

    <div class="col-lg-12 p-0 m-0">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i> Student Transport Fee Defaulter Report</b></div>
            <div class="panel-body p-0 m-0 row">
                <div class="col-lg-12 row m-0 pd-b-15 pd-l-0 pd-r-0">
                 <div class="col-lg-2">
                     <label>Class/Course :</label>
                     @include('components.course-import',['selectid'=>request()->get('course_id')])
                 </div>
                 <div class="col-lg-2">
                    <label>Section :</label>
                    @include('components.section-import',['selectid'=>request()->get('section_id')])
                 </div>
                </div>
            </div>
        </div>
    </div>

@endsection
