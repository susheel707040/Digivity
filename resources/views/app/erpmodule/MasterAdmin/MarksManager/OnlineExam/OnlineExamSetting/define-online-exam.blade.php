@extends('layouts.MasterLayout')

@section('ModelTitle','Add New Online Exam')
@section('ModelTitleInfo','Manage Online Exam')
@section('EditModelTitle','Edit Online Exam')
@section('EditModelTitleInfo','Modify Online Exam')

@section('AddModelPage')
    @include('app.erpmodule.MasterAdmin.MarksManager.OnlineExam.OnlineExamSetting.Add.add-online-exam')
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Marks Manager</li>
            <li class="breadcrumb-item active" aria-current="page">Online Exam Setting</li>
            <li class="breadcrumb-item active" aria-current="page">Define Online Exam</li>
        </ol>
    </nav>

    <div class="col-lg-12 p-0 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i> Define Online Exam</b></div>
            <div class="panel-body pd-b-0 row">
                <div class="col-lg-2">
                    @include('layouts.actionbutton.ActionButton')
                </div>

                <div class="col-lg-10 vhr">
                    <div data-label="Example" class="df-example demo-table">
                        <table id="example2" class="table datatable table-bordered">
                            <thead>
                            <tr>
                                <th class="wd-5p text-center">Sl.No.</th>
                                <th>Exam Name</th>
                                <th>Exam Type</th>
                                <th class="text-center">Start Date</th>
                                <th class="text-center">End Date</th>
                                <th>Maximum Time</th>
                                <th>Pass Percentage</th>
                                <th>Exam Format</th>
                                <th>Subject</th>
                                <th class="text-center">Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($onlineexam as $data)
                                <tr editurl="{{url('/MasterAdmin/MarksManager/EditViewOnlineExam/'.$data->id.'/edit')}}" deleteurl="{{url('/RecordDelete/'.$data->id.'/'.$data->getTable().'/delete')}}">
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td>{{$data->exam_name}}</td>
                                    <td>{{ucwords($data->exam_type)}}</td>
                                    <td class="text-center">{{nowdate($data->start_date,'d-M-Y')}}</td>
                                    <td class="text-center">{{nowdate($data->end_date,'d-M-Y')}}</td>
                                    <td>{{$data->duration}} <b>Minute</b></td>
                                    <td>{{$data->pass_marks}}</td>
                                    <td>{{ucwords($data->exam_format)}}</td>
                                    <td>{{ucwords($data->SubjectName())}}</td>
                                    <td class="text-center">
                                        @if($data->status=="yes")
                                            <span class="badge badge-success">Yes</span>
                                        @elseif($data->status=="no")
                                            <span class="badge badge-danger">No</span>
                                        @endif
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
