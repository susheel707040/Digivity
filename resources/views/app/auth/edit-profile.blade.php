@extends('layouts.MasterLayout')

@section('content')
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit User Profile</li>
            </ol>
        </nav>

        <div class="col-lg-6 p-0 m-0 mx-auto">
            <div class="panel panel-default">
                <div class="panel-heading"><b><i class="fa fa-edit"></i> Edit User Profile</b></div>
                <div class="panel-body pd-b-10">
                    @if(auth()->id()==$user->id)

                            <div class="row">

                                <div class="col-lg-12 row pd-l-0 pd-t-10 mg-l-0">
                                    <div class="col-3">
                                        <div class="avatar avatar-xxl">
                                            @if(isset($user->profile_img) && $user->profile_img)
                                                <img id="User_image" name="profile_img" src="{{ url('profile_image/' . $user->ProfileImage()) }}" class="rounded-circle bd-3 bd file-{{ $user->id }}" alt="">
                                            @else
                                                <img id="User_image" name="profile_img" src="{{ url('/assets/images/user_no_image.png') }}" class="rounded-circle bd-3 bd file-{{ $user->id }}" alt="">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-5 pd-t-10">
                                        <label>Profile Pictures <sup>*</sup> : </label>
                                        <form class="form_{{$user->id}}" action="{{'/FileUpdateModel'}}" method="POST" enctype="multipart/form-data">
                                            <input type="hidden" name="model_id" value="{{$user->id}}">
                                            <input type="hidden" name="model" value="{{\App\Models\User::class}}">
                                            <input type="hidden" name="model_column" value="profile_img">
                                            <input type="hidden" name="integrate" value="file">
                                            <input type="file" modelid="{{$user->id}}" filename="file-{{$user->id}}" formid="form_{{$user->id}}" alertmsg="alert-msg-{{$user->id}}" name="profile_img" class="form-control file-choose" id="useruploadImage" onchange="userpreview()">
                                            <span class="alert-msg-{{$user->id}} alert-msg-ajax"></span>
                                        </form>
                                    </div>
                                </div>


                                <script>
                                    function userpreview() {
                                        var userpreview = document.getElementById('User_image');
                                        var file    = document.getElementById('useruploadImage').files[0];
                                        var reader  = new FileReader();

                                        reader.onloadend = function () {
                                            userpreview.src = reader.result;
                                        }

                                        if (file) {
                                            reader.readAsDataURL(file);
                                        } else {
                                            userpreview.src = "{{ url('assets/images/no-image-available.png') }}";
                                        }
                                    }
                                </script>



                                <form action="{{url('/EditProfilePost/'.$user->id.'/edit')}}" method="POST"
                                      enctype="multipart/form-data" class="row m-0 p-0">
                                   @csrf

                                <div class="col-lg-6">
                                    <label>School <sup>*</sup> : </label>
                                    <select class="form-control input-sm" id="school_id" name="school_id" disabled>
                                        <option value="1">---Select---</option>
                                        @foreach($school as $data)
                                            <option value="{{$data->id}}" selected>{{$data->school_name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-lg-6">
                                    <label>School Branch Name <sup>*</sup> : </label>
                                    <select class="form-control input-sm" id="branches_id" name="branches_id" disabled>
                                        <option value="1">---Select---</option>
                                        @foreach($schoolbranch as $data)
                                            @if($user->branches_id==$data->id)
                                                <option value="{{$data->id}}" selected>{{$data->school_name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-lg-6">
                                    <label>Academic Year <sup>*</sup> : </label>
                                    <select class="form-control input-sm" id="academic_id" name="academic_id">
                                        <option value="1">---Select---</option>
                                        @foreach($academic as $data)
                                            <option value="{{$data->id}}"
                                                    @if($user->academic_id==$data->id) selected @endif >{{$data->academic_session}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-lg-6">
                                    <label>Finance Year <sup>*</sup> : </label>
                                    <select class="form-control input-sm" id="financial_id" name="financial_id">
                                        <option value="">---Select---</option>
                                        @foreach($financial as $data)
                                            <option value="{{$data->id}}"
                                                    @if($user->financial_id==$data->id) selected @endif >{{$data->financial_session}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-lg-6">
                                    <label>First Name <sup>*</sup> : </label>
                                    <input type="text" autocomplete="off" id="first_name" name="first_name"
                                           value="{{$user->first_name}}" class="form-control input-sm"
                                           placeholder="Enter First Name">
                                </div>

                                <div class="col-lg-6">
                                    <label>Last Name : </label>
                                    <input type="text" autocomplete="off" id="last_name" name="last_name"
                                           class="form-control input-sm"
                                           value="{{$user->last_name}}" placeholder="Enter Last Name">
                                </div>

                                <div class="col-lg-6">
                                    <label> Gender <sup>*</sup> : </label>
                                    <select name="gender" id="gender" class="form-control input-sm">
                                        <option value="0">---Select---</option>
                                        <option value="male" @if($user->gender=="male") selected @endif>Male</option>
                                        <option value="female" @if($user->gender=="female") selected @endif>Female
                                        </option>
                                        <option value="transgender" @if($user->gender=="transgender") selected @endif>
                                            Transgender
                                        </option>
                                    </select>
                                </div>

                                <div class="col-lg-6">
                                    <label> Date of Birth <sup>*</sup> : </label>
                                    <input type="text" autocomplete="off" id="dob" name="dob"
                                           class="form-control input-sm"
                                           value="{{$user->dob}}" placeholder="Enter Date of Birth">
                                </div>

                                <div class="col-lg-6">
                                    <label>Contact Number <sup>*</sup> : </label>
                                    <input type="text" autocomplete="off" id="contact_no" name="contact_no"
                                           value="{{$user->contact_no}}" class="form-control input-sm"
                                           placeholder="Enter Contact Number">
                                </div>

                                <div class="col-lg-6">
                                    <label>Email Address <sup>*</sup> : </label>
                                    <input type="text" autocomplete="off" id="email" name="email"
                                           class="form-control input-sm"
                                           value="{{$user->email}}" placeholder="Enter Email Address">
                                </div>

                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn-primary pull-right mg-r-10 mg-t-10"
                                            style=" float:right; ">
                                        <i class="fa fa-check"></i> Update
                                    </button>
                                </div>
                                </form>
                            </div>
                    @endif
                </div>
            </div>

        </div>
@endsection
