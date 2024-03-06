@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="{{url('/home')}}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Student Information</li>
            <li class="breadcrumb-item active" aria-current="page">Student Registration</li>
            <li class="breadcrumb-item active" aria-current="page">Edit Student Prospectus</li>
        </ol>
    </nav>


            <form action="{{url('MasterAdmin/StudentInformation/EditProspectus/'.$studentprospectus->id.'/edit')}}" method="POST" enctype="multipart/form-data"  data-parsley-validate="" novalidate="">
                {{csrf_field()}}
                <div class="panel panel-default">
                    <div class="panel-heading"><b><i class="fa fa-file"></i> Edit Prospectus Detail</b></div>
                    <div class="panel-body pd-b-15 tx-13">
                        <div class="row pd-0 m-0">
                            <div class="col-lg-3 pd-l-0">
                                @include('app.erpmodule.MasterAdmin.StudentInformation.Entry.FromIng.ProspectusFirstInfo')
                            </div>
                            <div class="col-lg-7 m-0 pd-l-10 pd-r-10 vhr">
                                @include('app.erpmodule.MasterAdmin.StudentInformation.Entry.FromIng.ProspectusStudentInfo')
                            </div>
                            <div class="col-lg-2 vhr">

                                <button type="submit" class="btn btn-block btn-outline-success tx-13 tx-bold mg-t-10 btn-lg rounded-pill">Update <i
                                        class="fa fa-arrow-right"></i></button><br/>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

@endsection
