@extends('layouts.AuthLayouts')

@section('title','DIGI SHIKSHA - SETUP')

@section('content')
    <div data-label="Example" class="df-example ml-lg-4 mt-lg-4 mb-lg-2">
        <ul class="steps">
            <li class="step-item active">
                <a href="#" class="step-link">
                    <span class="step-icon"><i class="fa fa-home"></i></span>
                    <div>
                        <span class="step-title">School Information</span>
                        <span class="step-desc">Enter your School details.</span>
                    </div>
                </a>
            </li>

            <li class="step-item disabled">
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

    <div class="col-lg-12">
        <form action="{{url('/CreateSchool')}}" method="POST" enctype="multipart/form-data"  data-parsley-validate="" novalidate="">
            {{ csrf_field() }}
            <div class="row  pd-lg-l-15">
                <div class="col-lg-3">
                    <label>School Name <sup>*</sup>: </label>
                    <input type="text" autocomplete="off" id="school_name" name="school_name"
                           class="form-control input-sm" placeholder="Enter School Name" required>
                </div>
                <div class="col-lg-3">
                    <label>School No. : </label>
                    <input type="text" autocomplete="off" class="form-control input-sm" id="school_no" name="school_no"
                           placeholder="Enter School Number">
                </div>

                <div class="col-lg-3">
                    <label>Affiliation To : </label>
                    <input type="text" autocomplete="off" class="form-control input-sm" id="affiliation_to"
                           name="affiliation_to" placeholder="Enter School Affiliation To">
                </div>

                <div class="col-lg-3">
                    <label>School Short Name : </label>
                    <input type="text" autocomplete="off" class="form-control input-sm" id="school_short_name"
                           name="school_short_name" placeholder="Enter School Short Name">
                </div>


                <div class="col-lg-3">
                    <label>Affiliation No. : </label>
                    <input type="text" autocomplete="off" class="form-control input-sm" id="affiliation_no"
                           name="affiliation_no" placeholder="Enter Affiliation Number">
                </div>

                <div class="col-lg-3">
                    <label>Associates : </label>
                    <input type="text" autocomplete="off" class="form-control input-sm" id="associates"
                           name="associates" placeholder="Enter School Associates with">
                </div>

                <div class="col-lg-3">
                    <label>Trust/Society Name : </label>
                    <input type="text" autocomplete="off" class="form-control input-sm" id="trust_society_name"
                           name="trust_society_name" placeholder="Enter Trust/Society Name">
                </div>

                <div class="col-lg-3">
                    <label>Trust/Society No. : </label>
                    <input type="text" autocomplete="off" class="form-control input-sm" id="trust_society_no"
                           name="trust_society_no" placeholder="Enter Trust/Society Number">
                </div>

                <div class="col-lg-3">
                    <label>Contact Number <sup>*</sup> : </label>
                    <input type="text" autocomplete="off" class="form-control input-sm" id="contact_number"
                           name="contact_number" placeholder="Enter Contact Number" required>
                </div>

                <div class="col-lg-3">
                    <label>Email Address <sup>*</sup> :</label>
                    <input type="text" autocomplete="off" class="form-control input-sm" id="email_address"
                           name="email_address" placeholder="Enter Email Address" required>
                </div>

                <div class="col-lg-3">
                    <label>Support Email :</label>
                    <input type="text" autocomplete="off" class="form-control input-sm" id="support_email"
                           name="support_email" placeholder="Enter School Support Email">
                </div>

                <div class="col-lg-3">
                    <label>Website :</label>
                    <input type="text" autocomplete="off" class="form-control input-sm" id="website" name="website"
                           placeholder="Enter School Website">
                </div>


                <div class="col-lg-6">
                    <label>Address 1 <sup>*</sup> :</label>
                    <input type="text" autocomplete="off" class="form-control input-sm" id="address1" name="address1"
                           placeholder="Enter School Address 1" required>
                </div>

                <div class="col-lg-6">
                    <label>Address 2 :</label>
                    <input type="text" autocomplete="off" class="form-control input-sm" id="address2" name="address2"
                           placeholder="Enter School Address 2">
                </div>

                <div class="col-lg-3">
                    <label>Establishment Year : </label>
                    <input type="text" autocomplete="off" class="form-control input-sm" id="establishment_year"
                           name="establishment_year" placeholder="Enter School Establishment Year">
                </div>

                <div class="col-lg-3">
                    <label>Establishment Code : </label>
                    <input type="text" autocomplete="off" class="form-control input-sm" id="establishment_code"
                           name="establishment_code" placeholder="Enter School Establishment Code">
                </div>


                <div class="col-lg-3">
                    <label>Chairman/Founder : </label>
                    <input type="text" autocomplete="off" class="form-control input-sm" id="chairman" name="chairman"
                           placeholder="Enter School Chairman/Founder">
                </div>

                <div class="col-lg-3">
                    <label>ISO Details : </label>
                    <input type="text" autocomplete="off" class="form-control input-sm" id="iso_details"
                           name="iso_details" placeholder="Enter ISO Details">
                </div>

                <div class="col-lg-3">
                    <label>Working Days : </label>
                    <input type="text" autocomplete="off" class="form-control input-sm" id="working_days"
                           name="working_days" placeholder="Enter School Working Days">
                </div>

                <div class="col-lg-3">
                    <label>School Logo <sup>*</sup> : </label>
                    <input type="file" class="form-control input-sm" id="school_logo" name="school_logo"
                           placeholder="Enter School Name" required>
                </div>


                <div class="col-lg-12 m-2">
                    <button type="submit" class="btn btn-primary btn-lg  pull-right mg-r-10" style=" float:right; ">Next
                        <i class="fa fa-arrow-right"></i></button>
                </div>

            </div>
        </form>
    </div>
@endsection
