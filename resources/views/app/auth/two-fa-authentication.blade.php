@extends('layouts.MasterLayout')

@section('content')
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Two Factor Authentication</li>
            </ol>
        </nav>

        <div class="container d-flex justify-content-center ht-100p" style=" padding-top:0px; margin-top:0px; ">

            <div class="panel panel-default">
                <div class="panel-heading"><b><i class="fa fa-key"></i> Two Factor Authentication (Enable/Disable)</b></div>
                <div class="panel-body pd-b-15">

            <div class="mx-wd-300 wd-sm-550 ht-100p d-flex flex-column align-items-center justify-content-center">
                <div class="wd-80p wd-sm-200 mg-t-10 mg-b-15"><img src="{{asset('assets/img/img18.png')}}" class="img-fluid" alt=""></div>
                <p class="tx-color-03 mg-b-10 tx-center">Enter your current password</p>
                <form action="{{url('/TwoFaPost/'.auth()->id().'/2fa')}}" method="POST" data-parsley-validate="" novalidate="">
                    {{csrf_field()}}
                    <div col-lg-12>
                        <lable><b>Two Factor Authentication Status : </b></lable>
                        <table class="mg-t-5">
                            <tr>
                                <td>
                                    <input type="radio" class="two_fa_at" name="two_fa_at" value="yes" @if(auth()->user()->two_fa_at=="yes") checked @endif>
                                </td>
                                <td>Enable</td>
                                <td class="wd-sm-10"></td>
                                <td class="pg-l-10">
                                    <input type="radio" class="two_fa_at" name="two_fa_at" value="no" @if(auth()->user()->two_fa_at=="no") checked @endif>
                                </td>
                                <td>Disable</td>
                            </tr>
                        </table>
                    </div>
                    <div col-lg-12>
                        <label>Password <sup>*</sup>:</label>
                        <input type="password" id="current_password" name="current_password" class="form-control wd-sm-400 flex-fill" placeholder="Enter your password" required>
                    </div>

                    <div class="col-lg-12 mg-t-15 p-0">
                        <button type="submit" class="btn btn-primary float-right"><i class="fa fa-check"></i> Change 2FA</button>
                    </div>

                </form>

            </div>
                </div>
            </div>
        </div><!-- container -->
@endsection
