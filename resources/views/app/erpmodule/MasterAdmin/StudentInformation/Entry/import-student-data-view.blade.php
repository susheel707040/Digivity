@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="{{url('/home')}}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Student Information</li>
            <li class="breadcrumb-item active" aria-current="page">Import Student Data Preview</li>
        </ol>
    </nav>

    <form action="{{ url('MasterAdmin/StudentInformation/ImportStudentCreate') }}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="col-lg-12 p-0 m-0">
            <div class="panel panel-default">
                <div class="panel-heading"><b><i class="fa fa-file-import"></i> Import Student Data Preview Data</b></div>
                <div class="panel-body pd-b-0 row">
                    <table class="table table-bordered bd b-1 mg-10">
                        <thead class="bg-light">
                        <tr>
                            @foreach($tablehead as $key=>$value)
                                @if($value!="")
                                    <th>{{ucwords(\Illuminate\Support\Str::replaceArray('_', [' ',' ',' ',' '], $value))}}
                                        <input type="hidden" name="column_id[]" value="{{$value}}">
                                    </th>
                                @endif
                            @endforeach
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($importdata as $key=>$data)
                            @if($key!=0)
                                @if(isset($data))
                                    @php
                                        $slno=$loop->iteration;
                                    @endphp

                                    <tr>
                                        <input type="hidden" name="slno[]" value="{{$slno}}">
                                        @foreach($data as $key1=>$value)
                                            @if(isset($tablehead[$key1])&&($tablehead[$key1]!=null))
                                                <td>
                                                    @if($tablehead[$key1]=="course_id")
                                                        <select name="input_{{$slno}}_id[{{$tablehead[$key1]}}]" required="" id="course_id"
                                                                class="form-control1 input-sm" >
                                                            <option value="">---Select---</option>
                                                            @foreach(courselist() as $data)
                                                                <option value="{{$data->id}}"
                                                                        @if(isset($value)&&($value==$data->course)) selected @endif>{{$data->course}}</option>
                                                            @endforeach
                                                        </select>
                                                    @elseif($tablehead[$key1]=="section_id")
                                                        <select class="form-control1 input-sm" name="input_{{$slno}}_id[{{$tablehead[$key1]}}]" required="">
                                                            <option value="">---Select---</option>
                                                            @foreach(sectionlist([]) as $data)
                                                                <option value="{{$data->section->id}}"
                                                                        @if(isset($value)&&($value==$data->section->section)) selected @endif>{{$data->section->section}}</option>
                                                            @endforeach
                                                        </select>
                                                    @elseif($tablehead[$key1]=="gender")
                                                        <select id="gender" name="input_{{$slno}}_id[{{$tablehead[$key1]}}]" class="form-control1 wd-70 input-sm">
                                                            <option value="">---Select---</option>
                                                            @foreach($genderlist as $data)
                                                                <option value="{{$data}}"
                                                                        @if(isset($value)&&(strtolower($value)==strtolower($data))) selected @endif>{{ucfirst($data)}}</option>
                                                            @endforeach
                                                        </select>
                                                    @elseif($tablehead[$key1]=="blood_group")
                                                        <select id="blood_group" name="input_{{$slno}}_id[{{$tablehead[$key1]}}]" class="form-control1 input-sm">
                                                            <option value="">---Select---</option>
                                                            @foreach($bloodgroup as $data)
                                                                <option value="{{$data}}"
                                                                        @if(isset($value)&&($value==$data)) selected @endif>{{$data}}</option>
                                                            @endforeach
                                                        </select>
                                                    @elseif($tablehead[$key1]=="religion")
                                                        <select id="religion" name="input_{{$slno}}_id[{{$tablehead[$key1]}}]" class="form-control1 input-sm">
                                                            <option value="">---Select---</option>
                                                            @foreach(religionselectlist() as $data)
                                                                <option value="{{$data->id}}" @if(strtolower($value)==strtolower($data->religion)) selected @endif>{{$data->religion}}</option>
                                                            @endforeach
                                                        </select>
                                                    @elseif($tablehead[$key1]=="nationality")
                                                        <select id="nationality" name="input_{{$slno}}_id[{{$tablehead[$key1]}}]" class="form-control1 input-sm">
                                                            <option value="">---Select---</option>
                                                            @foreach(nationalitylist() as $data)
                                                                <option value="{{$data->id}}" @if(strtolower($value)==strtolower($data->nationality)) selected @endif>{{$data->nationality}}</option>
                                                            @endforeach
                                                        </select>
                                                    @elseif($tablehead[$key1]=="category_id")
                                                        <select id="category_id" name="input_{{$slno}}_id[{{$tablehead[$key1]}}]" class="form-control1 input-sm">
                                                            <option value="">---Select---</option>
                                                            @foreach(categoryselectlist() as $data)
                                                                <option value="{{$data->id}}" @if(strtolower($value)==strtolower($data->category)) selected @endif>{{$data->category}}</option>
                                                            @endforeach
                                                        </select>
                                                    @elseif($tablehead[$key1]=="caste")
                                                        <select id="caste" name="input_{{$slno}}_id[{{$tablehead[$key1]}}]" class="form-control1 input-sm">
                                                            <option value="">---Select---</option>
                                                            @foreach(casteselectlist() as $data)
                                                                <option value="{{$data->id}}" @if(strtolower($value)==strtolower($data->caste)) selected @endif>{{$data->caste}}</option>
                                                            @endforeach
                                                        </select>
                                                    @elseif($tablehead[$key1]=="parent_status")
                                                        <select name="input_{{$slno}}_id[{{$tablehead[$key1]}}]" class="form-control1 input-sm">
                                                            <option value="">---Select---</option>
                                                        </select>
                                                    @else
                                                        <input type="text" @if($tablehead[$key1]=="contact_no") required @endif autocomplete="off" name="input_{{$slno}}_id[{{$tablehead[$key1]}}]"
                                                               value="{{$value}}" class="form-control1 wd-70">
                                                    @endif

                                                </td>
                                            @endif
                                        @endforeach

                                    </tr>
                                @endif
                            @endif

                        @endforeach

                        </tbody>
                    </table>
                    <div class="col-lg-12 mg-b-10">
                        <button class="btn btn-lg btn-primary wd-200"><i class="fa fa-check"></i> Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
