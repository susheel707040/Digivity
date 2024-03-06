<?php

namespace App\Http\Controllers\App\MasterAdmin\Transport;

use App\Http\Controllers\Controller;
use App\Imports\ImportFile;
use App\Models\MasterAdmin\Admission\StudentRecord;
use App\Repositories\MasterAdmin\StudentInformation\StudentRepository;
use App\Repositories\MasterAdmin\Transport\TransportRepository;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class TransportAssignController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * Student Transport Assign index Page
     */
    public function studentassignindex(Request $request)
    {
        return view('app.erpmodule.MasterAdmin.transport.Entry.student-assign-transport', compact(['request']));
    }

    /**
     *
     * bulk Assign student Transport
     */

    public function bulkAssignStudentTransport(Request $request)
    {
        return view('app.erpmodule.MasterAdmin.transport.Entry.bulk-assign-transport', compact(['request']));
    }

    /**
     *
     * import student transport
     */
    public function ImportAssignTransportToStudent(Request $request)
    {

        if ($request->hasFile('import_file')) {
            $routeMap = (new TransportRepository())->routeRelationHashMap();
            // return $routeMap;
            $importdata = collect(Excel::toArray(new ImportFile(), request()->file('import_file')))->shift();
            // dd($importdata);
            foreach ($importdata as $key => $data) {
                if ($key != 0) {
                    $route_relation_key = strtolower(trim($data[2]) . "@" . trim($data[3]));
                    // dd($route_relation_key);
                    if (array_key_exists($route_relation_key, $routeMap)) {
                        $transport_id = $routeMap[$route_relation_key];
                        $data1 = [
                            'transport_start_date' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($data[1])->format('Y-m-d'),
                            'transport_id' => $transport_id,
                            'transport_status' => 'active'
                        ];

                        $student = StudentRecord::query()->where('admission_no', $data[0])->first();
                        $student->update($data1);
                    }
                }
            }
            return back()->with('success', 'Transport Imported Data successfully');
        }
        return view('app.erpmodule.MasterAdmin.transport.Entry.import-assign-transport', compact(['request']));
    }

    /**
     * Delete Bulk Student Transport
     */

    public function deleteStudentTransportindex(Request $request, $student_id)
    {
        if (isset($student_id)) {
            $data = [
                'transport_stop_date' => Carbon::now()->format('Y-m-d'),
                'transport_id' => null,
                'transport_status' => "inactive"
            ];
            $student = StudentRecord::query()->where('id', $request->student_id)->first();
            $student->update($data);
            return back()->with('success', 'Transport facility suspended successfully');
        } else {
            return back()->with('danger', 'Please Select required fields');
        }
    }

    /**
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * Class wise Student Assign Transport
     */
    public function classwiseassigntransportindex(Request $request)
    {
        //if import file exist
        $importdata = [];
        if ($request->hasFile('import_file')) {
            $importdata = collect(Excel::toArray(new ImportFile(), request()->file('import_file')))->shift();
            $importdataarr = [];
            foreach ($importdata as $key => $data) {
                if ($key != 0) {
                    $importdataarr[] = ['admission_no' => $data[0], 'transport_start_date' => $data[1], 'route' => $data[2], 'route_stop' => $data[3], 'vehicle' => $data[4], 'driver' => $data[5]];
                }
            }
            $importdata = collect($importdataarr);
        }
        $student = (new StudentRepository())->studentshortlist(['customsearch' => ['where' => $request->only(['course_id', 'section_id']), 'wherelike' => $request->only('residence_address')]], ['student']);
        return view('app.erpmodule.MasterAdmin.transport.Entry.class-wise-assign-transport', compact(['student', 'importdata']));
    }

    public function studentAssignTransport(Request $request)
    {
        if (isset($request->student_id) && isset($request->transport_id) && isset($request->transport_assigned)) {
            $data = [
                'transport_start_date' => Carbon::createFromDate($request['transport_start_date'])->format('Y-m-d'),
                'transport_id' => $request["transport_id"],
                'transport_status' => $request["transport_assigned"]
            ];
            $student = StudentRecord::query()->where('id', $request->student_id)->first();
            $student->update($data);
            return back()->with('success', 'Transport assigned successfully');
        } else {
            return back()->with('danger', 'Please Select required fields');
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * Transport Assign Student
     */
    public function classWiseAssignTransportStore(Request $request)
    {
        if (isset($request->students)) {
            foreach ($request->students as $student) {
                if (array_key_exists('student_id', $student)) {
                    $data = [
                        'transport_start_date' => Carbon::now()->format('Y-m-d'),
                        'transport_id' => $student['transport_id'],
                        'transport_status' => 'active'
                    ];
                    $student = StudentRecord::query()->where('id', $student['student_id'])->first();
                    $student->update($data);
                }
            }
            return back()->with('success', 'Transport Assign Successful Complete');
        } else {
            return back()->with('danger', 'Please Select atleast one tudent');
        }
    }

    public function studenttransportstore(Request $request)
    {
        print_r($request->all());
    }

    /**
     * @param StudentRecord $studentrecord
     * @return \Illuminate\Http\RedirectResponse
     * Transport Remove Successful Complete
     */
    public function permanentlyremove(StudentRecord $studentrecord)
    {
        $studentrecord->update(['transport_id' => null, 'transport_status' => 'inactive', 'transport_stop_date' => null]);
        return back()->with('success', 'Transport Service Permanently Delete Successful Complete');
    }
}
