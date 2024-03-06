@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Certificate</li>
            <li class="breadcrumb-item active" aria-current="page">Certificate Preview</li>
        </ol>
    </nav>
    <div class="col-lg-12 pd-l-0 pd-r-0 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i>Certificate Preview</b></div>
            <div class="panel-body pd-b-0 row">
                @if(isset($certificaterecord))
                <div class="col-lg-10">
                    <table cellpadding="0" cellspacing="0" class="table datatable table-borderless">
                        <tr>
                            <td>{!! $certificaterecord->certificate_content !!}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-lg-2 pd-l-25 vhr text-center">
                    <button href="{{url('print/0')}}" type="button" class="btn btn-primary btnPrint btn-block btn-lg mg-t-15"><i class="fa fa-print"></i>Print</button>
                    <button type="button" class="btn btn-dark btn-block btn-lg mg-t-15"><i class="fa fa-file-pdf"></i>Download Pdf</button>
                    <button type="button" class="btn btn-success btn-block btn-lg mg-t-15"><i class="fa fa-edit"></i>Edit Certificate</button>
                    <button type="button" class="btn btn-danger btn-block btn-lg mg-t-15"><i class="fa fa-trash"></i> Remove</button>
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection
