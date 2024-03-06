@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Student Information</li>
            <li class="breadcrumb-item active" aria-current="page">Reports</li>
            <li class="breadcrumb-item active" aria-current="page">Class-Section Wise Strength Report</li>
        </ol>
    </nav>

    <div class="col-lg-12 p-0 m-0">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i> Class-Section Wise Strength Report</b></div>
            <div class="panel-body pd-b-0 row">
                <form class="col-lg-12" action="{{url('MasterAdmin/StudentInformation/ClassWiseStrength')}}" method="POST">
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
                                <th rowspan="2">Class/Course</th><th class="text-center" colspan="{{count($section)+1}}">Section Strength</th>
                            </tr>
                            <tr>
                                @php $totalsum=array(); @endphp
                                @foreach($section as $data1)
                                    @php $totalsum +=['total_'.$data1->section->id=>0]; @endphp
                                    <th class="text-center">{{$data1->section->section}}</th>
                                @endforeach
                                @php $totalsum +=['total'=>0]; @endphp
                                <th class="text-center bg-success-light">Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($course as $data)
                                <tr>
                                    <td>{{$data->course}}</td>
                                    @php $totalstrength=0; @endphp
                                    @foreach($section as $data1)
                                        @php
                                            $search=['course_id'=>$data->id,'section_id'=>$data1->section->id,'status'=>'active'];
                                            if(request()->get('is_new')){
                                            $search=array_merge($search,['is_new'=>request()->get('is_new')]);
                                            }
                                            $studentdata=dbtablesum(\App\Models\MasterAdmin\Admission\StudentRecord::class,['dbrow'=>'count(id) as totalstrength','search'=>$search]);

                                           if(isset($studentdata->totalstrength)){
                                               $totalstrength +=$studentdata->totalstrength;
                                               $totalsum['total_'.$data1->section->id] +=$studentdata->totalstrength;
                                               $totalsum['total'] +=$studentdata->totalstrength;
                                           }
                                        @endphp
                                        <td class="text-center">@if($studentdata->totalstrength && $totalstrength > 0) {{$studentdata->totalstrength}} @else {{"_"}} @endif</td>
                                    @endforeach
                                    <td class="text-center bg-success-light"><b>{{$totalstrength}}</b></td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr class="bg-success-light">
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
