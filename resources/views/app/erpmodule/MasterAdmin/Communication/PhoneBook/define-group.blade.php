@extends('layouts.MasterLayout')

@section('ModelTitle','Add New Phonebook Group')
@section('ModelTitleInfo','Manage Phonebook Group')
@section('EditModelTitle','Edit Phonebook Group')
@section('EditModelTitleInfo','Modify Phonebook Group')

@section('AddModelPage')
    @include('app.erpmodule.MasterAdmin.Communication.PhoneBook.Add.add-group')
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Communication</li>
            <li class="breadcrumb-item active" aria-current="page">Phonebook</li>
            <li class="breadcrumb-item active" aria-current="page">Define Phonebook Group</li>
        </ol>
    </nav>

    <div class="col-lg-10 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i> Phonebook Group List</b></div>
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
                                <th class="wd-25p">Phonebook Group</th>
                                <th class="wd-15p text-center">Status</th>
                                <th class="wd-20p text-center">Modify Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($phonebookgroup as $data)
                                <tr editurl="{{url('MasterAdmin/Communication/EditViewPhoneBookGroup/'.$data->id.'/view')}}"
                                    deleteurl="{{url('/RecordDelete/'.$data->id.'/'.$data->getTable().'/delete')}}">
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td>{{$data->phonebook_group}}</td>
                                    <td class="text-center">@if($data->status=="active")<span
                                            class="badge badge-success">Active</span>@else <span
                                            class="badge badge-danger">In-Active</span> @endif</td>
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
