@extends('layouts.MasterLayout')

@section('ModelTitle','Add New Staff Qualification')
@section('ModelTitleInfo','Manage Staff Qualification')
@section('EditModelTitle','Edit Staff Qualification')
@section('EditModelTitleInfo','Modify Staff Qualification')

@section('AddModelPage')
    @include('app.erpmodule.MasterAdmin.Staff.MasterSetting.Add.add-qualification')
@endsection

@section('EditModelPage')
    @include('app.erpmodule.MasterAdmin.Staff.MasterSetting.Edit.edit-qualification')
@endsection



@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Staff</li>
            <li class="breadcrumb-item active" aria-current="page">Master Setting</li>
            <li class="breadcrumb-item active" aria-current="page">Define Staff Qualification</li>
        </ol>
    </nav>

    <div class="col-lg-12 p-0 m-0 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i> Staff Qualification List</b></div>
            <div class="panel-body pd-b-0 row">
                <div class="col-lg-2">
                    @include('layouts.actionbutton.ActionButton')
                </div>

                <div class="col-lg-10 vhr">
                    <div data-label="Example" class="df-example demo-table">
                        <table id="example2" class="table datatable table-bordered" >
                            <thead>
                            <tr>
                                <th class="wd-10p text-center">Sl.No.</th>
                                <th>Qualification</th>
                                <th class="text-center">Default Set</th>
                                <th class="text-center">Modify Datekkk</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($qualification as $data)
                                <tr editurl="{{url('MasterAdmin/Staff/EditViewQualification/'.$data->id.'/editview')}}" deleteurl="{{url('/RecordDelete/'.$data->id.'/'.$data->getTable().'/delete')}}">
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td>{{$data->qualification}}</td>
                                    <td class="text-center">@if($data->default_at=="yes")<span class="badge badge-success">Active</span>@endif</td>
                                    <td class="text-center">{{\App\Helper\DateFormat::date($data->updated_at)}}</td>
                                     <td>
                                     <a href="{{route('edit_view_qualification',$data->id)}}" data-toggle="modal" data-target="#editModels" class="btn btn-block btn-outline-success btn-edit mg-t-10 btn-sm" ><i class="fa fa-edit"></i> Edit</a>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

    </div>
    {{-- <script>
        $('#editModels').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var qualificationId = button.data('qualification-id'); // Extract info from data-* attributes

            // Use Ajax to fetch data for the qualification and fill the modal fields
            $.ajax({
                url: '/MasterAdmin/Staff/EditQualification/' + qualificationId + '/edit',
                method: 'GET',
                success: function (data) {
                    // Populate modal fields with data
                    $('#qualification').val(data.qualification);
                    $('#default_at').prop('checked', data.default_at === 'yes');
                },
                error: function (error) {
                    console.error('Error fetching data:', error);
                }
            });
        });
    </script> --}}


@endsection
