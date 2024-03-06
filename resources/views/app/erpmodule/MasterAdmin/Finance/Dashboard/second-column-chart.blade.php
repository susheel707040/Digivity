<div class="col-lg-8 pd-l-0 mg-t-10">
    <div class="card">
        <div class="card-header d-flex align-items-start justify-content-between">
            <h6 class="lh-5 tx-13 pd-5 pd-l-0 mg-b-0"><b>Course Wise Fee Collection</b></h6>
            <a href="#" class="tx-13 pd-t-5 link-03"><i class="fa fa-calendar"></i> {{nowdate($fromdate,'d-M-Y')}} - {{nowdate($enddate,'d-M-Y')}}</a>
        </div><!-- card-header -->
        <div class="card-body pd-y-15 pd-x-10">
            <div class="table-responsive">
                <table class="table table-borderless table-sm tx-13 tx-nowrap mg-b-0">
                    <thead class="bg-light tx-13">
                    <tr class="tx-10 tx-spacing-1 tx-color-03 tx-uppercase">
                        <th class="wd-5p text-center">#</th>
                        <th>COURSE</th>
                        @php $totalsum=array('totalsum'=>0); @endphp
                        @foreach($section as $data1)
                            @php $totalsum['section_sum_'.$data1->section->id.'']=0; @endphp
                            <th class="text-right">{{$data1->section->section}}</th>
                        @endforeach
                        <th class="text-center">Percentage (%)</th>
                        <th class="text-right">AMOUNT</th>
                    </tr>
                    </thead>
                    <tbody class="tx-11">
                    @foreach($course as $data)
                        @php $color=substr(str_shuffle('ABCDEF0123456789'), 0, 6); @endphp
                    <tr>
                        <td class="align-middle text-center"><b><i class="fa fa-circle-notch" style=" color:#{{$color}};"></i></b></td>
                        <td class="align-middle tx-12">{{$data->course}}</td>
                        @php $coursetotal=0; @endphp
                        @foreach($section as $data1)
                            @php
                            $feecollection=dbtablesum(\App\Models\MasterAdmin\Finance\StudentFeeCollection::class,['dbrow'=>'SUM(paid_amount) as totalcollect','search'=>['course_id'=>$data->id,'section_id'=>$data1->section->id,'receipt_status'=>'paid'], 'customsearch' => [ 'whereBetween' => [ 'receipt_date' => [$fromdate,$enddate] ]]]);
                             $paymodeamount=0; if(isset($feecollection->totalcollect)){
                                 $paymodeamount +=$feecollection->totalcollect;
                                 $coursetotal +=$feecollection->totalcollect;
                                 $totalsum['section_sum_'.$data1->section->id.''] +=$feecollection->totalcollect;
                                 $totalsum['totalsum'] +=$feecollection->totalcollect;;
                             }
                             $percantage=0;
                             if($coursetotal>0){
                            $percantage=numberformat((($coursetotal*100)/$totalcollect));}
                            @endphp
                            <td class="text-right">{{numberformat($paymodeamount)}}</td>
                        @endforeach
                        <td class="align-middle text-center">
                            <div class="wd-80 d-inline-block">
                                <div class="progress ht-8 mg-b-0">
                                    <div class="progress-bar " style=" background:#{{$color}}; @if(isset($percantage)) width:{{$percantage}}%;" role="progressbar" aria-valuenow="{{$percantage}}" @endif aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </td>
                        <td class="align-middle text-right"><span class="tx-medium"><b>{{numberformat($coursetotal)}}</b></span></td>
                    </tr>
                    @endforeach
                    </tbody>
                    <tfoot class="bg-light tx-12">
                    <tr>
                        <td colspan="2" class="text-right"><b>Total Collection :</b></td>
                        @foreach($section as $data1)
                            @php
                            $totalsectionsum=0; if(isset($totalsum['section_sum_'.$data1->section->id.''])){ $totalsectionsum +=$totalsum['section_sum_'.$data1->section->id.''];}
                            @endphp
                            <td class="text-right"><b>{{numberformat($totalsectionsum)}}</b></td>
                        @endforeach
                        <td class="text-right" colspan="2"><b>{{numberformat($totalsum['totalsum'])}}</b></td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div><!-- card-body -->
    </div><!-- card -->
</div>




<div class="col-lg-4 pd-l-0 pd-r-0 mg-t-10">
    <div class="card">
        <div class="card-header d-flex align-items-start justify-content-between">
            <h6 class="lh-5 tx-13 pd-5 mg-b-0"><b>Paymode Wise Metrics</b></h6>
            <a href="#" class="tx-13 pd-t-5 link-03"><i class="fa fa-calendar"></i> {{nowdate($fromdate,'d-M-Y')}} - {{nowdate($enddate,'d-M-Y')}}</a>
        </div><!-- card-header -->
        <div class="card-body pd-y-15 pd-x-10">
            <div class="table-responsive">
                <table class="table table-borderless table-sm tx-13 tx-nowrap mg-b-0">
                    <thead class="bg-light">
                    <tr class="tx-10 tx-spacing-1 tx-color-03 tx-uppercase">
                        <th class="wd-5p">#</th>
                        <th>Paymode</th>
                        <th class="text-center">Percentage (%)</th>
                        <th class="text-right">Amount</th>
                    </tr>
                    </thead>
                    <tbody class="tx-12">
                    @php $totalpaymode=0; @endphp
                    @foreach($paymode as $data)
                        @php $color=substr(str_shuffle('ABCDEF0123456789'), 0, 6); @endphp
                    @php
                    $feecollection=dbtablesum(\App\Models\MasterAdmin\Finance\StudentFeeCollection::class,['dbrow'=>'SUM(paid_amount) as totalcollect','search'=>['paymode_id'=>$data->id,'receipt_status'=>'paid'], 'customsearch' => [ 'whereBetween' => [ 'receipt_date' => [$fromdate,$enddate] ]]]);
                    $paymodeamount=0; if(isset($feecollection->totalcollect)) { $paymodeamount +=$feecollection->totalcollect; $totalpaymode +=$feecollection->totalcollect;}
                    $percantage=0;
                    if($paymodeamount>0){
                    $percantage=numberformat((($paymodeamount*100)/$totalcollect));
                    }
                    @endphp

                    <tr>
                        <td class="align-middle text-center"><b><i style=" color:#{{$color}};" class="fa fa-circle-notch"></i></b></td>
                        <td class="align-middle tx-medium">{{$data->paymode}}</td>
                        <td class=" text-center">
                            <div class="wd-80  d-inline-block">
                                <div class="progress ht-8 mg-b-0">
                                    <div class="progress-bar" style="background:#{{$color}}; @if(isset($percantage)) width:{{$percantage}}%; @endif" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </td>
                        <td class="text-right"><span class="tx-medium"><b>{{numberformat($paymodeamount)}}</b></span></td>
                    </tr>
                    @endforeach
                    </tbody>
                    <tfoot class="bg-light tx-12">
                    <tr>
                        <td colspan="3" class="text-right"><b>Total Collection :</b></td>
                        <td class="text-right"><b>{{numberformat($totalpaymode)}}</b></td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div><!-- card-body -->
    </div><!-- card -->
</div>







