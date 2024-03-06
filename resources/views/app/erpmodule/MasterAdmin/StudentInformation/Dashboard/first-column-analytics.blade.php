<div class="row row-xs">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header d-sm-flex justify-content-between bd-b-0 pd-t-20 pd-b-0">
                <div class="mg-b-10 mg-sm-b-0">
                    <h6 class="mg-b-0 tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold"><b>Student Strength Information</b></h6>
                    <p class="tx-10 tx-color-03 mg-b-0">Class/Course Wise Student Strength</p>
                </div>
            </div>
            <div class="card-body pd-b-0 mg-b-0 pd-t-0 pd-l-5 pd-r-5">
            <canvas id="flotChart1" height="150"></canvas>
            </div><!-- card-body -->
            @php
            //function define calculate percantage
            function percantage($totalstrength,$value){
            if($totalstrength>0){
            return (($value*100)/$totalstrength);
            }
            return 0;
            }
            @endphp
            <div class="card-footer pd-y-15 pd-x-10">
                <div class="row row-sm">

                    <div class="col-6 col-sm-4 col-md-2 pd-l-0 pd-r-2">
                        <h4 class="tx-normal tx-rubik mg-b-10">@if(isset($student->totalstrength)){{$student->totalstrength}}@else{{"0"}}@endif</h4>
                        <div class="progress ht-2 mg-b-10">
                            <div class="progress-bar bg-df-2" style="width:{!! percantage($student->totalstrength,$student->totalstrength) !!}%;" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <h6 class="tx-uppercase tx-spacing-1 tx-semibold tx-9 tx-color-02 mg-b-2">Total Student</h6>
                        <p class="tx-10 tx-color-03 mg-b-0"><span class="tx-medium tx-success">0.0% <i class="icon ion-md-arrow-up"></i></span></p>
                    </div><!-- col -->

                    <div class="col-6 col-sm-4 col-md-2 pd-l-0 pd-r-2">
                        @php $activestudent=$student->totalstrength-$studentinactive->totalstrength; @endphp
                        <h4 class="tx-normal tx-rubik mg-b-10">@if(isset($student->totalstrength)&&(isset($studentinactive->totalstrength))){{$activestudent}}@else{{"0"}}@endif</h4>
                        <div class="progress ht-2 mg-b-10">
                            <div class="progress-bar bg-df-2" style=" width:{!! percantage($student->totalstrength,$activestudent) !!}%;" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <h6 class="tx-uppercase tx-spacing-1 tx-semibold tx-9 tx-color-02 mg-b-2">Active Stu.</h6>
                        <p class="tx-10 tx-color-03 mg-b-0"><span class="tx-medium tx-success">0.0% <i class="icon ion-md-arrow-up"></i></span></p>
                    </div><!-- col -->

                    <div class="col-6 col-sm-4 col-md-2">
                        <h4 class="tx-normal tx-rubik mg-b-10">@if(isset($studentinactive->totalstrength)){{$studentinactive->totalstrength}}@else{{"0"}}@endif</h4>
                        <div class="progress ht-2 mg-b-10">
                            <div class="progress-bar bg-df-2" style=" width:{!! percantage($student->totalstrength,$studentinactive->totalstrength) !!}%; " role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <h6 class="tx-uppercase tx-spacing-1 tx-semibold tx-9 tx-color-02 mg-b-2">Inactive Stu.</h6>
                        <p class="tx-10 tx-color-03 mg-b-0"><span class="tx-medium tx-danger ">0.0% <i class="icon ion-md-arrow-down"></i></span></p>
                    </div><!-- col -->

                    <div class="col-6 col-sm-4 col-md-2">
                        <h4 class="tx-normal tx-rubik mg-b-10">@if(isset($studentinactive->totalstrength)){{$studentinactive->totalstrength}}@else{{"0"}}@endif</h4>
                        <div class="progress ht-2 mg-b-10">
                            <div class="progress-bar bg-df-2" style=" width:{!! percantage($student->totalstrength,$studentinactive->totalstrength) !!}%; " role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <h6 class="tx-uppercase tx-spacing-1 tx-semibold tx-9 tx-color-02 mg-b-2">Suspend Stu.</h6>
                        <p class="tx-10 tx-color-03 mg-b-0"><span class="tx-medium tx-danger ">0.0% <i class="icon ion-md-arrow-down"></i></span></p>
                    </div><!-- col -->



                    <div class="col-6 col-sm-4 col-md-2">
                        <h4 class="tx-normal tx-rubik mg-b-10">{{$totalold}}</h4>
                        <div class="progress ht-2 mg-b-10">
                            <div class="progress-bar bg-df-2" style=" width:{!! percantage($student->totalstrength,$totalmale) !!}%; "  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <h6 class="tx-uppercase tx-spacing-1 tx-semibold tx-9 tx-color-02 mg-b-2">Old Student</h6>
                        <p class="tx-10 tx-color-03 mg-b-0"><span class="tx-medium tx-success">0.0% <i class="icon ion-md-arrow-down"></i></span></p>
                    </div><!-- col -->


                    <div class="col-6 col-sm-4 col-md-2">
                        <h4 class="tx-normal tx-rubik mg-b-10">{{$totalnew}}</h4>
                        <div class="progress ht-2 mg-b-10">
                            <div class="progress-bar bg-df-2" style=" width:{!! percantage($student->totalstrength,$totalfemale) !!}%; " role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <h6 class="tx-uppercase tx-spacing-1 tx-semibold tx-9 tx-color-02 mg-b-2">New Student</h6>
                        <p class="tx-10 tx-color-03 mg-b-0"><span class="tx-medium tx-success">0.0% <i class="icon ion-md-arrow-down"></i></span></p>
                    </div><!-- col -->
                </div><!-- row -->
            </div><!-- card-footer -->
        </div><!-- card -->
    </div>

    <div class="col-sm-6 col-lg-5 col-xl-3">
        <div class="card">
            <div class="card-header">
                <h6 class="pd-t-5 mg-b-0 tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold">Student Gender Information</h6>
                <h6 class="tx-10 tx-color-03 mg-b-0">Gender Strength Details</h6>
            </div>
            <div class="card-body p-0 m-0">
            <div class="col-lg-12 bd-1 bd-b text-center pd-b-10 pd-l-1 pd-r-1"><canvas id="GenderChart" height="206"></canvas></div>
            <div class="col-lg-12 p-0">
                <ul class="list-group list-group-flush tx-13">
                <li class="list-group-item d-flex pd-sm-x-20">
                    <div class="avatar d-none d-sm-block"><span class="avatar-initial rounded-circle text-center" style="background-color: #1a73e8;"><i class="fa fa-male mg-l-5 fa-lg"></i></span></div>
                    <div class="pd-sm-l-10">
                        <p class="tx-13 mg-b-0"><b>Male</b></p>
                        <small class="tx-10 pd-t-0 tx-color-03 mg-b-0">Male Strength</small>
                    </div>
                    <div class="mg-l-auto text-right">
                        <p class="mg-b-0 tx-bold tx-18 mg-b-0 pd-b-0">{{$totalmale}}</p>
                        <small class="tx-10 tx-success pd-t-0 mg-t-0 mg-b-0"><i class="fa fa-arrow-up"></i> 0.0% Increment</small>
                    </div>
                </li>
                    <li class="list-group-item d-flex pd-sm-x-20">
                        <div class="avatar d-none d-sm-block"><span class="avatar-initial rounded-circle text-center" style="background-color: #e75480;"><i class="fa fa-female mg-l-5 fa-lg"></i></span></div>
                        <div class="pd-sm-l-10">
                            <p class="tx-13 mg-b-0"><b>Female</b></p>
                            <small class="tx-10 pd-t-0 tx-color-03 mg-b-0">Female Strength</small>
                        </div>
                        <div class="mg-l-auto text-right">
                            <p class="mg-b-0 tx-bold tx-18 mg-b-0 pd-b-0">{{$totalfemale}}</p>
                            <small class="tx-10 tx-success mg-b-0"><i class="fa fa-arrow-up"></i> 0.0% Increment</small>
                        </div>
                    </li>
                    <li class="list-group-item d-flex pd-sm-x-20">
                        <div class="avatar d-none d-sm-block"><span class="avatar-initial rounded-circle text-center" style="background-color:#55CDFC; "><i class="fa fa-transgender mg-l-5 fa-lg"></i></span></div>
                        <div class="pd-sm-l-10">
                            <p class="tx-13 mg-b-0"><b>Transgender</b></p>
                            <small class="tx-10 pd-t-0 tx-color-03 mg-b-0">Transgender Strength</small>
                        </div>
                        <div class="mg-l-auto text-right">
                            <p class="mg-b-0 tx-bold tx-18 mg-b-0 pd-b-0">{{$totaltransgender}}</p>
                            <small class="tx-10 tx-success pd-t-0 mg-t-0 mg-b-0"><i class="fa fa-arrow-up"></i> 0.0% Increment</small>
                        </div>
                    </li>
                </ul>
            </div>
            </div>
        </div>
    </div>


    <div class="col-sm-6 col-lg-5 col-xl-3">
        <div class="card">
            <div class="card-header">
                <h6 class="pd-t-5 mg-b-0 tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold">Student Age Information</h6>
                <h6 class="tx-10 tx-color-03 mg-b-0">Student Age Wise Strength Details</h6>
            </div>
            <div class="card-body p-0 m-0">
              <canvas id="AgeChart" height="412"></canvas>
            </div>
        </div>
    </div>



    <div class="col-lg-12 mg-t-10">
        <div class="card">
            <div class="card-header d-sm-flex justify-content-between bd-b-0 pd-t-20 pd-b-0">
                <div class="mg-b-10 mg-sm-b-0">
                    <h6 class="mg-b-0 tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold"><b>Course-Section Student Strength Information</b></h6>
                    <p class="tx-9 tx-color-03 mg-b-0">Class/Course and Section Wise Student Strength</p>
                </div>
            </div>
            <div class="card-body pd-b-20 mg-b-0 pd-t-0 pd-l-5 pd-r-5">
                <canvas id="flotChart2" height="100"></canvas>
            </div>
        </div>
    </div>
</div>

