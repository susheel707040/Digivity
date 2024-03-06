@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">Finance/Account</li>
            <li class="breadcrumb-item" aria-current="page">Reports</li>
            <li class="breadcrumb-item active" aria-current="page">Student Fee Head Wise Fee Defaulter</li>
        </ol>
    </nav>

    <div class="col-lg-12 p-0 m-0 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i>Student Fee Head Wise Fee Defaulter</b></div>
            <div class="panel-body pd-b-10 row">
                <form action="{{url('MasterAdmin/Finance/StudentFeeHeadDefaulterReport')}}" method="POST">
                    {{csrf_field()}}
                    <div class="col-lg-12 row m-0 pd-l-5 pd-r-5 pd-b-15">
                        <div class="col-lg-2 pd-l-0 pd-r-5">
                            <label><b>Course :</b></label>
                            @include('components.course-import',['selectid'=>request()->get('course_id')])
                        </div>
                        <div class="col-lg-1 pd-l-5 pd-r-5">
                            <label><b>Section :</b></label>
                            @include('components.section-import',['selectid'=>request()->get('section_id')])
                        </div>
                        <div class="col-lg-2 pd-l-5 pd-r-5">
                            <label><b>Fee Head</b></label>
                            @include('components.Finance.fee-head-import',['selectid'=>request()->get('fee_head_id')])
                        </div>
                        <div class="col-lg-1 pd-l-5 pd-r-5">
                            <label>Fee Month : </label>
                            <input type="text" name="fee_month_date" value="{{nowdate(request()->get('fee_month_date'),'d-m-Y')}}" id="fee_month_date" placeholder="dd-mm-yyyy" class="date form-control1 input-sm">
                        </div>
                        <div class="col-lg-2">
                            <label><b>Balance Zero Show List :</b></label>
                            <table>
                                <tr>
                                    <td><input type="radio" name="zero_show" value="yes"></td><td class="pd-l-5">Yes</td>
                                    <td class="pd-l-10"><input type="radio" name="zero_show" value="no" checked></td><td class="pd-l-5">No</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-lg-2 pd-l-5 pd-r-5">
                            <label><b>Result :</b></label>
                            <table>
                                <tr>
                                    <td>
                                        <select name="result" class="form-control1 wd-100 input-sm">
                                            <option value="greater" @if(request()->get('result')=="greater") selected @endif>Greater Then</option>
                                            <option value="less" @if(request()->get('result')=="less") selected @endif>Less Then</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" name="result_amount" @if(request()->get('result_amount')) value="{{request()->get('result_amount')}}" @else value="0" @endif class="form-control1">
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-lg-2 pd-l-5 pd-l-0">
                            <button class="btn btn-primary mg-t-20"><i class="fa fa-search"></i> Search</button>
                        </div>
                    </div>
                </form>
                @if(request()->get('_token'))
                    <div class="col-lg-12 bd-1 bd-t">
                        <div class="col-lg-12 text-right"> @include('layouts.actionbutton.action-button-verticle')</div>
                        @php $colsum=8; @endphp
                        <table id='example2' datasum="true" colsum="@foreach($feehead as $data1){{$colsum++.","}}@endforeach" class="table mg-t-10 datatable table-bordered tx-11">
                            <thead class="bg-light">
                            <tr>
                                <th colspan="{{count($feehead)+9}}" class="tx-12">Fee Month : {{nowdate(request()->get('fee_month_date'),'F-Y')}}</th>
                            </tr>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center col-hide"><input type="checkbox" class="CheckAll" value="checkbox1"></th>
                                <th class="text-center">A/C Ledger No.</th>
                                <th class="text-center">Adm. No.</th>
                                <th class="text-left">Student</th>
                                <th class="text-center">Course</th>
                                <th class="text-left">Father</th>
                                <th class="text-center">Contact No.</th>
                                @foreach($feehead as $data)
                                    <th class="text-right">{{$data->fee_head}}</th>
                                @endforeach
                                <th class="text-right bg-success-light">Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                    $row=1;
                                    $totalsum=array();
                                    foreach($feehead as $data1){ $totalsum['total_sum_'.$data1->id.'']=0;} $totalsum['totalsum']=0;
                            @endphp
                            @foreach($student as $data)
                                @php
                                    $studenttotalbal=0;
                                    $currentdate=nowdate(request()->get('fee_month_date'),'Y-m-d');
                                    $feestructure=studentfeerecord(studentparameter($data),$currentdate,request()->get('fee_head_id'));
                                    /*
                                     * TABLE HTML PREDEFINE TABLES DETAILS
                                     */
                                    $tabletd="";
                                    foreach($feehead as $data1){
                                        $feeheadstructure=collect($feestructure[0])->where('fee_head_id',$data1->id)->mapWithKeys(function ($i){ return ['feebalance'=>array_sum($i['select_pay_instalment_amount'])-array_sum($i['select_pay_instalment_concession'])+array_sum($i['select_pay_instalment_late_fee'])];});
                                            if(isset($feeheadstructure['feebalance'])){
                                                $totalsum['total_sum_'.$data1->id.''] +=$feeheadstructure['feebalance'];
                                                $studenttotalbal +=$feeheadstructure['feebalance'];
                                                $totalsum['totalsum'] +=$feeheadstructure['feebalance'];
                                                $tabletd.="<td class='text-right'>".numberformat($feeheadstructure['feebalance'])."</td>";
                                            }else{
                                                $tabletd.="<td class='text-center'>---</td>";
                                            }
                                    }
                                @endphp
                                @if(isset($studenttotalbal)&&(request()->get('result')=="greater" && $studenttotalbal >  request()->get('result_amount') && $studenttotalbal > 0)||(request()->get('result')=="less" && $studenttotalbal <  request()->get('result_amount') && $studenttotalbal > 0))
                                    <tr>
                                        <td class="text-center">{{$row++}}</td>
                                        <td class="text-center col-hide"><input type="checkbox" class="checkbox1"></td>
                                        <td class="text-center">{{$data->ac_ledger_no}}</td>
                                        <td class="text-center">{{$data->admission_no}}</td>
                                        <td>{{$data->fullName()}}</td>
                                        <td class="text-center">{{$data->CourseSection()}}</td>
                                        <td>{{$data->FatherName()}}</td>
                                        <td class="text-center">{{$data->student->contact_no}}</td>
                                        {!! $tabletd !!}
                                        <td class="text-right bg-success-light">{{numberformat($studenttotalbal)}}</td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                            <tfoot class="bg-light">
                            <tr>
                                <td colspan="8" class="text-right"><b>Fee Head Total :</b></td>
                                @foreach($totalsum as $totalsumvalue)
                                    <td class="text-right"><b>0</b></td>
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
