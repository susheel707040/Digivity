@extends('layouts.MasterLayout')

@section('ModelTitle','Add New Document')
@section('ModelTitleInfo','Manage Document')
@section('EditModelTitle','Edit Document')
@section('EditModelTitleInfo','Modify Document')

@section('AddModelPage')
    @include('app.erpmodule.MasterAdmin.Staff.MasterSetting.Add.add-document-type')
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Staff</li>
            <li class="breadcrumb-item active" aria-current="page">Master Setting</li>
            <li class="breadcrumb-item active" aria-current="page">Define Document Type</li>
        </ol>
    </nav>

    <div class="col-lg-12 p-0 m-0 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i> Document Type List</b></div>
            <div class="panel-body pd-b-0 row">
                <div class="col-lg-2">
                    @include('layouts.actionbutton.ActionButton')
                </div>

                <div class="col-lg-10 vhr">
                    <div data-label="Example" class="df-example demo-table">
                        <table id="example2" class="table datatable table-bordered">
                            <thead>
                            <tr>
                                <th class="wd-10p text-center">Sl.No.</th>
                                <th>Document Type</th>
                                <th class="text-center">Fill Mandatory</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Default Set</th>
                                <th class="text-center">Modify Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($document as $data)
                                <tr editurl="{{url('MasterAdmin/Staff/EditViewDocument/'.$data->id.'/editview')}}"
                                    deleteurl="{{url('/RecordDelete/'.$data->id.'/'.$data->getTable().'/delete')}}">
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td>{{$data->document_name}}</td>
                                    <td class="text-center">@if($data->fill_mandatory=="yes")<span
                                            class="badge badge-success">Yes</span>@else <span
                                            class="badge badge-danger">No</span> @endif</td>

                                    <td class="text-center">@if($data->status=="active")<span
                                            class="badge badge-success">Active</span> @else
                                            <span class="badge badge-danger">In-Active</span>@endif</td>

                                    <td class="text-center">@if($data->default_at=="yes")<span
                                            class="badge badge-success">Active</span>@endif</td>
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
