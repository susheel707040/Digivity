<?php

namespace App\Http\Controllers\App\MasterAdmin\Admission\MasterUpdate;

use App\Helper\FileUpload;
use App\Http\Controllers\Controller;
use App\Models\MasterAdmin\AcademicSetting\StudentDocumentType;
use App\Models\MasterAdmin\Admission\StudentDocumentRecord;
use App\Models\MasterAdmin\Admission\StudentRecord;
use App\Repositories\MasterAdmin\GlobalSetting\CommanDataRepository;
use App\Repositories\MasterAdmin\StudentInformation\StudentRepository;
use Illuminate\Http\Request;

class StudentDocumentUpdateController extends Controller
{
    use FileUpload;
    public function index(Request $request)
    {
        $student = (new StudentRepository())->studentshortlist($request->all());
        $document = (new CommanDataRepository())->studentdocumenttypelist();
        return view('app.erpmodule.MasterAdmin.StudentInformation.MasterUpdate.student-document-update', compact(['student', 'document']));
    }

    public function uploadindex(StudentRecord $studentrecord, $documentid)
    {
        $documentid = explode(",", $documentid);
        $document = StudentDocumentType::query()->whereIn('id', $documentid)->get();
        return view('app.erpmodule.MasterAdmin.StudentInformation.MasterUpdate.student-document-upload-index', compact(['studentrecord', 'document']));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        if (isset($request->student_id)) {
            if (count($request->document_id) > 0) {
                foreach ($request->document_id as $documentid) {
                    StudentDocumentRecord::query()->where(['student_id' => $request->student_id, 'document_id' => $documentid])->forceDelete();
                    $fileid = null;
                    try {
                        if (($request->file("document_file_" . $documentid))) {
                            $fileresult = $this->upload($request->file("document_file_" . $documentid), ['integrate' => 'document']);
                            $fileid = $fileresult['file_id'];
                        }
                    } catch (\Exception $e) {
                    }

                    $data2 = [
                        'student_id' => $request->student_id,
                        'document_id' => $documentid,
                        'document_name' => $request["document_type_" . $documentid],
                        'document_no' => $request["document_no_" . $documentid],
                        'document_file' => $fileid,
                    ];
                    $insertresult = StudentDocumentRecord::create($data2);
                    if ($insertresult) {
                        return response()->json([
                            'result' => 1,
                            'message' => 'Document Upload Successful Complete',
                            'studentid' => $request->student_id,
                            'document_status' => 'yes',
                            'status' => 'success'
                        ]);
                    }
                }
            }
        }
        return response()->json([
            'result' => 0,
            'message' => 'Sorry, Request failed, Please try again.',
            'studentid' => $request->student_id,
            'document_status' => 'no',
            'status' => 'danger'
        ]);
    }

    public function studentdocumentremove(StudentRecord $studentid, $documentids)
{
    $student = StudentRecord::find($studentid);
    if (!$student) {
        return response()->json([
            'result' => '0',
            'message' => 'Student not found.',
            'status' => 'danger'
        ], 404);
    }

    $documentids = explode(",", $documentids);
    $removecount = 0;
    foreach ($documentids as $documentid) {
        // Ensure $student is not null before accessing its properties
        if ($student) {
            $result = StudentDocumentRecord::query()
                ->where(['student_id' => $student->id, 'document_id' => $documentid])
                ->forceDelete();
            if ($result) {
                $removecount++;
            }
        }
    }

    if ($removecount > 0) {
        return response()->json([
            'result' => '1',
            'message' => 'Document Remove Successful Complete.',
            'studentid' => $student->id,
            'documentids' => implode(",", $documentids),
            'status' => 'success'
        ], 200);
    }

    return response()->json([
        'result' => '0',
        'message' => 'Sorry, Request failed, Please try again.',
        'status' => 'danger'
    ], 200);
}

}
