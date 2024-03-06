@extends('layouts.MasterLayout')
@section('ModelTitle','Add Syllabus')
@section('ModelSize','modal-xl')
@section('ModelTitleInfo','Syllabus for Student & Staff')
@section('EditModelTitle','Edit Syllabus')
@section('EditModelTitleInfo','Modify Syllabus')
@section('AddModelPage')
    @include('app.erpmodule.MasterAdmin.InApp.Syllabus.Add.add-syllabus')
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">InApp</li>
            <li class="breadcrumb-item active" aria-current="page">Syllabus</li>
        </ol>
    </nav>
    <div class="col-lg-12 p-0 m-0 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i> Syllabus</b></div>
            <div class="panel-body pd-b-10 row">
                <form class="container-fluid" action="{{url('MasterAdmin/App/DefineSyllabus')}}" method="POST">
                    {{csrf_field()}}
                <div class="col-lg-12 pd-t-15 pd-b-15 row m-0">
                    <div class="col-lg-2">
                        <label><b>Course <span class="text-gray">(Optional)</span> :</b></label>
                        @include('components.course-import')
                    </div>
                    <div class="col-lg-2">
                        <label><b>Subject <span class="text-gray">(Optional)</span> :</b></label>
                        @include('components.subject-import')
                    </div>
                    <div class="col-lg-2">
                        <button type="submit" class="btn btn-primary mg-t-20 btn-sm"><i class="fa fa-search"></i> Search</button>
                    </div>
                </div>
                </form>

                <div class="col-lg-12 pd-t-15 bd-1 bd-t pd-b-15 row m-0">
                    <button href="#addModels" data-toggle="modal" class="btn btn-primary wd-150 mg-t-0"><i
                            class="fa fa-plus"></i> Add Syllabus
                    </button>

                    <table class="table table-bordered mg-t-15">
                        <thead class="bg-light ">
                        <tr>
                            <th class="text-center">Sr. No.</th>
                            <th class="text-center">Priority</th>
                            <th class="text-center">Course</th>
                            <th>Subject</th>
                            <th>Syllabus Title</th>
                            <th>Syllabus Details</th>
                            <th class="text-center">Attachment</th>
                            <th class="text-center">Show on</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($syllabus as $data)
                        <tr>
                            <td class="text-center">{{$loop->iteration}}</td>
                            <td class="text-center">{{$data->priority}}</td>
                            <td class="text-center">{{$data->course->course}}</td>
                            <td>@if(isset($data->subject->subject_name)){{$data->subject->subject_name}}@endif</td>
                            <td>{{$data->syllabus_title}}</td>
                            <td>{{$data->syllabus_details}}</td>
                            <td class="text-center">
                                @foreach($fileNames as $item)
                                <button class="badge badge-warning pd-5 pd-l-10 pd-r-10 tx-13" onclick="showPdfPreview('{{ url('uploads/syllabus/' . $item->file_name) }}')"><i class="fa fa-file"></i> Preview</button>
                                @endforeach
                            </td>
                            <script>
                                function showPdfPreview(pdfUrl) {
                                    // Open the PDF file in a new tab
                                    window.open(pdfUrl, '_blank');
                                }
                            </script>
                            <td class="text-center">
                                @if($data->show_app=="yes") <span class="badge badge-success">App</span> @endif
                                @if($data->show_website=="yes") <span class="badge badge-success">Website</span> @endif
                            </td>
                            <td class="text-center">
                                @if($data->status=="yes") <span class="badge badge-success">Active</span> @else <span class="badge badge-danger">Inactive</span> @endif
                            </td>
                            <td class="text-center">
                                <button type="button" value="{{url('/MasterAdmin/App/EditViewSyllabus/'.$data->id.'/editview')}}" class="btn BtnEditUrl btn-success btn-xs rounded-5"><i class="fa fa-edit"></i> Edit</button>
                                <a href="{{url('/RecordDelete/'.$data->id.'/'.$data->getTable().'/delete')}}">
                                    <button type="button" class="btn btn-danger btn-xs rounded-5"><i class="fa fa-trash"></i> Remove</button>
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
