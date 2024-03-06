@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">Global Setting</li>
            <li class="breadcrumb-item active" aria-current="page">Class/Course With Section Mapping</li>
        </ol>
    </nav>
    <form action="{{url('MasterAdmin/GlobalSetting/CreateClassWithSection')}}" method="POST">
        {{csrf_field()}}
        <div class="col-lg-12 mx-auto">
            <div class="panel panel-default">
                <div class="panel-heading"><b><i class="fa fa-sitemap"></i> Class With Section Mapping</b></div>
                <div class="panel-body pd-b-0 row">
                    <div class="col-lg-10">
                        <table class="table table-bordered mg-t-15 mg-b-15 rounded-5">
                            <thead>
                            <th class="text-center"><input type="checkbox" id="CheckAll" checked></th>
                            <th><b>Class/Course</b></th>
                            <th><b>Section</b></th>
                            </thead>
                            <tbody>
                            @foreach($course as $data)
                                <tr>
                                    <td class="wd-10p text-center"><input type="checkbox" class="checkBoxClass" name="course_id[]"
                                                                          value="{{$data->id}}" @if(isset($coursewithsection)&&($coursewithsection->where('course_id',$data->id)->count())) checked @endif></td>
                                    <td class="wd-30p">{{$data->course}}</td>
                                    <td>
                                        @foreach($section as $data1)
                                            <input type="checkbox" name="section_{{$data->id}}_id[]"
                                                   value="{{$data1->id}}" @if(in_array($data->id."@".$data1->id,$cwsarr)) checked @endif> <span
                                                class="pd-r-10">{{$data1->section}}</span>
                                        @endforeach
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="col-lg-2 pd-t-20 text-center">
                        <button class="btn btn-block btn-outline-primary" type="submit"><i class="fa fa-check"></i>
                            Update
                        </button>
                    </div>

                </div>
            </div>
        </div>

    </form>

@endsection
