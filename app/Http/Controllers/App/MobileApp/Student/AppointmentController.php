<?php

namespace App\Http\Controllers\App\MobileApp\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        return response()->json([
            'result'=>0,
            'message'=>'record no found',
            'success'=>null
        ],400);
    }
}
