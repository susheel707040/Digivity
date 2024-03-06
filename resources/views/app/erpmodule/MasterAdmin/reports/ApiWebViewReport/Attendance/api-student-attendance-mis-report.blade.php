@extends('layouts.api-web-view-master-layout')
@section('content')

    <div id="calender-modal" class="calender-modal">
        <div class="header-title" onclick="closeModal()">Amit Kumar Attendance Register
        <span class="close-btn" onclick="closeModal()">X</span>
        </div>
        <div id="modal-data"></div>
    </div>


    <div class='col-12 p-2 tx-13'>
        <table cellpadding='0' cellspacing='0' class='table table-bordered bg-light-dark'>
            <tbody>
            <tr>
                <td colspan="2"><b>Date :</b> {{$from_date}} <b>~</b> {{$to_date}}</td>
            </tr>
            <tr>
                <td><b>Class/Course : </b></td>
            </tr>
            <tr>
                <td><b>Months :</b></td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class='col-12 p-2'>
        <table class="table table-bordered">
            <thead class="bg-light">
            <tr>
                <th>Student Details</th>
                <th class="text-center">Action</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Amit Kumar
                <div id="mis-report-1" hidden>
                    {{draw_calendar(12,2020)}}
                    {{draw_calendar(01,2021)}}
                </div>
                </td>
                <td><button onclick="showModal(1)">Show Register</button></td>
            </tr>
            </tbody>
        </table>
    </div>

    <style>
        .calender-modal{
            display: none;
            position: absolute;
            top:1%;
            z-index: 1;
            left:1%;
            right:1%;
            width: 98%;
            height:auto;
            background-color:white;
            box-shadow: 0px 0px 10px 0px black;
            transition: width 2s, height 4s;
        }
        .header-title{
            width:100%;
            height:auto ;
            padding: 10px 10px;
            background-color:#0061AB;
            color: white;
            font-size:1.2rem ;
        }
        .modal-data{ width:98%; padding:1%; height:auto; }
        .close-btn{ position:absolute; color:white; top:8px;  right:15px; font-weight:bold;
        font-size:1.2rem; }
        /* calendar */
        table.calendar{ margin:1%;  border-left:1px solid #999; }
        tr.calendar-row	{  }
        td.calendar-day	{ min-height:80px; font-size:11px; position:relative; } * html div.calendar-day { height:80px; }
        td.calendar-day:hover { background:#eceff5; }
        td.calendar-day-np { background:#eee; min-height:80px; } * html div.calendar-day-np { height:80px; }
        td.calendar-day-head { background:#D6EAF8; font-weight:bold; text-align:center; width:120px; padding:5px; border-bottom:1px solid #999; border-top:1px solid #999; border-right:1px solid #999; }
        div.day-number { background:#D6EAF8; padding:5px; color:black; font-weight:bold; float:right; margin:-5px -5px 0 0; width:20px; text-align:center; }
        /* shared */
        td.calendar-day, td.calendar-day-np { width:120px; padding:5px; border-bottom:1px solid #999; border-right:1px solid #999; }
        tr.top-calendar-heading{ background-color:#fff;  }
        tr.top-calendar-heading td { padding:4px; text-align: center; font-weight:bold;
        border-top:1px solid silver; border-right:1px solid silver;  ;
        }
    </style>
    <script type="text/javascript">
        function showModal() {
            document.getElementById("calender-modal").style.display = "block";
            var data_text=document.getElementById("mis-report-1").innerText;
            document.getElementById("modal-data").innerHTML=data_text;
        }
        function closeModal() {
            document.getElementById("calender-modal").style.display = "none";
        }
    </script>

@endsection
<?php
/* draws a calendar */
function draw_calendar($month,$year){

    /* draw table */
    $calendar = '<table cellpadding="0" cellspacing="0" class="calendar">';
    $calendar.="<tr class='top-calendar-heading'><td colspan='7'>".date("M - Y",strtotime("$year-$month-01"))."</td></tr>";
    /* table headings */
    $headings = array('Sun','Mon','Tue','Wed','Thu','Fri','Sat');
    $calendar.= '<tr class="calendar-row"><td class="calendar-day-head">'.implode('</td><td class="calendar-day-head">',$headings).'</td></tr>';

    /* days and weeks vars now ... */
    $running_day = date('w',mktime(0,0,0,$month,1,$year));
    $days_in_month = date('t',mktime(0,0,0,$month,1,$year));
    $days_in_this_week = 1;
    $day_counter = 0;
    $dates_array = array();

    /* row for week one */
    $calendar.= '<tr class="calendar-row">';

    /* print "blank" days until the first of the current week */
    for($x = 0; $x < $running_day; $x++):
        $calendar.= '<td class="calendar-day-np"> </td>';
        $days_in_this_week++;
    endfor;

    /* keep going with days.... */
    for($list_day = 1; $list_day <= $days_in_month; $list_day++):
        $calendar.= '<td class="calendar-day">';
        /* add in the day number */
        $calendar.= '<div class="day-number">'.$list_day.'</div>';

        /** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! **/
        $calendar.= str_repeat('<p> </p>',2);

        $calendar.= '</td>';
        if($running_day == 6):
            $calendar.= '</tr>';
            if(($day_counter+1) != $days_in_month):
                $calendar.= '<tr class="calendar-row">';
            endif;
            $running_day = -1;
            $days_in_this_week = 0;
        endif;
        $days_in_this_week++; $running_day++; $day_counter++;
    endfor;

    /* finish the rest of the days in the week */
    if($days_in_this_week < 8):
        for($x = 1; $x <= (8 - $days_in_this_week); $x++):
            $calendar.= '<td class="calendar-day-np"> </td>';
        endfor;
    endif;

    /* final row */
    $calendar.= '</tr>';

    /* end the table */
    $calendar.= '</table>';

    /* all done, return result */
    return $calendar;
}
?>