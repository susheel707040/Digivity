@extends('layouts.AuthLayouts')
@section('title','DIGI PRO - SETUP')
@section('content')
    <div data-label="Example" class="df-example  ml-lg-4 mt-lg-4 mb-lg-2">
        <ul class="steps">
            <li class="step-item complete">
                <a href="#" class="step-link">
                    <span class="step-icon"><i class="fa fa-home"></i></span>
                    <div>
                        <span class="step-title">School Information</span>
                        <span class="step-desc">Enter your School details.</span>
                    </div>
                </a>
            </li>
            <li class="step-item complete">
                <a href="#" class="step-link">
                    <span class="step-icon"><i class="fa fa-key"></i></span>
                    <div>
                        <span class="step-title">Verify School</span>
                        <span class="step-desc">Verify your School details.</span>
                    </div>
                </a>
            </li>
            <li class="step-item complete">
                <a href="#" class="step-link">
                    <span class="step-icon"><i class="fa fa-building"></i></span>
                    <div>
                        <span class="step-title">School Branch Information</span>
                        <span class="step-desc">Enter your School Branch details.</span>
                    </div>
                </a>
            </li>
            <li class="step-item complete">
                <a href="#" class="step-link">
                    <span class="step-icon"><i class="fa fa-couch"></i></span>
                    <div>
                        <span class="step-title">Academic Session Information</span>
                        <span class="step-desc">Enter your School Current Session details.</span>
                    </div>
                </a>
            </li>
            <li class="step-item active">
                <a href="#" class="step-link">
                    <span class="step-icon"><i class="fa fa-user"></i></span>
                    <div>
                        <span class="step-title">Administration Information</span>
                        <span class="step-desc">Enter your School Administration details.</span>
                    </div>
                </a>
            </li>
        </ul>
    </div>

    <div class="col-lg-12 mx-auto">
        <form action="{{url('/CreateAdmin')}}" method="POST" enctype="multipart/form-data" data-parsley-validate="" novalidate="">
            {{ csrf_field() }}


            <div class="row  pd-lg-l-15">
                <div class="col-lg-3">
                    <label>School <sup>*</sup> : </label>
                    <select class="form-control input-sm" id="school_id" name="school_id" required>
                        <option value="">---Select---</option>
                        @foreach($school as $data)
                            <option value="{{$data->id}}" selected>{{$data->school_name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-lg-3">
                    <label>School Branch Name <sup>*</sup> : </label>
                    <select class="form-control input-sm" id="branches_id" name="branches_id" required>
                        <option value="">---Select---</option>
                        @foreach($schoolbranch as $data)
                            <option value="{{$data->id}}">{{$data->school_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-3">
                    <label>Academic Year <sup>*</sup> : </label>
                    <select class="form-control input-sm" id="academic_id" name="academic_id" required>
                        <option value="">---Select---</option>
                        @foreach($academic as $data)
                            <option value="{{$data->id}}"
                                    @if($data->default_at=='yes') selected @endif >{{$data->academic_session}}</option>
                        @endforeach
                    </select>
                </div>


                <div class="col-lg-3">
                    <label>Financial Year <sup>*</sup> : </label>
                    <select class="form-control input-sm" id="financial_id" name="financial_id" required>
                        <option value="">---Select---</option>
                        @foreach($financial as $data)
                            <option value="{{$data->id}}"
                                    @if($data->default_at=='yes') selected @endif >{{$data->financial_session}}</option>
                        @endforeach
                    </select>
                </div>


                <div class="col-lg-3">
                    <label>First Name <sup>*</sup> : </label>
                    <input type="text" autocomplete="off" id="first_name" name="first_name"
                           class="form-control input-sm" placeholder="Enter First Name" required>
                </div>

                <div class="col-lg-3">
                    <label>Last Name : </label>
                    <input type="text" autocomplete="off" id="last_name" name="last_name" class="form-control input-sm"
                           placeholder="Enter Last Name">
                </div>

                <div class="col-lg-3">
                    <label> Gender <sup>*</sup> : </label>
                    <select name="gender" id="gender" class="form-control input-sm" required>
                        <option value="">---Select---</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="transgender">Transgender</option>
                    </select>
                </div>

                <div class="col-lg-3">
                    <label> Date of Birth : </label>
                    <input type="text" autocomplete="off" id="dob" name="dob" class="form-control input-sm"
                           placeholder="Enter Date of Birth">
                </div>

                <div class="col-lg-3">
                    <label>Contact Number <sup>*</sup> : </label>
                    <input type="text" autocomplete="off" id="contact_no" name="contact_no"
                           class="form-control input-sm" placeholder="Enter Contact Number" required>
                </div>

                <div class="col-lg-3">
                    <label>Email Address <sup>*</sup> : </label>
                    <input type="text" autocomplete="off" id="email" name="email" class="form-control input-sm"
                           placeholder="Enter Email Address" required>
                </div>

                <div class="col-lg-3">
                    <label>Profile Picture : </label>
                    <input type="file" autocomplete="off" id="profile_img" name="profile_img"
                           class="form-control input-sm">
                </div>

                <div class="clearfix"></div>
                <div class="col-lg-3">
                    <label>Administration Role <sup>*</sup> : </label>
                    <select id="role_id" name="role_id" class="form-control input-sm" required>
                        @if(!isset($role))
                            <option value="0">---Select---</option>
                        @endif
                        @foreach($role as $data)
                            <option value="{{$data->id}}">{{$data->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-lg-3">
                    <label>Username <sup>*</sup> : </label>
                    <input type="text" autocomplete="off" id="username" name="username" class="form-control input-sm"
                           placeholder="Enter Username" required>
                </div>

                <div class="col-lg-3">
                    <label>New Password <sup>*</sup> : </label>
                    <input type="password" autocomplete="off" id="password" name="password"
                           class="form-control input-sm"
                           class="form-control input-sm"
                           placeholder="Enter New Password" required>
                </div>

                <div class="col-lg-3">
                    <label>Confirm Password <sup>*</sup> : </label>
                    <input type="password" autocomplete="off" id="confirm_password" name="confirm_password"
                           class="form-control input-sm"
                           placeholder="Enter Confirm Password" required>
                </div>


                <div class="col-lg-4">
                    <label>Enable 2FA <sup>*</sup> : <input type="checkbox" name="2fa_at" id="2fa_at"
                                                            value="yes"></label>
                    <div class="clearfix"></div>
                    <span><b>(two factor authentication)</b></span>
                </div>


                <div class="col-lg-12 m-2">
                    <button type="submit" class="btn btn-primary btn-lg  pull-right mg-r-10" style=" float:right; ">
                        Finish <i class="fa fa-check"></i></button>
                </div>

            </div>
        </form>
    </div>
@endsection

