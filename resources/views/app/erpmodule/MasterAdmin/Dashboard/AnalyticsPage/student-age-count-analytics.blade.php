<div class="card mg-t-10">
    <div class="card-header pd-b-0 pd-t-20 bd-b-0">
        <h6 class="mg-b-0"><b>Student Age Wise Strength Details</b></h6>
    </div><!-- card-header -->
    <div class="card-body pd-y-10 pd-b-0">
        <div class="d-flex align-items-baseline tx-rubik">
            <h1 class="tx-40 lh-1 tx-normal tx-spacing--2 mg-b-5 mg-r-5">0.0</h1>
            <p class="tx-11 tx-color-03 mg-b-0"><span class="tx-medium tx-success">0.0% <i class="icon ion-md-arrow-up"></i></span></p>
        </div>
        <h6 class="tx-uppercase tx-spacing-1 tx-semibold tx-10 tx-color-02 mg-b-15">Age Score (According date 01-Apr-2020)</h6>

        <div class="progress bg-transparent op-7 ht-10 mg-b-15">
            <div class="progress-bar bg-primary wd-50p" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
            <div class="progress-bar bg-success wd-25p bd-l bd-white" role="progressbar" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
            <div class="progress-bar bg-warning wd-5p bd-l bd-white" role="progressbar" aria-valuenow="5" aria-valuemin="0" aria-valuemax="100"></div>
            <div class="progress-bar bg-pink wd-5p bd-l bd-white" role="progressbar" aria-valuenow="5" aria-valuemin="0" aria-valuemax="100"></div>
            <div class="progress-bar bg-teal wd-10p bd-l bd-white" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
            <div class="progress-bar bg-purple wd-5p bd-l bd-white" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
        </div>

        @php
        $agedata=['0-3'=>'0 Year to 3 Year','4-8'=>'4 Year to 8 Year','9-12'=>'9 Year to 12 Year'
        ,'13-16'=>'13 Year to 16 Year','17-21'=>'17 Year to 21 Year','22-30'=>'22 Year to 30 Year'];
        @endphp
        <table cellspacing="0" cellpadding="0" class="table tx-11 table-dashboard-two pd-b-0">
            <thead class="bg-light">
            <tr>
                <th><b>Age Range</b></th>
                <th><b>Strength</b></th>
                <th class="text-center">Male</th>
                <th class="text-center">Female</th>
                <th class="text-center">Transgender</th>
            </tr>
            </thead>
            <tbody>
            @foreach($agedata as $key=>$value)
                @php
                $yearrange=explode('-',$key);
                $startyear=$yearrange[0];
                $endyear=$yearrange[1];
                $startdate=\Carbon\Carbon::parse('2020-03-31')->subYear($endyear)->toDateString();
                $enddate=\Carbon\Carbon::parse('2020-03-31')->subYear($startyear)->toDateString();
                @endphp
            <tr>
                <td class="flex-fill">
                    <table cellpadding="0" cellspacing="0" class="table-borderless"><tr><td><div class="wd-15 ht-15 rounded-circle bd bd-3 bd-primary"></div></td>
                        <td>{{$value}}</td>
                        </tr>
                    </table>
                </td>
                <td class="text-center">0</td>
                <td class="tx-center">0</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div><!-- card-body -->
</div>
