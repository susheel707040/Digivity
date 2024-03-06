@php
    $selected_course_id = request()->get('course_id');
    $selected_section_id = request()->get('section_id');
@endphp

@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a
                    href="{{ url('/MasterAdmin/Transport/index') }}">Transport</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Bulk Student Assign Transport</li>
        </ol>
    </nav>

    <form action="{{ url('MasterAdmin/Transport/BulkAssignTransportToStudent') }}" method="POST"
        enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="col-lg-12 p-0 m-0">
            <div class="panel panel-default">
                <div class="panel-heading"><b><i class="fa fa-search"></i> Search Student for Assign Transport</b></div>
                <div class="panel-body tx-12 pd-b-15 row">
                    <div class="col-lg-2">
                        <label>Course :</label><br>
                        @include('components.course-import', ['selectid' => request()->get('course_id')])
                    </div>

                    <div class="col-lg-2 p-0">
                        <label>Section :</label><br>
                        @include('components.section-import', [])
                    </div>

                    <div class="col-lg-2">
                        <label><b>Transport Joining Date :</b></label><br>
                        <input type="text" name="joining_date" value="{{nowdate(request()->get('joining_date'),'d-m-Y')}}" autocomplete="off" placeholder="dd-mm-yy"
                               class="form-control input-sm date">
                    </div>

                    <div class="col-lg-2 mg-t-20">
                        <button type="submit" class="btn styleButton btn-primary btn-sm"> Continue <i
                                class="fa fa-angle-right"></i></button>
                    </div>
                    <div class="col-lg-12 pd-t-10">
                        <a href="{{ asset('ImportFileFormat/StudentImportTransport.xlsx') }}" loader-disable="true"
                            download="" target="_blank" class="text-danger"><b><u><i class="fa fa-file-excel"></i>
                                    Download Student Assign Transport File Format</u></b></a>
                    </div>
                </div>
            </div>
        </div>
    </form>

    @if (isset($selected_course_id) &&
            $selected_course_id != null &&
            isset($selected_section_id) &&
            $selected_section_id != null)
        @php
            $students = collect(studentshortlist(['course_id' => $selected_course_id, 'section_id' => $selected_section_id]));
        @endphp
        <form action="{{ url('MasterAdmin/Transport/CreateCourseWiseAssignTransport') }}" method="POST"
            enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="col-lg-12 p-0 m-0">
                <div class="panel panel-default">
                    <div class="panel-heading"><b><i class="fa fa-plus"></i> Assign Student Bulk Transport</b></div>
                    <div class="panel-body pd-b-15 p-0 m-0 row">
                        <div class="col-lg-10 pd-l-0 pd-r-20  m-0">
                            <table class="table table-bordered tx-12 mg-10">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="text-center"><input type="checkbox" class="CheckAll" value="checkbox1">
                                        </th>
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
                                    @foreach ($students as $student)
                                        <tr @if (!isset($student->transport->id)) class="bg-success-light" @endif>
                                            <td class="text-center">
                                                @if (isset($student->transport->id))
                                                    <input type="checkbox" name="students[{{ $student->id }}][student_id]"
                                                        class="checkbox1" value="{{ $student->id }}">
                                                @endif
                                            </td>
                                            <td class="text-center">{{ $student->admission_no }}</td>
                                            <td>{{ $student->course->course }} {{ '-' }}
                                                {{ $student->section->section }} </td>
                                            <td>{{ $student->fullName() }} </td>
                                            <td>{{ $student->FatherName() }}</td>
                                            <td>{{ $student->ContactNo() }}</td>
                                            <td>{{ $student->Address() }}</td>
                                            <td>
                                                <table cellpadding="0" cellspacing="0" class="table-borderless p-0 m-0">
                                                    <tbody>
                                                        <tr>
                                                            <td class="select2">
                                                                @php
                                                                    $field_name = 'students[' . $student->id . '][transport_id]';
                                                                @endphp
                                                                @include(
                                                                    'components.Transport.assign-transport-route-list',
                                                                    [
                                                                        'id' => '',
                                                                        'class' =>
                                                                            'form-control select-search input-sm',
                                                                        'name' => $field_name,
                                                                        'selectid' => isset(
                                                                            $student->transport->id)
                                                                            ? $student->transport->id
                                                                            : '',
                                                                        'disabled' => isset(
                                                                            $student->transport->id)
                                                                            ? 'disabled'
                                                                            : '',
                                                                        'transport_assigned' => 'active',
                                                                    ]
                                                                )
                                                            </td>
                                                            <td>
                                                                <a
                                                                    href={{ url('MasterAdmin/Transport/removeStudentTransport/' . $student->id) }}>
                                                                    <button type="button" class="btn btn-danger btn-sm"
                                                                        style="width: 50px" fdprocessedid="3h8nb"><i
                                                                            class="fa fa-trash"></i></button></a>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-2 vhr text-center">
                            <button type="submit" class="btn btn-primary mg-t-10 btn-block btn-lg" fdprocessedid="zncr1"><i
                                    class="fa fa-plus"></i> Bulk Assign</button>
                            <button class="btn btn-white btn-lg btn-block mg-t-20" fdprocessedid="qhkif"><i
                                    class="fa fa-times"></i> Close</button>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    @endif


@endsection
