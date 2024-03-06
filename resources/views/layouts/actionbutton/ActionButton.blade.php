<button type="button" href="#addModels" data-toggle="modal" class="btn btn-block mg-t-10 btn-outline-primary btn-sm"><i class="fa fa-plus"></i> Add New</button>

{{-- <button type="button" href="#editModels" data-toggle="modal" class="btn btn-block btn-outline-success btn-edit mg-t-10 btn-sm" ><i class="fa fa-edit"></i> Edit</button> --}}

<a href="#" class="BtnRemoveUrl"><button type="button" class="btn btn-remove btn-block btn-outline-danger mg-t-10 btn-sm" disabled><i class="fa fa-trash-alt"></i> Remove</button></a>

<button type="button" class="btn btn-block btn-outline-dark mg-t-10 btn-sm "><i class="fa fa-times"></i> Cancel</button>

<button type="button" @if(isset($fileName))FileName="{{$fileName}}_{{\Carbon\Carbon::now()->format('d_M_y_h_i_s')}}"@else FileName="ExcelFile_{{\Carbon\Carbon::now()->format('d_M_y_h_i_s')}}" @endif @if(isset($colspan)) colspan="{{$colspan}}" @endif FileFormat="xlsx" href="{{url('/ExportFile')}}" tokenid="{{csrf_token()}}" method="POST" class="btn btn-block export-excel btn-outline-success mg-t-10 btn-sm ><i class="fa fa-file-excel"></i> Export Excel</button>

<button type="button" @if(isset($fileName))FileName="{{$fileName}}_{{\Carbon\Carbon::now()->format('d_M_y_h_i_s')}}"@else FileName="ExcelFile_{{\Carbon\Carbon::now()->format('d_M_y_h_i_s')}}" @endif @if(isset($colspan)) colspan="{{$colspan}}" @endif FileFormat="csv" href="{{url('/ExportFile')}}" tokenid="{{csrf_token()}}" method="POST" class="btn btn-block export-excel btn-outline-info mg-t-10 btn-sm "><i class="fa fa-file-csv"></i> Export CSV</button>

<button type="button" href="{{url('/ExportFilePdf')}}" tokenid="{{csrf_token()}}" method="POST"  class="btn export-pdf btn-block btn-outline-danger mg-t-10 btn-sm "><i class="fa fa-file-pdf"></i> Export Pdf</button>

<button  type="button" href="{{url('print/1')}}" class="btn btn-block btnPrint btn-outline-primary mg-t-10 mg-b-10 btn-sm "><i class="fa fa-print"></i> Print</button>

<script type="text/javascript" src="{{url('assets/javascript/export_file_js.js')}}"></script>
