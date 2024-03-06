@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="{{url('/home')}}">Dashboard</a></li>
            <li class="breadcrumb-item " aria-current="page">Student Information</li>
            <li class="breadcrumb-item " aria-current="page">Reports</li>
            <li class="breadcrumb-item active" aria-current="page">Student Document Submitted Report</li>
        </ol>
    </nav>
    <div class="col-lg-12 p-0 m-0">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i> Student Document Submitted Report</b></div>
            <div class="panel-body pd-b-0 row">
                <form action="" method="POST" enctype="multipart/form-data" data-parsley-validate="" novalidate="">
                    {{csrf_field()}}
                    <div class="col-lg-12 pd-t-10 pd-b-10 row m-0">
                        <div class="col-lg-1 pd-l-0 pd-r-0">
                            <label><b>Admission No. :</b></label>
                            <input type="text" autocomplete="off" placeholder="Admission No." value="{{request()->get('admission_no')}}" name="admission_no" class="form-control">
                        </div>
                        <div class="col-lg-2 pd-l-5 pd-r-5">
                            <label><b>Course :</b></label>
                            @include('components.course-import',['selectid'=>request()->get('course_id')])
                        </div>
                        <div class="col-lg-1 pd-l-5 pd-r-0">
                            <label><b>Section :</b></label>
                            @include('components.section-import',['selectid'=>request()->get('section_id')])
                        </div>
                        <div class="col-lg-3">
                            <label><b>Order By :</b></label>
                            @include('components.student-sort-by',['class'=>'form-control input-sm','id'=>'sortby','name'=>'sortby','required'=>'','selectid'=>request()->get('sortby'),'other'=>0])
                        </div>
                        <div class="col-lg-2">
                            <label><b>Document Attachment :</b></label>
                            @include('components.GlobalSetting.student-document-attachment-import',['selectid'=>request()->get('document_id')])
                        </div>
                        <div class="col-lg-2 pd-l-5 pd-r-0">
                            <button type="submit" class="btn mg-t-20 btn-primary"><i class="fa fa-search"></i> Get Result</button>
                        </div>
                    </div>
                </form>
                @if(request()->get('_token'))
                    <div class="col-lg-12 p-0 bd-1 bd-t pd-t-10 pd-b-10 row m-0">
                        <div class="col-lg-12 pd-l-0 pd-r-0"><span class="float-right">@include('layouts.actionbutton.action-button-verticle')</span></div>
                        <table class="table datatable table-bordered bd-1 bd mg-t-5">
                            <thead class="bg-light">
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Admission No.</th>
                                <th>Course - Section</th>
                                <th>Student Name</th>
                                <th>Father's Name</th>
                                @foreach($document as $data1)
                                    <th class="text-center">{{$data1->document_type}}</th>
                                @endforeach
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($student as $data)
                                <tr>
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td class="text-center">{{$data->admission_no}}</td>
                                    <td>{{$data->CourseSection()}}</td>
                                    <td>{{$data->FullName()}}</td>
                                    <td>{{$data->FatherName()}}</td>
                                    @php
                                        $documentsubmit=[];
                                        try {
                                        $documentsubmit=collect($data->documentsubmit)->pluck('document_id')->toArray();
                                        }catch (\Exception $e){}
                                    @endphp

                                    @foreach($document as $data1)
                                        <td class="text-center">
                                            @if(in_array($data1->id,$documentsubmit))
                                            <span class="badge-success badge">Yes</span>
                                            @else
                                            <span class="badge-danger badge">No</span>
                                            @endif
                                        </td>
                                    @endforeach
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
