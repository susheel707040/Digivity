@extends('layouts.MasterLayout')

@section('content')
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">User Profile</li>
                </ol>
            </nav>

            <div class="col-lg-12 p-0 m-0">
                <div class="panel panel-default">
                    <div class="panel-heading"><b><i class="fa fa-user-lock"></i> User Profile</b></div>
                    <div class="panel-body row pd-b-10">

                        <div class="col-lg-4 p-0 m-0">


                            <div class="col-sm-3 col-md-2 col-lg pd-t-10">
                                <div class="avatar avatar-xxl">
                                    <img src="{{ url('profile_image/' . auth()->user()->ProfileImage()) }}" class="rounded-circle" alt="">

                                </div>
                            </div><!-- col -->
                            <div class="col-sm-8 col-md-7 col-lg mg-t-5 mg-sm-t-0 mg-lg-t-5">
                                <h5 class="mg-b-1 tx-spacing--1">{{auth()->user()->first()->FullName()}}</h5>
                                <p class="tx-color-03 mg-b-10">{{auth()->user()->name ?? '' }}</p>
                                <p class="tx-color-03 tx-12 mg-b-5 text-danger">Last Login is 01-Apr-2019 11:25:00 AM</p>
                                <div class="d-flex mg-b-5">
                                    <a href="{{url('/EditUserProfile/'.auth()->id().'/edit')}}"><button type="button" class="btn btn-xs btn-outline-success btn-outline-primary btn-sm flex-fill"><i class="fa fa-edit"></i> Edit Profile</button></a>
                                    <a href="{{url('/ChangePassword')}}"><button type="button" class="btn btn-xs btn-outline-info flex-fill  mg-l-5"><i class="fa fa-edit"></i> Change Password</button></a>
                                    <a href="{{url('/logout')}}"><button type="button" class="btn btn-xs btn-outline-danger flex-fill mg-l-5"><i class="fa fa-sign-out-alt"></i> Sign Out</button></a>
                                </div>


                                <div class="d-flex mg-t-10">
                                    <div class="profile-skillset flex-fill">
                                        <h4 style=" margin-bottom:0; "><a href="#" class="link-01">1.4k</a></h4>
                                        <label style=" margin-top: 0;"><b>Login Attempt</b></label>
                                    </div>
                                    <a href="{{url('/TwoFaAuthentication')}}">
                                    <div class="profile-skillset flex-fill">
                                        <h4 style=" margin-bottom:0; " >@if(auth()->user()->first()->two_fa_at=="yes") <span class="badge badge-success">Enable</span>  @else  <span class="badge badge-danger">Disable</span> @endif</h4>
                                        <label style=" margin-top: 0;" ><center><b>2FA Status</b></center></label>
                                    </div>
                                    </a>
                                    <div class="profile-skillset flex-fill mg-l-30">
                                        <h4 style=" margin-bottom:0; " >@if(auth()->user()->first()->active_at=="yes") <span class="badge badge-success">Active</span>  @else  <span class="badge badge-danger">Deactive</span> @endif</h4>
                                        <label style=" margin-top: 0;"><b>User Status</b></label>
                                    </div>
                                </div>
                            </div><!-- col -->
                            <div class="col-sm-6 col-md-5 col-lg mg-t-10">
                                <label class="tx-sans tx-13 tx-semibold tx-uppercase tx-color-01 tx-spacing-1 mg-b-15">User Profile Information</label>
                                <nav class="nav nav-classic tx-13">
                                    <a class="nav-link"><i data-feather="user"></i> <span>{{auth()->user()->first()->FullName()}}</span></a>
                                    <a class="nav-link"><i data-feather="users"></i> <span>{{ucfirst(auth()->user()->first()->gender)}}</span></a>
                                    <a class="nav-link"><i data-feather="calendar"></i> <span>
                                         @if (auth()->user()->dob)
                                         @php
                                          $dob = is_string(auth()->user()->dob) ? new DateTime(auth()->user()->dob) : auth()->user()->dob;
                                          @endphp
                                          {{ $dob->format("d-M-Y") }}
                                            {{-- {{ auth()->user()->dob->format("d-M-Y") }} --}}
                                        @else
                                            N/A or any default value you prefer
                                        @endif</span></a>
                                    <a class="nav-link"><i data-feather="phone"></i> <span>{{auth()->user()->first()->contact_no}}</span></a>
                                    <a class="nav-link"><i data-feather="at-sign"></i> <span>{{auth()->user()->first()->email}}</span></a>
                                </nav>
                            </div><!-- col -->
                        </div><!-- row -->

                        <div class="col-lg-8 p-0 m-0">


                            <div class="media-body mg-t-40 mg-lg-t-10 pd-lg-x-10">


                                <div class="card mg-b-20 mg-lg-b-25">
                                    <div class="card-header pd-y-15 pd-x-20 d-flex align-items-center justify-content-between">
                                        <h6 class="tx-uppercase mg-b-0"><i class="fa fa-grid"></i> Map With Modules</h6>
                                    </div><!-- card-header -->
                                    <div class="card-body pd-20 pd-lg-25">


                                    </div>

                                </div><!-- card -->


                                <div class="card mg-b-20 mg-lg-b-10">
                                    <div class="card-header pd-y-15 pd-x-20 d-flex align-items-center justify-content-between">
                                        <h6 class="tx-uppercase mg-b-0">Recent Login History</h6>

                                    </div><!-- card-header -->
                                    <div class="card-body pd-20 pd-lg-25">


                                    </div>

                                </div><!-- card -->


                            </div><!-- media-body -->

                    </div>
                </div>
                </div>
            </div>


@endsection
