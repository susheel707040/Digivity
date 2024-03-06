@extends('layouts.MasterLayout')

@section('ModelTitle','Add New Genre')
@section('ModelTitleInfo','Manage Genre')
@section('EditModelTitle','Edit Genre')
@section('EditModelTitleInfo','Modify Genre')

@section('AddModelPage')
    @include('app.erpmodule.MasterAdmin.Library.MasterSetting.Add.add-genre')
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="#">Library</a></li>
            <li class="breadcrumb-item" aria-current="page">Master Setting</li>
            <li class="breadcrumb-item active" aria-current="page">Define Genre</li>
        </ol>
    </nav>



    <div class="col-lg-12 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i> Genre List</b></div>
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
                                <th>Genre</th>
                                <th>Alias</th>
                                <th>Book Type</th>
                                <th>Audience</th>
                                <th>Description</th>
                                <th>Modify Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($genre as $data)
                                <tr editurl="{{url('MasterAdmin/Library/EditViewGenres/'.$data->id.'/editview')}}"
                                    deleteurl="{{url('/RecordDelete/'.$data->id.'/'.$data->getTable().'/delete')}}">
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td>{{$data->genre}}</td>
                                    <td>{{$data->alias}}</td>
                                    <td>@if(isset($data->book_type)){{ucwords(str_replace("-"," ",$data->book_type))}}@endif</td>
                                    <td>@if(isset($data->audience)&&(isset($libraryaudience[$data->audience]))){{$libraryaudience[$data->audience]}}@endif</td>
                                    <td>{{$data->description}}</td>
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
