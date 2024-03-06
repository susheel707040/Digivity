@extends('layouts.AuthLayouts')
@section('title','DIGI SHIKSHA - SETUP')
@section('content')
    <div data-label="Example" class="df-example  ml-lg-4 mt-lg-4 mb-lg-0">
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
            <li class="step-item active">
                <a href="#" class="step-link">
                    <span class="step-icon"><i class="fa fa-key"></i></span>
                    <div>
                        <span class="step-title">Verify School</span>
                        <span class="step-desc">Verify your School details.</span>
                    </div>
                </a>
            </li>
            <li class="step-item disabled">
                <a href="#" class="step-link">
                    <span class="step-icon"><i class="fa fa-building"></i></span>
                    <div>
                        <span class="step-title">School Branch Information</span>
                        <span class="step-desc">Enter your School Branch details.</span>
                    </div>
                </a>
            </li>
            <li class="step-item disabled">
                <a href="#" class="step-link">
                    <span class="step-icon"><i class="fa fa-couch"></i></span>
                    <div>
                        <span class="step-title">Academic Session Information</span>
                        <span class="step-desc">Enter your School Current Session details.</span>
                    </div>
                </a>
            </li>
            <li class="step-item disabled">
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

    <div class="content content-fixed content-auth-alt" style=" padding-top:0px; margin-top:0px;  ">
        <div class="container ht-100p" style=" padding-top:0px; margin-top:0px;  ">
            <div class="ht-100p d-flex flex-column align-items-center justify-content-center" style=" padding-top:0px; margin-top:0px;  ">
                <div class="wd-150 wd-sm-250 mg-b-0"><img src="public/assets/img/img17.png" class="img-fluid" alt=""></div>
                <h4 class="tx-20 tx-sm-24">Verify your School with OTP</h4>
                <p class="tx-color-03 mg-b-20 text-xl-center">
                    Please check your email and mobile<br/> <b>6-digit One Time Password (OTP)</b> has been sent to
                    your mobile <b>{{\App\Helper\StringLength::string($mobile_no,4)}}</b> OR email <b>{{\App\Helper\StringLength::string($email_address,4)}}.</b>
                    <br/>please enter the same here to verify school.
                </p>
                <form action="{{url('/VerifySchool')}}" enctype="multipart/form-data" method="POST" data-parsley-validate="" novalidate="">
                    {{ csrf_field() }}
                    <div class="wd-100p d-flex flex-column flex-sm-row mg-b-0">
                        <table>
                            <tr>
                                <td>
                                    <input type="text" autocomplete="off" name="otp" id="otp" class="form-control wd-sm-300 flex-fill" placeholder="Enter one time password (OTP)" required>

                                </td>
                                <td>
                                    <button type="submit" class="btn btn-brand-02 mg-sm-l-10 mg-t-10 mg-sm-t-0">Verify & Login</button>

                                </td>
                            </tr>

                        </table>
                        <div class="clearfix"></div>

                    </div>
                    <div class="wd-100p d-flex flex-column flex-sm-row mg-b-40 mg-t-10">
                        <button type="button" class="btn btn-xs btn-outline-twitter d-inline-flex tx-14 " style=" padding-top:0px; padding-bottom:0px;">Resend OTP</button>
                    </div>
                </form>
                <span class="tx-12 tx-color-03">
                 <a href="#" class="btn btn-white d-inline-flex pull-right mg-l-5 tx-14"><i class="fa fa-phone mg-r-5 mg-t-3"></i> Contact Support</a>
                </span>
            </div>
        </div><!-- container -->
    </div><!-- content -->



@endsection
