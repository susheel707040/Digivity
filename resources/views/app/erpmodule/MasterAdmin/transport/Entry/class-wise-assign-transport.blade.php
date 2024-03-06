@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="{{url('/home')}}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{url('/MasterAdmin/Transport/index')}}">Transport</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Student Assign Transport</li>
        </ol>
    </nav>

    <form action="{{url('MasterAdmin/Transport/CourseWiseAssignTransport')}}" method="POST" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="col-lg-12 p-0 m-0">
            <div class="panel panel-default">
                <div class="panel-heading"><b><i class="fa fa-search"></i> Search Student for Assign Transport</b></div>
                <div class="panel-body tx-12 pd-b-15 row">
                    <div class="col-lg-2">
                        <label><b>Course :</b></label>
                        @include('components.course-import',['selectid'=>request()->get('course_id')])
                    </div>

                    <div class="col-lg-1 p-0">
                        <label><b>Section :</b></label>
                        @include('components.section-import',['selectid'=>request()->get('section_id')])
                    </div>

                    <div class="col-lg-2">
                        <label><b>Transport Joining Date :</b></label>
                        <input type="text" name="joining_date" value="{{nowdate(request()->get('joining_date'),'d-m-Y')}}" autocomplete="off" placeholder="dd-mm-yy"
                               class="form-control1 input-sm date">
                    </div>
                    <div class="col-lg-2 pd-l-0">
                        <label><b>Student Address :</b></label>
                        <input type="text" autocomplete="off" name="residence_address" placeholder="Enter Address"
                              value="{{request()->get('residence_address')}}" class="form-control1 input-sm">
                    </div>
                    <div class="col-lg-3 pd-l-0">
                        <label>Import File <span class="text-gray">(Optional)</span> :</label>
                        <input type="file" name="import_file" class="form-control1">
                    </div>
                    <div class="col-lg-2 mg-t-20">
                        <button type="submit" class="btn styleButton btn-primary btn-sm"> Continue <i class="fa fa-angle-right"></i></button>
                    </div>
                    <div class="col-lg-12 pd-t-10">
                        <a href="{{asset('ImportFileFormat/StudentImportTransport.xlsx')}}" loader-disable="true" download="" target="_blank" class="text-danger"><b><u><i class="fa fa-file-excel"></i> Download Student Assign Transport File Format</u></b></a>
                    </div>
                </div>
            </div>
        </div>
    </form>

    @if(request()->get('_token'))
    <form action="{{url('MasterAdmin/Transport/CreateCourseWiseAssignTransport')}}" method="POST" enctype="multipart/form-data">
        {{csrf_field()}}
    <div class="col-lg-12 p-0 m-0">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-plus"></i> Assign Student Bulk Transport</b></div>
            <div class="panel-body pd-b-15 p-0 m-0 row">
                <div class="col-lg-10 pd-l-0 pd-r-20  m-0">
                    <table class="table table-bordered tx-12 mg-10">
                        <thead class="bg-light">
                        <tr>
                            <th class="text-center"><input type="checkbox" class="CheckAll" value="checkbox1"></th>
                            <th class="text-center">Adm. No.</th>
                            <th>Class - Section</th>
                            <th>Student Name</th>
                            <th>Father Name</th>
                            <th>Mobile No.</th>
                            <th>Address</th>
                            <th>Transport Route</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($student as $data)
                            @php
                            if(isset($importdata)&&($importdata)){
                             try{
                              $studentimport=$importdata->where('admission_no',$data->admission_no)->first();
                             }catch (\Exception $e){
                                 $studentimport=[];
                             }
                             }
                             //dd($studentimport);
                            @endphp
                            <tr @if($data->transport_id) class="bg-success-light" @endif>
                                <td class="text-center">@if(!$data->transport_id)
                                <input type="checkbox" name="studentid[]" class="checkbox1" value="{{$data->id}}" @if(isset($studentimport['admission_no'])&&($studentimport['admission_no']==$data->admission_no)) checked @endif>@endif
                                <input type="hidden" name="transport_start_date_{{$data->id}}" @if(!isset($studentimport['transport_start_date'])) value="{{nowdate(request()->get('joining_date'),'Y-m-d')}}" @endif @if(isset($studentimport['transport_start_date'])) value="{{\App\Helper\DateFormat::UnixDate($studentimport['transport_start_date'])}}" @endif >
                                </td>
                                <td class="text-center">{{$data->admission_no}}</td>
                                <td>{{$data->CourseSection()}}</td>
                                <td>{{$data->fullName()}}</td>
                                <td>{{$data->FatherName()}}</td>
                                <td>{{$data->student->contact_no}}</td>
                                <td>{{$data->Address()}}</td>
                                <td>
                                    <table cellpadding="0" cellspacing="0" class="table-borderless p-0 m-0">
                                        <tr>
                                            <td>
                                                <select name="route_{{$data->id}}_id" class="form-control1 select-search wd-250 input-sm" @if($data->transport_id) disabled @endif>
                                                    <option value="">---Select---</option>
                                                    @foreach(routerelationlist() as $data1)
                                                        <option value="{{$data1->id}}" @if((!isset($studentimport['admission_no']))&&$data->transport_id==$data1->id) selected @endif @if(isset($studentimport['admission_no'])&&(strtolower($studentimport['route'])==strtolower($data1->route->route))&&(strtolower($studentimport['route_stop'])==strtolower($data1->routestop->route_stop))) selected @endif>{{$data1->route->route}} - {{$data1->routestop->route_stop}} - {{$data1->vehicle->registration_no}} ({{$data1->vehicle->vehicle_name}})</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            @if($data->transport_id)
                                            <td>
                                                <a href="{{url('MasterAdmin/Transport/StudentRouteRemove/'.$data->id.'/remove')}}">
                                                <button type="button" class="btn btn-danger btn-sm" style="width: 50px"><i class="fa fa-trash"></i></button></a>
                                            </td>
                                            @endif
                                        </tr>
                                    </table>
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-lg-2 vhr text-center">
                    <button type="submit" class="btn btn-primary mg-t-10 btn-block btn-lg"><i class="fa fa-plus"></i> Bulk Assign</button>
                    <button class="btn btn-white btn-lg btn-block mg-t-20"><i class="fa fa-times"></i> Close</button>
                </div>
            </div>
        </div>
    </div>
    </form>
    @endif
@endsection
