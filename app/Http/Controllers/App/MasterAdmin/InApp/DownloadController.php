<?php

namespace App\Http\Controllers\App\MasterAdmin\InApp;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterAdmin\InApp\DownloadRequest;
use App\Models\MasterAdmin\InApp\Download;
use App\Repositories\MasterAdmin\InApp\InAppDataRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class DownloadController extends Controller
{
    public function index()
    {
        $download = (new InAppDataRepository())->downloadlist([]);
        return view('app.erpmodule.MasterAdmin.InApp.Download.define-download', compact(['download']));
    }
    public function store(DownloadRequest $request)
{
    $validatedData = $request->validated();
    if ($request->hasFile('file_name')) {
        $file = $request->file('file_name');
        $fileName = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $filePath = 'uploads/documents/' . $fileName;
        $file->move(public_path('uploads/documents'), $fileName);
    } else {
        return back()->with('error', 'File is required.');
    }

    $validatedData['file_path'] = $filePath;
    $validatedData['file_name'] = $fileName;
    $validatedData['extension'] = $extension;

    $validatedData['upload_date'] = Carbon::createFromFormat('d-m-Y', $validatedData['upload_date'])->format('Y-m-d');

    Download::create($validatedData);

    return back()->with('success', 'Record saved successfully.');
}

    public function editview(Download $download)
    {
        return view('app.erpmodule.MasterAdmin.InApp.Download.Edit.edit-download', compact(['download']));
    }

    public function modify(Download $download, DownloadRequest $request)
    {
        $validatedData = $request->validated();

        if ($request->hasFile('file_name')) {
            if ($download->file_path) {
                $oldFilePath = public_path($download->file_path);
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            }
            $file = $request->file('file_name');
            $fileName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $filePath = 'uploads/documents/' . $fileName;
            $file->move(public_path('uploads/documents'), $fileName);

            $validatedData['file_path'] = $filePath;
            $validatedData['file_name'] = $fileName;
            $validatedData['extension'] = $extension;
        }

        // // Convert upload date format to match the database format
        // if ($request->filled('upload_date')) {
        //     $uploadDate = Carbon::createFromFormat('d-m-Y', $validatedData['upload_date'])->format('Y-m-d');
        //     $validatedData['upload_date'] = $uploadDate;
        // }

        $download->update($validatedData);
        session(['keyid' => 'editModels', 'url' => '/MasterAdmin/App/EditViewDownload/' . $download->id . '/editview']);
        return back()->with('success', 'Record Update Successfully');
    }


    /*
     * Mobile Application Controller
     */
    public function apistore($userid, Request $request)
    {
        $data = $request->all();
        /*
         * Generate Course and Section id
         */
        $course_id = null;
        $section_id = null;
        if ($request->course_id) {
            $course = explode("@", $request->course_id);
            $course_id = $course[0];
            $section_id = $course[1];
        }
        $uploaddate = nowdate($request->upload_date, 'Y-m-d');
        $datainsert = [
            'type' => strtolower($request->type),
            'course_id' => $course_id,
            'section_id' => $section_id,
            'upload_date' => $uploaddate,
            'download_title' => $request->download_title,
            'download_details' => $request->download_details,
            'show_app' => $request->show_app,
            'show_website' => $request->show_website,
            'status' => $request->status
        ];

        try {
            $download = Download::create($datainsert);

            return response()->json([
                'result' => 1,
                'message' => 'Record Save Successful Complete',
                'success' => null
            ], 200);

        } catch (\Exception $e) {
        }

        return response()->json([
            'result' => 0,
            'message' => 'Sorry, Record no Found',
            'success' => null
        ], 200);

    }

    //api download report
    public function apidownloadreport(Request $request)
    {
        $downlaoddata = [];
        $downlaod = (new InAppDataRepository())->downloadlist([]);
        $downlaoddata = collect($downlaod)->map(function ($data) {

            $attachment = [
                [
                    'file_name' => 'expert',
                    'file_path' => '',
                    'extension' => '.png'
                ]
            ];

            return [
                'db_id' => $data->id,
                'type' => $data->type,
                'upload_date' => nowdate($data->upload_date, 'd-M-Y'),
                'download_title' => $data->download_title,
                'download_details' => $data->download_details,
                'show_app' => $data->show_app,
                'show_website' => $data->show_website,
                'status' => $data->status,
                'attachment' => $attachment,
                'submitted_by' => $data->user ? $data->user->fullName() : "N/A",
                'submitted_by_profile' => $data->user ? $data->user->ProfileImage() : null,
            ];
        });

        return response()->json([
            'result' => 1,
            'message' => 'data found',
            'success' => $downlaoddata
        ], 200);

    }

    //api download remove
    public function apiremovedownload($userid, Download $download)
    {
        $download->delete();
        return response()->json([
            'result' => 1,
            'message' => 'Download Remove Successful Complete',
            'success' => null
        ], 200);
    }
}
