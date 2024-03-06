@extends('layouts.MasterLayout')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a
                    href="{{ url('/MasterAdmin/Transport/index') }}">Transport</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Import Student Transport to Database</li>
        </ol>
    </nav>

    <form action="{{ url('MasterAdmin/Transport/ImportAssignTransportToStudent') }}" method="POST"
        enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="col-lg-12 p-0 m-0">
            <div class="panel panel-default">
                <div class="panel-heading"><b><i class="fa fa-search"></i> upload Assigned Transport File to Database</b></div>
                <div class="panel-body tx-12 pd-b-15 row">
                    <div class="col-lg-3 pd-l-0">
                        <label>Import File <span class="text-gray"></span> :</label>
                        <span class="tx-danger tx-10">Please only upload Excel file</span>
                        <input type="file" name="import_file" id="import_file" class="form-control input-lg">

                    </div>

                    <div class="col-lg-2 mg-t-20">
                        <button type="submit" class="btn styleButton btn-primary btn-sm" onclick="validateFile()"> Import Data <i
                                class="fa fa-angle-right"></i></button>
                    </div>
                    <div class="col-lg-12 pd-t-10">
                        <a href="{{ url('ImportFileFormat/StudentImportTransport.xlsx') }}" loader-disable="true"
                            download="" target="_blank" class="text-danger"><b><u><i class="fa fa-file-excel"></i>
                                    Download Student Assign Transport File Format</u></b></a>
                    </div>
                </div>
            </div>
        </div>
    </form>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var importButton = document.querySelector('.styleButton');
                importButton.addEventListener('click', validateFile);
            });

            function validateFile() {
                var fileInput = document.getElementById('import_file');
                var filePath = fileInput.value;
                var allowedExtensions = /(\.xlsx|\.xls)$/i;

                if (!allowedExtensions.exec(filePath)) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Please choose a valid Excel file (xlsx or xls).',
                    });
                    fileInput.value = '';
                    return false;
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: 'File is valid!',
                        text: 'You can proceed.',
                    });
                }
            }
        </script>


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
                                        <tr @if (isset($student->transport->id)) class="bg-success-light" @endif>
                                            <td class="text-center">
                                                @if (!isset($student->transport->id))
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
                                                                    'component.Transport.assign-transport-route-list',
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
                    </div>
                </div>
            </div>


        </form>
    @endif


@endsection
