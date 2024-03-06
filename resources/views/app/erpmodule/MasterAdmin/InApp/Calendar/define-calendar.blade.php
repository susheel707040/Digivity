@extends('layouts.MasterLayout')
@section('ModelTitle','Add New Event & Calendar')
@section('ModelTitleInfo','Add New Event and Activity Calendar')
@section('ModelSize','modal-xl')
@section('AddModelPage')
    @include('app.erpmodule.MasterAdmin.InApp.Calendar.Add.add-calendar')
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1 mg-b-10">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">InApp</li>
            <li class="breadcrumb-item active" aria-current="page">Calendar & Event </li>
        </ol>
    </nav>
    <link href="{{url('assets/lib/fullcalendar/fullcalendar.min.css')}}" rel="stylesheet">
    <link href="{{url('assets/lib/select2/css/select2.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/css/dashforge.calendar.css')}}">
    <div class="col-lg-12 p-0 m-0 mx-auto">
        <div class="panel panel-default">
            <div class="panel-heading"><b><i class="fa fa-calendar"></i> Calendar & Event</b></div>
            <div class="panel-body pd-b-10 row" style=" height:550px; ">

                <div class="calendar-wrapper">
                    <div class="calendar-sidebar">
                        <div class="calendar-sidebar-header">
                            <i data-feather="search"></i>
                            <div class="search-form">
                                <input type="search" class="form-control" placeholder="Search calendar">
                            </div>
                            <a href="#addModels" data-toggle="modal"  class="btn btn-sm btn-primary btn-icon ">
                                <div data-toggle="tooltip"><i data-feather="plus"></i> Add Event</div>
                            </a><!-- calendar-add -->
                        </div><!-- calendar-sidebar-header -->
                        <div id="calendarSidebarBody" class="calendar-sidebar-body">

                            <div class="calendar-inline">
                                <div id="calendarInline"></div>
                            </div><!-- calendar-inline -->

                            <div class="pd-y-0 pd-x-15">
                                <label class="tx-uppercase tx-sans tx-10 tx-medium tx-spacing-1 tx-color-03 pd-l-10 mg-b-10">Calendar Type</label>
                                <nav class="calendar-nav">
                                    @foreach(calendartypelist([]) as $data)
                                        <a href="#" class="badge-{{$data->id}} show"><span></span> {{$data->calendar_type}}</a>
                                        <style>
                                            .calendar-nav a.badge-{{$data->id}} span::before{
                                                background-color: {{$data->color}};
                                            }
                                            .calendar-nav a.badge-{{$data->id}} span{
                                                border-color:{{$data->color}};
                                            }
                                        </style>
                                    @endforeach
                                </nav>
                            </div>

                            <div class="pd-20 mg-b-20">
                                <label class="tx-uppercase tx-sans tx-10 tx-medium tx-spacing-1 tx-color-03 mg-b-15">Upcoming Events</label>
                                <div class="schedule-group">
                                    <a href="#" class="schedule-item bd-l bd-2 bd-danger">
                                        <h6>Company Standup Meeting</h6>
                                        <span>8:00am - 9:00am, Engineering Room</span>
                                    </a><!-- schedule-item -->
                                    <a href="#" class="schedule-item bd-l bd-2 bd-success">
                                        <h6>Start Dashboard Concept</h6>
                                        <span>9:30am - 11:30am, Office Desk</span>
                                    </a><!-- schedule-item -->
                                    <a href="#" class="schedule-item bd-l bd-2 bd-primary">
                                        <h6>Chat Design Presentation</h6>
                                        <span>2:30pm - 3:00pm, Visual Room</span>
                                    </a><!-- schedule-item -->
                                </div><!-- schedule-group -->
                            </div>
                        </div><!-- calendar-sidebar-body -->
                    </div><!-- calendar-sidebar -->

                    <div class="calendar-content">
                        <div id="calendar" class="calendar-content-body"></div>
                    </div><!-- calendar-content -->
                </div><!-- calendar-wrapper -->

                <div class="modal calendar-modal-create fade effect-scale" id="modalCreateEvent" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-body pd-20 pd-sm-30">
                                <button type="button" class="close pos-absolute t-20 r-20" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true"><i data-feather="x"></i></span>
                                </button>

                                <h5 class="tx-18 tx-sm-20 mg-b-20 mg-sm-b-30">Create New Event</h5>

                                <form id="formCalendar" method="post" action="http://themepixels.me/dashforge/template/classic/app-calendar.html">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Add title">
                                    </div><!-- form-group -->
                                    <div class="form-group d-flex align-items-center">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input" checked>
                                            <label class="custom-control-label" for="customRadio1">Event</label>
                                        </div>
                                        <div class="custom-control custom-radio mg-l-20">
                                            <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input" checked>
                                            <label class="custom-control-label" for="customRadio2">Reminder</label>
                                        </div>
                                    </div><!-- form-group -->
                                    <div class="form-group mg-t-30">
                                        <label class="tx-uppercase tx-sans tx-11 tx-medium tx-spacing-1 tx-color-03">Start Date</label>
                                        <div class="row row-xs">
                                            <div class="col-7">
                                                <input id="eventStartDate" type="text" value="" class="form-control" placeholder="Select date">
                                            </div><!-- col-7 -->
                                            <div class="col-5">
                                                <select class="custom-select">
                                                    <option selected>Select Time</option>
                                                </select>
                                            </div><!-- col-5 -->
                                        </div><!-- row -->
                                    </div><!-- form-group -->
                                    <div class="form-group">
                                        <label class="tx-uppercase tx-sans tx-11 tx-medium tx-spacing-1 tx-color-03">End Date</label>
                                        <div class="row row-xs">
                                            <div class="col-7">
                                                <input id="eventEndDate" type="text" value="" class="form-control" placeholder="Select date">
                                            </div><!-- col-7 -->
                                            <div class="col-5">
                                                <select class="custom-select">
                                                    <option selected>Select Time</option>
                                                </select>
                                            </div><!-- col-5 -->
                                        </div><!-- row -->
                                    </div><!-- form-group -->
                                    <div class="form-group">
                                        <textarea class="form-control" rows="2" placeholder="Write some description (optional)"></textarea>
                                    </div><!-- form-group -->
                                </form>
                            </div><!-- modal-body -->
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary mg-r-5">Add Event</button>
                                <a href="#" class="btn btn-secondary" data-dismiss="modal">Discard</a>
                            </div><!-- modal-footer -->
                        </div><!-- modal-content -->
                    </div><!-- modal-dialog -->
                </div><!-- modal -->

                <div class="modal calendar-modal-event fade effect-scale" id="modalCalendarEvent" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h6 class="event-title"></h6>
                                <nav class="nav nav-modal-event">
                                    <a href="#" class="nav-link"><i data-feather="external-link"></i></a>
                                    <a href="#" class="nav-link"><i data-feather="trash-2"></i></a>
                                    <a href="#" class="nav-link" data-dismiss="modal"><i data-feather="x"></i></a>
                                </nav>
                            </div><!-- modal-header -->
                            <div class="modal-body">
                                <div class="row row-sm">
                                    <div class="col-sm-6">
                                        <label class="tx-uppercase tx-sans tx-11 tx-medium tx-spacing-1 tx-color-03">Start Date</label>
                                        <p class="event-start-date"></p>
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="tx-uppercase tx-sans tx-11 tx-medium tx-spacing-1 tx-color-03">End Date</label>
                                        <p class="event-end-date"></p>
                                    </div><!-- col-6 -->
                                </div><!-- row -->

                                <label class="tx-uppercase tx-sans tx-11 tx-medium tx-spacing-1 tx-color-03">Description</label>
                                <p class="event-desc tx-gray-900 mg-b-40"></p>

                                <a href="#" class="btn btn-secondary pd-x-20" data-dismiss="modal">Close</a>
                            </div><!-- modal-body -->
                        </div><!-- modal-content -->
                    </div><!-- modal-dialog -->
                </div><!-- modal -->


            </div>
        </div>
    </div>

    <style>
        .ui-datepicker{ box-shadow:none; }
    </style>
    <script src="{{url('/assets/lib/moment/min/moment.min.js')}}"></script>
    <script src="{{url('/assets/lib/fullcalendar/fullcalendar.min.js')}}"></script>
    @section('eventscript')
        // sample calendar events data
        'use strict'
        var curYear = moment().format('YYYY');
        var curMonth = moment().format('MM');
        var event_Source=new Array();
        var otherEvents = {
            id: 6,
            backgroundColor: 'rgba(253,126,20,.25)',
            borderColor: '#fd7e14',
            events: [
                {
                    id: '16',
                    start: curYear+'-'+curMonth+'-06',
                    end: curYear+'-'+curMonth+'-08',
                    title: 'My Rest Day'
                },
                {
                    id: '17',
                    start: curYear+'-'+curMonth+'-29',
                    end: curYear+'-'+curMonth+'-31',
                    title: 'My Rest Day'
                }
            ]
        };
            @foreach(calendartypelist([]) as $data)
            @php
                $calendararr=collect($calendar)->where('calendar_type_id',$data->id);
            @endphp
            @if($calendararr)

            var event_{{$data->id}}={
            id:{{$data->id}},
            backgroundColor: '{{$data->color}}',
                borderColor: '{{$data->color}}',
                events: [
                    @foreach($calendararr as $data1)
                {
                    id: {{$data1->id}},
                    start: '{{$data1->start_date}}T08:30:00',
                    end: '{{$data1->end_date}}T13:00:00',
                    title: '{{$data1->calendar_title}}',
                    description:'',

                },
                @endforeach
            ]
        };
            var objectval=event_{{$data->id}};
            event_Source.push(objectval);
         @endif
        @endforeach
    @endsection
<script>
    @yield('eventscript')
    console.log(event_Source);
</script>
    <script id="fullcalendar" src="{{url('/assets/js/dashforge.calendar.js')}}"></script>
    <script>
        $(function(){
            'use strict'

            // Initialize scrollbar for sidebar
            new PerfectScrollbar('#calendarSidebarBody', {
                suppressScrollX: true
            });

            $('#calendarSidebarShow').on('click', function(e){
                e.preventDefault()
                $('body').toggleClass('calendar-sidebar-show');

                $(this).addClass('d-none');
                $('#mainMenuOpen').removeClass('d-none');
            })

            $(document).on('click touchstart', function(e){
                e.stopPropagation();
                // closing of sidebar menu when clicking outside of it
                if(!$(e.target).closest('.burger-menu').length) {
                    var sb = $(e.target).closest('.calendar-sidebar').length;
                    if(!sb) {
                        $('body').removeClass('calendar-sidebar-show');

                        $('#mainMenuOpen').addClass('d-none');
                        $('#calendarSidebarShow').removeClass('d-none');
                    }
                }
            });

        })
    </script>


@endsection
