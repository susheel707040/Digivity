<?php

namespace App\Http\Controllers\MobileApp\Student;

use App\Http\Controllers\Controller;
use App\Models\MasterAdmin\Admission\StudentRecord;
use App\Model\MasterAdmin\InApp\Homework;
use Illuminate\Http\Request;

class HomeworkController extends Controller
{
    public function report($studentid, $hwdate)
    {
        //get current student details
        $student = StudentRecord::query()->where('student_id', $studentid)->record()->first();

        $homeworkdata = [];
        $homework = Homework::query()->where(['course_id' => $student->course_id])
            ->where(['section_id' => $student->section_id])
            ->where(['hw_date' => nowdate($hwdate, 'Y-m-d')])
            ->where(['status' => 'yes'])->where(['with_app' => 'yes'])
            ->with(['subject', 'attachment', 'user'])->record()->get();
        if ($homework) {
            foreach ($homework as $data) {
                //if homework attachment
                $attachmentfile = [];
                if ($data->attachment) {
                    foreach ($data->attachment as $data1) {
                        $attachmentfile[] = ['file_name' => $data1->file_name, 'file_path' => asset($data1->attachment_files)];
                    }
                }
                $homeworkdata[] = [
                    'homework_id' => $data->id,
                    'subject_name' => $data->SubjectName(),
                    'homework_date' => nowdate($data->hw_date, 'd-M-Y'),
                    'homework_title' => $data->hw_title,
                    'description' => $data->homework,
                    'submited_by' => $data->user->fullName(),
                    'profile_submitted_by' => $data->user->ProfileImage(),
                    'attach' => $attachmentfile,
                ];
            }
            return response()->json([
                'result' => 1,
                'message' => 'data found!',
                'success' => $homeworkdata
            ], 200);

        } else {
            return response()->json([
                'result' => 0,
                'message' => 'no data found!',
                'success' =>null
        ], 400);
        }
    }
}
