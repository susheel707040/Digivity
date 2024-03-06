<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CommonController extends Controller
{
    public function academicyearchange(User $user,Request $request)
    {
        $request->validate([
            'academic_id' => 'required',
            'financial_id' => 'required',
        ]);
        $user->update($request->all());
        session(['keyid' => 'editYearModels', 'url' => 0]);
        return back()->with('success','Academic Year and Financial Year Change Successfully Complete');
    }

    public function smsdocumentation()
    {
        return view('erpmodule.Documentation.sms-template-documentation');
    }

}



