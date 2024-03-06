@extends('layouts.MasterLayout')
@section('ModelTitle','Add Homework')
@section('ModelSize','modal-xl')
@section('ModelTitleInfo','Course Wise Homework Upload')
@section('filepath','storage/homework/')
@section('EditModelTitle','Edit Homework')
@section('EditModelTitleInfo','Modify Homework')
@section('AddModelPage')
    @include('app.erpmodule.MasterAdmin.InApp.Homework.Add.add-homework')
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">InApp</li>
            <li class="breadcrumb-item active" aria-current="page">Homework</li>
        </ol>
    </nav>

    <div class="col-lg-12 p-0 m-0 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i> Homework</b></div>
            <div class="panel-body pd-b-10 row">
                <form class="container-fluid" action="{{url('MasterAdmin/App/DefineHomework')}}" method="POST" enctype="multipart/form-data"  data-parsley-validate="" novalidate="">
                {{csrf_field()}}
                    <div class="col-lg-12 pd-t-15 pd-b-15 row m-0">
                    <div class="col-lg-2">
                        <label><b>Course <sup>*</sup>:</b></label>
                        @include('components.course-import',['selectid'=>request()->get('course_id'),'required'=>'required'])
                    </div>
                    <div class="col-lg-2">
                        <label><b>Section <sup>*</sup>:</b></label>
                        @include('components.section-import',['selectid'=>request()->get('section_id'),'required'=>'required'])
                    </div>
                   <div class="col-lg-2">
                       <label><b>Homework Date <sup>*</sup> :</b></label>
                       <input type="text" value="@if(request()->get('hw_date')){{request()->get('hw_date')}}@else{{nowdate('','d-m-Y')}}@endif" name="hw_date" placeholder="dd-mm-yyyy" class="form-control input-sm date">
                   </div>
                    <div class="col-lg-2">
                        <button class="btn btn-primary mg-20 btn-sm">Continue <i class="fa fa-angle-right"></i></button>
                    </div>
                </div>
                </form>

                @if((request()->get('hw_date')))
                <div class="col-lg-12 bd-1 bd-t">
                    <button href="#addModels" data-toggle="modal" class="btn btn-primary wd-150 mg-t-15"><i class="fa fa-plus"></i> Add Homework</button>
                    <table class="table table-bordered mg-t-15 tx-12">
                        <thead class="bg-light">
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">H.W. Date</th>
                            <th class="text-center">Course</th>
                            <th>Subject</th>
                            <th>H.W. Title</th>
                            <th class="wd-20p">Homework</th>
                            <th>Attachment Files</th>
                            <th class="text-center">Submitted Date</th>
                            <th class="text-center">Submitted By</th>
                            <th class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($homework as $data)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td class="text-center">{{nowdate($data->hw_date,'d-M-Y')}}</td>
                            <td class="text-center">{{$data->CourseSection()}}</td>
                            <td>{{$data->SubjectName()}}</td>
                            <td>{{$data->hw_title}}</td>
                            <td>{{$data->homework}}</td>
                            <td></td>
                            <td class="text-center">{{$data->created_at}}</td>
                            <td></td>
                            <td class="text-center">
                                <button type="button" value="{{url('/MasterAdmin/App/EditViewHomework/'.$data->id.'/editview')}}" class="btn BtnEditUrl btn-success btn-xs rounded-5"><i class="fa fa-edit"></i> Edit</button>
                                <a href="{{url('/RecordDelete/'.$data->id.'/'.$data->getTable().'/delete')}}">
                                <button type="button" class="btn btn-danger btn-xs rounded-5"><i class="fa fa-trash"></i> Remove</button>
                                </a>
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
