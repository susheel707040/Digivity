<?php

namespace App\Http\Controllers\App\MasterAdmin\GlobalSetting;

use App\Helper\FileUpload;
use App\Helper\UserModules;
use App\Http\Requests\MasterAdmin\GlobalSetting\SchoolBranchRequest;
use App\Http\Requests\MasterAdmin\GlobalSetting\UserMapModuleRequest;
use App\MasterAdmin\AcademicSession;
use App\Models\MasterAdmin\GlobalSetting\SchoolBranch;
use App\MasterAdmin\SchoolInformation;
use App\Models\MasterAdmin\GlobalSetting\UserMapModule;
use App\Role;
use App\Http\Controllers\Controller;
use App\Models\User as ModelsUser;
use App\Models\User;

class GlobalSettingController extends Controller
{
    use FileUpload;
    /*
     * School Information View
     */
    public function schoolinfoview()
    {
        $school=SchoolBranch::query()->record()->first();
        // return $school;
        return view('app.erpmodule.MasterAdmin.GlobalSetting.schoolsetting.school-info',compact(['school']));
    }
    /*
     * School info update
     */
    public function schoolinfoupdate(SchoolBranch $schoolbranch,SchoolBranchRequest $request)
    {
        $data=$request->validated();
        if ($request->hasFile('banner_logo')) {
            $SchoolBannnerLogoFileName = $schoolbranch->banner_logo;

            $schoolBannerImage = $request->file('banner_logo');

            $BannerfileName = $schoolBannerImage->getClientOriginalName();

            $schoolBannerImage->move(public_path('uploads/School_banner_logo'), $BannerfileName);

            $data['banner_logo'] = $BannerfileName;

            if($SchoolBannnerLogoFileName && file_exists(public_path("uploads/School_banner_logo/{$SchoolBannnerLogoFileName}"))){
                unlink(public_path("uploads/School_banner_logo/{$SchoolBannnerLogoFileName}"));
            }
        }

        if ($request->hasFile('logo')) {
            $SchoolSquareLogoFileName = $schoolbranch->logo;
            $schoolLogoImage = $request->file('logo');

            $LogofileName = $schoolLogoImage->getClientOriginalName();

            $schoolLogoImage->move(public_path('uploads/School_square_logo'), $LogofileName);

            $data['logo'] = $LogofileName;

            if($SchoolSquareLogoFileName && file_exists(public_path("uploads/School_square_logo/{$SchoolSquareLogoFileName}"))){
                unlink(public_path("uploads/School_square_logo/{$SchoolSquareLogoFileName}"));
            }
        }
        $schoolbranch->update($data);
        return back()->with('success','School Info. Record update successful complete');
    }


    public function usermapwithmoduleview()
    {
        $user=ModelsUser::query()->whereIn('role_id',[1,2])->get();
        $role = Role::query()->get();
        return view('app.erpmodule.MasterAdmin.GlobalSetting.schoolsetting.user-map-with-module', compact(['role','user']));
    }

    public function usermapwithmodulesearch($roleid,$usersid)
    {
        $role = Role::query()->get();
        $rolesalish = $role->where('id', $roleid)->pluck('alias');
        $user= ModelsUser::query()->whereIn('role_id',[1,2])->get();

        $search=['role_id'=>$roleid];
        if(isset($usersid)&&($usersid)){
            $search=['role_id'=>$roleid,'ac_user_id'=>$usersid];
        }

        $getwebapp = UserModules::getwebapp($rolesalish[0]);
        $getmobileapp = UserModules::getmobileapp($rolesalish[0]);
        $existwebappmodule = [];
        $existmobileappmodule = [];
        $usermapmodule = UserMapModule::query()->where($search)->record()->first();
        if ($usermapmodule) {
            $existwebappmodule = unserialize($usermapmodule->web_app_module);
            $existmobileappmodule = unserialize($usermapmodule->mobile_app_module);
        }
        return view('app.erpmodule.MasterAdmin.GlobalSetting.schoolsetting.user-map-with-module', compact(['role', 'getwebapp', 'getmobileapp', 'existwebappmodule', 'existmobileappmodule','user']));
    }

    public function usermapmodulestore(UserMapModuleRequest $request)
    {
        /**
         * user module delete role id
         */
        $search=['role_id'=>$request->role_id];
        if(isset($request->user_id)&&($request->user_id)){
         $search=['role_id'=>$request->role_id,'ac_user_id'=>$request->user_id];
        }
        UserMapModule::query()->where($search)->record()->forceDelete();

        $data = $request->validated();
        $data=array_merge($data,$search);;

        $web_app_array = array();
        foreach ($request->web_app_module as $module) {
            $dataArr = ['module_id' => $module, 'module_text' => $request["web_app_module_" . $module . "_text"], 'module_sequence' => $request["web_app_" . $module . "_sequence"]];
            $web_app_array[$module] = $dataArr;
        }

        $mobile_app_group_array=array();
        foreach ($request->mobile_app_module as $modulegroup) {
            $mobile_app_array = array();
            if(isset($request["mobile_app_".$modulegroup."_module"])) {
                foreach ($request["mobile_app_" . $modulegroup . "_module"] as $module) {
                    $dataArr = ['module_id' => $module, 'module_text' => $request["mobile_app_module_" . $module . "_text"], 'module_sequence' => $request["mobile_app_" . $module . "_sequence"]];
                    $mobile_app_array[$module] = $dataArr;
                }
            }
            $mobile_app_group_array[$modulegroup]=$mobile_app_array;
        }

        $data['web_app_module'] = serialize($web_app_array);
        $data['mobile_app_module'] = serialize($mobile_app_group_array);
        /**
         * create user map module
         */
        UserMapModule::create($data);
        return back()->with('success', 'Record Update Successful Complete');
    }


}
