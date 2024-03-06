<?php

namespace App\Http\Controllers\App\MasterAdmin\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Role;

class UserIndexController extends Controller
{
    public function index()
    {
        return view('app.erpmodule.MasterAdmin.User.index');
    }
    public function CreateRole(){
         return view('app.erpmodule.MasterAdmin.User.user-add-role');
    }
    public function StoreRole(Request $request){
        $validatedData = $request->validate([
            'name' => 'required',
        ]);
        $alias = strtolower(str_replace(' ', '_', $validatedData['name']));
        $validatedData['alias'] = $alias;

        $role = Role::create($validatedData);
        return redirect()->back()->with('success', 'Role add successfully');
    }
}
