@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="{{url('/home')}}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Global Setting</li>
            <li class="breadcrumb-item active" aria-current="page">All Form No. Auto Increment Configuration</li>
        </ol>
    </nav>
    <form action="{{url('MasterAdmin/GlobalSetting/CreateFormAutoIncrementConfiguration')}}" method="POST" enctype="multipart/form-data">
   {{csrf_field()}}
    <div class="col-lg-12 p-0 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-cog"></i> Form No. Auto Increment Configuration</b></div>
            <div class="panel-body pd-b-0 row">
                <div class="col-lg-12">

                    <table class="table table-bordered mg-t-15">
                        <thead class="bg-light">
                        <tr>
                            <th class="text-center"><input type="checkbox" class="CheckAll" value="checkbox1"></th>
                            <th><b>Form Name</b></th>
                            <th class="text-center"><b>Should Be</b></th>
                            <th class="text-center"><b>Prefix & Suffix Support Date</b></th>
                            <th class="text-center"><b>Prefix</b></th>
                            <th class="text-center"><b>Prefix With Date</b></th>
                            <th class="text-center"><b>Start No.</b></th>
                            <th class="text-center"><b>Suffix</b></th>
                            <th class="text-center"><b>Suffix With Date</b></th>
                            <th class="text-center"><b>Status</b></th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($formname as $key=>$value)
                        @php
                        if(isset($formnoauto)){
                        $formnodata=$formnoauto->where('key_id',$key)->first();
                        }
                        @endphp
                        <tr>
                            <td><input type="checkbox" class="checkbox1" name="key_id[]" @if(isset($formnodata->key_id)&&($formnodata->key_id==$key)) checked @endif value="{{$key}}"></td>
                            <td>{{$value}}</td>
                            <td>
                                <table class="mx-auto table-borderless">
                                    <tr>
                                        <td><input type="radio" name="should_be_{{$key}}" value="auto"  @if(isset($formnodata->should_be)&&($formnodata->should_be=="auto")) checked @endif @if(!isset($formnodata->should_be)) checked @endif></td><td>Automatic</td>
                                        <td><input type="radio" name="should_be_{{$key}}" value="manuel"  @if(isset($formnodata->should_be)&&($formnodata->should_be=="manuel")) checked @endif ></td><td>Manuel</td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table class="mx-auto table-borderless">
                                    <tr>
                                        <td><input type="radio" name="p_s_support_date_{{$key}}" value="yes" @if(isset($formnodata->p_s_support_date)&&($formnodata->p_s_support_date=="yes")) checked @endif @if(!isset($formnodata->p_s_support_date)) checked @endif></td><td>Yes</td>
                                        <td><input type="radio" name="p_s_support_date_{{$key}}" value="no" @if(isset($formnodata->p_s_support_date)&&($formnodata->p_s_support_date=="no")) checked @endif></td><td>No</td>
                                    </tr>
                                </table>
                            </td>
                            <td><input type="text" placeholder="Enter Prefix" autocomplete="off" @if(isset($formnodata->prefix)) value="{{$formnodata->prefix}}" @endif name="prefix_{{$key}}" class="form-control input-sm"></td>
                            <td><input type="text" placeholder="Enter like dMY" @if(isset($formnodata->prefix_date)) value="{{$formnodata->prefix_date}}" @endif name="prefix_with_date_{{$key}}" autocomplete="off" class="form-control input-sm"></td>
                            <td><input type="text" placeholder="Enter Start No." autocomplete="off" @if(isset($formnodata->start_from)) value="{{$formnodata->start_from}}" @endif name="start_no_{{$key}}" class="form-control input-sm"></td>
                            <td><input type="text" placeholder="Enter Suffix" autocomplete="off" @if(isset($formnodata->suffix)) value="{{$formnodata->suffix}}" @endif name="suffix_{{$key}}" class="form-control input-sm"></td>
                            <td><input type="text" placeholder="Enter like dMY" @if(isset($formnodata->suffix_date)) value="{{$formnodata->suffix_date}}" @endif name="suffix_with_date_{{$key}}" autocomplete="off" class="form-control input-sm"></td>
                            <td>
                                <table class="mx-auto table-borderless">
                                    <tr>
                                        <td><input type="radio" name="status_{{$key}}" value="yes" @if(isset($formnodata->status)&&($formnodata->status=="yes")) checked @endif @if(!isset($formnodata->status)) checked @endif></td><td>Active</td>
                                        <td><input type="radio" name="status_{{$key}}" value="no" @if(isset($formnodata->status)&&($formnodata->status=="no")) checked @endif></td><td>Inactive</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                         @endforeach
                        </tbody>

                    </table>

                </div>

                <div class="col-lg-12 pd-b-15 text-left">
                    <button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-edit"></i> Update</button>
                </div>
            </div>
        </div>
    </div>
    </form>
@endsection
