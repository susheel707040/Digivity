<?php

namespace App\Http\Controllers\MobileApp\Student;

use App\Http\Controllers\Controller;
use App\Model\MasterAdmin\InApp\Notice;
use Illuminate\Http\Request;

class NoticeController extends Controller
{
    public function report()
    {
        $noticedata = [];
        $notice = Notice::query()->with(['attachment', 'user'])->get();
        if ($notice) {
            foreach ($notice as $data) {
                //notice attachment file
                $noticeattachment = [];
                if (isset($data->attachment)) {
                    foreach ($data->attachment as $data1) {
                        $noticeattachment[] = ['file_name' => $data1->file_name, 'file_path' => asset($data1->file_path),'extension'=>$data1->extension];
                    }
                }
                $noticedata[] = [
                    'notice_id' => $data->id,
                    'notice_date' => nowdate($data->notice_date, 'd-M-Y'),
                    'notice_title' => $data->notice_title,
                    'description' => $data->notice,
                    'attach_file' => $noticeattachment,
                    'submitted_by' => $data->user->fullName(),
                    'profile_submitted_by' => asset($data->user->profile_img)
                ];
            }

            return response()->json([
                'result' => 1,
                'message' => 'data found',
                'success' => $noticedata
            ], 200);
        } else {
            return response()->json([
                'result' =>0,
                'message' => 'no data found',
                'success' => null
            ], 400);
        }
    }
}
