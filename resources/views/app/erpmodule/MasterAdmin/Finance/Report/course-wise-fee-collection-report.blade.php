@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">Finance/Account</li>
            <li class="breadcrumb-item" aria-current="page">Reports</li>
            <li class="breadcrumb-item active" aria-current="page">Class/Course-Section Wise Fee Collection Report</li>
        </ol>
    </nav>
    <div class="col-lg-12  p-0 m-0 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i> Class/Course-Section Wise Fee Collection Report</b></div>
            <div class="panel-body tx-11 pd-b-5 row">
                <form class="container-fluid" action="{{url('MasterAdmin/Finance/CourseWiseCollectionReport')}}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="col-lg-12 pd-b-15 row m-0">
                        <div class="col-lg-2">
                            <label><b>From Date :</b></label>
                            <input type="text" name="from_date" class="form-control1 date" value="{{nowdate(request()->get('from_date'),'d-m-Y')}}">
                        </div>
                        <div class="col-lg-2">
                            <label><b>To Date :</b></label>
                            <input type="text" name="to_date" class="form-control1 date" value="{{nowdate(request()->get('to_date'),'d-m-Y')}}">
                        </div>
                        <div class="col-lg-2">
                            <label><b>Class/Course :</b></label>
                            @include('components.course-import',['selectid'=>request()->get('course_id')])
                        </div>
                        <div class="col-lg-2">
                            <label><b>Section :</b></label>
                            @include('components.section-import',['selectid'=>request()->get('section_id')])
                        </div>
                        <div class="col-lg-2">
                            <button type="submit" class="btn btn-primary mg-t-20"><i class="fa fa-search"></i> Search</button>
                        </div>
                    </div>
                </form>
                @php
                /*
                * fianance get details
                */
                $fromdate=nowdate(request()->get('from_date'),'Y-m-d');
                $enddate=nowdate(request()->get('to_date'),'Y-m-d');
                @endphp
                <div class="col-lg-12 pd-t-10 bd-1 bd-t m-0 row">
                    <div class="col-lg-12 text-right">@include('layouts.actionbutton.action-button-verticle')</div>
                    <div class="col-lg-12 ">
                    <table id="example2" class="table datatable table-bordered">
                        <thead class="bg-light">
                        <tr>
                            <th class="text-center">#</th>
                            <th>Class/Course</th>
                            @php $totalsum=array('totalsum'=>0); @endphp
                            @foreach($sectionlist as $data1)
                                @php $totalsum['section_sum_'.$data1->section->id.'']=0; @endphp
                                <th class="text-center">{{$data1->section->section}}</th>
                            @endforeach
                            <th class="text-right">Fee Collect Amount</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($courselist as $data)
                        <tr>
                            <td class="text-center"><b>{{$loop->iteration}}</b></td>
                            <td>{{$data->course}}</td>
                            @php $coursetotal=0; @endphp
                            @foreach($sectionlist as $data1)
                                @php
                                    $feecollection=dbtablesum(\App\Models\MasterAdmin\Finance\StudentFeeCollection::class,['dbrow'=>'SUM(paid_amount) as totalcollect','search'=>['course_id'=>$data->id,'section_id'=>$data1->section->id,'receipt_status'=>'paid'], 'customsearch' => [ 'whereBetween' => [ 'receipt_date' => [$fromdate,$enddate] ]]]);
                                     $coursesectionamount=0; if(isset($feecollection->totalcollect)){
                                         $coursesectionamount +=$feecollection->totalcollect;
                                         $coursetotal +=$feecollection->totalcollect;
                                         $totalsum['section_sum_'.$data1->section->id.''] +=$feecollection->totalcollect;
                                         $totalsum['totalsum'] +=$feecollection->totalcollect;;
                                     }
                                @endphp
                                <td class="text-right">{{numberformat($coursesectionamount)}}</td>
                            @endforeach
                            <td class="text-right wd-15p">{{numberformat($coursetotal)}}</td>
                        </tr>
                        @endforeach
                        </tbody>
                        <tfoot class="bg-light">
                        <tr>
                            <td colspan="2" class="text-right"><b>Total :</b></td>
                            @foreach($sectionlist as $data1)
                                @php
                                    $totalsectionsum=0; if(isset($totalsum['section_sum_'.$data1->section->id.''])){ $totalsectionsum +=$totalsum['section_sum_'.$data1->section->id.''];}
                                @endphp
                                <td class="text-right"><b>{{numberformat($totalsectionsum)}}</b></td>
                            @endforeach
                            <td class="text-right"><b>{{numberformat($totalsum['totalsum'])}}</b></td>
                        </tr>
                        </tfoot>
                    </table>
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection
