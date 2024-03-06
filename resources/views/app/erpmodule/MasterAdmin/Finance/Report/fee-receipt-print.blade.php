@extends('layouts.master-layout-without-header-footer')
@section('content')
    @php
    $templatename="a5-receipt-format";
    if(isset($receiptconfig->rec_format)){
        $templatename=$receiptconfig->rec_format;
    }
    @endphp
    @include('app.erpmodule.MasterAdmin.Finance.Report.ReceiptTemplates.'.$templatename.'')
    <script type="text/javascript">
        window.print();
        window.onfocus=function(){ window.close();}
    </script>
@endsection

