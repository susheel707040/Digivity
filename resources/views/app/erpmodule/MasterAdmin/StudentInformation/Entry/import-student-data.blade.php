@extends('layouts.MasterLayout')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="{{url('/home')}}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Student Information</li>
            <li class="breadcrumb-item active" aria-current="page">Import Student Data</li>
        </ol>
    </nav>
    <div class="col-lg-12 p-0 m-0">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-file-import"></i> Import Student Data</b></div>
            <div class="panel-body pd-b-0 row">
                <form class="container-fluid" action="{{url('MasterAdmin/StudentInformation/ImportStudentView')}}" method="POST" enctype="multipart/form-data" data-parsley-validate="" novalidate="">
                    {{csrf_field()}}
                    <div class="col-lg-7 mx-auto pd-b-20 pd-t-10">
                   <div class="col-lg-9 mx-auto">
                       <label><b>Choose File <sup>*</sup> :</b></label>
                       <input type="file" name="import_file" id="import_file" class="form-control input-lg" required>
                   </div>
                    <div class="col-lg-12 mg-t-20 text-center">
                        <button class="btn wd-200 rounded-50 btn-primary btn-lg" onclick="validateFile()"> Continue <i class="fa fa-arrow-right"></i></button>
                    </div>
                    <div class="col-lg-12 mg-t-30">
                      <a href="{{url('/ImportFileFormat/StudentImport.xlsx')}}" download="" loader-disable="true" class="text-danger cursor-pointer tx-14"><u><i class="fa fa-file-excel"></i>Download Student Full Record Import Format</u></a>
                        <a href="{{url('ImportFileFormat/StudentShortImport.xlsx')}}" download="" loader-disable="true" class="text-danger cursor-pointer float-right tx-14"><u><i class="fa fa-file-excel"></i>Download Student Short Record Import Format</u></a>
                    </div>
                </div>
                </form>
                <div class="col-lg-12">
                    <div class="panel panel-default shadow-none">
                        <div class="panel-heading"><b><i class="fa fa-info"></i> Instructions :</b></div>
                        <div class="panel-body pd-b-10 pd-t-10 row m-0">
                            <p class="pd-b-0 container-fluid mg-b-2">1. Do care about case-sensitiveness in file name to write in sheet. IF it does not match, image/file will not be displayed.</p>
                            <p class="pd-b-0 container-fluid mg-b-2">2. Do not change column titles.</p>
                            <p class="pd-b-0 container-fluid mg-b-2">3. Use *.XLSX files only.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   <script>
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

@endsection
