<?php

namespace App\Http\Controllers\MobileApp\Student;

use App\Http\Controllers\Controller;
use App\Model\MasterAdmin\InApp\Download;
use Illuminate\Http\Request;

class FileDownloadController extends Controller
{
    public function report($studentid)
    {
        $downloaddata = [];
        $download = Download::query()
            ->where(function ($query) {
                $query->where(['type' => 'all'])->orWhere(['type' => 'student']);
            })
            ->record()->get();
        if ($download) {
            foreach ($download as $data) {
                $downloaddata[] = [
                    'download_id' => $data->id,
                    'create_date' => nowdate($data->upload_date, 'd-M-Y'),
                    'download_title' => $data->download_title,
                    'description' => $data->download_details,
                    'download_file_name' => $data->file_name,
                    'download_file_path' => asset($data->file_path),
                ];
            }

            return response()->json([
                'result' => 1,
                'message' => 'data found',
                'success' => $downloaddata
            ], 200);
        } else {
            return response()->json([
                'result' => 0,
                'message' => 'data found',
                'success' => null
            ], 400);
        }
    }
}
