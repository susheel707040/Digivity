@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Communication</li>
            <li class="breadcrumb-item active" aria-current="page">Compose SMS WITH</li>
        </ol>
    </nav>
    <div class="col-lg-12 p-0 m-0 tx-12">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-envelope"></i> Compose SMS</b></div>
            <div class="panel-body pd-b-0 row">

                <form class="communication" loader-disable="true" action="{{url('/MasterAdmin/Communication/SendSMS')}}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="col-lg-12 pd-5 mg-t-2 d-flex bg-white">
                        <div class="col-lg-4 p-0 m-0 flex-1">

                            <div class="card">
                                <div class="card-header bg-gray-100"><i class="fa fa-check-square"></i> Select Class-Section
                                    <span class="float-right"><input type="checkbox" class="CheckAll" value="checkbox1" @if($inputchecked==1) checked @endif> Select All</span>
                                </div>
                                <div class="card-body p-0 m-0 pd-10 pd-t-10 pd-b-10 tx-13 m-0 flex-fill">
                                    <div class="col-lg-12 pd-l-10 pd-r-10 pd-t-10 pd-b-10">
                                        @foreach(courselist() as $data)
                                            @foreach($data->coursewithsection as $data1)
                                                <span class="badge pd-5 tx-11 bd bd-1 bd-info mg-2 text-left" style="color: black;"
                                                      style=" width:31%; "> <input class="checkbox1" name="coursesectionid[]" type="checkbox" value="{{$data->id}}{{"@"}}{{$data1->section_id}}" @if($inputchecked==1) checked @endif> <span
                                                        class="pd-l-2">{{$data->course}}-({{$data1->SectionName()}})</span></span>
                                            @endforeach
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="card mg-t-10">
                                <div class="card-header bg-gray-100"><i class="fa fa-check-square"></i> Select Staff
                                    (Department & Designation)
                                    <span class="float-right"><input type="checkbox" class="CheckAll" value="checkbox2" @if($inputchecked==1) checked @endif> Select All</span>
                                </div>
                                <div class="card-body p-0 m-0 pd-10 pd-t-10 pd-b-10 tx-13 m-0 flex-fill">
                                    <div class="col-lg-12 pd-l-10 pd-r-10 pd-t-10 pd-b-10">
                                        @foreach(satffdesignationlist() as $data)
                                            <span class="badge pd-5 tx-11 bd bd-1 bd-info mg-2 text-left" style="color: black;"
                                                  style=" width:31%; "> <input class="checkbox2" name="designationid[]" type="checkbox" value="{{$data->id}}" @if($inputchecked==1) checked @endif> <span
                                                    class="pd-l-2">{{$data->designation}}</span></span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="card mg-t-10">
                                <div class="card-header bg-gray-100"><i class="fa fa-check-square"></i> Select User For
                                    Duplicate SMS Copy
                                    <span class="float-right"><input type="checkbox" class="CheckAll" value="checkbox3"
                                                                     checked> Select All</span>
                                </div>
                                <div class="card-body p-0 m-0 pd-10 pd-t-10 pd-b-10 tx-11 m-0 flex-fill">
                                    <div class="col-lg-12 pd-l-10 pd-r-10 pd-t-10 pd-b-10">
                                        <table class="table-receipt table-bordered m-0 p-0">
                                            <thead class="bg-light">
                                            <tr>
                                                <th class="text-center"><input type="checkbox" class="CheckAll checkbox3" value="checkbox3" checked></th>
                                                <th >Role</th>
                                                <th>Name</th>
                                                <th>Contact No.</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach(usersmscopylist() as $data)
                                                <tr>
                                                    <td class="text-center"><input type="checkbox" name="usercopyid[]" value="{{$data->id}}" class="checkbox3" checked></td>
                                                    <td>{{ucwords($data->designation)}}</td>
                                                    <td>{{ucwords($data->name)}}</td>
                                                    <td>{{$data->mobile_no}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>


                            <div class="card mg-t-10">
                                <div class="card-header bg-gray-100"><i class="fa fa-check-square"></i> Select Phonebook Group
                                    <span class="float-right"><input type="checkbox" class="CheckAll" value="checkbox4"> Select All</span>
                                </div>
                                <div class="card-body p-0 m-0 pd-10 pd-t-10 pd-b-10 tx-13 m-0 flex-fill">
                                    <div class="col-lg-12 pd-l-10 pd-r-10 pd-t-10 pd-b-10">
                                        @foreach(phonebookgrouplist() as $data)
                                            <span class="badge pd-5 tx-11 bd bd-1 bd-info mg-2 text-left" style="color: black;"
                                                  style=" width:45%; ">
                                       <input type="checkbox" class="checkbox4" name="phonebookgroupid[]" value="{{$data->id}}" > {{$data->phonebook_group}}
                                   </span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>


                        </div>

                        <div class="divider-text divider-vertical">and</div>

                        <div class="flex-1">
                            <div class="card mg-t-10 p-0 m-0">
                                <div class="card-header bg-gray-100"><i class="fa fa-envelope"></i> Text Message
                                </div>
                                <div class="card-body m-0 pd-0 pd-t-0 pd-b-10 tx-13 m-0 flex-fill row">
                                    @php
                                        $input_check="checked";
                                    @endphp
                                    @include('app.erpmodule.MasterAdmin.Communication.PagePlugin.sms-page-model')
                                </div>
                            </div>
                        </div>
                    </div>
                    @include('app.erpmodule.MasterAdmin.Communication.PagePlugin.sms-preview-confirm')
                </form>
            </div>
        </div>
    </div>


@endsection
