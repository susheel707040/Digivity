@extends('layouts.MasterLayout')

@section('ModelTitle','Add New Document Type')
@section('ModelTitleInfo','Manage Document Type')
@section('EditModelTitle','Edit Document Type')
@section('EditModelTitleInfo','Modify Document Type')

@section('AddModelPage')
    @include('app.erpmodule.MasterAdmin.GlobalSetting.AcademicSetting.Add.add-student-document-type')
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Master Setting</li>
            <li class="breadcrumb-item active" aria-current="page">Define Document Type</li>
        </ol>
    </nav>

    <div class="col-lg-10 mx-auto">
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
                                <th class="wd-10p text-center"><b>Sl.No.</b></th>
                                <th class="wd-25p"><b>Document Type</b></th>
                                <th class="wd-15p text-center"><b>Mandatory</b></th>
                                <th class="wd-20p text-center"><b>Modify Date</b></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($documenttype as $data)
                                <tr editurl="{{url('MasterAdmin/StudentInformation/EditViewDocumentType/'.$data->id.'/edit')}}"
                                    deleteurl="{{url('/RecordDelete/'.$data->id.'/'.$data->getTable().'/delete')}}">
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td>{{$data->document_type}}</td>
                                    <td class="text-center">@if($data->mandatory=="yes")<span
                                            class="badge badge-success">Yes</span>@else <span
                                            class="badge badge-danger">No</span> @endif</td>
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
