<?php

namespace App\Http\Controllers\MasterAdmin\Timetable;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StaffTimetableController extends Controller
{
    /*
     * Mobile Application Controller
     */

    public function apimytimetable($userid, $staffid)
    {
        return response()->json([
            'result' => 1,
            'message' => 'record available',
            'success' => [
               /* [
                    'timetable_id' => 1,
                    'timetable_title' => 'My all Class Timetable',
                    'update_on'=>nowdate('','d-m-Y'),
                    'is_new'=>'yes',
                    'attachment_file'=>[
                        [
                            'file_name'=>'pdf.pdf',
                            'extension'=>'.pdf',
                            'file_path'=>'http://www.pdf995.com/samples/pdf.pdf'
                        ]
                    ],
                    'submitted_by'=>'Amit Kumar',
                    'submitted_by_profile'=>null
                ]*/
            ]
        ]);
    }
}
