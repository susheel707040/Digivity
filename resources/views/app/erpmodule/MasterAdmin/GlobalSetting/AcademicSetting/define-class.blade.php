@extends('layouts.MasterLayout')

@section('ModelTitle','Add New Class/Course')
@section('ModelTitleInfo','Manage Class/Course')
@section('EditModelTitle','Edit Class/Course')
@section('EditModelTitleInfo','Modify Class/Course')

@section('AddModelPage')
    @include('app.erpmodule.MasterAdmin.GlobalSetting.AcademicSetting.Add.add-course')
@endsection

@section('content')
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Global Setting</li>
                    <li class="breadcrumb-item active" aria-current="page">Class/Course</li>
                </ol>
            </nav>

            <div class="col-lg-12 mx-auto">
                <div class="panel panel-default">
                    <div class="panel-heading"><b><i class="fa fa-list"></i> Class/Course List</b></div>
                    <div class="panel-body pd-b-0 row">
                        <div class="col-lg-2">
                            @include('layouts.actionbutton.ActionButton')
                        </div>

                        <div class="col-lg-10 vhr">
                            <div data-label="Example" class="df-example demo-table">
                                <table id="example2" class="table datatable table-bordered">
                                    <thead>
                                    <tr>
                                        <th class="text-center">Sl.No.</th>
                                        <th>Wing</th>
                                        <th class="text-center">Sequence</th>
                                        <th>Class/Course</th>
                                        <th class="text-center">Code</th>
                                        <th class="text-center">Full Name</th>
                                        <th class="text-center">TC Full Name</th>
                                        <th class="text-center">Modify Date</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($course as $data)
                                        <tr editurl="{{url('MasterAdmin/GlobalSetting/EditViewClass/'.$data->id.'/edit')}}"
                                            deleteurl="{{url('/RecordDelete/'.$data->id.'/'.$data->getTable().'/delete')}}">
                                            <td class="text-center">{{$loop->iteration}}</td>
                                            <td>{{!is_null($data->wing) ? $data->wing->wing : null}}</td>
                                            <td class="text-center">{{$data->sequence}}</td>
                                            <td>{{$data->course}}</td>
                                            <td class="text-center">{{$data->course_code}}</td>
                                            <td class="text-center">{{$data->full_name}}</td>
                                            <td class="text-center">{{$data->tc_name}}</td>
                                            <td class="text-center">{{\App\Helper\DateFormat::date($data->updated_at)}}</td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

@endsection
