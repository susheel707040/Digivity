@extends('layouts.MasterLayout')

@section('ModelTitle','Add New Section')
@section('ModelTitleInfo','Manage Section')
@section('EditModelTitle','Edit Section')
@section('EditModelTitleInfo','Modify Section')

@section('AddModelPage')
    @include('app.erpmodule.MasterAdmin.GlobalSetting.AcademicSetting.Add.add-section')
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Global Setting</li>
            <li class="breadcrumb-item active" aria-current="page">Section</li>
        </ol>
    </nav>



    <div class="col-lg-10 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i> Section List</b></div>
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
                                <th class="wd-15p text-center">Sequence</th>
                                <th class="wd-15p text-center">Section</th>
                                <th class="wd-15p text-center">Strength</th>
                                <th class="wd-10p text-center">Default</th>
                                <th class="wd-15p text-center">Modify Date</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($section as $data)
                                <tr editurl="{{url('MasterAdmin/GlobalSetting/EditViewSection/'.$data->id.'/edit')}}" deleteurl="{{url('/RecordDelete/'.$data->id.'/'.$data->getTable().'/delete')}}">
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td class="text-center">{{$data->sequence}}</td>
                                    <td class="text-center">{{$data->section}}</td>
                                    <td class="text-center">{{$data->strength}}</td>
                                    <td class="text-center">@if($data->default=="yes")<span class="badge badge-success">Active</span>@endif</td>
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
