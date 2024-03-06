<div class="col-lg-12 pd-l-0 pd-r-0 col-xl-7">
    <div class="card">
        <div class="card-header bd-b-0 pd-t-20 pd-lg-t-25 pd-l-20 pd-lg-l-25 d-flex flex-column flex-sm-row align-items-sm-start justify-content-sm-between">
            <div>
                <h6 class="mg-b-5 tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold"><b>Finance Metrics</b></h6>
                <p class="tx-12 tx-color-03 pd-t-0 mg-b-0">Student fee collection and school expense metrics summary</p>
            </div>
            <div class="btn-group mg-t-20 mg-sm-t-0">
                <button class="btn btn-xs btn-white btn-uppercase active"><i class="fa fa-calendar"></i> {{nowdate($fromdate,'d-M-Y')}} - {{nowdate($enddate,'d-M-Y')}}</button>
            </div><!-- btn-group -->
        </div><!-- card-header -->
        <div class="card-body pd-lg-15">
            <div class="row align-items-sm-end">
                <div class="col-lg-7 col-xl-8 pd-r-0">
                    <canvas id="chartBar1" width="600" height="311" class="chartjs-render-monitor"></canvas>
                </div>
                <div class="col-lg-5 col-xl-4 mg-t-30 mg-lg-t-0">
                    <div class="row">
                        <div class="col-sm-6 col-lg-12">
                            <div class="d-flex align-items-center justify-content-between mg-b-5">
                                <h6 class="tx-uppercase tx-10 tx-spacing-1 tx-color-02 tx-semibold mg-b-0">Fee Collect</h6>
                                <span class="tx-10 tx-color-04">65% goal reached</span>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mg-b-5">
                                <h5 class="tx-normal tx-rubik lh-2 mg-b-0">{{numberformat($totalcollect)}}</h5>
                            </div>
                            <div class="progress ht-4 mg-b-0 op-5">
                                <div class="progress-bar wd-65p" style=" background:#17A589;" role="progressbar" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>


                        <div class="col-sm-6 col-lg-12 mg-t-30">
                            <div class="d-flex align-items-center justify-content-between mg-b-5">
                                <h6 class="tx-uppercase tx-10 tx-spacing-1 tx-color-02 tx-semibold mg-b-0">Total Fee Receipt</h6>
                                <span class="tx-10 tx-color-04">20% goal reached</span>
                            </div>
                            <div class="d-flex justify-content-between mg-b-5">
                                <h5 class="tx-normal tx-rubik mg-b-0">{{$totalreceipt}}</h5>
                            </div>
                            <div class="progress ht-4 mg-b-0 op-5">
                                <div class="progress-bar wd-20p" style=" background:#3498DB;" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>


                        <div class="col-sm-6 col-lg-12 mg-t-30 mg-sm-t-0 mg-lg-t-30">
                            <div class="d-flex align-items-center justify-content-between mg-b-5">
                                <h6 class="tx-uppercase tx-10 tx-spacing-1 tx-color-02 tx-semibold mg-b-0">Expenses</h6>
                                <span class="tx-10 tx-color-04">45% goal reached</span>
                            </div>
                            <div class="d-flex justify-content-between mg-b-5">
                                <h5 class="tx-normal tx-rubik mg-b-0">{{$totalexpense}}</h5>
                            </div>
                            <div class="progress ht-4 mg-b-0 op-5">
                                <div class="progress-bar wd-45p" style=" background:#E74C3C;" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>


                        <div class="col-sm-6 col-lg-12 mg-t-30">
                            <div class="d-flex align-items-center justify-content-between mg-b-5">
                                <h6 class="tx-uppercase tx-10 tx-spacing-1 tx-color-02 tx-semibold mg-b-0">Total Voucher</h6>
                                <span class="tx-10 tx-color-04">4% goal reached</span>
                            </div>
                            <div class="d-flex justify-content-between mg-b-5">
                                <h5 class="tx-normal tx-rubik mg-b-0">{{$totalvoucher}}</h5>
                            </div>
                            <div class="progress ht-4 mg-b-0 op-5">
                                <div class="progress-bar wd-85p" style=" background:#F39C12;" role="progressbar" aria-valuenow="4" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div><!-- row -->

                </div>
            </div>
        </div><!-- card-body -->
    </div><!-- card -->
</div>



<div class="col-sm-12 col-lg-5 col-xl-3 pd-l-10 pd-r-0 ">
    <div class="card">
        <div class="card-header">
            <h6 class="mg-b-0 tx-11 pd-10"><b>FEE COLLECTION SUMMARY</b></h6>
        </div><!-- card-header -->
        <div class="card-body pd-lg-5">
            <div class="chart-seven"><canvas id="chartDonut" width="150" height="140"></canvas></div>
         </div><!-- card-body -->
        <div class="card-footer pd-15">
            <div class="row">
                <div class="col-6">
                    <p class="tx-10 tx-uppercase tx-medium tx-color-03 tx-spacing-1 tx-nowrap mg-b-5"><b>Total Fee</b></p>
                    <div class="d-flex align-items-center">
                        <div class="wd-10 ht-10 rounded-circle mg-r-5" style="background:#17A589; "></div>
                        <h5 class="tx-normal tx-14 tx-rubik mg-b-0">{{numberformat($receiptsummary['totalfee'])}}</h5>
                    </div>
                </div><!-- col -->
                <div class="col-6">
                    <p class="tx-10 tx-uppercase tx-medium tx-color-03 tx-spacing-1 mg-b-5"><b>Total Concession</b></p>
                    <div class="d-flex align-items-center">
                        <div class="wd-10 ht-10 rounded-circle mg-r-5" style="background:#D68910; "></div>
                        <h5 class="tx-normal tx-14 tx-rubik mg-b-0">{{numberformat($receiptsummary['totalconcession'])}}</h5>
                    </div>
                </div><!-- col -->
                <div class="col-6 mg-t-20">
                    <p class="tx-10 tx-uppercase tx-medium tx-color-03 tx-spacing-1 mg-b-5"><b>Total Late Fee</b></p>
                    <div class="d-flex align-items-center">
                        <div class="wd-10 ht-10 rounded-circle mg-r-5" style="background:#27AE60; "></div>
                        <h5 class="tx-normal tx-14 tx-rubik mg-b-0">{{numberformat($receiptsummary['totallatefee'])}}</h5>
                    </div>
                </div><!-- col -->
                <div class="col-6 mg-t-20">
                    <p class="tx-10 tx-uppercase tx-medium tx-color-03 tx-spacing-1 mg-b-5"><b>Total Fee Payable</b></p>
                    <div class="d-flex align-items-center">
                        <div class="wd-10 ht-10 rounded-circle mg-r-5" style="background:#9B59B6; "></div>
                        <h5 class="tx-normal tx-14 tx-rubik mg-b-0">{{numberformat($receiptsummary['totalpayable'])}}</h5>
                    </div>
                </div><!-- col -->
                <div class="col-6 mg-t-20">
                    <p class="tx-10 tx-uppercase tx-medium tx-color-03 tx-spacing-1 mg-b-5"><b>Total Collect Fee</b></p>
                    <div class="d-flex align-items-center">
                        <div class="wd-10 ht-10 rounded-circle mg-r-5" style="background:#2E86C1; "></div>
                        <h5 class="tx-normal tx-14 tx-rubik mg-b-0">{{numberformat($receiptsummary['totalpaid'])}}</h5>
                    </div>
                </div><!-- col -->
                <div class="col-6 mg-t-20 mg-b-10">
                    <p class="tx-10 tx-uppercase tx-medium tx-color-03 tx-spacing-1 mg-b-5"><b>Total Excess</b></p>
                    <div class="d-flex align-items-center">
                        <div class="wd-10 ht-10 rounded-circle mg-r-5" style="background:#F1C40F; "></div>
                        <h5 class="tx-normal tx-14 tx-rubik mg-b-0">{{$totalcollect-$receiptsummary['totalpaid']}}</h5>
                    </div>
                </div><!-- col -->
            </div><!-- row -->
        </div><!-- card-footer -->
    </div>
</div>

<div class="col-sm-12 col-lg-5 col-xl-2 pd-l-10 pd-r-0 ">
    <div class="card">
        <div class="card-header">
            <h6 class="mg-b-0 tx-uppercase tx-11 pd-10"><b>Student Information</b></h6>
        </div><!-- card-header -->
        <div class="card-body p-0">
            <div class="col-12 pd-10 m-0 bd-b bd-1 text-center">
                <h3 class="tx-normal tx-rubik tx-spacing--1 mg-b-5">@if(isset($studentstrength)){{$studentstrength}} @else {{"0"}} @endif</h3>
                <h6 class="tx-12 tx-semibold tx-spacing-1  mg-b-0">Student Strength</h6>
                <p class="tx-10 tx-color-03 mg-b-0">all course and student strength</p>
            </div>
            <div class="col-12 pd-10 m-0 bd-b bd-1 text-center">
                <h3 class="tx-normal tx-rubik tx-spacing--1 mg-b-5">@if(isset($usetransport->totalstrength)) {{$usetransport->totalstrength}} @else {{"0"}} @endif</h3>
                <h6 class="tx-12 tx-semibold tx-spacing-1  mg-b-0">Student Use Transport</h6>
                <p class="tx-10 tx-color-03 mg-b-0">all transport route student strength</p>
            </div>
            <div class="col-12 pd-10 m-0 bd-b bd-1 text-center">
                <h3 class="tx-normal tx-rubik tx-spacing--1 mg-b-5">0</h3>
                <h6 class="tx-12 tx-semibold tx-spacing-1  mg-b-0">Student Use Concession</h6>
                <p class="tx-10 tx-color-03 mg-b-0">student use finance concession facilities</p>
            </div>
            <div class="col-12 pd-10 m-0 bd-b bd-1 text-center">
                <h3 class="tx-normal tx-rubik tx-spacing--1 mg-b-5">0</h3>
                <h6 class="tx-12 tx-semibold tx-spacing-1  mg-b-0">Guardian's Strength</h6>
                <p class="tx-10 tx-color-03 mg-b-0">school guardian strength</p>
            </div>
        </div>
    </div>
</div>
