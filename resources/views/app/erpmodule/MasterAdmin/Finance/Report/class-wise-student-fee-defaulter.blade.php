@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">Finance/Account</li>
            <li class="breadcrumb-item" aria-current="page">Reports</li>
            <li class="breadcrumb-item active" aria-current="page">Class Wise Student Fee Defaulter</li>
        </ol>
    </nav>
    <div class="col-lg-12 p-0 m-0 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i> Class Wise Student Fee Defaulter</b></div>
            <div class="panel-body pd-b-10 row">
                <form class="container-fluid" action="{{url('/MasterAdmin/Finance/ClassWiseStudentFeeDefaulterReport')}}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="col-lg-12 pd-r-5 pd-b-20 row">
                        <div class="col-lg-1 pd-l-0 pd-r-0">
                            <label><b>Course : </b></label>
                            @include('components.course-import',['selectid'=>request()->get('course_id')])
                        </div>
                        <div class="col-lg-1 pd-l-5 pd-r-5">
                            <label><b>Section : </b></label>
                            @include('components.section-import',['selectid'=>request()->get('section_id')])
                        </div>
                        <div class="col-lg-1 p-1">
                            <label><b>Is New :</b></label>
                            @include('components.GlobalSetting.is-new-status',['selectid'=>request()->get('is_new'),'selectnull'=>1])
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
                        <div class="col-lg-2 p-l-0 p-r-0">
                            <button class="btn btn-primary mg-t-20 btn-block btn-sm"><i class="fa fa-search"></i> Search</button>
                        </div>
                    </div>
                </form>

                @if(request()->get('_token'))
                    <div class="col-lg-12 bd-1 bd-t">
                        <div class="col-lg-12 p-0 text-right">
                            <button type="button" id="token_btn" class="btn btn-outline-dark tx-bold tx-11 tx-uppercase float-left"><i class="fa fa-print"></i> Fee Estimate Token Print</button>
                            @php $sms=1; @endphp
                            @include('layouts.actionbutton.action-button-verticle',['sms'=>1])
                        </div>
                        <table id="example2" datasum="true" colsum="11,12" class="table mg-t-10 datatable table-bordered tx-11">
                            <thead class="bg-light">
                            <tr>
                                <th colspan="13">Fee Month Upto : {{nowdate(request()->get('fee_month_date'),'F - Y')}}</th>
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
                                <td class="wd-10p">Address</td>
                                <td class="wd-80">Instalment</td>
                                <th class="text-center">Last Paid Date</th>
                                <th>Late Fee</th>
                                <th class="text-right">Fee Balance</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $row=1; @endphp
                            @foreach($student as $data)
                                @php
                                    $currentdate=nowdate(request()->get('fee_month_date'),'Y-m-d');
                                    $feestructure=studentfeerecord(studentparameter($data),$currentdate,request()->get('fee_head_id'));
                                    //fee pay instalment
                                    try {$feeinstalmentprint=call_user_func_array("array_merge",array_column($feestructure[0],'select_pay_instalment_print'));}catch (\Exception $e){$feeinstalmentprint=[];}
                                @endphp
                                @if(isset($feestructure[5]['feepayable'])&&(request()->get('result')=="greater" && $feestructure[5]['feepayable'] >  request()->get('result_amount') && $feestructure[5]['feepayable'] > 0)||(request()->get('result')=="less" && $feestructure[5]['feepayable'] <  request()->get('result_amount') && $feestructure[5]['feepayable'] > 0))
                                    @php
                                        $parameter=['{FeeAmount}'=>numberformat($feestructure[5]['feepayable']),'{LateFee}'=>numberformat($feestructure[3]['finetotal']),'{FeeMonth}'=>nowdate($currentdate,'M-Y'),'{LastPaidDate}'=>nowdate($data->LastFeePaidDate(),'d-F-Y')];
                                    @endphp
                                    <tr>
                                        <td class="text-center">{{$row++}}</td>
                                        <td class="text-center col-hide">
                                            <input type="checkbox" data-contactid="{{$data->contactnoid()}}" data-parameter="{{serialize($parameter)}}" data-name="{{$data->fullName()}} <b>({{$data->CourseSection()}})</b>" data-contact-no="{!! \App\Helper\MobileNumberValidate::validate($data->student->contact_no) !!}" name="student_id" class="checkbox1 student_id" value="{{$data->student_id}}">
                                        </td>
                                        <td class="text-center">{{$data->ac_ledger_no}}</td>
                                        <td class="text-center">{{$data->admission_no}}</td>
                                        <td>{{$data->fullName()}}</td>
                                        <td class="text-center">{{$data->CourseSection()}}</td>
                                        <td>{{$data->FatherName()}}</td>
                                        <td class="text-center">{{$data->student->contact_no}}</td>
                                        <td>{{$data->Address()}}</td>
                                        <td class="tx-11">{{implode(", ",$feeinstalmentprint)}}</td>
                                        <td class="text-center">@if($data->LastFeePaidDate()) {{nowdate($data->LastFeePaidDate(),'d-M-Y')}} @endif</td>
                                        <td class="text-right">@if(isset($feestructure[3])){{numberformat($feestructure[3]['finetotal'])}}@endif</td>
                                        <td class="text-right">@if(isset($feestructure[5])){{numberformat($feestructure[5]['feepayable'])}}@endif</td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                            <tfoot class="bg-light">
                            <tr>
                                <th></th>
                                <th class="col-hide"></th>
                                <th colspan="9" class="text-right">Total :</th>
                                <th class="text-right"></th>
                                <th class="text-right"></th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $("#token_btn").click(function () {
            var feemonth=$("#fee_month_date").val();
            var payfeeid="@if(request()->get('fee_head_id')){{request()->get('fee_head_id')}}@else{{"0"}}@endif";
            var studentids = $("input[name='student_id']:checked").map(function(){return $(this).val();}).get();
            if(studentids==0){
                swal("Opps!", "Please select atleast one student.", "error");
                return false;
            }
            var url='/MasterAdmin/Finance/FeeEstimateToken/'+feemonth+'/'+payfeeid+'/'+studentids+'/Print';
            newTab(url);
            return false;
        });
    </script>
@endsection
