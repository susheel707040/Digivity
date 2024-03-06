@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">Timetable</li>
            <li class="breadcrumb-item active" aria-current="page">Class Wise Timetable Upload</li>
        </ol>
    </nav>

    <div class="panel panel-default">
        <div class="panel-heading"><b><i class="fa fa-upload"></i> Course - Section Upload Timetable</b></div>
        <div class="panel-body tx-12 pd-b-0 row">
            <div class="col-lg-5 mx-auto mg-t-20">
                <table class="table table-borderless tx-13">
                    <tr>
                        <td>
                            <b>Timetable :</b>
                        </td>
                        <td>
                            @include('components.Timetable.timetable-list-import')
                        </td>
                        <td>
                            <button type="button" class="btn continue-btn btn-primary">Continue <i class="fa fa-angle-right"></i></button>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="col-lg-12 row p-0 m-0 bd-t bd-2">
                <div class="col-lg-10 mg-t-15">
                    <form action="{{ route('createClassTimetable') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                    <table class="table table-bordered">
                        <thead class="bg-light">
                        <tr>
                            <td class="wd-5p text-center"><input type="checkbox"></td>
                            <td><b>Course - Section</b></td>
                            <td class="wd-30p"><b>Upload Attachment</b></td>
                            <td><b>Attachments</b></td>
                            <td class="text-center"><b>Status</b></td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach(coursesectionlist() as $data)
                            @foreach($data->sections as $data1)
                        <tr>
                            <td class="text-center"><input type="checkbox"></td>
                            <td>{{$data->course}} - {{$data1->section}}</td>
                            <td>
                                <input class="form-control input-sm mg-3" type="file">
                            </td>
                            <td></td>
                            <td></td>
                        </tr>
                            @endforeach
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-lg-2 vhr">
                    {{-- <button class="btn mg-t-15 btn-block btn-lg btn-primary"><i class="fa fa-plus"></i> Create</button> --}}
                    <button type="submit" class="btn mg-t-15 btn-block btn-lg btn-primary"><i class="fa fa-plus"></i> Create</button>
                </form>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(".continue-btn").click(function(){
         window.location.assign('/MasterAdmin/Timetable/UploadClassTimetable');
        });
    </script>
@endsection
