@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Global Setting</li>
            <li class="breadcrumb-item active" aria-current="page">Subject Map With Course</li>
        </ol>
    </nav>
    <form action="{{url('MasterAdmin/GlobalSetting/CreateSubjectMapWithCourse')}}" method="POST" enctype="multipart/form-data">
        {{csrf_field()}}
    <div class="col-lg-12 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-sitemap"></i> Subject Map with Course</b></div>
            <div class="panel-body pd-b-0 row">
                <div class="col-lg-10">
                <table class="table mg-10 table-bordered">
                    <thead class="bg-light">
                    <tr>
                        <td class="text-center"><input type="checkbox" class="CheckAll" value="checkbox1" checked></td>
                        <td><b>Course</b></td>
                        <td><b>Subject</b></td>
                    </tr>
                    </thead>
                    @foreach($coursesection as $data)
                        @foreach($data->sections as $data1)

                        @php
                            $subjectwithcoursedata=collect($subjectwithcourse)->where('course_id',$data->id)->where('section_id',$data1->id)->pluck('subject_id')->toArray();
                        @endphp
                    <tr>
                        <td class="text-center"><input type="checkbox" name="course[]" class="checkbox1" value="{{$data->id."@".$data1->id}}" checked></td>
                        <td class="wd-10p"><b>{{$data->course}} - {{$data1->section}}</b></td>
                        <td>
                            @foreach($subject as $data2)
                                <span class="pd-3 pd-l-5 pd-r-10 bd bd-1 rounded-5"><input name="subject_{{$data->id}}_{{$data1->id}}_id[]" value="{{$data2->id}}" @if(in_array($data2->id,$subjectwithcoursedata)) checked @endif type="checkbox"> {{$data2->subject_name}}</span>
                            @endforeach
                        </td>
                    </tr>
                        @endforeach
                    @endforeach
                </table>
                </div>
                <div class="col-lg-2">
                    <button class="btn btn-primary btn-lg btn-block mg-t-10"><i class="fa fa-check"></i> Submit</button>
                    <a href="{{url('MasterAdmin/GlobalSetting/RemoveSubjectMapWithCourse')}}">
                    <button type="button" class="btn btn-danger btn-lg btn-block mg-t-10"><i class="fa fa-trash"></i> Remove</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
    </form>
@endsection
