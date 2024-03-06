@extends('layouts.MasterLayout')
@section('content')

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{url('assets/lib/froala-editor/css/froala_editor.pkgd.min.css')}}">
    <link href="{{url('assets/lib/froala-editor/css/froala_style.min.css')}}" rel="stylesheet" type="text/css">
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
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item " aria-current="page">Global Setting</li>
            <li class="breadcrumb-item " aria-current="page">Certificate</li>
            <li class="breadcrumb-item active" aria-current="page">Certificate Template</li>
        </ol>
    </nav>

    <div class="col-lg-12 p-0 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-certificate"></i>Certificate Template</b></div>
            <div class="panel-body pd-b-0 row">
                <form class="container-fluid" action="{{url('MasterAdmin/GlobalSetting/CertificateTemplate')}}" method="POST"  data-parsley-validate="" novalidate="">
                {{csrf_field()}}
                    <div class="col-lg-12 row pd-l-0 pd-r-0 pd-b-15 m-0">
                    <div class="col-lg-3">
                        <label><b>Certificate :</b></label>
                        @include('components.GlobalSetting.Certificate.certificate-import',['class'=>'form-control','required'=>'required','selectid'=>request()->get('certificate_id')])
                    </div>
                    <div class="col-lg-3">
                        <label>Certificate Template :</label>
                        @include('components.GlobalSetting.Certificate.certificate-template-name-list-import',['class'=>'form-control','selectid'=>request()->get('certificate_title_slug')])
                    </div>
                    <div class="col-lg-2">
                        <button class="btn rounded-50 mg-t-20 btn-primary">Continue <i class="fa fa-arrow-right"></i></button>
                    </div>

                </div>
                </form>

                @if(request()->get('_token'))
                <form action="{{url('MasterAdmin/GlobalSetting/CreateCertificateTemplate')}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                    <div class="col-lg-12 row pd-l-0 pd-t-10 pd-r-0 bd-1 bd-t pd-b-15 m-0">
                    <div class="col-lg-3 pd-l-10">
                        <input type="hidden" name="certificate_id" @if($certificate) value="{{$certificate->id}}" @endif>
                        <label>Select Certificate <sup>*</sup> :</label>
                        <input type="text" @if($certificate) value="{{$certificate->certificate_name}}" @endif class="form-control bg-light" readonly="readonly" placeholder="Enter Certificate">
                    </div>
                    <div class="col-lg-3 pd-l-0">
                        <input type="hidden" name="certificate_template_id" @if(isset($certificatetemplate->certificate_title_slug))value="{{$certificatetemplate->certificate_title_slug}}" @endif>
                        <label>Certificate Template Name <sup>*</sup> :</label>
                        <input type="text" name="certificate_title" @if(isset($certificatetemplate->certificate_title)) value="{{$certificatetemplate->certificate_title}}" @endif class="form-control" placeholder="Enter Certificate Template">
                    </div>
                    <div class="col-lg-1">
                        <label>Editable <sup>*</sup> :</label>
                        <table>
                            <tr>
                                <td><input type="radio" name="editable" value="yes" @if(isset($certificatetemplate->editable)&&($certificatetemplate->editable=="yes")) checked @endif  @if(!isset($certificatetemplate->editable)) checked @endif></td><td class="pd-l-5">Yes</td>
                                <td class="pd-l-10"><input name="editable" value="no" type="radio"></td><td class="pd-l-5">No</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-lg-1">
                        <label>Default <sup>*</sup> :</label>
                        <table>
                            <tr>
                                <td><input type="radio" value="yes" name="default_at" checked></td><td class="pd-l-5">Yes</td>
                                <td class="pd-l-10"><input type="radio" name="default_at" value="no"></td><td class="pd-l-5">No</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-lg-2">
                        <label>Certificate Template Status <sup>*</sup> :</label>
                        <table>
                            <tr>
                                <td><input type="radio" name="status" value="active" checked></td><td class="pd-l-5">Active</td>
                                <td class="pd-l-10"><input type="radio" value="inactive" name="status"></td><td class="pd-l-5">In-Active</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-lg-10 mg-t-10 pd-l-10">
                        <label>Certificate Template Content :</label>
                        <textarea id="edit" name="template" placeholder="Enter Certificate Template" class="form-control">@if($certificatetemplate){{$certificatetemplate->template}}@endif</textarea>
                    </div>
                    <div class="col-lg-2 vhr mg-t-10 pd-r-5">
                        <button type="submit" class="btn btn-primary btn-block btn-lg">Submit <i class="fa fa-check"></i></button>
                        <button type="submit" class="btn btn-danger btn-block btn-lg"> <i class="fa fa-trash"></i> Remove</button>
                    </div>
                </div>
                </form>
                @endif

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
