<?php

namespace App\Http\Controllers\MobileApp\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MyTimetableController extends Controller
{
    public function report()
    {
        return response()->json([
           'result'=>1,
           'message'=>'data no found',
           'success'=>[
//               [
//                   'timetable_id'=>1,
//                   'timetable_title'=>'Summar Timetable',
//                   'timetable_detail'=>'student timetable',
//                   'class_teacher'=>'amit kumar',
//                   'attachment_file'=>'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf'
//               ]
           ]
        ]);
    }
}
