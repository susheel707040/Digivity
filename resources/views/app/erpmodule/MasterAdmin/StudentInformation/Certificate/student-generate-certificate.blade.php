@extends('layouts.MasterLayout')
@section('content')

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{asset('assets/lib/froala-editor/css/froala_editor.pkgd.min.css')}}">
    <link href="{{asset('assets/lib/froala-editor/css/froala_style.min.css')}}" rel="stylesheet" type="text/css">
    <style>
        div#editor {
            width: 100%;
            margin: auto;
            text-align: left;
        }
        #froala-editor {
            min-height: 200px;
            margin: 0px 8px 20px 40px;
            border: 1px solid #ccc;
        }
    </style>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="{{url('/home')}}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{url('/MasterAdmin/StudentInformation/index')}}">Transport</a></li>
            <li class="breadcrumb-item active" aria-current="page">Student Generate {{$certificate->certificate_name}} </li>
        </ol>
    </nav>
    <div class="col-lg-12 p-0 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-certificate"></i>Student Generate {{$certificate->certificate_name}}</b></div>
            <div class="panel-body pd-b-0 row">
                <form class="row m-0" action="{{url('MasterAdmin/StudentInformation/CertificateRecord')}}" method="POST" enctype="multipart/form-data">
                  {{csrf_field()}}
                    <div class="col-lg-12 bd-1 bd-b">
                    <table class="table bd-1 bd mg-t-10 pd-b-0 mg-b-10 bg-light">
                        <tr>
                            <td class="wd-100" rowspan="4">
                                <div class="avatar avatar-xxl wd-100 h-100 bd-2 bd"><img src="{{$studentrecord->ProfileImage()}}" class="rounded-circle" alt=""></div>
                            </td>
                            <td><b>Admission No.</b></td><td><b>:</b></td><td>{{$studentrecord->admission_no}}</td>
                            <td><b>Class/Course-Section</b></td><td><b>:</b></td><td>{{$studentrecord->CourseSection()}}</td>
                            <td><b>Academic Session</b></td><td><b>:</b></td><td>{{$studentrecord->SessionName()}}</td>
                        </tr>
                        <tr>
                            <td><b>Student Name</b></td><td><b>:</b></td><td><span class="badge badge-warning tx-uppercase">{{$studentrecord->fullName()}}</span></td>
                            <td><b>Father's Name</b></td><td><b>:</b></td><td><span class="badge-danger badge tx-uppercase">{{$studentrecord->FatherName()}}</span></td>
                            <td><b>Contact No.</b></td><td><b>:</b></td><td>{{$studentrecord->student->contact_no}}</td>
                        </tr>
                        <tr>
                            <td><b>Address</b></td><td><b>:</b></td>
                            <td colspan="7">{{$studentrecord->Address()}}</td>
                        </tr>
                        <tr>
                            <td class="tx-12"><b>Certificate</b></td><td><b>:</b></td><td><span class="badge badge-success tx-12">{{$certificate->certificate_name}}</span></td>
                        </tr>
                    </table>
                </div>
                <div class="col-lg-10 pd-l-0 pd-b-10">
                    <input type="hidden" name="student_id" value="{{$studentrecord->student_id}}">
                    <input type="hidden" name="certificate_for" value="student">
                    <input type="hidden" name="certificate_id" value="{{$certificate->id}}">

                    @php
                    $certificate_template="";
                    if(isset($certificatetemplate)){
                    $studentArr=$studentrecord->parameters();
                    unset($studentArr['id']);
                    $certificate_template=str_replace(array_keys($studentArr),array_values($studentArr),$certificatetemplate->template);
                    }
                    @endphp

                    <div class="col-lg-12 pd-l-0 pd-r-0 mg-t-10 pd-l-10">
                        <label>Certificate Template Content :</label>
                        <textarea id="edit" name="certificate_content" placeholder="Enter Certificate Template" class="form-control">{{$certificate_template}}</textarea>
                    </div>

                </div>
                <div class="col-lg-2 vhr">
                    <button class="btn btn-primary mg-t-10 btn-block"><i class="fa fa-check"></i> Save </button>
                    <button type="button" class="btn btn-info mg-t-10 btn-block"><i class="fa fa-file"></i> Preview </button>
                    <button type="button" class="btn btn-danger mg-t-10 btn-block"><i class="fa fa-file-pdf"></i> Generate PDF </button>
                    <button type="button" class="btn btn-success mg-t-10 btn-block"><i class="fa fa-print"></i> Print</button>
                </div>
                </form>
            </div>
        </div>
    </div>


    <style>
        #alert-msg{ width:40%; font-size:1.2rem; float:right; text-align:center; padding-top:4px; padding-bottom:6px;
            border-radius:10px; }
        .fr-box > div:nth-last-child(2) { display:none; }
        .fr-wrapper{ display: block !important;}
    </style>
    <script type="text/javascript" src="{{asset('assets/lib/froala-editor/js/froala_editor.pkgd.min.js')}}"></script>
    <script type="text/javascript">
        $(function(){
            $('#edit').froalaEditor({
                fullPage: true,
                heightMin: 500,
                heightMax: 800
            }).on('froalaEditor.image.beforeUpload', function (e, editor, files) {
                    if (files.length) {
                        // Create a File Reader.
                        var reader = new FileReader();

                        // Set the reader to insert images when they are loaded.
                        reader.onload = function (e) {
                            var result = e.target.result;
                            editor.image.insert(result, null, null, editor.image.get());
                        };

                        // Read image as base64.
                        reader.readAsDataURL(files[0]);
                    }
                    editor.popups.hideAll();
                    // Stop default upload chain.
                    return false;
                }
            );
        });
    </script>
@endsection
