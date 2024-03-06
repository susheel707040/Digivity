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
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">Mobile App</li>
            <li class="breadcrumb-item active" aria-current="page">About School</li>
        </ol>
    </nav>
    <div class="col-lg-12 p-0 m-0 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-info-circle"></i> About School</b></div>
            <div class="panel-body pd-b-0 row">
                <div class="col-lg-12 bd-1 bd-b pd-t-10 pd-b-10">
                    <table class="col-lg-6">
                        <tr>
                            <td class="wd-100">
                                <label><b>Page Name :</b></label>
                            </td>
                            <td>
                                <select id="page_id" class="form-control input-sm" required>
                                    <option value="">---Select---</option>
                                    @foreach($pagename as $key=>$value)
                                        <option value="{{$key}}" @if(request()->route('pageid')==$key) selected @endif>{{$value}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="wd-150">
                                <button type="button" class="btn btn-continue btn-success mg-l-15">Continue <i class="fa fa-arrow-right"></i></button>
                            </td>
                        </tr>
                    </table>
                </div>
                @if(request()->route('pageid'))
                <form action="{{url('MasterAdmin/MobileApp/CreateAboutSchool')}}" class="col-lg-12 row m-0 p-0" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                    <div class="col-lg-10 pd-b-10 pd-t-10">
                    <lable class="tx-13"><b>{{$pagename[request()->route('pageid')]}} Body Containt <sup>*</sup>:</b></lable>
                    <input type="hidden" name="page_id" value="{{request()->route('pageid')}}">
                    <textarea id="edit" name="body_data" style="margin-top: 30px; height:40%; display: none;">@if(isset($pagedata)){{$pagedata->body_data}}@endif</textarea>
                </div>
                <div class="col-lg-2 vhr">
                    <button type="submit" class="btn btn-primary mg-t-10 mg-b-10 btn-block btn-lg"><i class="fa fa-check"></i> Submit</button>
                    <button type="submit" class="btn btn-danger  mg-t-10 mg-b-10 btn-block "><i class="fa fa-trash"></i> Remove</button>
                </div>
                </form>
                @endif
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(".btn-continue").click(function () {
            loader('block');
            if($("#page_id").val()!=0){
                window.location.assign('/MasterAdmin/MobileApp/AboutSchool/'+$("#page_id").val()+'/search');
            }else{
                window.location.assign('/MasterAdmin/MobileApp/AboutSchool');
            }
        });
    </script>
    <style>
        #alert-msg{ width:40%; font-size:1.2rem; float:right; text-align:center; padding-top:4px; padding-bottom:6px;
            border-radius:10px; }
        .fr-box > div:nth-last-child(2) { display:none; }
        .fr-wrapper{ display: block !important;}
    </style>
    <script type="text/javascript" src="{{url('assets/lib/froala-editor/js/froala_editor.pkgd.min.js')}}"></script>
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
