@extends('layouts.MasterLayout')
@section('ModelTitle','Add Notice')
@section('ModelSize','modal-xl')
@section('ModelTitleInfo','Notice for Student & Staff')
@section('EditModelTitle','Edit Notice')
@section('EditModelTitleInfo','Modify Notice')
@section('filepath','storage/notice/')
@section('AddModelPage')
    @include('app.erpmodule.MasterAdmin.InApp.Notice.Add.add-notice')
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
                        <label><b>Notice For :</b></label>
                        <table>
                            <tr>
                                <td><input type="radio" checked></td>
                                <td class="pd-l-5">All</td>
                                <td class="pd-l-10"><input type="radio"></td>
                                <td class="pd-l-5">Student</td>
                                <td class="pd-l-10"><input type="radio"></td>
                                <td class="pd-l-5">Staff</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-lg-2">
                        <label><b>Notice From Date :</b></label>
                        <input type="text" placeholder="dd-mm-yyyy" value="{{nowdate('','d-m-Y')}}"
                               class="form-control date">
                    </div>
                    <div class="col-lg-2">
                        <label><b>Notice To Date :</b></label>
                        <input type="text" placeholder="dd-mm-yyyy" value="{{nowdate('','d-m-Y')}}"
                               class="form-control date">
                    </div>
                    <div class="col-lg-2">
                        <button class="btn mg-t-20 btn-primary btn-sm"><i class="fa fa-search"></i> Search</button>
                    </div>
                </div>


                <div class="col-lg-12 pd-t-15 bd-1 bd-t pd-b-15 row m-0">
                    <button href="#addModels" data-toggle="modal" class="btn btn-primary wd-150 mg-t-15"><i
                            class="fa fa-plus"></i> Add Notice
                    </button>
                    <table class="table table-bordered mg-t-10">
                        <thead class="bg-light">
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Notice For</th>
                            <th class="text-center">Notice Date</th>
                            <th>Notice Title</th>
                            <th class="wd-25p">Notice</th>
                            <th class="text-center">Attachment</th>
                            <th class="text-center">Communication</th>
                            <th class="text-center">Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($notice as $data)
                        <tr>
                            <td class="text-center">{{$loop->iteration}}</td>
                            <td class="text-center">{{ucfirst($data->type)}}</td>
                            <td class="text-center">{{ucfirst($data->notice_date)}}</td>
                            <td class="text-left">{{ucfirst($data->notice_title)}}</td>
                            <td class="text-left">{{ucfirst($data->notice)}}</td>
                            <td class="text-center">
                                <button class="badge badge-warning pd-5 pd-l-10 pd-r-10 tx-13"><i class="fa fa-file"></i> Preview</button>
                            </td>
                            <td class="text-center">
                                @if($data->with_app=="yes") <span class="badge badge-success">App</span> @endif
                                @if($data->with_text_sms=="yes") <span class="badge badge-success">Text SMS</span> @endif
                                @if($data->with_email=="yes") <span class="badge badge-success">Email</span> @endif
                                @if($data->with_website=="yes") <span class="badge badge-success">Website</span> @endif
                            </td>
                            <td class="text-center">
                                <button type="button" value="{{url('/MasterAdmin/App/EditViewNotice/'.$data->id.'/editview')}}" class="btn BtnEditUrl btn-success btn-xs rounded-5"><i class="fa fa-edit"></i> Edit</button>
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
