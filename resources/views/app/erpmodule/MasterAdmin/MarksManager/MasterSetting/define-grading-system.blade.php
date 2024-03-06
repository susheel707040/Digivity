@extends('layouts.MasterLayout')

@section('ModelTitle','Add New Exam Grade System')
@section('ModelTitleInfo','Manage Exam Grade System')
@section('EditModelTitle','Edit Exam Grade System')
@section('EditModelTitleInfo','Modify Exam Grade System')

@section('AddModelPage')
    @include('app.erpmodule.MasterAdmin.MarksManager.MasterSetting.Add.add-grading-system')
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item">Marks Manager</li>
            <li class="breadcrumb-item">Master Setting</li>
            <li class="breadcrumb-item active">Define Grade System</li>
        </ol>
    </nav>

    <div class="col-lg-12 pd-l-0 pd-r-0">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i> Exam Grade System List</b></div>
            <div class="panel-body pd-b-0 row">
                <div class="col-lg-2">
                    @include('layouts.actionbutton.ActionButton')
                </div>
                <div class="col-lg-10 vhr">
                    <div data-label="Example" class="df-example demo-table">
                        <table id="example2" class="table datatable table-bordered" >
                            <thead class="bg-light">
                            <tr>
                                <th class="wd-5p text-center">Sl.No.</th>
                                <th class="text-center wd-5p">Position</th>
                                <th>Grade Title</th>
                                <th class="wd-20p">Description</th>
                                <th class="wd-45p">
                                    <div class="row m-0 p-0">
                                        <div class="col bd-r bd-1 text-center">Grade Name</div>
                                        <div class="col bd-r bd-1 text-center">Grade Point</div>
                                        <div class="col bd-r bd-1 text-center">Range</div>
                                    </div>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($gradesystem as $data)
                                <tr editurl="{{url('MasterAdmin/MarksManager/EditViewExamGradeSystem/'.$data->id.'/edit')}}"
                                    deleteurl="{{url('/RecordDelete/'.$data->id.'/'.$data->getTable().'/delete')}}">
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td class="text-center">{{$data->position}}</td>
                                    <td>{{$data->grade_title}}</td>
                                    <td>{{$data->description}}</td>
                                    <td class="p-0 m-0">
                                        @php
                                        $gradeinput=[];
                                        try {
                                           $gradeinput=unserialize($data->grade_input);
                                         }catch (\Exception $e){}
                                        @endphp
                                        @foreach($gradeinput['grade_name'] as $key=>$value)
                                        <div class="row m-0 p-0 @if($key!=0)bd-1 bd-t @endif">
                                            <div class="col bd-r bd-1 text-center">{{$value}}</div>
                                            <div class="col bd-r bd-1 text-center">@if(isset($gradeinput['grade_point'][$key])){{$gradeinput['grade_point'][$key]}}@else{{"--"}}@endif</div>
                                            <div class="col bd-r bd-1 text-center">@if(isset($gradeinput['grade_from'][$key])){{$gradeinput['grade_from'][$key]}}@else{{"--"}}@endif
                                                <i class="fa fa-arrow-right pd-l-5"></i>
                                                @if(isset($gradeinput['grade_to'][$key])){{$gradeinput['grade_to'][$key]}}@else{{"--"}}@endif
                                            </div>
                                        </div>
                                        @endforeach
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
