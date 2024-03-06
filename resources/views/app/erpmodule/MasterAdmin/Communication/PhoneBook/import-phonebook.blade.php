@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Communication</li>
            <li class="breadcrumb-item active" aria-current="page">Phonebook</li>
            <li class="breadcrumb-item active" aria-current="page">Import Phonebook Contact</li>
        </ol>
    </nav>
    <div class="col-lg-12 p-0 m-0 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-file-import"></i>Import Phonebook Contact</b></div>
            <div class="panel-body pd-b-0 row">
                <div class="col-lg-6 pd-10 mx-auto">
                    <table class="mg-t-20 mg-b-20">
                        <tr>
                            <td><input type="file" class="form-control input-sm"></td>
                            <td><button type="submit" class="btn btn-primary"><i class="fa fa-upload"></i> Submit</button></td>
                        </tr>
                    </table>
                    <button type="button" class="btn btn-danger mg-t-10"><i class="fa fa-file-excel"></i> Download Sample File</button>
                </div>

            </div>
        </div>
    </div>
@endsection
