@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">User</li>
            <li class="breadcrumb-item active" aria-current="page">Create User</li>
        </ol>
    </nav>
    <div class="col-lg-8 p-0 m-0 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-user-plus"></i> Create New User</b></div>
            <div class="panel-body pd-b-0 row">

                <form action="{{url('/MasterAdmin/User/StoreUser')}}" method="POST" enctype="multipart/form-data" data-parsley-validate="" novalidate="">
                   {{csrf_field()}}
                 <div class="col-lg-12 mx-auto row pd-t-10 pd-b-10 pd-l-0 pd-r-0">
                <div class="col-lg-4">
                    <label><b>Academic Year <sup>*</sup> :</b></label>
                    <select name="academic_id" class="form-control input-sm" required>
                        <option value="">---Select---</option>
                        @foreach(academicyearlist([]) as $data)
                            <option value="{{$data->id}}">{{$data->academic_session}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-4">
                    <label><b>Finance Year <sup>*</sup> :</b></label>
                    <select name="financial_id" class="form-control input-sm" required>
                        <option value="">---Select---</option>
                        @foreach(financialyearlist([]) as $data)
                            <option value="{{$data->id}}">{{$data->financial_session}}</option>
                        @endforeach
                    </select>
                </div>
                     <div class="col-lg-4">
                         <label><b>School Branch <sup>*</sup> :</b></label>
                         <select name="branches_id" class="form-control input-sm" required>
                             <option value="">---Select---</option>
                             @foreach(schoolbranchlist([]) as $data)
                                 <option value="{{$data->id}}">{{$data->school_name}}</option>
                             @endforeach
                         </select>
                     </div>

                    <div class="col-lg-4">
                        <label><b>First Name <sup>*</sup> :</b></label>
                        <input type="text"  name="first_name" placeholder="Enter First Name" autocomplete="off" class="form-control input-sm" required>
                    </div>
                    <div class="col-lg-4">
                        <label><b>Last Name :</b></label>
                        <input type="text" name="last_name" placeholder="Enter Last Name" autocomplete="off" class="form-control input-sm">
                    </div>
                    <div class="col-lg-4">
                        <label><b>Gender :</b></label>
                        <select name="gender" class="form-control input-sm">
                            <option value="">---Select---</option>
                            @foreach($genderlist as $data)
                                <option value="{{$data}}">{{ucfirst($data)}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-4">
                        <label><b>Date of Birth :</b></label>
                        <input type="text" name="dob" placeholder="Enter Date of Birth (dd-mm-yyyy) " autocomplete="off" class="form-control date input-sm" ref="">
                    </div>
                    <div class="col-lg-4">
                        <label><b>Contact No. <sup>*</sup> :</b></label>
                        <input type="text" name="contact_no" placeholder="Enter Contact Number" autocomplete="off" class="form-control input-sm"  required>
                    </div>
                    <div class="col-lg-4">
                        <label><b>Email <sup>*</sup> :</b></label>
                        <input type="text" name="email" data-parsley-type="email" placeholder="Enter Email" autocomplete="off" class="form-control input-sm" required>
                    </div>
                    <div class="col-lg-4">
                        <label><b>Profile :</b></label>
                        <input type="file" placeholder="Enter First Name" autocomplete="off" class="form-control input-sm" ref="">
                    </div>

                    <div class="col-lg-4">
                        <label><b>2FA Status <sup>*</sup> :</b></label>
                 <table>
                     <tr>
                         <td><input type="radio" name="two_fa_at" value="yes"></td><td class="pd-l-5">Enable</td>
                         <td class="pd-l-15"><input type="radio" value="no" name="two_fa_at" checked></td><td class="pd-l-5">Disable</td>
                     </tr>
                 </table>
                    </div>
                    <div class="col-lg-4">
                        <label><b>Role <sup>*</sup> :</b></label>
                        @include('components.role-import',['class'=>'form-control','required'=>'required'])
                    </div>
                    <div class="col-lg-4">
                        <label><b>Username <sup>*</sup> :</b></label>
                        <input type="text" name="username" placeholder="Enter Username" autocomplete="off" class="form-control input-sm" required>
                    </div>
                    <div class="col-lg-4">
                        <label><b>New Password <sup>*</sup> :</b></label>
                        <input type="password" id="password1" placeholder="Enter New Password" name="password" autocomplete="off" class="form-control input-sm" data-parsley-minlength="8" required>
                    </div>
                    <div class="col-lg-4">
                        <label><b>Re-type Password <sup>*</sup> :</b></label>
                        <input type="password" placeholder="Enter Re-type Password" data-parsley-equalto="#password1" name="retype_password" autocomplete="off" class="form-control input-sm" required>
                    </div>
                    <div class="col-lg-12 pd-b-10">
                        <button type="submit" class="btn btn-primary mg-t-15 btn-lg wd-150 float-right"><i class="fa fa-check"></i> Submit</button>
                    </div>
                </div>
                </form>

            </div>
        </div>
    </div>
@endsection
