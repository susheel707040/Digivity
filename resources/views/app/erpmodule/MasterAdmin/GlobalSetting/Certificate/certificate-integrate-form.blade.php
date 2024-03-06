@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item " aria-current="page">Global Setting</li>
            <li class="breadcrumb-item " aria-current="page">Certificate</li>
            <li class="breadcrumb-item active" aria-current="page">Certificate Integrate Form Fields</li>
        </ol>
    </nav>
    @php $row=1; @endphp
    <div class="col-lg-12 p-0 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-certificate"></i>Certificate Integrate Form Fields Configuration</b></div>
            <div class="panel-body pd-b-0 row">

                <form class="container-fluid" action="{{url('MasterAdmin/GlobalSetting/CertificateIntegrateFormFields')}}" method="POST"  data-parsley-validate="" novalidate="">
                    {{csrf_field()}}
                    <div class="col-lg-12 row pd-l-0 pd-r-0 pd-b-15 m-0">
                        <div class="col-lg-3">
                            <label><b>Certificate :</b></label>
                            @include('components.GlobalSetting.Certificate.certificate-import',['class'=>'form-control','required'=>'required','selectid'=>request()->get('certificate_id')])
                        </div>
                        <div class="col-lg-2">
                            <label><b>Certificate For :</b></label>
                            <select name="certificate_for" class="form-control">
                                <option value="student" @if(request()->get('certificate_for')=="student") selected @endif>Student</option>
                                <option value="staff" @if(request()->get('certificate_for')=="staff") selected @endif>Staff</option>
                            </select>
                        </div>
                        <div class="col-lg-2">
                            <button class="btn rounded-50 mg-t-25 btn-primary">Continue <i class="fa fa-arrow-right"></i></button>
                        </div>
                    </div>
                </form>

                @if(request()->get('_token'))
                    <form class="container-fluid" action="{{url('MasterAdmin/GlobalSetting/StoreCertificateIntegrateFormFields')}}" method="POST" data-parsley-validate="" novalidate="">
                        {{csrf_field()}}
                        <input type="hidden" name="certificate_id" value="{{request()->get('certificate_id')}}">
                        <input type="hidden" name="certificate_for" value="{{request()->get('certificate_for')}}">
                        <div class="col-lg-12 row m-0 pd-l-0 pd-r-0 bd-1 bd-t">
                            <div class="col-lg-12 pd-l-0 pd-r-0">
                                <table id="FieldsTable" class="table bd-1 bd mg-t-10">
                                    <thead class="bg-light">
                                    <tr>
                                        <th class="text-center">S.No.</th>
                                        <th>Label Name</th>
                                        <th>Field Type</th>
                                        <th>Field ID/Name</th>
                                        <th>Field Value</th>
                                        <th>Dynamic Replace</th>
                                        <th>Default Value</th>
                                        <th>Class</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php  $row=0; @endphp
                                    @if(isset($exist_data)&&($exist_data))
                                        @php
                                            $certificateform=unserialize($exist_data);
                                        @endphp
                                        @foreach($certificateform as $key=>$fields)
                                            @php $row++ @endphp
                                            <tr>
                                                <td class="text-center">{{$row}}.</td>
                                                <td><input type="text" autocomplete="0ff" name="{{$key}}[]" @if(isset($fields[0])) value="{{$fields[0]}}" @endif class="form-control1" placeholder="Enter Label Name"></td>
                                                <td><select class="form-control1" name="{{$key}}[]"><option>Text</option><option>Select Box</option><option>Radio</option></select></td>
                                                <td><input type="text" autocomplete="0ff" name="{{$key}}[]" @if(isset($fields[2])) value="{{$fields[2]}}" @endif class="form-control1 wd-100" placeholder="Field ID/Name"></td>
                                                <td><textarea class="form-control" autocomplete="0ff" name="{{$key}}[]" placeholder="Enter Field Value">@if(isset($fields[3])){{$fields[3]}}@endif</textarea></td>
                                                <td><input type="text" autocomplete="0ff" name="{{$key}}[]" @if(isset($fields[4])) value="{{$fields[4]}}" @endif class="form-control1" placeholder="Enter Dynamic Replace"></td>
                                                <td><input type="text" autocomplete="0ff" name="{{$key}}[]" @if(isset($fields[5])) value="{{$fields[5]}}" @endif class="form-control1" placeholder="Enter Default Value"></td>
                                                <td><input type="text" autocomplete="0ff" name="{{$key}}[]" @if(isset($fields[6])) value="{{$fields[6]}}" @endif class="form-control1 wd-60" placeholder="Class"></td>
                                                <td><button type="button" class="btn btn-xs rounded-5 btn-outline-danger DeleteButton text-center"><i class="fa fa-trash p-0 m-0"></i></button></td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                            <div id="tbody_data" hidden>

                            </div>
                            <div class="col-lg-12 pd-l-0 pd-b-15 pd-r-0">
                                <button type="button" id="AddRow" class="btn btn-danger btn-sm"><i class="fa fa-plus"></i> Add</button>
                                <button type="submit" class="btn btn-primary float-right btn-lg">Submit <i class="fa fa-check"></i></button>
                            </div>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            function tablebody(row) {
                var option="";
                var selectoption=['text','textarea','radio','checkbox','select','file','image','color','date','email','number','url'];
                for(var i=0;i<10;i++){
                    option +="<option>"+selectoption[i]+"</option>";
                }
                return '<tr>\n' +
                    '<td class="text-center">'+row+'.</td>\n' +
                    '<td><input type="text" autocomplete="off" name="input_'+row+'[]" class="form-control1" placeholder="Enter Label Name"></td>\n' +
                    '<td><select class="form-control1" autocomplete="off" name="input_'+row+'[]">'+option+'</select></td>\n' +
                    '<td><input type="text" autocomplete="off" name="input_'+row+'[]" class="form-control1 wd-100" placeholder="Enter Field id/Name"></td>\n' +
                    '<td><textarea class="form-control" autocomplete="off" name="input_'+row+'[]" placeholder="Enter Field Value"></textarea></td>\n' +
                    '<td><input type="text" autocomplete="off" name="input_'+row+'[]" class="form-control1" placeholder="Enter Dynamic Replace"></td>\n' +
                    '<td><input type="text" autocomplete="off" name="input_'+row+'[]" class="form-control1" placeholder="Enter Default Value"></td>\n' +
                    '<td><input type="text" autocomplete="off" name="input_'+row+'[]" class="form-control1 wd-60" placeholder="Class"></td>\n'+
                    '<td><button type="button" autocomplete="off" name="input_'+row+'[]" class="btn btn-xs rounded-5 DeleteButton btn-outline-danger text-center"><i class="fa fa-trash p-0 m-0"></i></button></td>\n' +
                    '</tr>';
            }
            var row={{$row}};
            $("#AddRow").click(function () {
                row++;
                var tbody_data=tablebody(row);
                $("#FieldsTable tbody").append(tbody_data);
            });

            row++;
            var tbody_data=tablebody(row);
            $("#FieldsTable tbody").append(tbody_data);

            $("#FieldsTable").on("click", ".DeleteButton", function() {
                swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this table row",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            $(this).closest("tr").remove();
                        } else {
                            return false;
                        }
                    });

            });
        });
    </script>
@endsection
