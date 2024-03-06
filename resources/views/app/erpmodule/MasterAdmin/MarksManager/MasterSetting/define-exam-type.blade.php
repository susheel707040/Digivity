@extends('layouts.MasterLayout')

@section('ModelTitle','Add New Exam Type')
@section('ModelTitleInfo','Manage Exam Type')
@section('EditModelTitle','Edit Exam Type')
@section('EditModelTitleInfo','Modify Exam Type')

@section('AddModelPage')
    @include('app.erpmodule.MasterAdmin.MarksManager.MasterSetting.Add.add-exam-type')
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item">Marks Manager</li>
            <li class="breadcrumb-item">Master Setting</li>
            <li class="breadcrumb-item active">Define Exam Type</li>
        </ol>
    </nav>

    <div class="col-lg-12 pd-l-0 pd-r-0">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i> Exam Type List</b></div>
            <div class="panel-body pd-b-0 row">
                <div class="col-lg-2">
                    @include('layouts.actionbutton.ActionButton')
                </div>
                <div class="col-lg-10 vhr">
                    <div data-label="Example" class="df-example demo-table">
                        <table id="example2" class="table datatable table-bordered" >
                            <thead>
                            <tr>
                                <th class="wd-5p text-center">Sl.No.</th>
                                <th class="text-center">Position</th>
                                <th>Exam Type</th>
                                <th>Alias</th>
                                <th class="text-center">Integrate With</th>
                                <th>Description</th>
                                <th class="text-center">Is Active</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($examtype as $data)
                                <tr editurl="{{url('MasterAdmin/MarksManager/EditViewExamType/'.$data->id.'/edit')}}"
                                    deleteurl="{{url('/RecordDelete/'.$data->id.'/'.$data->getTable().'/delete')}}">
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td class="text-center">{{$data->position}}</td>
                                    <td>{{$data->exam_type}}</td>
                                    <td>{{$data->alias}}</td>
                                    <td class="text-center"><span class="badge badge-warning">{{ucwords($data->integrate)}}</span></td>
                                    <td>{{$data->description}}</td>
                                    <td class="text-center">
                                        @if($data->is_active==0)
                                            <span class="badge badge-success">Yes</span>
                                        @elseif($data->is_active==1)
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
