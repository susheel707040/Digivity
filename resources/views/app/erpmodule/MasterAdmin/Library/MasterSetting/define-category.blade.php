@extends('layouts.MasterLayout')

@section('ModelTitle','Add New Item Category')
@section('ModelTitleInfo','Manage Item Category')
@section('EditModelTitle','Edit Item Category')
@section('EditModelTitleInfo','Modify Item Category')

@section('AddModelPage')
    @include('app.erpmodule.MasterAdmin.Library.MasterSetting.Add.add-category')
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="#">Library</a></li>
            <li class="breadcrumb-item" aria-current="page">Master Setting</li>
            <li class="breadcrumb-item active" aria-current="page">Define Category</li>
        </ol>
    </nav>

    <div class="col-lg-10 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i> Item Category List</b></div>
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
                                <th class="wd-25p">Item Category</th>
                                <th class="wd-25p">Return Days</th>
                                <th class="wd-20p text-center">Default</th>
                                <th class="wd-20p text-center">Modify Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($itemcateory as $data)
                                <tr editurl="{{url('MasterAdmin/Library/EditViewItemCategory/'.$data->id.'/editview')}}"
                                    deleteurl="{{url('/RecordDelete/'.$data->id.'/'.$data->getTable().'/delete')}}">
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td>{{$data->item_category}}</td>
                                    <td>{{$data->return_day}} Days</td>
                                    <td class="text-center">@if($data->default_at=="yes")<span class="badge badge-success">Active</span>@endif</td>
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
