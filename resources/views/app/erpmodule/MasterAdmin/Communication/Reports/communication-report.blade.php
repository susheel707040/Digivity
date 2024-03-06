@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item " aria-current="page">Communication</li>
            <li class="breadcrumb-item " aria-current="page">Reports</li>
            <li class="breadcrumb-item active" aria-current="page">Communication Report</li>
        </ol>
    </nav>

    <div class="col-lg-12 p-0 m-0 tx-12">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i> Communication Report</b></div>
            <div class="panel-body pd-b-0 row">
                <form action="{{url('MasterAdmin/Communication/SMSReport')}}" method="POST" class="container-fluid p-0 m-0">
                {{csrf_field()}}
                <div class="col-lg-12 pd-l-0 pd-r-0 pd-b-20 row m-0">
                    <div class="col-lg-2">
                       <label>Communication id :</label>
                       <input type="text" name="communication_token_id" placeholder="Enter Communication ID" value="{{request()->get('communication_token_id')}}" class="form-control input-sm">
                    </div>
                    <div class="col-lg-2">
                        <label>Communication Type :</label>
                        @include('components.Communication.communication-type-import',['selectid'=>request()->get('communication_type_id')])
                    </div>
                    <div class="col-lg-2">
                        <label><b>From Date :</b></label>
                        <input type="text" name="from_date" class="form-control date input-sm" value="{{nowdate(request()->get('from_date'),'d-m-Y')}}">
                    </div>
                    <div class="col-lg-2">
                        <label><b>To Date :</b></label>
                        <input type="text" name="to_date" class="form-control date input-sm" value="{{nowdate(request()->get('to_date'),'d-m-Y')}}">
                    </div>
                    <div class="col-lg-2">
                        <label>Contact No. :</label>
                        <input type="text" placeholder="Enter Contact No." name="contact_no" value="{{request()->get('contact_no')}}" class="form-control input-sm">
                    </div>
                    <div class="col-lg-2">
                        <button type="submit" class="btn btn-primary btn-sm mg-t-20"><i class="fa fa-search"></i> Search</button>
                    </div>
                </div>
                </form>

                <div class="col-lg-12 pd-l-0 pd-r-0 bd-t bd-1">
                    <div class="col-lg-12 text-right">
                    @include('layouts.actionbutton.action-button-verticle')
                    </div>
                    <table id="example2" datasum="true" colsum="2,8" class="table tx-11 datatable table-bordered mg-t-15">
                        <thead class="bg-light">
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Communication id</th>
                            <th class="text-center">Receiver</th>
                            <th>Campaign Name</th>
                            <th class="text-center">Date</th>
                            <th>Communication Type</th>
                            <th class="text-center">Unicode</th>
                            <th>Message</th>
                            <th class="text-center">Message Count</th>
                            <th class="text-center">Status</th>
                        </tr>
                        </thead>

                        <tbody>
                        @php $totalsms=0; $totalreceiver=0; @endphp
                        @foreach($communication as $communicationid=>$data)
                        @php
                        $communicationdata=collect($data);
                        $receiver=$communicationdata->count();
                        $smscount=$communicationdata->sum('sms_balance');
                        /*
                         * delivered and awating report
                         */
                        $delivered=$communicationdata->where('delivery_status','yes')->count();
                        $awating=$communicationdata->where('delivery_status','no')->count();

                        $totalsms +=$smscount;
                        $totalreceiver +=$receiver;
                        $singledata=$communicationdata->shift();
                        //dd();
                        @endphp
                        <tr>
                            <td class="text-center">{{$loop->iteration}}</td>
                            <td class="text-center"><a href="{{url('MasterAdmin/Communication/SMSReport/'.$communicationid.'/View')}}" loader-disable="true" target="_blank"><u><b class="tx-primary"><i class="fa fa-eye"></i>{{$communicationid}}</b></u></a></td>
                            <td class="text-center tx-14">@if(isset($receiver)){{$receiver}}@endif</td>
                            <td>@if(isset($singledata->campaign_name)) {{$singledata->campaign_name}} @else {{"N/A"}} @endif</td>
                            <td class="text-center">@if(isset($singledata->communication_date)) {{nowdate($singledata->communication_date,'d-F-Y')}} @endif</td>
                            <td>@if(isset($singledata->communicationtype->communication_type)) {{$singledata->communicationtype->communication_type}} @else {{"N/A"}} @endif</td>
                            <td class="text-center">@if((isset($singledata->unicode))&&($singledata->unicode=="GSM_7BIT")) <span class="badge badge-success">{{"English"}}</span> @else <span class="badge badge-warning">{{"Unicode"}}</span> @endif</td>
                            <td class="wd-25p tx-10">@if(isset($singledata->text_message)){!! nl2br($singledata->text_message) !!} @endif</td>
                            <td class="text-center tx-14 tx-bold">@if(isset($smscount)){{numberformat($smscount)}}@endif</td>
                            <td class=" text-center">
                               @if($delivered>0)<span class="badge badge-success tx-11 pd-5">Delivered</span><br/>@endif
                                @if($awating>0)<span class="badge badge-danger tx-11 mg-t-10">Awaiting ({{$awating}})</span>@endif
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                        <tfoot class="bg-light tx-12">
                        <tr>
                            <td colspan="2" class="text-right"><b>Total Receiver :</b></td>
                            <td class="text-center tx-bold">{{$totalreceiver}}</td>
                            <td colspan="5" class="text-right"><b>Total SMS</b></td>
                            <td class="text-center tx-bold tx-17">{{numberformat($totalsms)}}</td>
                            <td colspan="1"></td>
                        </tr>
                        </tfoot>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection
