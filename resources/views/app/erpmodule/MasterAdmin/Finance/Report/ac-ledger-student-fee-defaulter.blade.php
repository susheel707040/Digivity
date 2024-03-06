@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">Finance/Account</li>
            <li class="breadcrumb-item" aria-current="page">Reports</li>
            <li class="breadcrumb-item active" aria-current="page">A/C Ledger Wise Student Fee Defaulter</li>
        </ol>
    </nav>
    <div class="col-lg-12 p-0 m-0 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i> A/C Ledger Wise Student Fee Defaulter</b></div>
            <div class="panel-body pd-b-10 row">
                <form class="container-fluid" action="{{url('/MasterAdmin/Finance/ACLedgerStudentFeeDefaulterReport')}}" method="POST">
                {{csrf_field()}}
                    <div class="col-lg-12 row m-0 pd-b-15">
                    <div class="col-lg-2 pd-l-0 pd-r-5">
                        <label><b>A/C Ledger No. :</b></label>
                        <input type="text" name="ac_ledger_no" id="ac_ledger_no" placeholder="Enter A/C Ledger No." class="form-control1 input-sm">
                    </div>
                    <div class="col-lg-2 pd-l-5 pd-r-5">
                        <label><b>Fee Head :</b></label>
                        @include('components.Finance.fee-head-import',['selectid'=>request()->get('fee_head_id')])
                    </div>
                    <div class="col-lg-2 pd-l-5 pd-r-5">
                        <label><b>Fee Month :</b></label>
                        <input type="text" autocomplete="off" name="fee_month_date" id="fee_month_date" value="{{nowdate(request()->get(''),'d-m-Y')}}" class="form-control1 date input-sm">
                    </div>
                    <div class="col-lg-2">
                        <button type="submit" class="btn mg-t-20 btn-primary btn-sm"><i class="fa fa-search"></i> Search</button>
                    </div>
                    </div>
                </form>

                <div class="col-lg-12 bd-1 bd-t">
                    <div class="col-lg-12 text-right">@include('layouts.actionbutton.action-button-verticle')</div>
                    <table id="example2" rowgroup="" datasum="true" colsum="8,9,10" class="table tx-11 datatable mg-t-10 table-bordered">
                        <thead class="bg-light">
                        <tr>
                            <th class="text-center">#</th>
                            <th><input type="checkbox" class="CheckAll col-hide" value="checkbox1"></th>
                            <th class="text-center active">A/C Ledger No.</th>
                            <th>Adm. No.</th>
                            <th>Course-Sect.</th>
                            <th>Student</th>
                            <th>Father</th>
                            <th>Contact No.</th>
                            <th class="wd-10p">Address</th>
                            <th class="text-right">Late Fee</th>
                            <th class="text-right">Fee Balance</th>
                            <th class="text-center">Last Paid Date</th>
                            <th class="text-right">Total Fee Balance</th>
                        </tr>
                        </thead>
                        @php
                        $rowid=0;
                        $totalsum=['latefee'=>0,'feebalnce'=>0,'totalbal'=>0];
                        @endphp
                        @foreach($acledger as $data)
                            <tbody>
                            @php
                            $student=studentshortlist(['ac_ledger_no'=>$data->ac_ledger_no]);
                            $studenttotalbalance=0;
                            @endphp
                            @foreach($student as $key=>$data1)

                                @php
                                    $rowid++;
                                        $currentdate=nowdate(request()->get('fee_month_date'),'Y-m-d');
                                        $feestructure=studentfeerecord(studentparameter($data1),$currentdate,request()->get('fee_head_id'));
                                        //dd($feestructure);
                                        $studenttotalbalance +=$feestructure[5]['feepayable'];
                                        $totalsum['latefee'] +=$feestructure[3]['finetotal'];
                                        $totalsum['feebalnce'] +=$feestructure[5]['feepayable'];
                                @endphp

                            <tr>
                                @if($key==0)
                                <td rowspan="{{count($student)}}" class="text-center">{{$loop->parent->iteration}}</td>
                                @endif
                                    @if($key==0)
                                        <td rowspan="{{count($student)}}" class="text-center col-hide"><input type="checkbox" class="checkbox1" value=""></td>
                                    @endif
                                @if($key==0)
                                <td rowspan="{{count($student)}}" class="text-center">{{$data->ac_ledger_no}}</td>
                                @endif
                                <td class="text-center">{{$data1->admission_no}}</td>
                                <td>{{$data1->CourseSection()}}</td>
                                <td>{{$data1->fullName()}}</td>
                                <td>{{$data1->FatherName()}}</td>
                                <td>{{$data1->student->contact_no}}</td>
                                <td>{{$data1->Address()}}</td>
                                <td class="text-right">@if(isset($feestructure[3])){{numberformat($feestructure[3]['finetotal'])}}@endif</td>
                                <td class="text-right">@if(isset($feestructure[5])){{numberformat($feestructure[5]['feepayable'])}}@endif</td>
                                <td class="text-center">@if($data1->LastFeePaidDate()){{nowdate($data1->LastFeePaidDate(),'d-F-Y')}}@endif</td>
                                @if((count($student)>1)&&$key==0)
                                <td rowspan="{{count($student)-1}}" class="text-right"></td>
                                @endif
                                @if($loop->last)
                                    @php
                                        $totalsum['totalbal'] +=$studenttotalbalance;
                                    @endphp
                                    <td class="bg-warning-light text-right"><b>{{numberformat($studenttotalbalance)}}</b></td>
                                @endif
                            </tr>
                            @endforeach
                            </tbody>
                        @endforeach

                        <tfoot class="bg-light">
                        <tr>
                            <th></th>
                            <th colspan="8" class="text-right"><b>Total :</b></th>
                            <th class="text-right">{{numberformat($totalsum['latefee'])}}</th>
                            <th class="text-right">{{numberformat($totalsum['feebalnce'])}}</th>
                            <th class="text-center">---------</th>
                            <th class="text-right bg-success-light">{{numberformat($totalsum['totalbal'])}}</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

<script>
    $(function () {
        'use strict'
        var groupColumn = 1;
        $('#example3').DataTable({
            responsive: true,
            "paging": false,
            order: [[1, 'asc']],
            language: {
                searchPlaceholder: 'Search...',
                sSearch: '',
                lengthMenu: '_MENU_ items/page',
            },
            "footerCallback": function (row, data, start, end, display) {
                if ($(this).attr('datasum') == "true") {
                    function parseCurrency(num) {
                        return parseFloat(num.replace(/,/g, ''));
                    }

                    var api = this.api();
                    var nb_cols = api.columns().nodes().length;
                    var col = $(this).attr('colsum');
                    col = col.split(',');
                    $.each(col, function (key, val) {
                        var pageTotal = api
                            .column(val, {page: 'current'})
                            .data()
                            .reduce(function (a, b) {
                                return Number(a) + Number(parseCurrency(b));
                            }, 0);
                        // Update footer
                        $(api.column(val).footer()).html(pageTotal.toFixed(2));
                    });
                }
            },
            "drawCallback": function ( settings ) {
                var api = this.api();
                var rows = api.rows({page: 'current'}).nodes();
                var last = null;

                api.column(groupColumn, {page: 'current'}).data().each(function (group, i) {
                    if (last !== group) {
                        $(rows).eq(i).before(
                            '<tr class="group"><td></td><td colspan="9"><b>A/C Ledger No. - ' + group + '</b></td><td class="text-right">100</td><td></td></tr>'
                        );

                        last = group;
                    }
                });
            }
        });
    });
</script>

@endsection
