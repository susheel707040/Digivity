@extends('layouts.MasterLayout')

@section('content')
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Change Password</li>
            </ol>
        </nav>

        <div class="container d-flex justify-content-center ht-100p" style=" padding-top:0px; margin-top:0px; ">

            <div class="panel panel-default">
                <div class="panel-heading"><b><i class="fa fa-key"></i> Change your password</b></div>
                <div class="panel-body pd-b-10">
            <div class="mx-wd-300 wd-sm-450 ht-100p d-flex flex-column align-items-center justify-content-center">
                <div class="wd-80p wd-sm-200 mg-b-10"><img src="{{asset('assets/img/img18.png')}}" class="img-fluid" alt=""></div>
                <p class="tx-color-03 mg-b-10 tx-center">Enter your username or email address and we will send you a link to reset your password.</p>
                <form action="{{url('/ChangePasswordPost/'.auth()->id().'/password')}}" method="POST"  data-parsley-validate="" novalidate="">
                    {{csrf_field()}}
                        <div col-lg-12>
                          <label>Old Password <sup>*</sup>:</label>
                            <input type="password" id="old_password" name="old_password" class="form-control wd-sm-400 flex-fill" placeholder="Enter your old password" required>
                        </div>
                        <div col-lg-12>
                            <label>New Password <sup>*</sup>:</label>
                            <input type="password" id="password" name="password" class="form-control wd-sm-400 flex-fill" placeholder="Enter your new password" required>
                        </div>
                        <div col-lg-12>
                            <label>Re-type Password <sup>*</sup>:</label>
                            <input type="password" id="re_type_password" name="re_type_password" class="form-control wd-sm-400 flex-fill" placeholder="Enter your re-type password" required>
                        </div>
                        <div class="col-lg-12 mg-t-15 p-0">
                            <button type="submit" class="btn btn-primary float-right"><i class="fa fa-check"></i> Change Password</button>
                        </div>

                </form>

            </div>
                </div>
            </div>
        </div><!-- container -->
@endsection
