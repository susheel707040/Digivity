<?php

namespace App\Http\Controllers\MasterAdmin\OnlineStream;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OnlinePeriodController extends Controller
{
    public function apiperiodlist()
    {
        return response()->json([
            'result'=>1,
            'message'=>'data found',
            'success'=>[
                ['id'=>1,'value'=>'Lecture 1'],
                ['id'=>2,'value'=>'Lecture 2'],
                ['id'=>3,'value'=>'Lecture 3'],
                ['id'=>4,'value'=>'Lecture 4'],
                ['id'=>5,'value'=>'Lecture 5'],
                ['id'=>6,'value'=>'Lecture 6'],
                ['id'=>7,'value'=>'Lecture 7'],
                ['id'=>8,'value'=>'Lecture 4']
            ]
        ],200);
    }
}
