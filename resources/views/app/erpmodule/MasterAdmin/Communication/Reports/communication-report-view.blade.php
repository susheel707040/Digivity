@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item " aria-current="page">Communication</li>
            <li class="breadcrumb-item " aria-current="page">Reports</li>
            <li class="breadcrumb-item active" aria-current="page">Communication Report View</li>
        </ol>
    </nav>

    <div class="col-lg-12 p-0 m-0 tx-12">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i> Communication Report View</b></div>
            <div class="panel-body pd-b-0 row m-0">
                <div class="col-lg-12 pd-l-0 text-right mg-10">
                    <table class="float-left">
                        <tr>
                            <td><a href="{{url('MasterAdmin/Communication/SMSReport')}}"><button type="button" class="btn btn-primary float-left"><i class="fa fa-arrow-left"></i> Back</button></a></td>
                            <td class="tx-13 pd-l-20"><b>Communication ID :</b> <span class="tx-primary">{{$communicationtokenid}}</span></td>
                            <td class="tx-13 pd-l-20"><b>Total SMS Deduct :</b> @if($communication->sum('sms_balance')){{numberformat($communication->sum('sms_balance'))}} @else {{"0"}} @endif </td>
                        </tr>
                    </table>

                    @include('layouts.actionbutton.action-button-verticle')</div>
                <div class="col-lg-12 p-0">
                <table id="example2" class="table dataTable table-bordered mg-t-10">
                    <thead class="bg-light">
                    <tr>
                        <th class="text-center">S.No.</th>
                        <th class="text-center"><input type="checkbox" class="Checkall" value="checkbox1"></th>
                        <th>Contact No.</th>
                        <th>Message</th>
                        <th class="text-center">Schedule Datetime</th>
                        <th class="text-center">Type</th>
                        <th class="text-center">Message Count</th>
                        <th class="text-center">Date</th>
                        <th class="text-center">Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($communication as $data)
                    <tr>
                        <td class="text-center">{{$loop->iteration}}</td>
                        <td class="text-center"><input type="checkbox" class="checkbox1"></td>
                        <td>{{$data->contact_no}} <i class="fa fa-check-circle tx-success"></i></td>
                        <td class="wd-30p tx-10">@if(isset($data->text_message)){!! nl2br($data->text_message) !!} @endif</td>
                        <td class="text-center">N/A</td>
                        <td class="text-center">@if((isset($data->unicode))&&($data->unicode=="GSM_7BIT")) <span class="badge badge-success">{{"English"}}</span> @else <span class="badge badge-warning">{{"Unicode"}}</span> @endif</td>
                        <td class="text-center"><b>{{$data->sms_balance}}</b></td>
                        <td class="text-center">{{nowdate($data->communication_date,'d-F-Y')}}</td>
                        <td class=" text-center">
                            @if($data->delivery_status=="yes")<span class="badge badge-success tx-11 pd-5">Delivered</span><br/>@endif
                            @if($data->delivery_status=="no")<span class="badge badge-danger tx-11 pd-5">Awaiting</span><br/>@endif
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>

@endsection
