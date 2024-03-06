<?php

namespace App\Http\Controllers\App\MobileApp\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LibraryController extends Controller
{
    public function currentissuereport()
    {
        return response()->json([
            'result'=>0,
            'message'=>'record no found',
            'success'=>null
        ],400);
    }

    public function historyreport()
    {
        return response()->json([
            'result'=>0,
            'message'=>'record no found',
            'success'=>null
        ],400);
    }

    public function searchbook()
    {
        return response()->json([
            'result'=>0,
            'message'=>'record no found',
            'success'=>null
        ],400);
    }
}
