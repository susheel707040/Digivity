@extends('layouts.MasterLayout')

@section('ModelTitle','Add New Library')
@section('ModelTitleInfo','Manage Library')
@section('EditModelTitle','Edit Library')
@section('EditModelTitleInfo','Modify Library')

@section('AddModelPage')
    @include('app.erpmodule.MasterAdmin.Library.MasterSetting.Add.add-library')
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="#">Library</a></li>
            <li class="breadcrumb-item" aria-current="page">Master Setting</li>
            <li class="breadcrumb-item active" aria-current="page">Define Library</li>
        </ol>
    </nav>

    <div class="col-lg-12 p-0 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i> Library List</b></div>
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
                                <th>Library</th>
                                <th>Alias</th>
                                <th>Address</th>
                                <th>In-Charge</th>
                                <th>School</th>
                                <th>School Sub Branch</th>
                                <th>Description</th>
                                <th>Default</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($library as $data)
                                <tr editurl="{{url('MasterAdmin/Library/EditViewLibrary/'.$data->id.'/editview')}}"
                                    deleteurl="{{url('/RecordDelete/'.$data->id.'/'.$data->getTable().'/delete')}}">
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td>{{$data->library_name}}</td>
                                    <td>{{$data->alias}}</td>
                                    <td>{{$data->address}}</td>
                                    <td>{{$data->InChargeName()}}</td>
                                    <td></td>
                                    <td></td>
                                    <td>{{$data->description}}</td>
                                    <td class="text-center">@if($data->default_at=="yes") <span class="badge badge-success">Yes</span> @endif</td>
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
