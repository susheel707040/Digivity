<?php

namespace App\Http\Controllers\App\MasterAdmin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterAdmin\User\ModifyUserRequest;
use App\Http\Requests\MasterAdmin\User\UserStoreRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('app.erpmodule.MasterAdmin.User.create-user');
    }

    public function store(UserStoreRequest $request)
    {
        try {
            $data = $request->all();
            $data['password']=Hash::make($request->password);
            $data['dob']=$request->dob ? nowdate($request->dob,'Y-m-d') : null;
            $user = User::create($data);
            $user->roles()->attach($request->role_id);
            if ($user) {
                return back()->with('success', 'Record Save Successful Complete');
            }
        } catch (\Exception $e) {
        }
        return back()->with('danger', 'sorry, do not permission to create this record');
    }

    public function editview(User $user)
    {
        return view('app.erpmodule.MasterAdmin.User.edit-user',compact(['user']));
    }

    public function modify(User $user,ModifyUserRequest $request)
    {
        try {

            $data = $request->all();
            $data['dob']=$request->dob ? nowdate($request->dob,'Y-m-d') : null;
            $user->update($data);
            return back()->with('success', 'Record Update Successful Complete');

        }catch (\Exception $e){}
        return back()->with('danger', 'sorry, do not permission to create this record');
    }

    //--User Log History Report
    public function userloghistory(User $user)
    {

    }

    //-- User Logout
    public function userlogout(User $user)
    {

    }

    //-- User Mobile Logout
    public function usermobilelogout(User $user)
    {

    }

    //Mobile Api Controller
    public function apiuserprofile($userid)
    {
        $userdata=[];
        $user=User::find($userid);
        if($user){
            $userdata[]=[
                'db_id'=>$user->id,
                'joining_date'=>'',
                'staff_no'=>'',
                'profession'=>'',
                'staff_type'=>'',
                'department'=>'',
                'designation'=>'',
                'first_name'=>$user->first_name,
                'full_name'=>$user->fullName(),
                'father_name'=>'',
                'spouse_name'=>'',
                'contact_no'=>$user->contact_no,
                'email'=>$user->email,
                'address'=>'',
                'staff_id'=>$user->staff_id,
                'student_id'=>$user->student_id,
                'profile_img'=>$user->ProfileImage()
            ];
            return response()->json([
                'result'=>1,
                'message'=>'data found',
                'success'=>$userdata
            ],200);
        }
        return response()->json([
            'result'=>0,
            'message'=>'data found',
            'success'=>$userdata
        ],200);

    }
}
