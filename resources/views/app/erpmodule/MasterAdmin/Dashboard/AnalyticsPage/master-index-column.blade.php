
<div class="col-sm-6 pd-l-0 pd-r-0 col-lg-3">
    <div class="card card-body">
        <h6 class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold mg-b-8">Student Strength</h6>
        <div class="d-flex d-lg-block d-xl-flex align-items-end">
            <h3 class="tx-normal tx-rubik mg-b-0 mg-r-5 lh-1">@if(isset($studentstrength)){{$studentstrength}}@else {{"0"}} @endif</h3>
            <p class="tx-11 tx-color-03 mg-b-0"><span class="tx-medium tx-success">0.0% <i class="icon ion-md-arrow-up"></i></span> than last week</p>
        </div>
        <div class="chart-three p-0">
            <img style=" width:100%; " src="{{url('assets/images/chart/chart_1.png')}}">
        </div><!-- chart-three -->
    </div>
</div><!-- col -->


<div class="col-sm-6 col-lg-3 pd-r-0 mg-t-10 mg-sm-t-0">
    <div class="card card-body">
        <h6 class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold mg-b-8">Staff Strength</h6>
        <div class="d-flex d-lg-block d-xl-flex align-items-end">
            <h3 class="tx-normal tx-rubik mg-b-0 mg-r-5 lh-1">@if(isset($staff->totalstrength)) {{$staff->totalstrength}} @endif</h3>
            <p class="tx-11 tx-color-03 mg-b-0"><span class="tx-medium tx-success">0.0% <i class="icon ion-md-arrow-up"></i></span> than last week</p>
        </div>
        <div class="chart-three p-0">
            <img style=" width:100%; " src="{{url('assets/images/chart/chart_2.png')}}">
        </div><!-- chart-three -->
    </div>
</div><!-- col -->

<div class="col-sm-6 col-lg-3 pd-r-0 mg-t-10 mg-sm-t-0">
    <div class="card card-body">
        <h6 class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold mg-b-8">Communication Balance</h6>
        <div class="d-flex d-lg-block d-xl-flex align-items-end">
            <h3 class="tx-normal tx-rubik mg-b-0 mg-r-5 lh-1">@if(isset($communicationbalance->text_balance)){{$communicationbalance->text_balance}}@else {{"0"}} @endif</h3>
            <p class="tx-11 tx-color-03 mg-b-0"><span class="tx-medium tx-danger">0.0% <i class="icon ion-md-arrow-down"></i></span> than last week</p>
        </div>
        <div class="chart-three p-0">
            <img style=" width:100%; " src="{{url('assets/images/chart/chart_3.png')}}">
        </div><!-- chart-three -->
    </div>
</div><!-- col -->

<div class="col-sm-6 pd-r-0 col-lg-3 mg-t-10 mg-sm-t-0">
    <div class="card card-body">
        <h6 class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold mg-b-8">Today Fee Collect</h6>
        <div class="d-flex d-lg-block d-xl-flex align-items-end">
            <h3 class="tx-normal tx-rubik mg-b-0 mg-r-5 lh-1">{{numberformat($totalcollect)}}</h3>
            <p class="tx-11 tx-color-03 mg-b-0"><span class="tx-medium tx-success">0.0% <i class="icon ion-md-arrow-up"></i></span> than last week</p>
        </div>
        <div class="chart-three p-0">
            <img style=" width:100%; " src="{{url('assets/images/chart/chart_4.png')}}">
        </div><!-- chart-three -->
    </div>
</div><!-- col -->
