@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Staff</li>
            <li class="breadcrumb-item active" aria-current="page">Reports</li>
            <li class="breadcrumb-item active" aria-current="page">Staff/Employee List</li>
        </ol>
    </nav>

    <div class="col-lg-12 p-0 m-0">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i> Staff/Employee List</b></div>
            <div class="panel-body pd-b-0 row">

                <form action="{{url('MasterAdmin/Staff/StaffList')}}" class="container-fluid" method="POST">
                {{csrf_field()}}
                    <div class="col-lg-12 p-0 nav-line">
                        <div class="row tx-12 pd-l-0 pd-r-0 pd-b-10 m-0">

                            <div class="col-lg-2 pd-l-0 pd-r-5">
                            <label><b>Profession Type :</b></label>
                            @include('components.Staff.profession-import',['selectid'=>0])
                            </div>

                            <div class="col-lg-2 pd-r-5">
                                <label><b>Staff Type :</b></label>
                                @include('components.Staff.staff-type-import',['selectid'=>0])
                            </div>

                            <div class="col-lg-2 pd-r-5">
                                <label><b>Department :</b></label>
                                @include('components.Staff.department-import',['selectid'=>0])
                            </div>

                            <div class="col-lg-2">
                                <label><b>Designation :</b></label>
                                @include('components.Staff.designation-import',['selectid'=>0])
                            </div>
                            <div class="col-lg-2">
                                <button type="submit" class="btn mg-t-20 btn-primary btn-sm"><i class="fa fa-search"></i> Get Result</button>
                            </div>
                            <div class="col-lg-12 pd-t-3 pd-l-0">
                                <span class="tx-primary"><b><i class="fa fa-search"></i> Advance Search</b></span>
                            </div>
                        </div>
                    </div>
                </form>


                <div class="col-lg-12 p-0">
                    <div class="col-lg-12 pd-r-0 text-right">@include('layouts.actionbutton.action-button-verticle',['sms'=>1])</div>
                    <table id="example2" class="table mg-t-10 datatable tx-11 table-bordered">
                        <thead class="bg-light">
                        <tr>
                            <th class="text-center">S.No.</th>
                            <th class="text-center"><input type="checkbox" class="CheckAll" value="checkbox1"></th>
                            <th class="text-center">Staff ID/No.</th>
                            <th>Staff Type</th>
                            <th>Department</th>
                            <th>Designation</th>
                            <th>Staff Name</th>
                            <th>Father</th>
                            <th>Spouse</th>
                            <th class="flex-fill">Contact No.</th>
                            <th class="flex-fill">Address</th>
                            <th class="text-center">Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($staff as $data)
                        <tr>
                            <td class="text-center">{{$loop->iteration}}</td>
                            <td class="text-center"><input type="checkbox" class="checkbox1"></td>
                            <td class="text-center">{{$data->staff_no}}</td>
                            <td>{{$data->StaffTypeName()}}</td>
                            <td>{{$data->DepartmentName()}}</td>
                            <td>{{$data->DesignationName()}}</td>
                            <td>{{$data->fullName()}}</td>
                            <td>{{$data->FatherName()}}</td>
                            <td>{{$data->SpouseName()}}</td>
                            <td>{!! \App\Helper\MobileNumberValidate::validate($data->contact_no) !!}</td>
                            <td>{{$data->Address()}}</td>
                            <td class="text-center"><span class="badge badge-success">Active</span></td>
                            <td class="col-hide">
                                <div class="container-fluid col-hide dropdown pd-t-3 pd-b-3 text-right">
                                    <button class="badge container-fluid pd-t-7 pd-b-7 border-primary tx-11 dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: black;">Quick Action</button>
                                    <div class="dropdown-menu bg-light dropdown-menu-right shadow-lg tx-12" x-placement="bottom-start" style="position:absolute; will-change: transform; top: 0px; left: 0;  transform: translate3d(0px, 25px, 0px);">
                                        <a href="{{url('MasterAdmin/Staff/EditViewStaff/'.$data->id.'/editview')}}"><li class="dropdown-item" url=""><i class="fa fa-edit"></i> Modify Detail</li></a>
                                        <a target="_blank" loader-disable="true" href=""><li class="dropdown-item" url=""><i class="fa fa-edit"></i> Inactive</li></a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
