@extends('layouts.master-layout-without-header-footer')
@section('content')
    @php
        $templatename="a5-receipt-estimate-print";

    @endphp
    @include('app.erpmodule.MasterAdmin.Finance.Report.ReceiptTemplates.'.$templatename.'')
    <script type="text/javascript">
        window.print();
        window.onfocus=function(){ window.close();}
    </script>
@endsection
