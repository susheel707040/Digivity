<?php

namespace App\Http\Controllers\App\MasterAdmin\User;

use App\Helper\UserModules;
use App\Http\Controllers\Controller;
use App\Http\Requests\MasterAdmin\User\UserPermissionRequest;
use App\Models\MasterAdmin\GlobalSetting\UserMapModule;
use App\Models\User as ModelsUser;
use App\Models\User;
use Illuminate\Http\Request;

class UserPermissionController extends Controller
{
    public function index()
    {
        $getwebapp = UserModules::getwebapp('master-admin');
        $getmobileapp = UserModules::getmobileapp('master-admin');
        return view('app.erpmodule.MasterAdmin.User.user-permission',compact(['getwebapp','getmobileapp']));
    }

    public function indexsearch(Request $request)
{
    $getwebapp = UserModules::getwebapp('master-admin');
    $getmobileapp = UserModules::getmobileapp('master-admin');
    $user = ModelsUser::query()->where(['id' => $request->user_id])->first();

    $usermapmodule = UserMapModule::query()->where('ac_user_id', $user->id)->record()->first();
    $existwebappmodule = $existmobileappmodule = null; // Initialize variables

    if ($usermapmodule) {
        $existwebappmodule = unserialize($usermapmodule->web_app_module);
        $existmobileappmodule = unserialize($usermapmodule->mobile_app_module);
    }

    return view('app.erpmodule.MasterAdmin.User.user-permission', compact(['getwebapp', 'getmobileapp', 'user', 'existwebappmodule', 'existmobileappmodule']));
}

    public function store(UserPermissionRequest $request)
    {
        try {
            /**
             * user module delete role id
             */
            UserMapModule::query()->where(['ac_user_id'=>$request->ac_user_id])->record()->forceDelete();

            $data=$request->all();
            $web_app_array = array();
            foreach ($request->web_app_module as $module) {
                $dataArr = ['module_id' => $module, 'module_text' => $request["web_app_module_" . $module . "_text"], 'module_sequence' => $request["web_app_" . $module . "_sequence"]];
                $web_app_array[$module] = $dataArr;
            }
            $data['web_app_module'] = serialize($web_app_array);
            $data['mobile_app_module'] = serialize(array(null));

            UserMapModule::create($data);
            return back()->with('success', 'Record Update Successful Complete');

        }catch (\Exception $e){return  $e;}
        return back()->with('danger', 'sorry, do not permission to create this record');
    }

    public function remove()
    {

    }
}
