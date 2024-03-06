@extends('layouts.MasterLayout')

@section('ModelTitle','Add New Subject')
@section('ModelTitleInfo','Manage Subject')
@section('EditModelTitle','Edit Subject')
@section('EditModelTitleInfo','Modify Exam Subject')

@section('AddModelPage')
    @include('app.erpmodule.MasterAdmin.MarksManager.MasterSetting.Add.add-subject')
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item">Marks Manager</li>
            <li class="breadcrumb-item">Master Setting</li>
            <li class="breadcrumb-item active">Define Subject</li>
        </ol>
    </nav>

    <div class="col-lg-12 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i> Exam Subject List</b></div>
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
                                <th>Group</th>
                                <th>Subject</th>
                                <th>Alias</th>
                                <th>Subject Code</th>
                                <th>Description</th>
                                <th class="text-center">Is Active</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($subject as $data)
                            <tr editurl="{{url('MasterAdmin/MarksManager/EditViewExamSubject/'.$data->id.'/edit')}}"
                                deleteurl="{{url('/RecordDelete/'.$data->id.'/'.$data->getTable().'/delete')}}">
                                <td class="text-center">{{$loop->iteration}}</td>
                                <td>{{$data->SubjectGroupName()}}</td>
                                <td>{{$data->subject_name}}</td>
                                <td>{{$data->alias}}</td>
                                <td>{{$data->subject_code}}</td>
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
