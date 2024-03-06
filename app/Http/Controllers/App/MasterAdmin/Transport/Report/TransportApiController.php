<?php

namespace App\Http\Controllers\MasterAdmin\Transport\Report;

use App\Http\Controllers\Controller;
use App\Repositories\MasterAdmin\Finance\FinanceFeeCollectionRepository;
use App\Repositories\MasterAdmin\StudentInformation\StudentRepository;
use Illuminate\Http\Request;

class TransportApiController extends Controller
{
    public function studenttransport($studentid)
    {
        try {
            /*
             * Student Profile Details
             */
            $student = (new StudentRepository())->studentshortlist(['student_id' => $studentid])->first();
        } catch (\Exception $e) {
        }
        $transport = [];
        if (isset($student->transport) && ($student->transport)) {
            try {
                $transport = [
                    ['key' => 'Route Name', 'value' => $student->transport ? $student->transport->RouteName() : null],
                    ['key' => 'Pick Point', 'value' => $student->transport ? $student->transport->RouteStopName() : null],
                    ['key' => 'Pickup Time', 'value' => $student->transport ? $student->transport->PickupTime() : null],
                    ['key' => 'Drop Time', 'value' => $student->transport ? $student->transport->DropTime() : null],
                    ['key' => 'Vehicle', 'value' => $student->transport ? $student->transport->VehicleName() : null],
                    ['key' => 'Driver', 'value' => $student->transport ? $student->transport->DriverName() : null],
                    ['key' => 'Driver Mobile', 'value' => $student->transport ? $student->transport->DriverMobileNo() : null],
                    ['key' => 'Transport Help No.', 'value' => $student->transport ? $student->transport->TransportHelpNo() : null]
                ];
            } catch (\Exception $e) {
            }
        }

        if(isset($transport)&&($transport)){
            return response()->json([
                'result' => 1,
                'message'=>'transport data found',
                'success' => [
                    [
                        'transport' => $transport
                    ]
                ]
            ],200);
        }

        return response()->json([
            'result'=>1,
            'message'=>'transport no found',
            'success'=>null
        ],200);

    }
}
