@extends('layouts.master-layout-without-header-footer')
@section('content')
    @include('app.erpmodule.MasterAdmin.MarksManager.Report.HallTicketTemplate.hall-ticket-1')
    <style>@media print {
            h1 {page-break-after: always;}
        }
    </style>
@endsection
