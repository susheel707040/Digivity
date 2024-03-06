<?php

namespace App\Http\Controllers\App\MasterAdmin\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserRoleController extends Controller
{
    public function index()
    {
        $user=User::query()->whereIn('role_id',[1,2])->get();
        return view('app.erpmodule.MasterAdmin.User.user-role',compact(['user']));
    }

    public function updaterole(Request $request)
    {
        if(isset($request->user_id)&&(count($request->user_id))){
            foreach ($request->user_id as $userid){
                $user=User::find($userid);
                $user->roles()->detach();
                $user->roles()->attach($request["role_id_".$userid.""]);
                $userupdate=$user->update(['role_id'=>$request["role_id_".$userid.""]]);
            }
            return back()->with('success','User Role Assign Successful Complete');
        }
        return back()->with('danger','Please select atleast one user');
    }
}
