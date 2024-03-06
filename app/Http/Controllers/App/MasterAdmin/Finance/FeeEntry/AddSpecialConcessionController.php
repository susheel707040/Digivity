<?php

namespace App\Http\Controllers\MasterAdmin\Finance\FeeEntry;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AddSpecialConcessionController extends Controller
{
    public function index($studentid,Request $request)
    {
       $studentfee=$request->all();
       return view('erpmodule.MasterAdmin.Finance.FeeEntry.Page.add-special-concession-modal',compact(['studentid','studentfee']));
    }
}
