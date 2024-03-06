<?php

namespace App\Http\Controllers\MobileApp\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExamResultController extends Controller
{
    public function examresult()
    {
        return response()->json([
            'result'=>0,
            'message'=>'record no found',
            'success'=>null
        ],400);
    }

    public function classtestresult()
    {
        return response()->json([
            'result'=>0,
            'message'=>'record no found',
            'success'=>null
        ],400);
    }
}
