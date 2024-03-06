@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Student Information</li>
            <li class="breadcrumb-item active" aria-current="page">Reports</li>
            <li class="breadcrumb-item active" aria-current="page">Gender Wise Strength Report</li>
        </ol>
    </nav>
    <div class="col-lg-12 p-0 m-0">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i> Gender Wise Strength Report</b></div>
            <div class="panel-body pd-b-0 row">
                <form class="col-lg-12" action="{{url('MasterAdmin/StudentInformation/GenderWiseStrength')}}" method="POST">
                    {{csrf_field()}}
                    <div class="row pd-b-10 m-0">
                        <div class="col-lg-2 pd-l-0">
                            <label>Admission :</label>
                            @include('components.GlobalSetting.is-new-status',['selectid'=>request()->get('is_new'),'all'=>1])
                        </div>
                        <div class="col-lg-2 pd-l-0">
                            <button type="submit" class="btn btn-primary mg-t-20"><i class="fa fa-search"></i> Get Result</button>
                        </div>
                    </div>
                </form>

                <div class="row col-lg-12 pd-b-10 bd-t bd-1 m-0">
                    <div class="col-lg-12 pd-l-0 pd-r-0"><span class="float-right">@include('layouts.actionbutton.action-button-verticle')</span></div>
                    <div class="col-lg-12 pd-l-0 pd-r-0">
                        <table class="table datatable table-bordered mg-t-10">
                            <thead class="bg-light">
                            <tr>
                                <th rowspan="3">Class/Course</th>
                                <th colspan="{{count($section)*(count($gender)+1)}}" class="text-center">Gender (With Section) Strength Report</th>
                                <th rowspan="2" colspan="{{count($gender)+1}}"></th>
                            </tr>
                            <tr>
                                @foreach($section as $data1)
                                    <th class="text-center" colspan="{{count($gender)+1}}">{{$data1->section->section}}</th>
                                @endforeach
                            </tr>
                            <tr>
                                @php $totalsum=array(); @endphp
                                @foreach($section as $data1)
                                    @foreach($gender as $id=>$value)
                                        @php $totalsum +=['total_'.$id.'_'.$data1->section->id=>0]; @endphp
                                        <th class="text-center">{{$value}}</th>
                                    @endforeach
                                    @php $totalsum +=['total_'.$data1->section_id=>0]; @endphp
                                    <th class="text-center">Total</th>
                                @endforeach
                                @foreach($gender as $id=>$value)
                                    <th class="text-center">{{$value}} Total</th>
                                    @php $totalsum +=['total_'.$id=>0]; @endphp
                                @endforeach
                                @php $totalsum +=['total'=>0]; @endphp
                                <th>Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($course as $data)
                                @php $coursetotal=['total_'.$data->id=>0]; @endphp
                                <tr>
                                    <td>{{$data->course}}</td>
                                    @foreach($section as $data1)
                                        @php $totalstrength=0; @endphp
                                        @foreach($gender as $id=>$value)
                                            @php
                                                $search=['course_id'=>$data->id,'section_id'=>$data1->section->id,'status'=>'active'];
                                                if(request()->get('is_new')){
                                                $search=array_merge($search,['is_new'=>request()->get('is_new')]);
                                                }
                                                    $coursetotal +=[$id.$data->id=>0];
                                                        $studentdata=dbtablesum(\App\Models\MasterAdmin\Admission\StudentRecord::class,
                                                        ['dbrow'=>'count(t1.id) as totalstrength'
                                                        ,'search'=>$search
                                                        ,'joinsearch'=>['t1.gender'=>$id]
                                                        ,'join'=>['t1'=>['table'=>'student_record','foreigntable'=>null,'foreign'=>'student_id','ownerkey'=>'id']]]);

                                                       if(isset($studentdata->totalstrength)){
                                                           $totalstrength +=$studentdata->totalstrength;
                                                           $totalsum['total_'.$id.'_'.$data1->section->id] +=$studentdata->totalstrength;
                                                           $totalsum['total_'.$data1->section->id] +=$studentdata->totalstrength;
                                                           $totalsum['total_'.$id] +=$studentdata->totalstrength;
                                                           $totalsum['total'] +=$studentdata->totalstrength;
                                                           $coursetotal[$id.$data->id] +=$studentdata->totalstrength;
                                                           $coursetotal['total_'.$data->id] +=$studentdata->totalstrength;
                                                       }

                                            @endphp
                                            <th class="text-center">@if($studentdata->totalstrength && $totalstrength > 0) {{$studentdata->totalstrength}} @else {{"_"}} @endif</th>
                                        @endforeach
                                        <th class="text-center">@if($totalstrength > 0) {{$totalstrength}} @else {{ "_" }} @endif</th>
                                    @endforeach

                                    @foreach($gender as $id=>$value)
                                        <td class="text-center bg-success-light">@if(isset($coursetotal[$id.$data->id])){{$coursetotal[$id.$data->id]}}@else{{"0"}}@endif</td>
                                    @endforeach
                                    <td class="text-center bg-success-light">{{$coursetotal['total_'.$data->id]}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot class="bg-success-light">
                            <tr>
                                <td class="text-right"><b>Total Strength :</b></td>
                                @foreach($totalsum as $amt)
                                    <td class="text-center"><b>{{$amt}}</b></td>
                                @endforeach
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
