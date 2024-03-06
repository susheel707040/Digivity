@extends('layouts.MasterLayout')

@section('ModelTitle','Add New Racks')
@section('ModelTitleInfo','Manage Racks')
@section('EditModelTitle','Edit Racks')
@section('EditModelTitleInfo','Modify Racks')

@section('AddModelPage')
    @include('app.erpmodule.MasterAdmin.Library.MasterSetting.Add.add-racks')
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="#">Library</a></li>
            <li class="breadcrumb-item" aria-current="page">Master Setting</li>
            <li class="breadcrumb-item active" aria-current="page">Define Racks</li>
        </ol>
    </nav>

    <div class="col-lg-11 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i> Racks List</b></div>
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
                                <th class="wd-15p">Racks</th>
                                <th class="wd-25p">Description</th>
                                <th class="wd-10p">Capacity</th>
                                <th class="wd-10p text-center">Sequence</th>
                                <th class="wd-15p text-center">Modify Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($racks as $data)
                                <tr editurl="{{url('MasterAdmin/Library/EditViewRacks/'.$data->id.'/editview')}}"
                                    deleteurl="{{url('/RecordDelete/'.$data->id.'/'.$data->getTable().'/delete')}}">
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td>{{$data->racks}}</td>
                                    <td>{{$data->description}}</td>
                                    <td class="text-center">{{$data->capacity}}</td>
                                    <td class="text-center">{{$data->sequence}}</td>
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
