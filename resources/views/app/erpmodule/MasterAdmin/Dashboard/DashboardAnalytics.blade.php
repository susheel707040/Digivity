<div class="d-sm-flex align-items-center justify-content-between mg-t-0 pd-t-0 mg-b-5 mg-lg-b-5 mg-xl-b-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Master Monitoring</li>
        </ol>
    </nav>
    <div class="d-none d-md-block mg-t-2">
    <a href="{{url('/dashboard')}}">
    <button type="button" class="btn btn-sm pd-x-15 btn-white btn-uppercase mg-l-5"><i class="fa fa-refresh"></i> Refresh</button></a>
    </div>
</div>
@php
       /*
        *get student details
        */
       $studentstrength = studentstrength(['status'=>'active']);
       $studentinactivestrength = studentstrength(['status'=>'inactive']);
       $student=dbtablesum(\App\Models\MasterAdmin\Admission\StudentRecord::class,['dbrow'=>'count(id) as totalstrength','search'=>['status'=>'active']]);
       $studentinactive=dbtablesum(\App\Models\MasterAdmin\Admission\StudentRecord::class,['dbrow'=>'count(id) as totalstrength','search'=>['status'=>'inactive']]);

       $studentgendermale=dbtablesum(\App\Models\MasterAdmin\Admission\StudentRecord::class,['relation'=>['student'],'search'=>['gender'=>'male','status'=>'active'],'get'=>'get','relationdbrow'=>['student'=>['count(id) as total']]]);
       $studentgenderfemale=dbtablesum(\App\Models\MasterAdmin\Admission\StudentRecord::class,['relation'=>['student'],'search'=>['gender'=>'female','status'=>'active'],'get'=>'get','relationdbrow'=>['student'=>['count(id) as total']]]);
       /*
        * Get Staff Details
        */
       $staff=dbtablesum(\App\Models\MasterAdmin\Staff\StaffRecord::class,['dbrow'=>'count(id) as totalstrength']);

       $usetransport=dbtablesum(\App\Models\MasterAdmin\Admission\StudentRecord::class,['dbrow'=>'count(id) as totalstrength','customsearch'=>['whereNotNull'=>'transport_id','where'=>['transport_status'=>'active']]]);
       $studentusetransport=0;
       if(isset($usetransport->totalstrength)){
       $studentusetransport=$usetransport->totalstrength;
       }
       $studentnotusetransport=0;
       if(isset($student->totalstrength)&&isset($usetransport->totalstrength)){
       $studentnotusetransport=$student->totalstrength-$usetransport->totalstrength;
       }
       /*
        * fee collection
        */
       $fromdate=nowdate('','Y-m-d');
       $enddate=nowdate('','Y-m-d');

       $feecollection=dbtablesum(\App\Models\MasterAdmin\Finance\StudentFeeCollection::class,['dbrow'=>'SUM(paid_amount) as totalcollect,count(id) as totalreceipt','search'=>['receipt_status'=>'paid'],'customsearch' => [ 'whereBetween' => [ 'receipt_date' => [$fromdate,$enddate] ]]]);
       $totalcollect=0; if(isset($feecollection->totalcollect)){$totalcollect=$feecollection->totalcollect;}

@endphp
<div class="row row-xs">
    <div class="col-lg-12 col-xl-12 row m-0">
        @include('app.erpmodule.MasterAdmin.Dashboard.AnalyticsPage.master-index-column')
    </div>
    <div class="col-lg-12 col-xl-8 mg-t-10">
        @include('app.erpmodule.MasterAdmin.Dashboard.AnalyticsPage.course-info-analytics')
    </div>
    <div class="col-lg-12 col-xl-4 mg-t-10">
        @include('app.erpmodule.MasterAdmin.Dashboard.AnalyticsPage.transport-info-analytics')
        @include('app.erpmodule.MasterAdmin.Dashboard.AnalyticsPage.student-age-count-analytics')
    </div>

</div>

<script type="text/javascript" src="{{url('assets/lib/chart.js/Chart.bundle.min.js')}}"></script>
<script>
    /** PIE CHART **/
    var datapie = {
        labels: ['Use Transport Service', 'Not Use Transport Service'],
        datasets: [{
            data: [{{$studentusetransport}},{{$studentnotusetransport}}],
            height:100,
            weight:150,
            backgroundColor: ['#10b759','#dc3545']
        }]
    };

    var optionpie = {
        maintainAspectRatio: false,
        responsive: true,
        legend: {
            display: false,
        },
        animation: {
            animateScale: true,
            animateRotate: true
        }
    };

    // For a pie chart
    var ctx2 = document.getElementById('chartDonut');
    var myDonutChart = new Chart(ctx2, {
        type: 'doughnut',
        data: datapie,
        options: optionpie
    });
</script>


