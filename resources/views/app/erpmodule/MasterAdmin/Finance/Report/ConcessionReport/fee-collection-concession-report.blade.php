@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">Finance/Account</li>
            <li class="breadcrumb-item" aria-current="page">Reports</li>
            <li class="breadcrumb-item active" aria-current="page">Fee Collection Concession/Discount Report</li>
        </ol>
    </nav>


    <div class="col-lg-12 p-0 m-0 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i> Fee Collection Concession/Discount Report</b></div>
            <div class="panel-body pd-b-10 row">
                <form action="{{url('MasterAdmin/Finance/FeeCollectionConcessionReport')}}" method="POST">
                    {{csrf_field()}}
                    <div class="col-lg-12 row pd-b-10">
                        <div class="col-lg-1 pd-l-5 pd-r-5">
                            <label><b>Receipt No. :</b></label>
                            <input type="text" autocomplete="off" name="receipt_id" value="{{request()->get('receipt_id')}}" placeholder="Receipt No." class="form-control1">
                        </div>
                        <div class="col-lg-2 pd-l-5 pd-r-5">
                            <label><b>Receipt From Date :</b></label>
                            <input type="text" autocomplete="off" name="from_date" value="{{request()->get('from_date')}}" placeholder="dd-mm-yyy" class="form-control1 date">
                        </div>
                        <div class="col-lg-2 pd-l-5 pd-r-5">
                            <label><b>Receipt To Date :</b></label>
                            <input type="text" autocomplete="off" name="to_date" value="{{request()->get('to_date')}}" placeholder="dd-mm-yyyy" class="form-control1 date">
                        </div>
                        <div class="col-lg-2 pd-l-5 pd-r-5">
                            <label><b>Class/Course :</b></label>
                            @include('components.course-import',['selectid'=>request()->get('course_id')])
                        </div>
                        <div class="col-lg-2 pd-l-5 pd-r-5">
                            <label><b>Paymode :</b></label>
                            @include('components.Finance.paymode-import',['selectid'=>request()->get('paymode_id')])
                        </div>
                        <div class="col-lg-1 pd-l-0 pd-r-0">
                            <label><b>Receipt Status :</b></label>
                            @include('components.Finance.receipt-status-import',['selectid'=>request()->get('receipt_status') ? request()->get('receipt_status') : 'paid'])
                        </div>
                        <div class="col-lg-2">
                            <button type="submit" class="btn btn-primary mg-t-20"><i class="fa fa-search"></i> Get Result</button>
                        </div>
                    </div>
                </form>

                <div class="col-lg-12 bd-1 bd-t m-0 pd-l-5 pd-r-5 mg-t-10 row">
                    <div class="col-lg-12 p-0 m-0 text-right">@include('layouts.actionbutton.action-button-verticle')</div>
                    <div class="col-lg-12 p-0 m-0">
                        <table id="example2" datasum="true" colsum="8,9" class="table datatable table-bordered mg-t-10">
                            <thead class="bg-light">
                            <tr>
                                <th class="text-center">Sl.No.</th>
                                <th>Adm. No.</th>
                                <th>Class/Course</th>
                                <th>Student Name</th>
                                <th>Father Name</th>
                                <th>Receipt No.</th>
                                <th class="text-center">Receipt Date</th>
                                <th class="text-center">Paymode</th>
                                <th class="text-right">Fine Concession Amount</th>
                                <th class="text-right">Fee Concession Amount</th>
                                <th class="text-center">Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($feecollection as $data)
                                <tr>
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td>{{$data->AdmissionNo()}}</td>
                                    <td>{{$data->CourseSection()}}</td>
                                    <td>{{$data->fullName()}}</td>
                                    <td>{{$data->FatherName()}}</td>
                                    <td>{{$data->receipt_id}}</td>
                                    <td class="text-center">{{nowdate($data->receipt_date,'d-M-Y')}}</td>
                                    <td class="text-center">{{$data->PaymodeName()}}</td>
                                    <td class="text-right">{{$data->fine_concession}}</td>
                                    <td class="text-right">{{$data->concession_total}}</td>
                                    <td class="text-center">@if($data->receipt_status=="paid")<span class="badge badge-success">{{ucfirst($data->receipt_status)}}</span>@elseif($data->receipt_status=="unpaid") <span class="badge badge-warning">{{ucfirst($data->receipt_status)}}</span>@elseif($data->receipt_status=="cancel") <span class="badge badge-danger">{{ucfirst($data->receipt_status)}}</span> @endif</td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr class="bg-light">
                                <td colspan="8" class="text-right"><b>Total :</b></td>
                                <td class="text-right tx-bold">0.00</td>
                                <td class="text-right tx-bold">0.00</td>
                                <td></td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>


@endsection
