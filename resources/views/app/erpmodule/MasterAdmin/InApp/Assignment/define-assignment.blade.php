@extends('layouts.MasterLayout')
@section('ModelTitle','Add Assignment')
@section('ModelSize','modal-xl')
@section('ModelTitleInfo','Assignment For Student Class Wise')
@section('EditModelTitle','Edit Assignment')
@section('EditModelTitleInfo','Modify Assignment')
@section('filepath','storage/assignment/')
@section('AddModelPage')
    @include('app.erpmodule.MasterAdmin.InApp.Assignment.Add.add-assignment')
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">InApp</li>
            <li class="breadcrumb-item active" aria-current="page">Notice</li>
        </ol>
    </nav>

    <div class="col-lg-12 p-0 m-0 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i> Notice</b></div>
            <div class="panel-body pd-b-10 row">
                <div class="col-lg-12 pd-t-15 pd-b-15 row m-0">
                    <div class="col-lg-2">
                        <label><b>Assignment For <sup>*</sup> :</b></label>
                        <table>
                            <tr>
                                <td><input type="radio" name="type" class="all" checked></td><td class="pd-l-5">All Student</td>
                                <td class="pd-l-10"><input type="radio" name="type"  class="all"></td><td class="pd-l-5">Student</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-lg-2">
                        <label><b>Course <sup>*</sup>:</b></label>
                        @include('components.course-import',['selectid'=>request()->get('course_id'),'required'=>'required'])
                    </div>
                    <div class="col-lg-2">
                        <label><b>Section <sup>*</sup>:</b></label>
                        @include('components.section-import',['selectid'=>request()->get('section_id'),'required'=>'required'])
                    </div>
                    <div class="col-lg-2">
                        <label><b>Subject <sup>*</sup>:</b></label>
                        @include('components.subject-import',['selectid'=>request()->get('section_id'),'required'=>'required','search'=>[]])
                    </div>
                    <div class="col-lg-2">
                        <button class="btn mg-t-20 btn-primary btn-sm"><i class="fa fa-search"></i> Search</button>
                    </div>
                </div>

                <div class="col-lg-12 pd-t-5 bd-1 bd-t pd-b-15 row m-0">
                    <button href="#addModels" data-toggle="modal" class="btn btn-primary wd-150 mg-t-15"><i
                            class="fa fa-plus"></i> Add Assignment
                    </button>
                    <table class="table table-bordered mg-t-10">
                        <thead class="bg-light">
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Assignment For</th>
                            <th>Subject</th>
                            <th class="text-center">Assignment Date</th>
                            <th class="text-center">Assigned On</th>
                            <th class="text-center">To be Submitted</th>
                            <th>Assignment Title</th>
                            <th>Assignment</th>
                            <th class="text-center">Attachment</th>
                            <th class="text-center">Communication</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($assignment as $data)
                        <tr>
                            <td class="text-center">{{$loop->iteration}}</td>
                            <td class="text-center">{{ucfirst($data->type)}}</td>
                            <td>{{$data->SubjectName()}}</td>
                            <td class="text-center">{{nowdate($data->assignment_date,'d-M-Y')}}</td>
                            <td class="text-center">{{nowdate($data->assigned_date,'d-M-Y')}}</td>
                            <td class="text-center">{{nowdate($data->submitted_date,'d-M-Y')}}</td>
                            <td>{{$data->assignment_title}}</td>
                            <td>{{$data->assignment}}</td>
                            <td>
                                <button class="btn btn-warning btn-xs rounded-5"><b><i class="fa fa-file"></i> Preview</b></button>
                            </td>
                            <td class="text-center">
                                @if($data->with_app=="yes") <span class="badge badge-success">App</span> @endif
                                @if($data->with_text_sms=="yes") <span class="badge badge-success">Text SMS</span> @endif
                                @if($data->with_email=="yes") <span class="badge badge-success">Email</span> @endif
                                @if($data->with_website=="yes") <span class="badge badge-success">Website</span> @endif
                            </td>
                            <td class="text-center">
                                @if($data->status=="yes") <span class="badge badge-success">Active</span> @else <span class="badge badge-danger">Inactive</span> @endif
                            </td>
                            <td class="text-center">
                                <button type="button" value="{{url('/MasterAdmin/App/EditViewAssignment/'.$data->id.'/editview')}}" class="btn pd-l-10 pd-r-10 BtnEditUrl btn-success btn-xs rounded-5"><i class="fa fa-edit"></i> Edit</button>
                                <a href="{{url('/RecordDelete/'.$data->id.'/'.$data->getTable().'/delete')}}">
                                    <button type="button" class="btn btn-danger pd-l-10 pd-r-10 btn-xs rounded-5"><i class="fa fa-trash"></i> Remove</button>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>



@endsection
