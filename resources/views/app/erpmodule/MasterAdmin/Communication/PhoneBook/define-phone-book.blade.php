@extends('layouts.MasterLayout')

@section('ModelTitle','Add New Phonebook Contact')
@section('ModelTitleInfo','Manage Phonebook Contact')
@section('EditModelTitle','Edit Phonebook Contact')
@section('EditModelTitleInfo','Modify Phonebook Contact')

@section('AddModelPage')
    @include('app.erpmodule.MasterAdmin.Communication.PhoneBook.Add.add-phonebook')
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Communication</li>
            <li class="breadcrumb-item active" aria-current="page">Phonebook</li>
            <li class="breadcrumb-item active" aria-current="page">Define Phonebook Contact</li>
        </ol>
    </nav>

    <div class="col-lg-12 p-0 m-0 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i> Phonebook Contact List</b></div>
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
                                <th class="wd-10p">Group</th>
                                <th>Name</th>
                                <th>Gender</th>
                                <th>Contact No.</th>
                                <th>Email</th>
                                <th>Company</th>
                                <th>Designation</th>
                                <th class="text-center">Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($phonebookcontact as $data)
                                <tr editurl="{{url('MasterAdmin/Communication/EditViewPhoneBookContact/'.$data->id.'/view')}}"
                                    deleteurl="{{url('/RecordDelete/'.$data->id.'/'.$data->getTable().'/delete')}}">
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td class="text-capitalize">{{$data->phonebook_group}}</td>
                                    <td class="text-capitalize">{{$data->title}} {{$data->name}}</td>
                                    <td class="text-capitalize">{{$data->gender}}</td>
                                    <td>{{$data->contact_no}}</td>
                                    <td>{{$data->email}}</td>
                                    <td class="text-capitalize">{{$data->company}}</td>
                                    <td class="text-capitalize">{{$data->designation}}</td>
                                    <td class="text-center">@if($data->status=="active")<span
                                            class="badge badge-success">Active</span>@else <span
                                            class="badge badge-danger">In-Active</span> @endif</td>
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
