<?php

namespace App\Http\Controllers\MasterAdmin\OnlineStream;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OnlineForController extends Controller
{
    public function apionlinetypelist()
    {
        return response()->json([
            'result'=>1,
            'message'=>'data found',
            'success'=>[
                ['id'=>1,'value'=>'Online Class'],
                ['id'=>1,'value'=>'PTM'],
                ['id'=>1,'value'=>'Online Test']
            ]
        ],200);
    }
}
