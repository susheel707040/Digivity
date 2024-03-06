@extends('layouts.MasterLayout')

@section('ModelTitle','Add New Exam Term Assessment')
@section('ModelTitleInfo','Manage Exam Term Assessment')
@section('EditModelTitle','Edit Exam Term Assessment')
@section('EditModelTitleInfo','Modify Exam Term Assessment')

@section('AddModelPage')
    @include('app.erpmodule.MasterAdmin.MarksManager.MasterSetting.Add.add-exam-assessment')
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item">Marks Manager</li>
            <li class="breadcrumb-item">Master Setting</li>
            <li class="breadcrumb-item active">Define Exam Term Assessment</li>
        </ol>
    </nav>

    <div class="col-lg-12 pd-l-0 pd-r-0">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i> Exam Term Assessment List</b></div>
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
                                <th>Exam Term</th>
                                <th class="text-center">Position</th>
                                <th>Exam Assessment</th>
                                <th>Alias</th>
                                <th>Marks</th>
                                <th>Description</th>
                                <th class="text-center">Is Active</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($examassessment as $data)
                                <tr editurl="{{url('MasterAdmin/MarksManager/EditViewExamAssessment/'.$data->id.'/edit')}}"
                                    deleteurl="{{url('/RecordDelete/'.$data->id.'/'.$data->getTable().'/delete')}}">
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td>{{$data->ExamTermName()}}</td>
                                    <td class="text-center">{{$data->position}}</td>
                                    <td>{{$data->exam_assessment}}</td>
                                    <td>{{$data->alias}}</td>
                                    <td>{{$data->marks}}</td>
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
