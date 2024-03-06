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
            <li class="step-item active">
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
        <form action="{{url('/CreateSchoolBranch')}}" method="POST" enctype="multipart/form-data" data-parsley-validate="" novalidate="">
            {{ csrf_field() }}


            <div class="row  pd-lg-l-15">
                <div class="col-lg-3">
                    <label>School <sup>*</sup> : </label>
                    <select class="form-control input-sm" id="school_id" name="school_id">
                        <option value="1">---Select---</option>
                        @foreach($school as $data)
                            <option value="{{$data->id}}" selected>{{$data->school_name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-lg-3">
                    <label>School Branch Name <sup>*</sup>  : </label>
                    <input type="text" id="school_name" name="school_name" class="form-control input-sm" placeholder="Enter School Name" required>
                </div>

                <div class="col-lg-3">
                    <label>Address <sup>*</sup>  : </label>
                    <input type="text" id="address" name="address" class="form-control input-sm" placeholder="Enter School Address" required>
                </div>

                <div class="col-lg-12 m-2">
                    <button type="submit" class="btn btn-primary btn-lg  pull-right mg-r-10" style=" float:right; ">Next <i class="fa fa-arrow-right"></i></button>
                </div>

            </div>
        </form>
    </div>


@endsection
