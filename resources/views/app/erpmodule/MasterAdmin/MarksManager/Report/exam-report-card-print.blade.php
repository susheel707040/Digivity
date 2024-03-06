@extends('layouts.master-layout-without-header-footer')
@section('content')
    @php
        $row=0;
        $reportcard_template="report-card-template";
        $studentinformation_template="student-information-template";
    @endphp

    @foreach($student as $data)
        @php $row++; @endphp
        <div class="container-fluid tx-15">
            <div class="col-lg-12 pd-l-0 pd-r-0">
                @include('Print.print-page-header',['header'=>1,'footer'=>0,'stylenull'=>1])
            </div>
            <div class="col-lg-12">
                @include('app.erpmodule.MasterAdmin.MarksManager.Report.ReportCardTemplate.StudentInformationSection.'.$studentinformation_template.'',['data'=>$data])
            </div>
            <div class="col-lg-12">
                @include('app.erpmodule.MasterAdmin.MarksManager.Report.ReportCardTemplate.ReportCard.'.$reportcard_template.'',['data'=>$data,'examtermid'=>$examtermid])
            </div>
        </div>

        <h1></h1>
    @endforeach
    @if($row==2)
        <style>@media print {
                h1 {page-break-after: always;}
            }
        </style>
        @php $row=0; @endphp
    @endif
@endsection
