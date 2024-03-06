<?php

namespace App\Http\Controllers\MobileApp\Student;

use App\Http\Controllers\Controller;
use App\Model\MasterAdmin\InApp\Calendar;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function report($studentid,$calenderdate)
    {
        $calendardata=[];
        $calendar=Calendar::query()->where(['show_app'=>'yes'])->with(['calendartype','attachment','user'])->record()->get();
        if($calendar){
            foreach ($calendar as $data){
                /**
                 * if calendar attachment file get
                 */
                $attachment=[];
                if(isset($data->attachment)){
                    foreach ($data->attachment as $data1){
                        $attachment[]=[
                          'file_name'=>$data1->file_name,
                          'file_path'=>asset($data1->file_path)
                        ];
                    }
                }
                /**
                 * calendar data get
                 */
                $calendardata[]=[
                    'calender_id'=>$data->id,
                    'title'=>$data->calendar_title,
                    'description'=>$data->calendar_details,
                    'start_date'=>nowdate($data->start_date,'d-m-Y'),
                    'start_time'=>$data->start_time,
                    'end_date'=>nowdate($data->end_date,'d-m-Y'),
                    'end_time'=>$data->end_date,
                    'type'=>$data->calendartype->calendar_type,
                    'type_color'=>$data->calendartype->color,
                    'attachment'=>$attachment,
                    'submit_by'=>$data->user->fullName(),
                    'submit_by_profile'=>$data->user->ProfileImage()
                ];
            }
            return response()->json([
                'result' => 1,
                'message' => 'data found',
                'success' =>$calendardata
            ],200);
        }else{
            return response()->json([
               'result'=>0,
               'message'=>'data no found',
               'success'=>null
            ],400);
        }
    }
}
