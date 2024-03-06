
<div class="card">
    <div class="card-header pd-12">
        <h6 class="mg-b-0 tx-color-02"><b>Transportation Information</b></h6>
    </div><!-- card-header -->
    <div class="card-body pd-0">
        <div class="row no-gutters pd-10">
            <table cellspacing="0" cellpadding="0" class="table table-borderless mg-b-0 pd-b-0">
                <tr>
                    <td class="wd-40p" rowspan="2">
                        <div class="card-body p-0">
                        <div class="chart-seven"><canvas id="chartDonut" width="100" height="150"></canvas></div>
                        </div>
                    </td>
                    <td class="bd-2 bd-b">
                        <h6 class="mg-b-0 mg-t-0 text-success"><b>Use Transport Service</b></h6>
                        <p class="lh-4 tx-12 tx-color-03 mg-b-10">Student use transportation service</p>
                        <h3 class="tx-spacing--1 tx-color-02 bd-2 bd-b mg-b-0">{{$studentusetransport}}<small class="tx-12 tx-color-03">/ Student use Transport</small></h3>
                    </td>
                </tr>
                <tr>
                    <td class="bd-2 bd-b">
                        <h6 class="mg-b-0 mg-t-0 text-danger"><b>Not Use Transport Service</b></h6>
                        <p class="lh-4 tx-12 tx-color-03 mg-b-10">Student not use transportation service</p>
                        <h3 class="tx-spacing--1 tx-color-02 mg-b-0">{{$studentnotusetransport}}<small class="tx-12 tx-color-03">/ Student not use Transport</small></h3>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
