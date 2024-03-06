@extends('layouts.MasterLayout')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mg-b-10 mg-lg-b-10 mg-xl-b-10">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Finance Dashboard</li>
            </ol>
        </nav>
        @php
            /**
             *get student details
             */
             $studentstrength = studentstrength(['status'=>'active']);
             $student=dbtablesum(\App\Models\MasterAdmin\Admission\StudentRecord::class,['dbrow'=>'count(id) as totalstrength','search'=>['status'=>'active']]);
             $usetransport=dbtablesum(\App\Models\MasterAdmin\Admission\StudentRecord::class,['dbrow'=>'count(id) as totalstrength','customsearch'=>['whereNotNull'=>'transport_id','where'=>['transport_status'=>'active']]]);
             /*
             * fianance get details
             */
             $fromdate=nowdate(request()->get('from_date'),'Y-m-d');
             $enddate=nowdate(request()->get('to_date'),'Y-m-d');

             $feecollection=dbtablesum(\App\Models\MasterAdmin\Finance\StudentFeeCollection::class,['dbrow'=>'SUM(paid_amount) as totalcollect,count(id) as totalreceipt','search'=>['receipt_status'=>'paid'],'customsearch' => [ 'whereBetween' => [ 'receipt_date' => [$fromdate,$enddate] ]]]);
             $totalcollect=0; if(isset($feecollection->totalcollect)){$totalcollect=$feecollection->totalcollect;}
             $totalreceipt=0; if(isset($feecollection->totalreceipt)){$totalreceipt=$feecollection->totalreceipt;}

             $totalexpense=0;
             $totalvoucher=0;

/**
*Fee collection full summary
 */
        $receiptsummary=['totalfee'=>0,'totalconcession'=>0,'totallatefee'=>0,'totalpayable'=>0,'totalpaid'=>0];

        $feecollectionsummary=dbtablesum(\App\Models\MasterAdmin\Finance\StudentFeeCollection::class
        ,['search'=>['receipt_status'=>'paid'],'customsearch' => [ 'whereBetween' => [ 'receipt_date' => [$fromdate,$enddate] ]]

        ,'join'=>['t1'=>['table'=>'finance_fee_collection_instalment_record','foreigntable'=>null,'foreign'=>'id','ownerkey'=>'fee_collection_id']]

        ,'dbrow'=>'SUM(t1.instalment_amount) as totalfee,SUM(t1.instalment_concession) as totalconcession
        ,SUM(t1.instalment_fine) as totallatefee,SUM(t1.instalment_total_amount) as totalpayable,SUM(t1.instalment_paid) as totalpaid']);

        if(isset($feecollectionsummary)){
            $feecollectionsummary->totalfee ? $receiptsummary['totalfee'] +=$feecollectionsummary->totalfee : 0 ;
            $feecollectionsummary->totalconcession ? $receiptsummary['totalconcession'] +=$feecollectionsummary->totalconcession : 0 ;
            $feecollectionsummary->totallatefee ? $receiptsummary['totallatefee'] +=$feecollectionsummary->totallatefee : 0 ;
            $feecollectionsummary->totalpayable ? $receiptsummary['totalpayable'] +=$feecollectionsummary->totalpayable : 0 ;
            $feecollectionsummary->totalpaid ? $receiptsummary['totalpaid'] +=$feecollectionsummary->totalpaid : 0 ;
        }
        @endphp


        <div class="d-none d-md-block mg-t-5">
            <form action="{{url('MasterAdmin/Finance/index')}}" method="POST">
                {{csrf_field()}}
            <table>
                <tr>
                    <td><input type="text" name="from_date" autocomplete="off" value="@if(request()->get('from_date')){{request()->get('from_date')}}@else{{nowdate('','d-m-Y')}}@endif" class="form-control date"></td>
                    <td>-</td>
                    <td><input type="text" name="to_date" autocomplete="off" value="@if(request()->get('to_date')){{request()->get('to_date')}}@else{{nowdate('','d-m-Y')}}@endif" class="form-control date"></td>
                    <td>
                        <button type="submit" class="btn btn-sm pd-x-15 btn-white btn-uppercase mg-l-5"><i
                                class="fa fa-search wd-10 mg-r-5"></i> Get Result
                        </button>
                    </td>
                </tr>
            </table>
            </form>
        </div>
    </div>
    <div class="row row-xs">
        <div class="col-lg-12 col-xl-12 row m-0">
            @include('app.erpmodule.MasterAdmin.Finance.Dashboard.first-column-chart')
        </div>

        <div class="col-lg-12 col-xl-12 row m-0">
            @include('app.erpmodule.MasterAdmin.Finance.Dashboard.second-column-chart')
        </div>
    </div>

    <script type="text/javascript" src="{{url('assets/lib/chart.js/Chart.bundle.min.js')}}"></script>
    <script>
        /** PIE CHART **/
        var datapie = {
            labels: ['Total Fee', 'Total Fee Concession', 'Total Late Fee', 'Total Fee Payable', 'Total Fee Collect', 'Total Excess Amount'],
            datasets: [{
                data: [{{$receiptsummary['totalfee']}}, {{$receiptsummary['totalconcession']}}, {{$receiptsummary['totallatefee']}}, {{$receiptsummary['totalpayable']}}, {{$receiptsummary['totalpaid']}},{{$totalcollect-$receiptsummary['totalpaid']}}],
                height: 100,
                weight: 150,
                backgroundColor: ['#17A589', '#D68910','#27AE60','#9B59B6','#2E86C1','#F1C40F']
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

    <script>
        $(function () {
            'use strict'
            var data = {
                datasets: [{
                    data: [{{$totalcollect}},{{$totalreceipt}},{{$totalexpense}},{{$totalvoucher}}],
                    backgroundColor: [
                        "#17A589",
                        "#3498DB",
                        "#E74C3C",
                        "#F39C12"
                    ]
                }],
                // These labels appear in the legend and in the tooltips when hovering different arcs
                labels: [
                    'Total Fee Collection',
                    'Total Generate Fee Receipt',
                    'Total Expenses',
                    'Total Generate Voucher'
                ],

            };
            var ctx1 = document.getElementById('chartBar1').getContext('2d');
            new Chart(ctx1, {
                data: data,
                type: 'polarArea',
                options: {
                    responsive: true,
                    legend: {
                        position: 'left',
                    }
                }
            });
        });
    </script>


@endsection
