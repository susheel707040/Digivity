@extends('layouts.AuthLayouts')
@section('title','DIGI PRO - SETUP')
@section('content')
    <div data-label="Example" class="df-example  ml-lg-4 mt-lg-4 mb-lg-2">
        <ul class="steps">
            <li class="step-item complete">
                <a href="#" class="step-link">
                    <span class="step-icon"><i class="fa fa-home"></i></span>
                    <div>
                        <span class="step-title">School</span>
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
                        <span class="step-title">School Branch</span>
                        <span class="step-desc">Enter your School Branch details.</span>
                    </div>
                </a>
            </li>
            <li class="step-item complete ">
                <a href="#" class="step-link">
                    <span class="step-icon"><i class="fa fa-couch"></i></span>
                    <div>
                        <span class="step-title">Academic Year</span>
                        <span class="step-desc">Enter your School Current Session details.</span>
                    </div>
                </a>
            </li>
            <li class="step-item active">
                <a href="#" class="step-link">
                    <span class="step-icon"><i class="fa fa-couch"></i></span>
                    <div>
                        <span class="step-title">Financial Year</span>
                        <span class="step-desc">Enter your School Current Session details.</span>
                    </div>
                </a>
            </li>
            <li class="step-item disabled">
                <a href="#" class="step-link">
                    <span class="step-icon"><i class="fa fa-user"></i></span>
                    <div>
                        <span class="step-title">Administration</span>
                        <span class="step-desc">Enter your School Administration details.</span>
                    </div>
                </a>
            </li>
        </ul>
    </div>


    <div class="col-lg-6 mx-auto">
        <form action="{{url('/CreateFinancialYear')}}" method="POST" enctype="multipart/form-data" id="selectForm2"
              class="parsley-style-1" data-parsley-validate="" novalidate="">
            {{ csrf_field() }}
            <div class="row  pd-lg-l-15">
                <div class="col-lg-6">
                    <label>School <sup>*</sup> : </label>
                    <select class="form-control input-sm" id="school_id" name="school_id" required>
                        <option value="0">---Select---</option>
                        @foreach($school as $data)
                            <option value="{{$data->id}}" selected>{{$data->school_name}}</option>

                        @endforeach
                    </select>
                </div>
                <div class="col-lg-6">
                    <label>School Branch <sup>*</sup> : </label>
                    <select class="form-control input-sm" id="branches_id" name="branches_id" required>
                        <option value="">---Select---</option>
                        @foreach($schoolbranch as $data)
                            <option value="{{$data->id}}">{{$data->school_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-12">
                    <label>Financial Year <sup>*</sup> : </label>
                    <input type="text" id="financial_session" name="financial_session" autocomplete="off"
                           class="form-control input-sm" placeholder="Enter Financial Year Like : 2019-2020" required>
                </div>
                <div class="col-lg-6">
                    <label>Financial Year Start Date <sup>*</sup> : </label>
                    <input type="text" id="start_date datepicker1" name="start_date" autocomplete="off"
                           class="form-control date input-sm" placeholder="Enter Session Start Date (dd-mm-yyyy)" required>
                </div>
                <div class="col-lg-6">
                    <label>Financial Year End Date <sup>*</sup> : </label>
                    <input type="text" id="end_date" name="end_date" autocomplete="off" class="form-control date input-sm"
                           placeholder="Enter Session End Date (dd-mm-yyyy)" required>
                </div>
                <div class="col-lg-6">
                    <label>Default Active <sup>*</sup> : <input type="checkbox" value="yes" name="default_at"
                                                                id="default_at" checked></label>
                </div>
                <div class="col-lg-12 m-2 mt-lg-3">
                    <button type="submit" class="btn btn-primary btn-lg  pull-right mg-r-10" style=" float:right; ">Next
                        <i class="fa fa-arrow-right"></i></button>
                </div>
            </div>
        </form>
    </div>



@endsection

<script type="text/javascript">
    $(document).ready(function () {
        $('#datepicker1').datepicker();
    });

</script>
