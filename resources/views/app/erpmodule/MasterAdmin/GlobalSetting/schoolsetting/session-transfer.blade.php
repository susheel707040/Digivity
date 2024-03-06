@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="{{url('/home')}}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Global Setting</li>
            <li class="breadcrumb-item active" aria-current="page">Session Transfer</li>
        </ol>
    </nav>

    <div class="col-lg-12 p-0 m-0">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i> Session Transfer</b></div>
            <div class="panel-body pd-b-10">
                <form action="" method="POST" data-parsley-validate novalidate>
                {{csrf_field()}}
                    <div class="row">
                <div class="col-lg-2">
                    <label><b>Current Class/Course :</b></label><br>
                    @include('components.course-import',['class'=>'form-control select-box','selectid'=>request()->get('course_id'),'required'=>'required','data'=>['for'=>'section_id','this_id'=>'course_id','request_ids'=>'course_id','get'=>'sectionlist']])
                </div>
                <div class="col-lg-2">
                    <label><b>Current Section :</b></label><br>
                    @include('components.section-import',['required'=>'required','selectid'=>request()->get('section_id')])
                </div>
                <div class="col-lg-2">
                    <label><b>Current Status :</b></label><br>
                    @include('components.GlobalSetting.status-import',['all'=>1])
                </div>
                <div class="col-lg-2">
                    <label><b>Current Admission Type :</b></label><br>
                    @include('components.GlobalSetting.is-new-status',['all'=>1])
                </div>
                </div>
                <div class="clearfix"></div>
                <div class="row">
                    <div class="col-lg-12 text-center tx-18 mt-3"><b>Transfer to</b></div>
                    <div class="col-lg-2">
                        <label><b>Next Class/Course :</b></label><br>
                        @include('components.course-import',['class'=>'form-control','name'=>'next_course_id','id'=>'next_course_id','required'=>'required','selectid'=>request()->get('next_course_id')])
                    </div>
                    <div class="col-lg-2">
                        <label><b>Next Section :</b></label><br>
                        @include('components.section-import',['required'=>'required','name'=>'next_section_id','id'=>'next_section_id','selectid'=>request()->get('next_section_id')])
                    </div>
                    <div class="col-lg-2">
                        <label><b>Next Admission Type :</b></label><br>
                        @include('components.GlobalSetting.is-new-status',['required'=>'required','name'=>'next_is_new','selectid'=>'old'])
                    </div>
                    <div class="col-lg-2">
                        <label><b>Academic Year :</b></label><br>
                        @include('components.GlobalSetting.academic-year-import',['selectid'=>request()->get('next_academic_id'),'name'=>'next_academic_id','id'=>'next_academic_id','required'=>'required'])
                    </div>
                    <div class="col-lg-2">
                        <label><b>Financial Year :</b></label><br>
                        @include('components.GlobalSetting.financial-year-import',['selectid'=>request()->get('next_financial_id'),'name'=>'next_financial_id','id'=>'next_financial_id','required'=>'required'])
                    </div>
                    <div class="col-lg-2">
                        <button type="submit" class="btn btn-primary mt-4">Continue <i class="fa fa-arrow-right"></i></button>
                    </div>
                </div>
                </form>
            </div>
        </div>


        @if(isset($student))
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i> Student List</b></div>
            <div class="panel-body pd-b-10">

                @if(count($student)>0)
                <form action="{{route('admin.sessiontransfer',['module'=>'student'])}}" method="POST">
                {{csrf_field()}}
                    <input type="hidden" readonly="readonly" name="next_academic_id" value="{{request()->get('next_academic_id')}}" required>
                    <input type="hidden" readonly="readonly" name="next_financial_id" value="{{request()->get('next_financial_id')}}" required>
                    <div class="row m-0">
                    <div class="col-lg-12">
                        <table class="table table-bordered mt-2">
                            <thead class="bg-light">
                            <tr>
                                <th>#</th>
                                <th><input type="checkbox" class="CheckAll" value="checkbox1"></th>
                                <th>Student Name</th>
                                <th>Father Name</th>
                                <th>Assigned Class/Course</th>
                                <th>New Class/Course</th>
                                <th>New Section</th>
                                <th>Assig. Adm. Type</th>
                                <th>New Adm. Type</th>
                                <th>Assig. Status</th>
                                <th>New Status</th>
                            </tr>
                            </thead>
                            @php $row=1; @endphp
                            @foreach($student as $data)
                            <tbody>
                            <tr>
                                <td class="text-center">{{$row++}}</td>
                                <td><input type="checkbox" name="student_db_id[]" class="checkbox1" value="{{$data->id}}"></td>
                                <td>{{$data->fullName()}}</td>
                                <td>{{$data->FatherName()}}</td>
                                <td>{{$data->CourseSection()}}</td>
                                <td>@include('component.course-import',['selectid'=>request()->get('next_course_id'),'name'=>'course_id_'.$data->id.''])</td>
                                <td>@include('component.section-import',['selectid'=>request()->get('next_section_id'),'name'=>'section_id_'.$data->id.''])</td>
                                <td class="text-center"><span class="badge-danger badge">{{ucfirst($data->is_new)}}</span></td>
                                <td>@include('component.GlobalSetting.is-new-status',['selectid'=>request()->get('next_is_new')?:"old",'name'=>'is_new_'.$data->id.''])</td>
                                <td class="text-center"><span class="badge badge-success">{{ucfirst($data->status)}}</span></td>
                                <td>@include('component.GlobalSetting.status-import',['selectid'=>$data->status,'name'=>'status_'.$data->id.''])</td>
                            </tr>
                            </tbody>
                            @endforeach
                        </table>
                    </div>
                    <div class="col-lg-12 bd-2 bd-t">
                        <button class="btn btn-primary btn-lg mt-3"><i class="fa fa-check"></i>Submit</button>
                    </div>
                </div>
                </form>
                @else
                    {!! recordnofound() !!}
                @endif

            </div>
        </div>
        @endif

    </div>

@endsection