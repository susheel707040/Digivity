@extends('layouts.master-layout-without-header-footer')
@section('content')
    <div style='width:100%; height:35px;'></div>
    @php $printsheet=0; @endphp
    @foreach($datas as $data)
        @php
            $printsheet++;
            $barcodeno=sprintf("%06d",$data->accession_no);
        @endphp
        <div style="width:18%; height:104px;  margin-left:1%; margin-right:1%; padding:10px; padding-top:5px; float:left; font-size:10px;  border:1px solid white; border-radius:2px;    ">
            <h6 class="text-center m-0 p-0 font-size:13px;"><b>AGSV LIBRARY</b></h6>
            <p class="text-center m-0 p-0">Accession Number</p>
            <img style="width:100%; height:26px; " src="data:image/png;base64,{{DNS1D::getBarcodePNG($barcodeno, 'C39',30,100)}}" alt="barcode"   />
            <p class="text-center m-0 p-0">{{$barcodeno}}</p>
            <p class="p-0 m-0"><span><b>Book No:</b> {{$data->book_no}}</span>
                <span class='float-right'><b>DDC No.:</b> {{$data->ddc_no}}</span>
            </p>
        </div>
        @if($printsheet==65)
            @php $printsheet=0; @endphp
            <h1></h1>
            <div style='width:100%; height:35px;'></div>
        @endif
    @endforeach
    <style type="text/css">
        @media print {
            h1 {page-break-after: always;}
        }
    </style>
@endsection
