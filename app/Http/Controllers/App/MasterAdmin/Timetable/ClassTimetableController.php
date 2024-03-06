<?php

namespace App\Http\Controllers\App\MasterAdmin\Timetable;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterAdmin\Timetable\TimeTableRecord;



class ClassTimetableController extends Controller
{
    public function index()
    {
        return view('app.erpmodule.MasterAdmin.Timetable.Entry.course-upload-timetable');
    }

    public function store(Request $request)
    {
        dd($request->all());
        $request->validate([
            'file_path' => 'required',
        ]);

        if ($request->hasFile('file_path')) {
            $file = $request->file('file_path');
            $filePath = $file->store('timetables');

            // Save the file path to the database
            $timetableRecord = new TimetableRecord();
            $timetableRecord->file_path = $filePath;
            $timetableRecord->save();

            return redirect()->back()->with('success', 'Timetable uploaded successfully');
        }

        // Handle if no file is uploaded
        return redirect()->back()->with('error', 'No file uploaded');
    }
    }
