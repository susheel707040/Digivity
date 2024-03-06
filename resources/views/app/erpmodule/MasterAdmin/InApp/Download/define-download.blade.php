@extends('layouts.MasterLayout')
@section('ModelTitle','Add Download')
@section('ModelTitleInfo','Download for Student & Staff')
@section('EditModelTitle','Edit Download')
@section('EditModelTitleInfo','Modify Download')
@section('AddModelPage')
    @include('app.erpmodule.MasterAdmin.InApp.Download.Add.add-download')
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">InApp</li>
            <li class="breadcrumb-item active" aria-current="page">Download</li>
        </ol>
    </nav>

    <div class="col-lg-12 p-0 m-0 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i> Downloads</b></div>
            <div class="panel-body pd-b-10 row">


                <div class="col-lg-12">
                    <button  href="#addModels" data-toggle="modal" class="btn btn-primary mg-t-15 wd-150"><i class="fa fa-plus"></i> Add Download</button>
                    <table class="table table-bordered mg-t-15">
                        <thead class="bg-light">
                        <tr>
                            <th class="text-center">Sr No.</th>
                            <th class="text-center">Download For</th>
                            <th class="text-center">Create Date</th>
                            <th>Download Title</th>
                            <th>Download Details</th>
                            <th class="text-center">Attachment</th>
                            <th class="text-center">Show In</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($download as $data)
                            <tr>
                                <td class="text-center">{{$loop->iteration}}</td>
                                <td class="text-center">{{ucfirst($data->type)}}</td>
                                <td class="text-center">{{nowdate($data->upload_date,'d-M-Y')}}</td>
                                <td>{{$data->download_title}}</td>
                                <td>{{$data->download_details}}</td>
                                <td class="text-center tx-12">
                                    <span class="badge-primary badge pd-8 pd-l-10 pd-r-10" onclick="showPdfPreview('{{ url('uploads/documents/' . $data->file_name) }}')">Preview</span>
                                </td>
                                <script>
                                    function showPdfPreview(pdfUrl) {
                                        // Open the PDF file in a new tab
                                        window.open(pdfUrl, '_blank');
                                    }
                                </script>

                                <td class="text-center">
                                    @if($data->show_app=="yes")<span class="badge badge-success">Mobile App</span>@endif
                                    @if($data->show_website=="yes")<span class="badge badge-success">Website</span>@endif
                                </td>
                                <td class="text-center">
                                    @if($data->status=="yes") <span class="badge-success badge">Active</span> @elseif($data->status=="no") <span class="badge-danger badge">In-Active</span> @endif
                                </td>
                                <td class="text-center">
                                    <button type="button"  value="{{url('/MasterAdmin/App/EditViewDownload/'.$data->id.'/editview')}}" class="btn BtnEditUrl btn-success btn-xs rounded-5"><i class="fa fa-edit"></i> Edit</button>
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
