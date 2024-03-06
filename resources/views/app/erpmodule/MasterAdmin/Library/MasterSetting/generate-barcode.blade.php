@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="#">Library</a></li>
            <li class="breadcrumb-item" aria-current="page">Master Setting</li>
            <li class="breadcrumb-item active" aria-current="page">Generate Barcode</li>
        </ol>
    </nav>

    <div class="col-lg-12 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-plus"></i> Generate Barcode</b></div>
            <div class="panel-body pd-b-0 row">

                <form class="wd-100p m-0 p-0" action="{{url('MasterAdmin/Library/DefineBooks')}}" method="POST">
                    {{csrf_field()}}
                    <div class="col-lg-12 row m-0 p-0">
                        <div class="col-lg-2 pd-l-5 pd-r-5">
                            <label><b>Library :</b></label>
                            @include('component.Library.library-import',['selectid'=>request()->get('library_id')])
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
