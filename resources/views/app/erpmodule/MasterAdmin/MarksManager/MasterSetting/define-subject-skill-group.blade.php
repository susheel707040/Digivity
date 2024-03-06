@extends('layouts.MasterLayout')

@section('ModelTitle','Add New Subject Skill Group')
@section('ModelTitleInfo','Manage Subject Skill Group')
@section('EditModelTitle','Edit Subject Skill Group')
@section('EditModelTitleInfo','Modify Exam Subject Skill Group')

@section('AddModelPage')
    @include('app.erpmodule.MasterAdmin.MarksManager.MasterSetting.Add.add-subject-skill-group')
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item">Marks Manager</li>
            <li class="breadcrumb-item">Master Setting</li>
            <li class="breadcrumb-item active">Define Subject Skill Group</li>
        </ol>
    </nav>

    <div class="col-lg-11 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i> Exam Subject Skill Group List</b></div>
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
                                <th>Subject Skill Group</th>
                                <th>Position</th>
                                <th class="wd-30p">Description</th>
                                <th class="text-center">Printable in Report Card</th>
                                <th class="text-center">Is Active</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($subjectskillgroup as $data)
                                <tr editurl="{{url('MasterAdmin/MarksManager/EditViewExamSubjectSkillGroup/'.$data->id.'/edit')}}"
                                    deleteurl="{{url('/RecordDelete/'.$data->id.'/'.$data->getTable().'/delete')}}">
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td>{{$data->skill_group_name}}</td>
                                    <td>{{$data->position}}</td>
                                    <td>{{$data->description}}</td>
                                    <td class="text-center">
                                        @if($data->print=='yes')
                                            <span class="badge badge-success">Yes</span>
                                        @elseif($data->print=='no')
                                            <span class="badge badge-danger">No</span>
                                        @endif
                                    </td>
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
