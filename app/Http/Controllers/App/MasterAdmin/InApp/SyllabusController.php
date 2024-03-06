<?php

namespace App\Http\Controllers\App\MasterAdmin\InApp;

use App\Helper\FileUpload;
use App\Http\Controllers\Controller;
use App\Http\Requests\MasterAdmin\InApp\SyllabusRequest;
use App\Models\MasterAdmin\InApp\Syllabus;
use App\Models\MasterAdmin\InApp\SyllabusAttachmentFile;
use App\Repositories\MasterAdmin\InApp\InAppDataRepository;
use App\Repositories\MasterAdmin\StudentInformation\StudentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class SyllabusController extends Controller
{
    use FileUpload;

    public function index()
    {
        $syllabus = (new InAppDataRepository())->syllabuslist([]);
        $fileNames = SyllabusAttachmentFile::all();
        // dd($fileNames);
        return view('app.erpmodule.MasterAdmin.InApp.Syllabus.define-syllabus', compact(['syllabus','fileNames']));
    }

    public function store(SyllabusRequest $request)
    {
        // dd($request->all());
        $validatedData = $request->validated();
        $syllabus = Syllabus::create($validatedData);
        if ($syllabus) {
            if ($request->hasFile('icon')) {
                $syllabusImage = $request->file('icon');

                $syllabusFileName = $syllabusImage->getClientOriginalName();

                $syllabusImage->move(public_path('uploads/syllabus_icon_image'), $syllabusFileName);

                $syllabus->icon = $syllabusFileName;
                $syllabus->save();
            }
            if ($request->hasFile('file_name')) {
                $file = $request->file('file_name');
                $fileName = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $filePath = 'uploads/documents/' . $fileName;
                $file->move(public_path('uploads/syllabus'), $fileName);

                $data = [
                    'syllabus_id' => $syllabus->id,
                    'file_path' => $filePath,
                    'file_name' => $fileName,
                    'extension' => $extension
                ];

                SyllabusAttachmentFile::create($data);
            } else {
                return back()->with('error', 'File is required.');
            }

            return back()->withInput()->with('success', 'Syllabus Upload Successfully');
        }
        return back()->with('danger', 'Sorry, Request failed, please try again');
    }

    /*
     * Edit View Syllabus
     * @param Syllabus $syllabus
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editview(Syllabus $syllabus)
    {
        // dd($syllabus);

        return view('app.erpmodule.MasterAdmin.InApp.Syllabus.Edit.edit-syllabus', compact(['syllabus']));
    }

    /**
     * Modify Syllabus
     * @param Syllabus $syllabus
     * @param SyllabusRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function modify(Syllabus $syllabus, SyllabusRequest $request)
    {
        $validatedData = $request->validated();
        if ($request->hasFile('icon')) {
            $oldIconPath = public_path('uploads/syllabus_icon_image/' . $syllabus->icon);
            if (file_exists($oldIconPath)) {
                unlink($oldIconPath);
            }

            $iconImage = $request->file('icon');
            $iconFileName = $iconImage->getClientOriginalName();
            $iconImage->move(public_path('uploads/syllabus_icon_image'), $iconFileName);
            $validatedData['icon'] = $iconFileName;
        }

        if ($request->hasFile('file_name')) {
            foreach ($syllabus->attachment as $attachment) {
                $oldFilePath = public_path('uploads/syllabus/' . $attachment->file_name);
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
                $attachment->delete();
            }

            $file = $request->file('file_name');
            $fileName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $filePath = 'uploads/syllabus/' . $fileName;
            $file->move(public_path('uploads/syllabus'), $fileName);

            $attachmentData = [
                'syllabus_id' => $syllabus->id,
                'file_path' => $filePath,
                'file_name' => $fileName,
                'extension' => $extension
            ];

            $syllabus->attachment()->updateOrCreate([], $attachmentData);
        }
        $syllabus->update($validatedData);

        session(['keyid' => 'editModels', 'url' => '/MasterAdmin/App/EditViewSyllabus/' . $syllabus->id . '/editview']);
        return back()->with('success', 'Syllabus Record Update Successfully');
    }


    /*
     * Mobile Application Controller
     */
    public function studentsyllabus($studentid)
    {
        //check student is available
        $student=(new StudentRepository())->studentshortlist(['student_id'=>$studentid])->first();
        if($student) {
            $syllabusdata = [];
            $syllabus = (new InAppDataRepository())->syllabuslist(['course_id'=>$student->course_id]);
            if ($syllabus) {
                foreach ($syllabus as $data) {
                    /**
                     * Attachment files
                     */
                    $attachmentdata = [];
                    if (isset($data->attachment)) {
                        foreach ($data->attachment as $data1) {
                            $attachmentdata[] = [
                                'file_name' => $data1->file_name,
                                'extension' => $data1->extension,
                                'file_path' => asset($data1->file_path)
                            ];
                        }
                    }
                    /**
                     * syllabus data array
                     */
                    $syllabusdata[] = [
                        'syllabus_id' => $data->id,
                        'subject' => $data->SubjectName(),
                        'syllabus_title' => $data->syllabus_title,
                        'syllabus_detail' => $data->syllabus_details,
                        'icon' => $data->icon(),
                        'upload_date' => nowdate('', 'd-F-Y'),
                        'attachment' => $attachmentdata,
                        'submitted_by' => $data->user ? $data->user->fullName() : null,
                        'submitted_by_profile' => $data->user ? $data->user->ProfileImage() : null
                    ];
                }
                return response()->json([
                    'result' => 1,
                    'message' => 'no data found',
                    'success' => $syllabusdata
                ], 200);
            }
        }
        return response()->json([
            'result' => 0,
            'message' => 'no data found',
            'success' => null
        ], 200);
    }

    public function apistore($userid,Request $request)
    {
        $data=$request->all();
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

        $datainsert = [
            'priority'=>$request->priority,
            'course_id'=>$course_id,
            'subject_id'=>$request->subject_id,
            'syllabus_title'=>$request->syllabus_title,
            'syllabus_details'=>$request->syllabus_details,
            'icon'=>null,
            'show_app'=>$request->show_app,
            'show_website'=>$request->show_website,
            'status'=>$request->status
            ];

        try {
            $syllabus=Syllabus::create($datainsert);
            if($syllabus){
                //if file extension available
                $extension=[];if(isset($data['fileExtension'])){$extension=explode("~",$data['fileExtension']);}

                //Syllabus document uploader
                for ($i=0;$i<=5;$i++){
                    if(isset($data['fileList'.$i.''])){
                        $file=$data['fileList'.$i.''];
                        //if file extension available
                        $extension[$i] ? $FileExtension=$extension[$i] : $FileExtension=null;
                        //Store File
                        $fileresult=$this->upload($file,['base64'=>true,'integrate'=>'document','db_id'=>$syllabus->id,'extension'=>$FileExtension]);
                        SyllabusAttachmentFile::create(['syllabus_id' => $syllabus->id, 'file_name' => $fileresult['file_name'], 'file_path' => $fileresult['file_id'],'extension'=> $fileresult['file_extension'], 'user_id' => $data['user_id']]);
                    }
                }
            }

            return response()->json([
                'result'=>1,
                'message'=>'Record Save Successful Complete',
                'success'=>null
            ],200);

        }catch (\Exception $e){

            return response()->json([
                'result'=>0,
                'message'=>'Request failed, Please try again.',
                'success'=>null
            ],200);

        }
    }

    public function apisyllabusview(Request $request)
    {
        $search=[];
        if(isset($request->course_id)&&($request->course_id)){
            $coursearr=explode("@",$request->course_id);
            $courseid=$coursearr[0];
            $search=array_merge($search,['course_id'=>$courseid]);
        }
        $search=array_merge($search,['subject_id'=>$request->subject_id]);
        $search=['search'=>$search,'customsearch'=>['wherelike'=>['syllabus_title'=>$request->syllabus_title]]];

        $syllabusdata = [];
        $syllabus = (new InAppDataRepository())->syllabuslist($search);
        if($syllabus) {
            foreach ($syllabus as $data) {
                /**
                 * Attachment files
                 */
                $attachmentdata = [];
                if (isset($data->attachment)) {
                    foreach ($data->attachment as $data1) {
                        $attachmentdata[] = [
                            'file_name' => $data1->file_name,
                            'extension' => $data1->extension,
                            'file_path' => asset($data1->file_path)
                        ];
                    }
                }
                /**
                 * syllabus data array
                 */
                $syllabusdata[] = [
                    'syllabus_id' => $data->id,
                    'subject' => $data->SubjectName(),
                    'syllabus_title' => $data->syllabus_title,
                    'syllabus_detail' => $data->syllabus_details,
                    'icon' => $data->icon(),
                    'upload_date'=>nowdate('','d-M-Y'),
                    'attachment' => $attachmentdata,
                    'submitted_by'=>$data->user ? $data->user->fullName() : "N/A",
                    'submitted_by_profile'=>$data->user ? $data->user->ProfileImage() : null,
                ];
            }
            return response()->json([
                'result' => 1,
                'message' => 'no data found',
                'success' => $syllabusdata
            ], 200);

        }
        return response()->json([
            'result' => 0,
            'message' => 'no data found',
            'success' => null
        ], 400);
    }


    /*
     * Api Syllabus Remove
     */
    public function removeapisyllabus($userid,Syllabus $syllabus)
    {
        $syllabus->delete();
        return response()->json([
            'result' => 1,
            'message' => 'Syllabus Remove Successful Complete',
            'success' => null
        ]);
    }

}
