@extends('layouts.MasterLayout')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mg-b-0 mg-lg-b-0 mg-xl-b-0">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#">Student Management</a></li>
                <li class="breadcrumb-item active" aria-current="page">Dashboard Analytics</li>
            </ol>
        </nav>
    </div>
    @php
        /*
        *get student details
        */
        $student=dbtablesum(\App\Models\MasterAdmin\Admission\StudentRecord::class,['dbrow'=>'count(id) as totalstrength']);
        $studentinactive=dbtablesum(\App\Models\MasterAdmin\Admission\StudentRecord::class,['dbrow'=>'count(id) as totalstrength','search'=>['status'=>'inactive']]);
        /*
         * Student Details
         */
        $studentsummary=dbtablesum(\App\Models\MasterAdmin\Admission\StudentRecord::class
        ,['search'=>['status'=>'active']
        ,'join'=>['t1'=>['table'=>'student_record','foreigntable'=>null,'foreign'=>'student_id','ownerkey'=>'id']]
        ,'dbrow'=>"sum(case gender when 'male' then 1 else 0 end) totalmale,sum(case gender when 'female' then 1 else 0 end) totalfemale,sum(case gender when 'transgender' then 1 else 0 end) totaltransgender
        ,sum(case is_new when 'new' then 1 else 0 end) totalnew,sum(case is_new when 'old' then 1 else 0 end) totalold"]);

        isset($studentsummary->totalmale) ? $totalmale=$studentsummary->totalmale : $totalmale=0;
        isset($studentsummary->totalfemale) ? $totalfemale=$studentsummary->totalfemale : $totalfemale=0;
        isset($studentsummary->totaltransgender) ? $totaltransgender=$studentsummary->totaltransgender : $totaltransgender=0;
        isset($studentsummary->totalnew) ? $totalnew=$studentsummary->totalnew : $totalnew=0;
        isset($studentsummary->totalold) ? $totalold=$studentsummary->totalold : $totalold=0;

    /*
     * Student Age Calculator
     */
    $agestrength=[];
    $ageyear=['26-30','23-25','18-22','16-18','13-15','9-12','6-8','3-5','0-2'];
    foreach ($ageyear as $year){
        $yeararr=explode("-",$year);
        $startyear=$yeararr[0];
        $endyear=$yeararr[1];
        //get academic year date
        if(isset(auth()->user()->academicyear->start_date)){
         $yeardate=\Carbon\Carbon::parse(auth()->user()->academicyear->start_date)->subDay(1)->toDateString();
         $startdate=\Carbon\Carbon::parse($yeardate)->subYear($endyear)->toDateString();
         $enddate=\Carbon\Carbon::parse($yeardate)->subYear($startyear)->toDateString();

         //get student strength date of birth
         $studentagedata=dbtablesum(\App\Models\MasterAdmin\Admission\StudentRecord::class
        ,['search'=>['status'=>'active'], 'joincustomsearch' => [ 'whereBetween' => [ 't1.dob' => [$startdate,$enddate] ]]
        ,'join'=>['t1'=>['table'=>'student_record','foreigntable'=>null,'foreign'=>'student_id','ownerkey'=>'id']]
        ,'dbrow'=>"count(t1.id) as totalstrength"]);
         $agestrength[]=$studentagedata->totalstrength;
        }
    }
    $agestrength=implode(',',$agestrength);
    @endphp

    @include('app.erpmodule.MasterAdmin.StudentInformation.Dashboard.first-column-analytics')

    @php
    $randomcolor=\App\Helper\RandomColor::many(27, array('luminosity'=>'dark'));
    //section define strength
    $sectionid=[];
    $sectionname=[];
    $sectionval=[];
    foreach (sectionlist([]) as $data){
        $sectionid[]=$data->section->id;
        $sectionname[$data->section->id]=$data->section->section;;
    }
    //course strength
    $dataarr=[];
    foreach (courselist() as $data){
        $dataarr['course'][] =$data->course;
        $coursestudentstrangth=dbtablesum(\App\Models\MasterAdmin\Admission\StudentRecord::class,['dbrow'=>'count(id) as totalstrength','search'=>['course_id'=>$data->id,'status'=>'active']]);
        isset($coursestudentstrangth->totalstrength) ? $coursestrangth=$coursestudentstrangth->totalstrength : $coursestrangth=0; ;
        $dataarr['coursevalue'][]=$coursestrangth;

        //get course and section strength
        foreach ($sectionid as $section_id){
        $sectionstudentstrangth=dbtablesum(\App\Models\MasterAdmin\Admission\StudentRecord::class,['dbrow'=>'count(id) as totalstrength','search'=>['course_id'=>$data->id,'section_id'=>$section_id,'status'=>'active']]);
        isset($sectionstudentstrangth->totalstrength) ? $sectionstrength=$sectionstudentstrangth->totalstrength : $sectionstrength=0 ;
        $sectionval['section_'.$section_id.''][]=$sectionstrength;
        }
    }
    isset($dataarr['course']) ? $coursename=implode(",",$dataarr['course']) : $coursename="" ;
    isset($dataarr['coursevalue']) ? $coursevalue=implode(",",$dataarr['coursevalue']) : $coursevalue="";
    @endphp


    <script type="text/javascript" src="{{url('assets/lib/chart.js/Chart.bundle.min.js')}}"></script>
    <script type="text/javascript">
        var course="{{$coursename}}";
        var coursearr=course.split(",");
        var coursevalue="{{$coursevalue}}";
        var coursevaluearr=coursevalue.split(",");
        var ctx = document.getElementById('flotChart1').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'bar',
            // The data for our dataset
            data: {
                labels: coursearr,
                datasets: [{
                    label: 'Student Strength',
                    barThickness: 2,
                    backgroundColor: '#1a73e8',
                    borderColor: '#1a73e8',
                    data: coursevaluearr
                }]
            },
            // Configuration options go here
            options: []
        });


        //course and section strength radar chart
        var ctx2 = document.getElementById('flotChart2').getContext('2d');

        @foreach($sectionname as $key=>$section)
            var sectionstrength="{{implode(',',$sectionval['section_'.$key.''])}}";
            var sectionstrength_{{$section}}=sectionstrength.split(',');
        @endforeach
        var myRadarChart = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: coursearr,
                datasets: [
                    @foreach($sectionname as $key=>$section)
                    {
                    label: '{{$section}}',
                    backgroundColor:'{{$randomcolor[$key]}}',
                    borderColor: '{{$randomcolor[$key]}}',
                    data : sectionstrength_{{$section}}
                    },
                    @endforeach
                ]
            },
            options: []
        });
        //gender pie chart
        var ctx3 = document.getElementById('GenderChart').getContext('2d');
        var myPieChart = new Chart(ctx3, {
            type: 'pie',
            data : {
                labels: ['Male','Female','Transgender'],
                datasets: [
                    {
                    backgroundColor:['#1a73e8','#e75480','#55CDFC'],
                    data: [{{$totalmale}}, {{$totalfemale}},{{$totaltransgender}}],
                    }
                ]
            },
            options: []
        });

        //age bar columna
        var ageval='{{$agestrength}}';
        var agearr=ageval.split(',');
        var ctx4=document.getElementById('AgeChart').getContext('2d');
        var myBarChart = new Chart(ctx4, {
            type: 'horizontalBar',
            data: {
                labels: ['26 Yr. to 30 Yr.','23 Yr. to 25 Yr.','18 Yr. to 22 Yr.','16 Yr. to 18 Yr.','13 Yr. to 15 Yr.','9 Yr. to 12 Yr.','6 Yr. to 8 Yr.','3 Yr. to 5 Yr.','0 Yr. to 2 Yr.'],
                FontSize:6,
                datasets: [{
                    label: 'Age Strength',
                    barThickness: 2,
                    backgroundColor:'#E2517D',
                    borderColor : '#E2517D',
                    data: agearr
                }]
            },
            options: []
        });
    </script>

@endsection
