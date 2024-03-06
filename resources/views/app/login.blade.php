@extends('layouts.AuthLayouts')
@section('content')
    <div class="content content-fixed content-auth mg-t-30 ">
        <div class="container">
            <div class="media align-items-stretch justify-content-center ht-100p pos-relative">
                <div class="media-body align-items-center d-none d-lg-flex">
                    <div class="mx-wd-600 mx-ht-100p">
                        <img src="{{ asset('/assets/img/newimg.svg') }}" class="img-fluid" alt="">
                    </div>
                    <div class="pos-absolute b-0 l-0 tx-12 tx-center">
                        <!--text sms template any message-->
                    </div>
                </div><!-- media-body -->
                <div class="sign-wrapper col-lg-4 p-0 m-0 mg-lg-l-50 mg-xl-l-60">
                    <div class="wd-100p">
                        <div class="col-sm04">
                           <img width='90px' src="{{ asset('/assets/img/digivityLogo.jpg') }}">
                            {{-- <img width='90px' src="{{ asset($school->school_logo) }}"> --}}
                            <h3 class="tx-color-01 tx-20 mg-b-0 mg-t-5"><b>{{ $school->school_name }}</b></h3>
                            <p class="tx-color-03 tx-12 mg-b-10"><b>{{ $school->address1 }}</b></p>
                        </div>
                        <h3 class="tx-color-02 tx-20 mg-b-0">Sign In</h3>
                        <p class="tx-color-03 tx-14 mg-b-5">Welcome back again! Please sign in to continuedjdjkkjdknk.</p>
                        <form action="{{ url('/AttemptLogin') }}" method="POST" data-parsley-validate="" novalidate=""
                            style='width:100%;'>
                            {{ csrf_field() }}
                            <input type="hidden" name="school_id" value="{{ $school->school_id }}">
                            <div class="form-group">
                                <input type="text" tabindex="1" class="form-control" autocomplete="off"
                                    id="login_username" name="username" placeholder="Enter your username" required="">
                            </div>
                            <div class="form-group">
                                <div class="d-flex justify-content-between mg-b-0">

                                </div>
                                <input type="password" tabindex="2" class="form-control" autocomplete="off"
                                    id="login_password" name="password" placeholder="Enter your password" required="">

                                <div align="right"> <a tabindex="-1" href="{{ route('auth.resetpassword') }}"
                                        class="tx-13">Forgot password?</a></div>
                            </div>
                            <button type="submit" tabindex="3" class="btn btn-brand-0 badge-success text-purple btn-block">Log in <i
                                    class="fa fa-arrow-right"></i></button>
                        </form>

                        <div class="divider-text">or</div>
                        {{-- <button class="btn btn-outline-facebook btn-block">Sign Up With DIGI SHIKSHA</button> --}}
                        <div class="tx-13 mg-t-15 tx-center">Don't have an account? <a target="_blank" tabindex="-1"
                                href="https://www.digishiksha.in">Create an
                                Account</a></div>
                    </div>
                </div><!-- sign-wrapper -->
            </div><!-- media -->
        </div><!-- container -->
    </div><!-- content -->
@endsection
