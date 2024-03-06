<div class="col-lg-12 text-right">
    <span>@include('layouts.actionbutton.action-button-verticle')</span>
</div>
<div class="col-lg-12 " >
    @if(isset($studentrecord))

        <table class="table datatable table-bordered mt-1">
            <thead>
            <tr>
                <td colspan="7">
                    @include('component.Student.student-short-table-record',['student'=>$studentrecord])
                </td>
            </tr>
            </thead>
            <thead class="bg-light">
            <tr>
                <th>S.No.</th>
                <th>V. Type/No.</th>
                <th>Date</th>
                <th class="wd-40p">Description</th>
                <th class="text-right">Debit</th>
                <th class="text-right">Credit</th>
                <th class="text-right">Closing Balance</th>
            </tr>
            </thead>
            <tbody>
            @php $row=1; $totalfeesum=0; $totalpaid=0; $totalbal=0; @endphp

            @foreach($instalmentdates as $key=>$instalmentdate)

                @php
                    $feemonth=nowdate($instalmentdate->start_date,'Y-m-d');
                    $lastmonthdate=\Carbon\Carbon::createFromDate($instalmentdate->start_date)->endOfMonth()->toDateString();
                    $studentfeerecord = studentfeerecord(array_merge(studentparameter($studentrecord),['withoutpaid_fee'=>true]),['from_date'=>$feemonth,'to_date'=>$lastmonthdate], []);
                @endphp
                @if(isset($studentfeerecord)&&(strtotime($feemonth)<=strtotime(nowdate($feemonthdate,'Y-m-d'))))
                    @php
                        $feebalance=($studentfeerecord[5]['feepayable']);
                        $totalfeesum +=$feebalance;
                        $totalbal +=$feebalance;
                    @endphp
                    @if($feebalance)
                    <tr>
                        <td class="text-center">{{$row++}}</td>
                        <td></td>
                        <td>{{nowdate($instalmentdate->start_date,'d-M-Y')}}</td>
                        <td>Fee Bill Generated in the month of {{nowdate($instalmentdate->start_date,'F')}}</td>
                        <td class="text-right">{{numberformat($feebalance,2)}}</td>
                        <td class="text-right"></td>
                        <td class="text-right">{{numberformat($totalbal,2)}}</td>
                    </tr>
                    @endif
                @endif

                @php
                    if($instalmentdates[$key]->start_date){
                    $startdate=$instalmentdates[$key]->start_date;
                    $nextkey=$key+1;
                    if(isset($instalmentdates[$nextkey])){
                    $enddate=\Carbon\Carbon::createFromDate($instalmentdates[$nextkey]->start_date)->subDays(1);;
                    }else{
                      $enddate=nowdate($feemonthdate,'Y-m-d');
                    }
                    }
                    $feecollectionlist=(new \App\Repositories\MasterAdmin\Finance\FinanceRepository())->feecollectionfulllist(['search'=>['student_id'=>$studentrecord->student_id,'receipt_status'=>'paid'],'customsearch' => [ 'whereBetween' => [ 'receipt_date' => [$startdate,$enddate] ]]])->sortBy('receipt_date');
                @endphp

                @foreach($feecollectionlist as $data)
                    @php $totalpaid +=$data->paid_amount; $totalbal-=$data->paid_amount @endphp
                    <tr>
                        <td class="text-center">{{$row++}}</td>
                        <td>{{$data->receipt_id}}</td>
                        <td>{{nowdate($data->receipt_date,'d-M-Y')}}</td>
                        <td>Fee Received against Bill No. : by {{$data->PaymodeName()}} @if($data->instrument_no) No. {{$data->instrument_no}} @endif @if($data->instrument_date) Dt. {{nowdate($data->instrument_date,'d-M-Y')}} @endif</td>
                        <td></td>
                        <td class="text-right">{{numberformat($data->paid_amount,2)}}</td>
                        <td class="text-right">{{numberformat($totalbal,2)}}</td>
                    </tr>
                @endforeach

            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <td rowspan="2" colspan="3"></td>
                <td><b>Total</b></td>
                <td class="text-right"><b>{{numberformat($totalfeesum,2)}}</b></td>
                <td class="text-right"><b>{{numberformat($totalpaid,2)}}</b></td>
                <td rowspan="2"></td>
            </tr>
            <tr>
                <td colspan="2"><b>Balance as on {{nowdate($feemonthdate,'d-m-Y')}}</b></td>
                <td class="text-right"><b>{{numberformat($totalbal,2)}}</b></td>
            </tr>
            </tfoot>
        </table>
    @endif
</div>

<script src="{{url('/assets/lib/print/jquery.printPage.js')}}"></script>

<script>
    $(function(){
        $(".btnPrint").printPage();
    });
</script>
