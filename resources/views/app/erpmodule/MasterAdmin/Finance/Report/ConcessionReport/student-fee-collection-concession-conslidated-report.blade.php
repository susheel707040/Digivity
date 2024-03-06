@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">Finance/Account</li>
            <li class="breadcrumb-item" aria-current="page">Reports</li>
            <li class="breadcrumb-item active" aria-current="page">Concession/Discount Consolidated Report</li>
        </ol>
    </nav>

    <div class="col-lg-12 p-0 m-0 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i> Concession/Discount Consolidated Report</b></div>
            <div class="panel-body pd-b-10 row">
                <form action="{{url('MasterAdmin/Finance/ConcessionConsolidatedReport')}}" method="POST" class="container-fluid">
                {{csrf_field()}}
                    <div class="col-lg-12 row pd-b-10">
                        <div class="col-lg-2 pd-l-5 pd-r-5">
                            <label><b>Class/Course :</b></label>
                            @include('components.course-import',['selectid'=>request()->get('course_id')])
                        </div>
                        <div class="col-lg-1 pd-l-5 pd-r-5">
                            <label><b>Section :</b></label>
                            @include('components.section-import',['selectid'=>request()->get('section_id')])
                        </div>
                        <div class="col-lg-2">
                            <label><b>Fee Head :</b></label>
                            @include('components.Finance.fee-head-import',['selectid'=>request()->get('fee_head_id')])
                        </div>
                        <div class="col-lg-1 pd-l-0 pd-r-5">
                            <label><b>Instalment :</b></label>
                            @include('components.Finance.fee-head-instalment-group-import',['selectid'=>request()->get('instalment_id')])
                        </div>
                        <div class="col-lg-1 pd-l-5 pd-r-0">
                            <label><b>Paymode :</b></label>
                            @include('components.Finance.paymode-import',['selectid'=>request()->get('paymode_id')])
                        </div>
                        <div class="col-lg-2 pd-l-5 pd-r-5">
                            <button type="submit" class="btn mg-t-25 rounded-5 btn-xs btn-primary"><i class="fa fa-search"></i> Get Result</button>
                        </div>
                    </div>
                </form>

                @if(request()->get('_token'))
                <div class="col-lg-12 text-right">@include('layouts.actionbutton.action-button-verticle')</div>
                <div class="col-lg-12 m-0 p-0 row pd-b-10">
                    <table class="table datatable table-bordered tx-12">
                        <thead class="bg-light">
                        <tr>
                            <th rowspan="2">S.No.</th>
                            <th rowspan="2">Adm.No.</th>
                            <th rowspan="2">Class/Course</th>
                            <th rowspan="2">Student Name</th>
                            <th rowspan="2">Father Name</th>
                            @php $instalmentarr=[]; $totalsuminstalment=[]; @endphp
                            @foreach($feehead as $data)
                             @php
                               $instalmentdata=collect($feeheadinstalment)->where('fee_head_id',$data->id)->first();
                             @endphp

                             @if(isset($instalmentdata['instalment'])&&(count($instalmentdata['instalment'])>0))

                             <th colspan="{{count($instalmentdata['instalment'])}}">{{$data->fee_head}}</th>

                             @foreach($instalmentdata['instalment'] as $data1)
                                @php
                                    $instalmentarr[$data->id][] =$data1->instalment_unique_id;
                                    $totalsuminstalment +=['total_'.$data->id.'_'.$data1->instalment_unique_id=>0];
                                @endphp
                             @endforeach
                             @endif
                             @endforeach
                            @php $totalsuminstalment +=['total'=>0]; @endphp
                            <th rowspan="2" class="bg-success-light">Gr.Total</th>
                        </tr>
                        <tr>
                        @foreach($feehead as $data)
                           @if(isset($instalmentarr[$data->id]))
                           @foreach($instalmentarr[$data->id] as $instalmentid)
                               <th>{{ucwords($instalmentid)}}</th>
                           @endforeach
                           @endif
                        @endforeach
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($student as $data3)
                        <tr>
                            <td class="text-center">{{$loop->iteration}}</td>
                            <td>{{$data3->admission_no}}</td>
                            <td>{{$data3->CourseSection()}}</td>
                            <td>{{$data3->fullName()}}</td>
                            <td>{{$data3->FatherName()}}</td>
                            @php $totalconcession=0; @endphp
                            @foreach($feehead as $data)
                                @if(isset($instalmentarr[$data->id]))
                                    @foreach($instalmentarr[$data->id] as $instalmentid)
                                        @php
                                    $receiptsummary=['totalfee'=>0,'totalconcession'=>0,'totallatefee'=>0,'totalpayable'=>0,'totalpaid'=>0];

                                    $feecollectionsummary=dbtablesum(\App\Models\MasterAdmin\Finance\StudentFeeCollection::class
                                    ,['joinsearch'=>['t1.instalment_unique_id'=>$instalmentid,'t1.fee_head_id'=>$data->id,'finance_fee_collection_record.student_id'=>$data3->student_id,'finance_fee_collection_record.receipt_status'=>'paid']

                                    ,'join'=>['t1'=>['table'=>'finance_fee_collection_instalment_record','foreigntable'=>null,'foreign'=>'id','ownerkey'=>'fee_collection_id']]

                                    ,'dbrow'=>'*,SUM(t1.instalment_concession) as totalconcession']);

                                        if(isset($feecollectionsummary->totalconcession)){
                                          $totalconcession +=  $feecollectionsummary->totalconcession;
                                          $totalsuminstalment['total'] +=$feecollectionsummary->totalconcession;
                                          $totalsuminstalment['total_'.$data->id.'_'.$instalmentid] +=$feecollectionsummary->totalconcession;
                                        }
                                        @endphp

                                        <td class="text-right">@if(isset($feecollectionsummary->totalconcession)){{numberformat($feecollectionsummary->totalconcession,2)}}@else{{"--"}}@endif</td>
                                    @endforeach
                                @endif
                            @endforeach
                            <td class="bg-success-light text-right">{{numberformat($totalconcession,2)}}</td>
                        </tr>
                        @endforeach
                        </tbody>
                        <tfoot class="bg-success-light">
                        <tr>
                            <td colspan="5"><b>Total :</b></td>
                            @foreach($totalsuminstalment as $totalconcessionamt)
                            <td class="text-right"><b>{{numberformat($totalconcessionamt,2)}}</b></td>
                            @endforeach
                        </tr>
                        </tfoot>
                    </table>
                </div>
                @endif

            </div>
        </div>
    </div>
@endsection
