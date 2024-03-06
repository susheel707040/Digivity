<?php

namespace App\Http\Controllers\App\MasterAdmin\Admission;

use App\Helper\AutoSendSMSNotification;
use App\Helper\FileUpload;
use App\Http\Controllers\Controller;
use App\Http\Requests\MasterAdmin\Admission\StudentAdmissionRequest;
use App\Models\MasterAdmin\Admission\StudentAdmission;
use App\Models\MasterAdmin\Admission\StudentDocumentRecord;
use App\Models\MasterAdmin\Admission\StudentPreviousSchool;
use App\Models\MasterAdmin\Admission\StudentProspectus;
use App\Models\MasterAdmin\Admission\StudentRecord;
use App\Models\MasterAdmin\Finance\StudentFeeCollection;
use App\Models\MasterAdmin\Finance\StudentFeeCollectionInstalmentRecord;
use App\Repositories\MasterAdmin\StudentInformation\StudentRepository;
use App\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Helper\FormNoGenerate;
use Milon\Barcode\DNS1D;

class StudentAdmissionController extends Controller
{
    use FileUpload;
    use AutoSendSMSNotification;

    public function index()
    {
        $student = [];
        if (request()->get('pros_no')) {

            $student = (new StudentRepository())->prospectuslist(['id' => request()->get('pros_no')])->first();
        }
        return view('app.erpmodule.MasterAdmin.StudentInformation.Entry.StudentRegistration', compact(['student']));
    }

    public function store(StudentAdmissionRequest $request)
    {
        // dd($request->all());
        $data = $request->validated();

        // Set transport_start_date
        $data['transport_start_date'] = Carbon::createFromDate($request->admission_date)->format('Y-m-d');

        // Check for duplicate admission number
        $existcheck = StudentRecord::query()->where(['admission_no' => $request->admission_no])->count();
        if ($existcheck > 0) {
            return back()->with('danger', 'Sorry, Admission Number Already Assigned.');
        }

        // Generate admission number and sr number
        $getadmissionno = FormNoGenerate::generate('admission_no');
        $getsrno = FormNoGenerate::generate('sr_no');
        if ($getadmissionno->should_be == "auto") {
            $data['admission_no'] = $getadmissionno->GetNo();
        }
        if ($getsrno->should_be == "auto") {
            $data['sr_no'] = $getsrno->GetNo();
        }

         // Save images if provided
         if ($request->hasFile('profile_img')) {
            $studentImage = $request->file('profile_img');

            $StudentProfileImage = $studentImage->getClientOriginalName();

            $studentImage->move(public_path('uploads/student_profile_image'), $StudentProfileImage);

            $data['profile_img'] = $StudentProfileImage;
        }

        // Save image if provided
    if ($request->hasFile('father_photo')) {
        $FatherImage = $request->file('father_photo');

        $FatherProfileImage = $FatherImage->getClientOriginalName();

        $FatherImage->move(public_path('uploads/father_photo'), $FatherProfileImage);

        $data['father_photo'] = $FatherProfileImage;
    }

    if ($request->hasFile('mother_photo')) {
        $MotherImage = $request->file('mother_photo');

        $MotherProfileImage = $MotherImage->getClientOriginalName();

        $MotherImage->move(public_path('uploads/mother_photo'), $MotherProfileImage);

        $data['mother_photo'] = $MotherProfileImage;
    }

    if ($request->hasFile('local_guardian_photo')) {
        $GuardianImage = $request->file('local_guardian_photo');

        $GuardianrProfileImage = $GuardianImage->getClientOriginalName();

        $GuardianImage->move(public_path('uploads/local_guardian_photo'), $GuardianrProfileImage);

        $data['local_guardian_photo'] = $GuardianrProfileImage;
    }

        // Save student personal details
        $studentrecord = StudentAdmission::create($data);
        if (!$studentrecord->id) {
            return back()->with('danger', 'Sorry, Request failed, Please try again.');
        }
        $data['student_id'] = $studentrecord->id;

        // Get role for student login
        $role = Role::query()->where('alias', 'student')->first();

        // Create new request parameters for user table
        $username = Str::lower($studentrecord->first_name . $studentrecord->id);
        $pwd = Str::lower($studentrecord->first_name . $studentrecord->id);

        // User administration create start here

        // $userData = [
        //     'role_id' => optional($role)->id, // Use optional() to handle null case
        //     'username' => $username,
        //     'password' => Hash::make($pwd),
        //     'pwd' => $pwd,
        // ];

        // // User administration create
        // $userregistration = User::create($userData);
        // if ($role) {
        //     $userregistration->roles()->attach($role->id);
        // }
        // $data['ac_user_id'] = $userregistration->id;

        // Student admission class wise
        $student = StudentRecord::create($data);
        if (!$student || !$student->id) {
            return back()->with('danger', 'Sorry, Request failed, Please try again.');
        }


        // Save student previous school details
        foreach ($request['school_name'] as $key => $school_name) {
            if ($school_name) {
                $data1 = [
                    'student_id' => $studentrecord->id,
                    'school_name' => $school_name,
                    'board' => $request["board"][$key],
                    'class' => $request["class"][$key],
                    'year' => $request["year"][$key],
                    'percentage' => $request["percentage"][$key],
                ];
                StudentPreviousSchool::create($data1);
            }
        }

        // Save student document details
        if (!empty($request['document_id'])) {
            foreach ($request['document_id'] as $documentid) {
                $data2 = [
                    'student_id' => $studentrecord->id,
                    'document_id' => $documentid,
                    'document_name' => $request["document_type_" . $documentid],
                    'document_no' => $request["document_no_" . $documentid],
                    'document_file' => $request["document_file_" . $documentid],
                ];
                StudentDocumentRecord::create($data2);
            }
        }

        // Increment admission number and sr number
        $getadmissionno->increment('start_from', 1);
        $getsrno->increment('start_from', 1);

        // Prospectus Convert Admission Confirm
        if ($request->prospectus_id) {
            $prospectus = StudentProspectus::find($request->prospectus_id);
            $prospectus->update(['status' => 'approve']);

            $feecollection = StudentFeeCollection::query()->where('prospectus_id', $request->prospectus_id)->record()->first();
            $feecollection->update(['student_id' => $studentrecord->id, 'course_id' => $request->course_id, 'section_id' => $request->section_id]);

            $feecollectioninstalment = StudentFeeCollectionInstalmentRecord::where('fee_collection_id', $feecollection->id)->update(['student_id' => $studentrecord->id]);
        }

        // SMS Notification
        try {
            $this->smsnotification('student-admission', StudentRecord::class, ['search' => ['id' => $student->id]]);
        } catch (\Exception $e) {
            // Handle exception if needed
        }

        return redirect('MasterAdmin/StudentInformation/StudentRegistration')->with('success', 'Student Record Save Successful Done');
    }

    public function editview($studentid)
    {
        $student = StudentRecord::query()->record()->where('student_id', $studentid)->with(['student'])->first();
        return view('app.erpmodule.MasterAdmin.StudentInformation.Entry.Edit.edit-student-detail', compact('student'));
    }

    public function modaleditview($studentid)
    {
        $student = StudentRecord::query()->record()->where('student_id', $studentid)->with(['student'])->first();
        return view('app.erpmodule.MasterAdmin.StudentInformation.Entry.Edit.modify-student-details-modal-index', compact('student'));
    }

    public function modifyview()
    {
        return view('app.erpmodule.MasterAdmin.StudentInformation.modify-student-detail-index');
    }

    public function modifymodalview()
    {
        return view('app.erpmodule.MasterAdmin.StudentInformation.Edit.modify-student-details-modal-index');
    }

    /**
     * student modify data
     * @param $studentid
     * @param StudentAdmissionRequest $request
     */
    public function modify($studentid, StudentAdmissionRequest $request)
    {
        $request->validated();
        $request->merge(['admission_date' => Carbon::createFromDate($request->admission_date)->format('Y-m-d'),
            'dob' => Carbon::createFromDate($request->dob)->format('Y-m-d')]);
        $data = $request->all();
        //multiple subject ids
        if(isset($request->subject_id)){
            $data = array_merge($data, ['subject_id' => implode(",",$request->subject_id)]);
        }
        $studentadmissionclass = StudentRecord::query()->where('id', $studentid)->first();
        $studentrecord = StudentAdmission::query()->where('id', $studentadmissionclass->student_id)->first();
        /**
         * Student Admission Record Update
         */
        $studentadmissionclass->update($data);
        /**
         * Student PERSONAL Record UPDATE
         */
        $studentrecord->update($data);
        return back()->with('success', 'Record Update Successful Complete');
    }


    /**
     * mobile application api Controller
     */

    public function studentindex()
    {
        /*
         * Get Admission Number
         */
        $admisionno = 0;
        $caste = [];
        $transport = [];
        try {
            $admisionno = FormNoGenerate('admission_no')->GetNo();
        } catch (\Exception $e) {
        }
        try {
            foreach (casteselectlist([]) as $data) {
                $caste[] = ['caste_id' => $data->id, 'caste' => $data->caste];
            }
            foreach (routerelationlist() as $data) {
                $transport[] = ['route_id' => $data->id, 'route_name' => $data->route->route . " - " . $data->routestop->route_stop . " - " . $data->vehicle->registration_no . " - " . $data->vehicle->vehicle_name];
            }
        } catch (\Exception $e) {
        }
        return response()->json([
            'result' => 1,
            'success' => [
                ['admission_no' => $admisionno, 'caste' => $caste, 'transport' => $transport]
            ]
        ], 200);
    }

    /*
     * Mobile Application Add Student
     */
    public function apiaddstudent($userid, Request $request)
    {
        if (isset($request->course_id) && ($request->course_id)) {

            //Check Admission Number if Exist
            $existstudentvalidate = (new StudentRepository())->studentshortlist(['admission_no' => $request->admission_no])->first();
            if (!$existstudentvalidate) {
                $course = explode("@", $request->course_id);
                $student_name = explode(" ", preg_replace('/(\s\s+|\t|\n)/', ' ', $request->first_name));
                $datainsert = [
                    'admission_no' => $request->admission_no,
                    'category_id' => $request->caste,
                    'form_no' => $request->form_no,
                    'course_id' => $course[0],
                    'section_id' => $course[1],
                    'transport_start_date' => $request->transport_id ? nowdate('', 'Y-m-d') : null,
                    'transport_id' => $request->transport_id,
                    'transport_status' => $request->transport_id ? "active" : "inactive",
                    'is_ewa' => 'no',
                    'is_new' => 'new',
                    'admission_date' => nowdate($request->admission_date, 'Y-m-d'),
                    'first_name' => $student_name[0] ? $student_name[0] : null,
                    'middle_name' => isset($student_name[1]) ? $student_name[1] : null,
                    'last_name' => isset($student_name[2]) ? implode(" ", array_slice($student_name, 2)) : null,
                    'gender' => strtolower($request->gender),
                    'dob' => $request->dob ? nowdate($request->dob, 'Y-m-d') : null,
                    'contact_no' => $request->contact_no,
                    'mother_mobile_no' => $request->alt_contact_no,
                    'father_name' => preg_replace('/(\s\s+|\t|\n)/', ' ', $request->father_name),
                    'mother_name' => preg_replace('/(\s\s+|\t|\n)/', ' ', $request->mother_name),
                    'residence_address' => preg_replace('/(\s\s+|\t|\n)/', ' ', $request->residence_address)
                ];
                /*
                * admission no or sr no get auto fill
                */
                if (FormNoGenerate::generate('admission_no')) {
                    $getadmissionno = FormNoGenerate::generate('admission_no');
                    if ($getadmissionno->should_be == "auto") {
                        $datainsert = array_merge($datainsert, ['admission_no' => $getadmissionno->GetNo()]);
                    }
                }
                if (FormNoGenerate::generate('sr_no')) {
                    $getsrno = FormNoGenerate::generate('sr_no');
                    if ($getsrno->should_be == "auto") {
                        $datainsert = array_merge($datainsert, ['sr_no' => $getsrno->GetNo()]);
                    }
                }
                $studentrecord = StudentAdmission::create($datainsert);
                if ($studentrecord) {
                    $datainsert['student_id'] = $studentrecord->id;

                    //get role get for student login
                    $role = Role::query()->where('alias', 'student')->first();

                    //create new request parameters for user table
                    $username = Str::lower($studentrecord->first_name . $studentrecord->id);
                    $pwd = Str::lower($studentrecord->first_name . $studentrecord->id);
                    $data = array_merge($datainsert, ['role_id' => $role->id, 'username' => $username, 'password' => Hash::make($pwd), 'pwd' => $pwd]);

                    //user administration create
                    $userregistration = User::create($data);
                    $userregistration->roles()->attach($role->id);
                    $datainsert['ac_user_id'] = $userregistration->id;

                    //student admission class wise
                    $student = StudentRecord::create($datainsert);
                    if (isset($student) && ($student)) {
                        /**
                         * increment admission number and sr number
                         */
                        if (isset($getadmissionno)) {
                            $getadmissionno->increment('start_from', 1);
                        }
                        if (isset($getsrno)) {
                            $getsrno->increment('start_from', 1);
                        }
                        return response()->json([
                            'result' => 1,
                            'message' => 'Record Save Successful Complete',
                            'success' => null
                        ], 200);
                    }
                }
            } else {
                return response()->json([
                    'result' => 1,
                    'message' => 'Admission Number Already Exist in Record.',
                    'success' => null
                ], 200);
            }
        }

        return response()->json([
            'result' => 1,
            'message' => 'Sorry, Request failed, Please try again.',
            'success' => null
        ], 200);
    }

    //Api Student Update
    public function apimodifystudent($userid, $studentid, Request $request)
    {
        $student = (new StudentRepository())->studentshortlist(['student_id' => $studentid])->first();
        if ($student) {
            if (isset($request->course_id) && ($request->course_id)) {
                $course = explode("@", $request->course_id);
                $dataupdate = [
                    'course_id' => $course[0],
                    'section_id' => $course[1],
                    'admission_no' => $request->admission_no,
                    'form_no' => $request->form_no,
                    'category_id' => $request->caste,
                    'transport_start_date' => $request->transport_id ? nowdate('', 'Y-m-d') : null,
                    'transport_id' => $request->transport_id,
                    'transport_status' => $request->transport_id ? "active" : "inactive",
                ];
                $student_name = explode(" ", preg_replace('/(\s\s+|\t|\n)/', ' ', $request->first_name));
                $dataupdate1 = [
                    'admission_date' => nowdate($request->admission_date, 'Y-m-d'),
                    'first_name' => $student_name[0] ? $student_name[0] : null,
                    'middle_name' => isset($student_name[1]) ? $student_name[1] : null,
                    'last_name' => isset($student_name[2]) ? implode(" ", array_slice($student_name, 2)) : null,
                    'gender' => strtolower($request->gender),
                    'dob' => $request->dob ? nowdate($request->dob, 'Y-m-d') : null,
                    'aadhar_card_no' => $request->aadhar_card_no,
                    'contact_no' => $request->contact_no,
                    'mother_mobile_no' => $request->alt_contact_no,
                    'father_name' => preg_replace('/(\s\s+|\t|\n)/', ' ', $request->father_name),
                    'mother_name' => preg_replace('/(\s\s+|\t|\n)/', ' ', $request->mother_name),
                    'residence_address' => preg_replace('/(\s\s+|\t|\n)/', ' ', $request->residence_address)
                ];
                $studentupdate = $student->update($dataupdate);
                if ($studentupdate) {
                    $student->student->update($dataupdate1);
                    return response()->json([
                        'result' => 1,
                        'message' => 'Student Record Update Successfully.'
                    ], 200);
                }
            }
        }
        return response()->json([
            'result' => 0,
            'message' => 'Sorry, request failed, Please try again.'
        ], 200);
    }


}
