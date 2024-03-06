@extends('layouts.MasterLayout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item " aria-current="page">Student Information</li>
            <li class="breadcrumb-item " aria-current="page">Reports</li>
            <li class="breadcrumb-item active" aria-current="page">Daily Library Entry Report</li>
        </ol>
    </nav>


    <div class="col-lg-12 p-0 m-0">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-list"></i> Daily Library Entry Report</b></div>
            <div class="panel-body pd-b-0 row">

                <form class="col-lg-12" action="{{route('daily.entry.report')}}" method="POST">
                    {{csrf_field()}}
                    <div class="row pd-b-10 m-0 bd-b-1">
                        <div class="col-lg-1 pd-l-0">
                            <label>Book No. :</label>
                            <input type="text" autocomplete="off" name="book_id" id="book_id" class="form-control form-control" value="{{request()->get('book_no')}}">
                        </div>

                        <div class="col-lg-1 pd-l-0">
                            <label>Barcode No. :</label>
                            <input type="text" autocomplete="off" name="book_group_id"  id="book_group_id" class="form-control form-control" value="{{request()->get('barcode_no')}}">
                        </div>

                        {{-- <div class="col-lg-1 pd-l-0">
                        <label>From :</label>
                        <input type="text" name="from_date" id="from_date" class="form-control form-control date" value="{{nowdate(request()->get('from_date'),'d-m-Y')}}">
                        </div> --}}

                        <div class="col-lg-1 pd-l-0">
                            <label>To :</label>
                            <input type="text" name="entry_date" id="entry_date" class="form-control form-control date" value="{{nowdate(request()->get('to_date'),'d-m-Y')}}">
                        </div>
                        <div class="col-lg-1 pd-l-0">
                            <label>End Date :</label>
                            <input type="text" name="end_date" id="end_date" autocomplete="off" class="form-control form-control date" @if(request()->get('end_date')) value="{{nowdate(request()->get('end_date'),'d-m-Y')}}" @endif>
                        </div>
                        <div class="col-lg-1 pd-l-0">
                            <label>Entry Mode :</label>
                            @include('components.Library.entry-mode-import',['all'=>1,'selectid'=>request()->get('entry_status')])
                        </div>

                        <div class="col-lg-2 pd-l-0">
                            <button type="submit" class="btn btn-primary mg-t-20"><i class="fa fa-search"></i> Get Result</button>
                        </div>
                    </div>
                </form>

                @if(request()->get('_token'))
                    <div class="col-lg-12 pd-l-0"><span class="float-right">@include('layouts.actionbutton.action-button-verticle')</span></div>
                    <div data-label="Example" class="col-lg-12 p-1 df-example demo-table tx-11">
                        <table id="example2" class="table table-bordered tx-11 datatable">
                            <thead class="bg-light">
                            <tr>
                                <th class="wd-5p text-center">#</th>
                                <th class="text-center">Book No.</th>
                                <th class="wd-30p">Book Title</th>
                                <th>Borrowed By</th>
                                <th class="text-center">Entry Date</th>
                                <th class="text-center">End/Return Date</th>
                                <th class="text-center">Entry Mode</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($dailyrecord as $data)
                                <tr>
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td class="text-center">{{$data->BookNo()}}</td>
                                    <td>{{$data->BookName()}}</td>
                                    <td>{!! $data->MemberName() !!}</td>
                                    <td class="text-center">{{nowdate($data->entry_date,'d-M-Y')}}</td>
                                    <td class="text-center">{{nowdate($data->end_date,'d-M-Y')}}</td>
                                    <td class="text-center">{!! $data->EntryStatus() !!}</td>
                                </tr>

                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif



            </div>
        </div>
    </div>

@endsection
