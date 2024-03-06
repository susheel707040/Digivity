@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="#">Library</a></li>
            <li class="breadcrumb-item"><a href="#">Entry</a></li>
            <li class="breadcrumb-item active" aria-current="page">Issue Book/Item</li>
        </ol>
    </nav>

    <div class="col-lg-12 p-0 m-0 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i> Issue Books/Items</b></div>
            <div class="panel-body pd-b-0 pd-r-0 row ">
                <div class="col-lg-12 p-0 mg-t-10">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link @if(!request()->route('selectuserid')&&!request()->route('selectuser')) active @endif " id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><b><i class="fa fa-user-check"></i>Search and Select Student/Staff</b></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if(request()->route('selectuserid')&&request()->route('selectuser')) active @endif" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false"><b><i class="fa fa-book-reader"></i>Search and Select Books/Item</b></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false"><b><i class="fa fa-history"></i> Student Library Full History</b></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#book" role="tab" aria-controls="book" aria-selected="false"><b><i class="fa fa-book"></i> Book/Item Details</b></a>
                        </li>
                    </ul>

                    <div class="tab-content bd-t-0 pd-20" id="myTabContent">

                        <div class="tab-pane fade @if(!request()->route('selectuserid')&&!request()->route('selectuser')) show active @endif" id="home" role="tabpanel" aria-labelledby="home-tab">
                            @include('app.erpmodule.MasterAdmin.Library.Entry.Pages.search-and-select-student-staff')
                        </div>

                        <div class="tab-pane row fade @if(request()->route('selectuserid')&&request()->route('selectuser')) show active @endif" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            @include('app.erpmodule.MasterAdmin.Library.Entry.Pages.search-and-select-book')
                        </div>

                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                            <h6>Coming Soon</h6>
                        </div>

                        <div class="tab-pane fade" id="book" role="tabpanel" aria-labelledby="contact-tab">
                            <h6>Coming Soon book</h6>
                        </div>
                    </div>


                </div>

            </div>
        </div>
    </div>

@endsection
