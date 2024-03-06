<?php

namespace App\Http\Controllers\MobileApp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SchoolInfoController extends Controller
{
    public function index($pageid)
    {
        return response()->json([
           'result'=>1,
           'message'=>'data found',
           'success'=>[
               'page_id'=>$pageid,
               'page_body'=>"<html><body><b>Amit Kumar</b><br/><b style='color:Red;'>Sumit Kumar</b></body></html>"
           ]
        ]);
    }
}
