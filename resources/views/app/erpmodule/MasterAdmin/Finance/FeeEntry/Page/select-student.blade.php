<div class="card">
    <div class="card-header bg-gray-100"><b><i class="fa fa-user-graduate"></i> Search and Select Student</b>
        <table class="float-right text-danger"><tr><td><input type="checkbox" class="take_siblings" value="enable"></td><td class="pd-l-5"><b>Take Siblings Fee</b></td></tr></table>
    </div>
    <div class="card-body pd-l-10 pd-r-10 pd-b-5 pd-t-0 pd-b-0 m-0 flex-fill">
        <div class="row p-0 m-0">
            <div class="col-6 p-0 m-0">
                <label><b>Course :</b></label>
                @include('components.course-import',['class'=>'form-control1 input-sm','id'=>'course_id','name'=>'course_id','required'=>'','selectid'=>0,'other'=>0])
            </div>
            <div class="col-6 pd-l-10 pd-r-0 m-0">
                <label><b>Section :</b></label>
                @include('components.section-import')
            </div>
            <div class="col-12 p-0 m-0">
                <label><b>Student <sup>*</sup> :</b></label>
                @include('components.student-list-import')
            </div>
            <div class="col-4 p-0 m-0">
                <label><b>A/C Ledger No. :</b></label>
                <input type="text" id="ac_ledger_no" placeholder="Enter Ledger No." autocomplete="off" class="form-control input-sm">
            </div>
            <div class="col-5 pd-l-10 pd-r-0 m-0">
                <label><b>Admission No. :</b></label>
                <input type="text" id="admission_no" placeholder="Enter Admission No." autocomplete="off" class="form-control input-sm">
            </div>
            <div class="col-3 pd-l-5 pd-r-0 m-0">
                <button type="button" id="student-search" class="btn btn-primary btn-xs mg-t-25 rounded-5"><i class="fa fa-search"></i> Search</button>
            </div>
            <span class="alert-msg text-danger"></span>
            <div class="col-lg-12 p-0 m-0"><a class="text-primary"><b><u><i class="fa fa-search pd-r-1"></i> Advance Search</u></b></a></div>
        </div>
    </div>
</div>

<div class="card mg-t-5">
    <div class="card-header bg-gray-100"><b><i class="fa fa-rupee-sign"></i> Fee Information</b>
        <table class="float-right text-danger"><tr><td><input id="complete_fee" todaydate="{{\Illuminate\Support\Carbon::now()->format('d-m-Y')}}" type="checkbox" value="{{date('d-m-Y',strtotime(auth()->user()->financialyear->end_date))}}" @if(request()->route('feeuptodate')==date('d-m-Y',strtotime(auth()->user()->financialyear->end_date))) checked @endif></td><td class="pd-l-5"><b><u>Full Year Fee Estimate</u></b></td></tr></table>
    </div>
    <div class="card-body pd-l-10 pd-r-10 pd-b-5 pd-t-0 pd-b-0 m-0 flex-fill">
        <div class="row p-0 m-0">
            <div class="col-6 pd-l-0 pd-r-0  m-0">
                <label><b>Choose Fee :</b></label>
                <select id="select_pay_fee" class="form-control input-sm">
                    <option value="0">---Select---</option>
                    @foreach(feeheadlist([]) as $data)
                        <option value="{{$data->id}}">{{$data->fee_head}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-6 pd-l-10 pd-r-0  m-0">
                <label><b>Fee Pay Upto Month <sup>*</sup> :</b></label>
                <input type="text" id="fee_pay_upto_date" value="@if(request()->route('feeuptodate')){{request()->route('feeuptodate')}}@else{{nowdate('','d-m-Y')}}@endif" placeholder="dd-mm-yyyy" class="form-control bg-warning-light input-sm" >
            </div>
        </div>
    </div>
</div>
