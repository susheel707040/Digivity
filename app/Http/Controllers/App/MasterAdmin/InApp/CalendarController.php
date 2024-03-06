<?php

namespace App\Http\Controllers\App\MasterAdmin\InApp;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterAdmin\InApp\CalendarRequest;
use App\Models\MasterAdmin\InApp\Calendar;
use App\Models\MasterAdmin\InApp\CalendarAttachmentFile;
use App\Repositories\MasterAdmin\InApp\InAppDataRepository;
use Carbon\Carbon;
use Extsalt\Otp\Facades\SMS;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index()
    {
        $calendar=(new InAppDataRepository())->calendarlist([]);
        return view('app.erpmodule.MasterAdmin.InApp.Calendar.define-calendar',compact(['calendar']));
    }

    public function store(CalendarRequest $request)
    {
        // dd($request->all());
        $validatedData = $request->validated();
        $request->merge(['start_date'=>Carbon::createFromDate($request->start_date)->format('Y-m-d')]);
        $request->merge(['end_date'=>Carbon::createFromDate($request->end_date)->format('Y-m-d')]);
        $calendar=Calendar::create($request->all());
        if($calendar){
            if($request->hasFile('file_name')) {
                $file = $request->file('file_name');
                $fileName = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $filePath = 'uploads/Calender/' .$fileName;
                $file->move(public_path('uploads/Calender'),$fileName );
                    $data=[
                        'calendar_id'=>$calendar->id,
                        'file_name'=>$fileName,
                        'file_path'=>$filePath,
                        'extension'=>$extension,
                        'user_id'=>$calendar->user_id
                    ];
                    CalendarAttachmentFile::create($data);
                }

            return back()->with('success','Calender Record Save Successfully');
        }
        return back()->with('danger','Sorry, Request failed, Please Try Again.');
    }

    public function editview(Calendar $calendar)
    {
        return view('app.erpmodule.MasterAdmin.InApp.Calendar.Edit.edit-calendar',compact(['calendar']));
    }

    public function modify(Calendar $calendar, CalendarRequest $request)
    {
        $validatedData = $request->validated();
        $request->merge(['start_date'=>Carbon::createFromDate($request->start_date)->format('Y-m-d')]);
        $request->merge(['end_date'=>Carbon::createFromDate($request->end_date)->format('Y-m-d')]);

        // Update calendar data
        $calendar->update($request->all());

        // Handle file update
        if($request->hasFile('file_name')) {
            $oldFilePath = $calendar->attachmentFile->file_path;
            $oldFileName = $calendar->attachmentFile->file_name;

            // Delete old file
            if (file_exists(public_path($oldFilePath))) {
                unlink(public_path($oldFilePath));
            }

            // Upload new file
            $file = $request->file('file_name');
            $fileName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $filePath = 'uploads/Calender/' .$fileName;
            $file->move(public_path('uploads/Calender'), $fileName);

            // Update file details in the database
            $calendar->attachmentFile()->update([
                'file_name' => $fileName,
                'file_path' => $filePath,
                'extension' => $extension,
            ]);
        }

        return back()->with('success','Calendar Record Updated Successfully');
    }


    /**
     * full calendar
     */
    public function fullcalendar()
    {
        $insertArr = [
            'id'=>1,
            'title' => 'hhggj',
            'start' => '01-04-2020',
            'end' => '02-04-2020'
        ];
        return response()->json($insertArr);
    }
    /*
     * Mobile Application api Route
     */

    public function apistoreactivity()
    {
        return response()->json([
           'result'=>1,
           'message'=>'Record Save Successful Complete',
           'success'=>null
        ]);
    }

    //remove activity
    public function apiremoveactivity($userid,Calendar $calendar)
    {
        $calendar->delete();
        return response()->json([
            'result' => 1,
            'message' => 'Calender/Activity Remove Successful Complete',
            'success' => null
        ]);
    }
}
