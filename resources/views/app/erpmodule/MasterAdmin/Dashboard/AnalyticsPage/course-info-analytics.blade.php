<div class="card mg-b-10  mg-r-10">
    <div class="card-header pd-t-20 d-sm-flex align-items-start justify-content-between bd-b-0 pd-b-0">
        <div>
            <h6 class="mg-b-5"><b>Course & Section or Gender Details</b></h6>
            <p class="tx-12 tx-color-03 mg-b-0">Course,Section,Gender Details Current Academic Session</p>
        </div>
    </div><!-- card-header -->
    <div class="card-body pd-y-20">
        <div class="d-sm-flex">

            <div class="media">
                <div class="wd-40 wd-md-40 ht-40 ht-md-40 bg-teal tx-white mg-r-10 mg-md-r-10 d-flex align-items-center justify-content-center rounded-circle op-8">
                    <i class="fa  fa-male fa-2x"></i>
                </div>
                <div class="media-body">
                    <h6 class="tx-sans tx-uppercase tx-11 tx-spacing-1 tx-color-03 tx-semibold mg-b-5 mg-md-b-8">
                        Male</h6>
                    <h4 class="tx-14 tx-sm-14 tx-md-14 tx-normal tx-rubik mg-b-0">@if(isset($studentgendermale)){{$studentgendermale->sum('student_sum0')}}@else {{"0"}} @endif</h4>
                </div>
            </div>

            <div class="media mg-t-20 mg-sm-t-0 mg-sm-l-10 mg-md-l-20">
                <div class="wd-40 wd-md-40 ht-40 ht-md-40 bg-pink tx-white mg-r-10 mg-md-r-10 d-flex align-items-center justify-content-center rounded-circle op-8">
                    <i class="fa  fa-female fa-2x"></i>
                </div>
                <div class="media-body">
                    <h6 class="tx-sans tx-uppercase tx-11 tx-spacing-1 tx-color-03 tx-semibold mg-b-5 mg-md-b-8">
                        Female</h6>
                    <h4 class="tx-14 tx-sm-14 tx-md-14 tx-normal tx-rubik mg-b-0">@if(isset($studentgenderfemale)){{$studentgenderfemale->sum('student_sum0')}}@else {{"0"}} @endif</h4>
                </div>
            </div>

            <div class="media mg-t-20 mg-sm-t-0 mg-sm-l-10 mg-md-l-20">
                <div class="wd-40 wd-md-40 ht-40 ht-md-40 bg-success tx-white mg-r-10 mg-md-r-10 d-flex align-items-center justify-content-center rounded-circle op-8">
                    <i class="fa  fa-check fa-2x"></i>
                </div>
                <div class="media-body">
                    <h6 class="tx-sans tx-uppercase tx-11 tx-spacing-1 tx-color-03 tx-semibold mg-b-5 mg-md-b-8">
                        Total Student</h6>
                    <h4 class="tx-14 tx-sm-14 tx-md-14 tx-normal tx-rubik mg-b-0">@if(isset($studentstrength)){{$studentstrength}}@else {{"0"}} @endif</h4>
                </div>
            </div>

            <div class="media mg-t-20 mg-sm-t-0 mg-sm-l-10 mg-md-l-20">
                <div class="wd-40 wd-md-40 ht-40 ht-md-40 bg-danger tx-white mg-r-10 mg-md-r-10 d-flex align-items-center justify-content-center rounded-circle op-8">
                    <i class="fa fa-times fa-2x"></i>
                </div>
                <div class="media-body">
                    <h6 class="tx-sans tx-uppercase tx-11 tx-spacing-1 tx-color-03 tx-semibold mg-b-5 mg-md-b-8">
                        Deactive Student</h6>
                    <h4 class="tx-14 tx-sm-14 tx-md-14 tx-normal tx-rubik mg-b-0">@if(isset($studentinactivestrength)) {{$studentinactivestrength}} @else {{"0"}} @endif</h4>
                </div>
            </div>

        </div>
    </div><!-- card-body -->
    <div class="table-responsive pd-10">
        <table class="table table-bordered table-dashboard ">
            <thead class="bg-light">
            <tr>
                <th>Course</th>
                @php $sectionstrength=['sumtotal'=>0]; @endphp
                @foreach($section as $data1)

                    @php $sectionstrength['sum_'.$data1->id]=0; @endphp

                    <th class="text-center">{{$data1->section->section}}</th>
                @endforeach
                <th class="text-center"><b>Total Strength</b></th>
            </tr>
            </thead>
            <tbody>
            @foreach($coursesection as $data)
                <tr>
                    <td class="tx-normal"><b>{{$data->course}}</b></td>
                    @php $totalstrength=0; @endphp
                    @foreach($section as $data1)
                        @php
                         $studentdata=dbtablesum(\App\Models\MasterAdmin\Admission\StudentRecord::class,['dbrow'=>'count(id) as totalstrength','search'=>['course_id'=>$data->id,'section_id'=>$data1->section->id,'status'=>'active']]);

                        if(isset($studentdata->totalstrength)){
                            $totalstrength +=$studentdata->totalstrength;
                            $sectionstrength['sum_'.$data1->id] +=$studentdata->totalstrength;
                            $sectionstrength['sumtotal'] +=$studentdata->totalstrength;
                        }
                        @endphp
                        <td class="tx-center  text-center">@if($studentdata->totalstrength && $totalstrength>0) {{$studentdata->totalstrength}} @else {{"--"}} @endif</td>
                    @endforeach
                    <td class="tx-center wd-15p bg-success-light text-center">{{$totalstrength}}</td>
                </tr>
            @endforeach
            </tbody>
            <tfoot class="bg-light">
            <tr>
                <td class="text-right"><b>Total Strength :</b></td>
                @foreach($section as $data1)
                    <td class="text-center">@if(isset($sectionstrength['sum_'.$data1->id])) {{$sectionstrength['sum_'.$data1->id]}} @else {{"0"}} @endif</td>
                @endforeach
                <td class="tx-center wd-15p bg-success-light text-center">@if(isset($sectionstrength['sumtotal'])) {{$sectionstrength['sumtotal']}} @else {{"0"}} @endif</td>
            </tr>
            </tfoot>
        </table>
    </div><!-- table-responsive -->
</div><!-- card -->


