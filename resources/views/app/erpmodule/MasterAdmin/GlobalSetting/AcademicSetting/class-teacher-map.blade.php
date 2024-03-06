@extends('layouts.MasterLayout')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Global Setting</li>
            <li class="breadcrumb-item active" aria-current="page">Teacher Class/Course Mapping/Allocate</li>
        </ol>
    </nav>

    <div class="col-lg-12 p-0 m-0 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i> Teacher Class/Course Mapping/Allocate</b></div>
            <div class="panel-body pd-b-0 row">

            <div class="col-lg-12 pd-t-20 pd-b-20">
                <table class="col-lg-10 text-left">
                    <tr>
                        <td><b> Staff/Employee No.:</b></td>
                        <td><input type="text" id="emp_no" value="{{request()->route('staffno')}}" class="form-control" placeholder="Enter Staff Number"></td>
                        <td class="pd-l-15"><b>OR</b></td>
                        <td class="pd-l-20"><b> Staff/Employee :</b></td>
                        <td class="pd-l-10">
                            @include('components.staff-import',['class'=>'form-control select-search','selectid'=>request()->route('staffid')])
                        </td>
                        <td class="pd-l-10">
                            <button type="button" class="btn btn-continue btn-primary">Continue <i class="fa fa-arrow-right"></i></button>
                        </td>
                    </tr>
                </table>
            </div>

            @if(isset($staff))
            <form action="{{url('MasterAdmin/GlobalSetting/StoreTeacherClassMap')}}" method="POST" data-parsley-validate="" novalidate="">
            {{csrf_field()}}
            <input type="hidden" name="staff_id" value="{{$staff->id}}">
            <div class="col-lg-12 bd-1 bd-t p-0">
                <table class="table table-bordered mg-t-10">
                    <thead>
                    <tr>
                        <th colspan="3" class="tx-14 text-primary">
                            <b>Staff/Teacher : </b> {{$staff->staff_no}} - {{$staff->fullName()}} ({{$staff->contact_no}}) - {{$staff->DesignationName()}}
                        </th>
                    </tr>
                    </thead>
                    <thead class="bg-light">
                    <tr>
                        <th class="wd-5p text-center">Sl.No.</th>
                        <th class="wd-20p">Default Set For Class/Course Teacher</th>
                        <th class="valign-middle align-middle">Teacher Class/Course Allotement
                            <span class="float-right"><input type="checkbox" class="CheckAll" value="checkbox1"> Select All</span>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                    $teacherwithcourse=collect($teacherwithcourse);
                    $defaultcourse=$teacherwithcourse->first();
                    @endphp
                    <tr>
                        <td class="text-center"><b>1</b></td>
                        <td>
                            <select name="for_class_id" class="form-control" required>
                                <option value="">---Select---</option>
                                @foreach($course as $data)
                                    @if(isset($data->coursewithsection))
                                    @foreach($data->coursewithsection as $data1)
                                    <option value="{{$data->id.'@'.$data1->section->id}}" @if(isset($defaultcourse)) @if($defaultcourse->for_course_id==$data->id && $defaultcourse->for_section_id==$data1->section->id) selected @endif @endif>{{$data->course}} - {{$data1->SectionName()}}</option>
                                    @endforeach
                                    @endif
                                @endforeach
                            </select>
                        </td>
                        <td>
                            @foreach($course as $data)
                                @if(isset($data->coursewithsection))
                                    @foreach($data->coursewithsection as $data1)
                                        @php
                                            try {
                                             $record=$teacherwithcourse->where('course_id',$data->id)->where('section_id',$data1->section->id)->first();
                                            }catch (\Exception $e){}
                                        @endphp

                                        <span class="badge bg-primary-light bd-1 bd pd-1 pd-l-10 pd-r-10">
                                    <table cellspacing="0" cellpadding="0" class="table table-borderless m-0 pd-l-10 pd-r-10">
                                        <tr>
                                            <td class="p-0 m-0"><input class="checkbox1" name="class_id[]" type="checkbox" value="{{$data->id.'@'.$data1->section->id}}" @if(isset($record)) @if($record->course_id==$data->id && $record->section_id==$data1->section->id) checked @endif @endif></td><td class="pd-l-10 pd-b-0 pd-t-0 m-0">{{$data->course}} - {{$data1->SectionName()}}</td>
                                        </tr>
                                    </table>
                                </span>
                                    @endforeach
                                @endif
                            @endforeach
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-12 pd-l-0 pd-r-0 pd-b-20 ">

                @if(isset($defaultcourse)&&($defaultcourse))
                <a href="{{url('/MasterAdmin/GlobalSetting/RemoveTeacherClassMap/'.$staff->id.'/remove')}}" class="tx-danger pd-l-10"><b><i class="fa fa-trash"></i> Remove</b></a>
                @endif

                <button type="submit" class="btn btn-primary mg-b-20 float-right btn-lg"><i class="fa fa-check"></i> Submit</button>
            </div>
            </form>
            @endif
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(".btn-continue").click(function () {
            var emp_no=$("#emp_no").val();
            if(emp_no==0){emp_no=0;}
            var emp_id=$("#staff_id").val();
            if(emp_no==0 && emp_id==0){
                swal({
                    title: "Opps!",
                    text: "Please enter Staff Number OR Choose Staff",
                    icon: "error",
                    button: "Ok",
                });
                return false;
            }
            window.location.assign('/MasterAdmin/GlobalSetting/TeacherClassMap/'+emp_no+'/'+emp_id+'/search');
            loader('block');
        });
    </script>

@endsection
