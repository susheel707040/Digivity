@extends('layouts.MasterLayout')

@section('ModelTitle','Add New Skill and Knowledge')
@section('ModelTitleInfo','Manage Skill and Knowledge')
@section('EditModelTitle','Edit Skill and Knowledge')
@section('EditModelTitleInfo','Modify Skill and Knowledge')

@section('AddModelPage')
    @include('app.erpmodule.MasterAdmin.Staff.MasterSetting.Add.add-skill-and-knowledge')
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Staff</li>
            <li class="breadcrumb-item active" aria-current="page">Master Setting</li>
            <li class="breadcrumb-item active" aria-current="page">Define Skill and Knowledge</li>
        </ol>
    </nav>

    <div class="col-lg-12 p-0 m-0 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i> Skill and Knowledge List</b></div>
            <div class="panel-body pd-b-0 row">
                <div class="col-lg-2">
                    @include('layouts.actionbutton.ActionButton')
                </div>

                <div class="col-lg-10 vhr">
                    <div data-label="Example" class="df-example demo-table">
                        <table id="example2" class="table datatable table-bordered" >
                            <thead>
                            <tr>
                                <th class="wd-10p text-center">Sl.No.</th>
                                <th>Skill and Knowledge</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Modify Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($skillandknowledge as $data)
                                <tr editurl="{{url('MasterAdmin/Staff/EditViewSkillAndKnowledge/'.$data->id.'/editview')}}" deleteurl="{{url('/RecordDelete/'.$data->id.'/'.$data->getTable().'/delete')}}">
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td>{{$data->skill_name}}</td>
                                    <td class="text-center">@if($data->status=="enable")<span class="badge badge-success">Enable</span>@else <span class="badge badge-danger">Disable</span> @endif</td>
                                    <td class="text-center">{{\App\Helper\DateFormat::date($data->updated_at)}}</td>
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
