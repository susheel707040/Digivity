<?php

namespace App\Http\Controllers\MobileApp\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PerformanceChartController extends Controller
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
