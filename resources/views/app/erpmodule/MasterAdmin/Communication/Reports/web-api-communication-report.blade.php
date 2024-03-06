@extends('layouts.master-layout-without-header-footer')
@section('content')
    @if(isset($communicationreport))
    <div class="content content-fixed mg-t-10 pd-t-0">
        <div class="container-fluid">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item " aria-current="page">Communication</li>
                    <li class="breadcrumb-item " aria-current="page">Reports</li>
                    <li class="breadcrumb-item active" aria-current="page">Api Fail Communication Report</li>
                </ol>
            </nav>
            <form action="" method="POST">
            <div class="col-lg-12 p-0 m-0 tx-12">
                <div class="panel panel-default">
                    <div class="panel-heading"><b><i class="fa fa-list"></i> Communication Fail SMS Report</b></div>
                    <div class="panel-body pd-b-0 row">
                        <table class="table table-bordered mg-t-10">
                            <thead>
                            <tr>
                                <th colspan="4" class="text-primary tx-15">Communication Token Id : {{$communicationreport[0]->communication_token_id}}</th>
                                <th colspan="3" class="valign-middle text-danger tx-15">Total SMS Count : {{$communicationreport->sum('sms_balance')}}</th>
                                <th colspan="4" class="text-center">
                                    <button type="button" data-reason="{{request()->get('reason')}}" class="btn all-resend-sms btn-primary tx-14"><i class="fa fa-envelope"></i> Resend all SMS</button>
                                </th>
                            </tr>
                            </thead>
                            <thead class="bg-light">
                            <tr>
                                <th class="text-center">Sl.No.</th>
                                <th class="text-center"><input type="checkbox" class="CheckAll" value="checkbox1"></th>
                                <th>Contact No.</th>
                                <th>Message</th>
                                <th>Schedule Datetime</th>
                                <th>Type</th>
                                <th>Message Count</th>
                                <th>Created at</th>
                                <th>Updated at</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($communicationreport as $data)
                            <tr>
                                <td class="text-center">{{$loop->iteration}}</td>
                                <td class="text-center">@if($data->delivery_status=="no")<input type="checkbox" name="communication_id[]" value="{{$data->id}}" class="checkbox1 communication_id">@endif</td>
                                <td>{{$data->contact_no}}</td>
                                <td class="wd-30p tx-10">@if(isset($data->text_message))
                                        <input type="hidden" name="communication_message_{{$data->id}}_id" value="{!! nl2br($data->text_message) !!}">
                                        {!! nl2br($data->text_message) !!} @endif</td>
                                <td>N/A</td>
                                <td>@if((isset($data->unicode))&&($data->unicode=="GSM_7BIT")) <span class="badge badge-success">{{"English"}}</span> @else <span class="badge badge-warning">{{"Unicode"}}</span> @endif</td>
                                <td><b>{{$data->sms_balance}}</b></td>
                                <td>{{$data->created_at}}</td>
                                <td>{{$data->updated_at}}</td>
                                <td class=" text-center">
                                    @if($data->delivery_status=="yes")<span class="badge badge-success tx-11 pd-5">Delivered</span><br/>@endif
                                    @if($data->delivery_status=="no")<span class="badge badge-danger tx-11 pd-5">Awaiting</span><br/>@endif
                                </td>
                                <td class="text-center">
                                    @if($data->delivery_status=="no")
                                    <button type="button" id="btn-{{$data->id}}" data-communication_id="{{$data->id}}" data-reason="{{request()->get('reason')}}" class="btn single-resend-sms btn-primary"><i class="fa fa-envelope"></i> Resend</button>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            </form>

        </div>
    </div>

        <script type="text/javascript">
            $(".single-resend-sms").click(function (){
                loader('block');
                var communicationid=$(this).data('communication_id');
                $("#btn-"+communicationid).hide();
                var json={communicationid:$(this).data('communication_id'),reason:$(this).data('reason')};
                var result=formrequest('','/MasterAdmin/Communication/SMSFailureResend','POST',json)
                var result = $.parseJSON(result);
                Alert(result);
                if(result['result']==0){
                    $("#btn-"+communicationid).show();
                }
            });
            var i=0;
            $(".all-resend-sms").click(function (){

                var communicationids = [];
                $('.communication_id:checked').each(function () {
                    communicationids[i++] = $(this).val();
                });
                if(communicationids==0){
                    swal("Opps!", "To send a message, it is necessary to select atleast one reciever!", "error");
                    return  false;
                }else{
                    loader('block');
                    var json={communicationid:communicationids,reason:$(this).data('reason')};
                    var result=formrequest('','/MasterAdmin/Communication/SMSFailureResend','POST',json)
                    var result = $.parseJSON(result);
                    Alert(result);
                }
            });
        </script>
    @endif
@endsection
