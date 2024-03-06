<?php

namespace App\Http\Controllers\MasterAdmin\GlobalSetting;

use App\Http\Controllers\Controller;
use App\Repositories\MasterAdmin\Finance\FinanceRepository;
use App\Repositories\MasterAdmin\GlobalSetting\CommanDataRepository;
use App\Repositories\MasterAdmin\Staff\StaffRepositories;
use App\Repositories\MasterAdmin\Transport\TransportRepository;
use Illuminate\Http\Request;

class MasterApiController extends Controller
{
    public function index($userid,$get)
    {
        $getarray=explode(",",strtolower($get));
        $masterresponse=[];

        if((in_array('finance',$getarray))||($get=="all")) {
            //finance paymode
            try {
                $paymode = (new FinanceRepository())->paymodelist()->map(function ($item) {
                    return ['id' => $item->id, 'paymode' => $item->paymode];
                })->toArray();
                $masterresponse = array_merge($masterresponse, ['paymode' => $paymode]);
            } catch (\Exception $e) {
            }


            //finance entry mode
            try {
                $entrymode = ['school' => 'School', 'online' => 'Online', 'bank' => 'Bank'];
                $entrymodearr = [];
                foreach ($entrymode as $key => $value) {
                    $entrymodearr[] = ['id' => $key, 'value' => $value];
                }
                $masterresponse = array_merge($masterresponse, ['entry_mode' => $entrymodearr]);
            } catch (\Exception $e) {
            }


            //finance fee receipt
            try {
                $receiptstatus = ['paid' => 'Paid', 'unpaid' => 'Unpaid', 'cancel' => 'Cancel'];
                $receiptstatusarr = [];
                foreach ($receiptstatus as $key => $value) {
                    $receiptstatusarr[] = ['id' => $key, 'value' => $value];
                }
                $masterresponse = array_merge($masterresponse, ['receipt_status' => $receiptstatusarr]);
            } catch (\Exception $e) {
            }

            //finance fee head
            try {
                $feehead = (new FinanceRepository())->feeheadlist([])->map(function ($item) {
                    return ['id' => $item->id, 'feehead' => $item->fee_head];
                })->toArray();
                $masterresponse = array_merge($masterresponse, ['feehead' => $feehead]);;
            } catch (\Exception $e) {
            }

            //finance result search
            try {
                $resultstatus = ['greater_than' => 'Greater Than', 'less_than' => 'Less Than'];
                $resultstatusarr = [];
                foreach ($resultstatus as $key => $value) {
                    $resultstatusarr[] = ['id' => $key, 'value' => $value];
                }
                $masterresponse = array_merge($masterresponse, ['result' => $resultstatusarr]);
            } catch (\Exception $e) {}
        }

        if((in_array('student',$getarray))||($get=="all")) {

            //student/staff category
            try {
                $category = (new CommanDataRepository())->categoryselectlist()->map(function ($item) {
                    return ['id' => $item->id, 'value' => $item->category];
                })->toArray();
                $masterresponse = array_merge($masterresponse, ['category' => $category]);
            } catch (\Exception $e) {
            }
            //student is new status
            try {
                $isnew = (new CommanDataRepository())->admissionisnewstatuslist()->map(function ($item) {
                    return ['id' => $item->alias, 'value' => $item->admission_status];
                })->toArray();
                $masterresponse = array_merge($masterresponse, ['isnewstatus' => $isnew]);
            } catch (\Exception $e) {
            }

            //student status
            try {
                $resultstatus = ['active' => 'Active', 'inactive' => 'inactive'];
                $resultstatusarr = [];
                foreach ($resultstatus as $key => $value) {
                    $resultstatusarr[] = ['id' => $key, 'value' => $value];
                }
                $masterresponse = array_merge($masterresponse, ['status' => $resultstatusarr]);
            } catch (\Exception $e) {}

        }

        if((in_array('transport',$getarray))||($get=="all")) {
            //transport route
            try {
                $route = (new TransportRepository())->routelist()->map(function ($item) {
                    return ['id' => $item->id, 'value' => $item->route];
                })->toArray();
                $masterresponse = array_merge($masterresponse, ['transport_route' => $route]);
            } catch (\Exception $e) {}

            //transport route stop
            try {
                $routestop = (new TransportRepository())->routestoplist()->map(function ($item) {
                    return ['id' => $item->id, 'value' => $item->route_stop];
                })->toArray();
                $masterresponse = array_merge($masterresponse, ['transport_route_stop' => $routestop]);
            } catch (\Exception $e) {}

            //transport vehicle
            try {
                $vehicle = (new TransportRepository())->vehiclelist()->map(function ($item) {
                    return ['id' => $item->id, 'value' => $item->vehicle_name." - ".$item->registration_no];
                })->toArray();
                $masterresponse = array_merge($masterresponse, ['transport_vehicle' => $vehicle]);
            } catch (\Exception $e) {}

            //transport driver
            try {
                $driver = (new StaffRepositories())->staffshortlist(['integrated_id'=>'driver'])->map(function ($item) {
                    return ['id' => $item->id, 'value' => $item->fullName()];
                })->toArray();
                $masterresponse = array_merge($masterresponse, ['transport_driver' => $driver]);
            } catch (\Exception $e) {}

            //transport status
            try {
                $resultstatus = ['active' => 'Active', 'inactive' => 'inactive'];
                $resultstatusarr = [];
                foreach ($resultstatus as $key => $value) {
                    $resultstatusarr[] = ['id' => $key, 'value' => $value];
                }
                $masterresponse = array_merge($masterresponse, ['transport_status' => $resultstatusarr]);
            } catch (\Exception $e) {}

        }


        return response()->json([
            'result'=>1,
            'message'=>'master api record found',
            'success'=>[$masterresponse]
        ],200);
    }
}
