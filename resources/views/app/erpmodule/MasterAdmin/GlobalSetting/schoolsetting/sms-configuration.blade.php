@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="{{url('/home')}}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Global Setting</li>
            <li class="breadcrumb-item active" aria-current="page">SMS Configuration</li>
        </ol>
    </nav>
    <form action="{{url('MasterAdmin/GlobalSetting/CreateSmsConfiguration')}}" method="POST">
        {{csrf_field()}}
    <div class="col-lg-6 p-0 m-0 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-cog"></i> SMS Configuration</b></div>
            <div class="panel-body pd-b-10 pd-t-10 row">
                <div class="col-lg-6">
                    @php
                    $vendor=['msg91'=>'MSG 91','nimbus'=>'Nimbus','msgkiri'=>'MSG KIRI','amazesms'=>'AMAZE SMS'];
                    @endphp
                    <label><b>Communication Vendor  <sup>*</sup> :</b></label>
                    <select name="vendor" class="form-control input-sm" required>
                        @foreach($vendor as $key=>$value)
                        <option value="{{$key}}" @if((isset($smsconfiguration->vendor))&&$smsconfiguration->vendor==$key) selected @endif>{{$value}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-6">
                    <label><b>Sender id <sup>*</sup> :</b></label>
                    <input type="text" value="@if(isset($smsconfiguration->sender_id)){{$smsconfiguration->sender_id}}@endif" name="sender_id" class="form-control input-sm" placeholder="Enter Sender id like: DPSDEL" required>
                </div>
                <div class="col-lg-12 pd-t-10">
                    <label><b>Communication Vendor Credentials <sup>*</sup> :</b></label>
                    <textarea name="credentials" class="form-control" style="height:250px;" placeholder="Enter credentials here" required>@if(isset($smsconfiguration->credentials)){{$smsconfiguration->credentials}}@endif</textarea>
                </div>
                <div class="col-6">
                    <span class="pd-t-15 tx-11 text-danger"><b>Credentials Example:</b><br/>
                        <span class="text-gray tx-13">
                        authkey=>gute76t23e283e273e9te923e9,<br/>username=>amit,<br/>password=>131314,<br/>userid=>1
                        </span>
                    </span>
                </div>
                <div class="col-6 pd-t-10">
                    <button type="submit" class="btn btn-primary float-right"><i class="fa fa-check"></i> Submit</button>
                </div>
            </div>
        </div>
    </div>
    </form>

@endsection
