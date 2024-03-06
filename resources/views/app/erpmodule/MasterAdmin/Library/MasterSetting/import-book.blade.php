@extends('layouts.MasterLayout')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="#">Library</a></li>
            <li class="breadcrumb-item" aria-current="page">Master Setting</li>
            <li class="breadcrumb-item active" aria-current="page">Import Books/Items</li>
        </ol>
    </nav>

    <div class="col-lg-12 p-0 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-plus"></i> Import Books/Items</b></div>
            <div class="panel-body pd-b-0 row">

                <form class="container-fluid" action="{{url('MasterAdmin/Library/StoreImportBook')}}" method="POST" enctype="multipart/form-data" onsubmit="return validateFile()">
                    {{csrf_field()}}
                    <div class="col-lg-6 mx-auto pd-b-25 mg-t-15 pd-t-10">
                        <div class="col-lg-9 mx-auto">
                            <label><b>Choose File <sup>*</sup> :</b></label>
                            <input type="file" id="import_file" name="import_file" class="form-control input-lg" required>
                        </div>
                        <div class="col-lg-12 mg-t-20 text-center">
                            <button type="submit" class="btn wd-200 rounded-50 btn-primary btn-lg"> Continue <i class="fa fa-arrow-right"></i></button>
                        </div>
                        <div class="col-lg-12 text-center mg-t-30">
                            <a href="{{url('ImportFileFormat/BookImport.xlsx')}}" download="" loader-disable="true" class="text-success cursor-pointer tx-14"><u><i class="fa fa-file-excel"></i>Books/Items Full Record Import Format</u></a>
                        </div>
                    </div>
                </form>
                <script>
                    function validateFile() {
                        var fileInput = document.getElementById('import_file');
                        var filePath = fileInput.value;
                        var allowedExtensions = /(\.xlsx|\.xls)$/i;

                        if (filePath === "") {
                            // If no file is selected
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Please choose a file.',
                            });
                            return false;
                        } else if (!allowedExtensions.exec(filePath)) {
                            // If selected file is not an Excel file
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Please choose a valid Excel file (xlsx or xls).',
                            });
                            return false;
                        }
                        return true;
                    }
                </script>

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

@endsection
