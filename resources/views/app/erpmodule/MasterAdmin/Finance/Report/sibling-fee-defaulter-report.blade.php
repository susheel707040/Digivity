@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">Finance/Account</li>
            <li class="breadcrumb-item" aria-current="page">Reports</li>
            <li class="breadcrumb-item active" aria-current="page">Sibling Fee Defaulter Detail</li>
        </ol>
    </nav>

    <div class="col-lg-12  p-0 m-0 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i> Sibling Fee Defaulter Detail</b></div>
            <div class="panel-body tx-11 pd-b-5 row">
                <form class="container-fluid" action="{{url('MasterAdmin/Finance/SiblingsFeeDefaulterReport')}}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="col-lg-12 pd-b-15 pd-t-15 m-0 bd-1 bd-b row">
                        <div class="col-lg-3 pd-l-10">
                            <label><b>Group By Student List :</b></label>
                            <table>
                                <tr>
                                    <td><input type="checkbox" name="father_group" value="yes" @if(request()->get('father_group')=="yes") checked @endif @if(!request()->get('father_group')) checked @endif></td><td >Father Name</td>
                                    <td class="pd-l-5"><input name="mother_group" value="yes" type="checkbox"  @if(request()->get('mother_group')=="yes") checked @endif></td><td class="pd-l-5">Mother Name</td>
                                    <td class="pd-l-5"><input name="contact_group" value="yes" type="checkbox" @if(request()->get('contact_group')=="yes") checked @endif @if(!request()->get('contact_group')) checked @endif></td><td class="pd-l-5">Mobile No.</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-lg-2">
                            <table cellspacing="0" cellpadding="0" class="">
                                <tr>
                                    <td>
                                        <label><b>Sibling Wise List :</b></label>
                                        <table>
                                            <tr>
                                                <td><input type="radio" name="sibling_group" value="yes" ></td><td class="pd-l-5">Yes</td>
                                                <td class="pd-l-10"><input type="radio" name="sibling_group" value="no" checked></td><td class="pd-l-5">No</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-lg-1 pd-l-5 pd-r-5">
                            <label><b>Fee Month : </b></label>
                            <input type="text" name="fee_month_date" id="fee_month_date" class="form-control1 date" value="{{nowdate(request()->get('fee_month_date'),'d-m-Y')}}">
                        </div>
                        <div class="col-lg-2 pd-l-5 pd-r-5">
                            <label><b>Fee Head</b></label>
                            @include('components.Finance.fee-head-import',['selectid'=>request()->get('fee_head_id')])
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
                                        <select name="result" class="form-control1 inout-sm wd-100">
                                            <option value="greater" @if(request()->get('result')=="greater") selected @endif>Greater Then</option>
                                            <option value="less" @if(request()->get('result')=="less") selected @endif>Less Then</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" name="result_amount" @if(request()->get('result_amount')) value="{{request()->get('result_amount')}}" @else value="0" @endif class="form-control1 text-right input-sm wd-70">
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-lg-2 p-0">
                            <button class="btn mg-t-10 btn-primary"><i class="fa fa-search"></i> Get Result</button>
                        </div>
                    </div>
                </form>

                @if(request()->get('_token'))
                    <div class="col-lg-12 mg-t-10">
                        <div class="col-lg-12 text-right m-0 pd-b-10">@include('layouts.actionbutton.action-button-verticle')</div>
                        <table class="table datatable table-bordered">
                            <thead class="bg-light">
                            <tr>
                                <th>Sl.No.</th>
                                <th class="text-center"><input type="checkbox"></th>
                                <th>Admission No.</th>
                                <th>Class/Course</th>
                                <th>Student Name</th>
                                <th>Father Name</th>
                                <th>Contact No.</th>
                                <th>Address</th>
                                <th class="text-center">Last Paid Date</th>
                                <th>Fee Instalment</th>
                                <th class="text-right">Fee Amount</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $row=0; $totalfee=0; @endphp
                            @foreach($studentgroup as $group=>$student)

                                @if(count($student)>1)


                                    @php $siblingtotal=0; @endphp
                                    @foreach($student as $data)
                                        @php $row++; @endphp

                                        @php
                                            $currentdate=nowdate(request()->get('fee_month_date'),'Y-m-d');
                                            $feestructure=studentfeerecord(studentparameter($data),$currentdate,request()->get('fee_head_id'));
                                            //fee pay instalment
                                            try {$feeinstalmentprint=call_user_func_array("array_merge",array_column($feestructure[0],'select_pay_instalment_print'));}catch (\Exception $e){$feeinstalmentprint=[];}
                                        @endphp
                                        @if(isset($feestructure[5]['feepayable'])&&(request()->get('result')=="greater" && $feestructure[5]['feepayable'] >  request()->get('result_amount') && $feestructure[5]['feepayable'] > 0)||(request()->get('result')=="less" && $feestructure[5]['feepayable'] <  request()->get('result_amount') && $feestructure[5]['feepayable'] > 0))
                                            @if($loop->iteration==1)
                                                <tr>
                                                    <td colspan="11" class="bg-primary-light tx-13"><span><b>Father Name :</b> </span> <span class="mg-l-10">|</span> <span class="mg-l-10"><b>Mobile No. :</b> </span> </td>
                                                </tr>
                                            @endif

                                            <tr>
                                                <td>{{$row}}</td>
                                                <td class="text-center"><input type="checkbox"></td>
                                                <td>{{$data->admission_no}}</td>
                                                <td>{{$data->CourseSection()}}</td>
                                                <td>{{$data->fullName()}}</td>
                                                <td>{{$data->FatherName()}}</td>
                                                <th>{{$data->student->contact_no}}</th>
                                                <td class="wd-20p">{{$data->Address()}}</td>
                                                <td class="text-center">{{nowdate($data->LastFeePaidDate(),'d-M-Y')}}</td>
                                                <td class="wd-10p">{{implode(", ",$feeinstalmentprint)}}</td>
                                                <td class="text-right">@if(isset($feestructure[5])){{numberformat($feestructure[5]['feepayable'])}}
                                                    @php if($feestructure[5]['feepayable']>0){ $totalfee +=$feestructure[5]['feepayable']; $siblingtotal +=$feestructure[5]['feepayable'];} @endphp @endif
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach

                                    @if((count($student)>1)&&($siblingtotal>0))
                                        <tr class="bg-light">
                                            <td colspan="10" class="text-right"><b>Total Sibling Fee :</b></td>
                                            <td class="text-right"><b>{{numberformat($siblingtotal,2)}}</b></td>
                                        </tr>
                                    @endif

                                @endif

                            @endforeach
                            </tbody>
                            <tfoot class="bg-success-light tx-13">
                            <tr>
                                <td colspan="10" class="text-right"><b>Total Fee :</b></td>
                                <td class="text-right"><b>{{numberformat($totalfee,2)}}</b></td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection
