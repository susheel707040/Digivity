<?php

namespace App\Http\Controllers\App\MasterAdmin\GlobalSetting;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterAdmin\GlobalSetting\SMSConfigurationRequest;
use App\Models\MasterAdmin\GlobalSetting\SMSConfiguration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;

class SMSConfigurationController extends Controller
{
    public function index()
    {
        $smsconfiguration=SMSConfiguration::query()->record()->first();
        return view('app.erpmodule.MasterAdmin.GlobalSetting.schoolsetting.sms-configuration',compact(['smsconfiguration']));
    }

    public function store(SMSConfigurationRequest $request)
    {

     $credentials="
     'MSG91_AUTH_KEY' => '154712AvwbLU758TdF59314929',

     'NIMBUS_AUTH_KEY' => '010hQEHTtR009I2ZpZVT',
     'NIMBUS_USER_ID' => '100285',

     'MSGKIRI_AUTH_KEY' => '5cfcd5da04c6519f59e6db2a80f97b',

     'AMAZESMS_AUTH_KEY'=>'010GM0cJ30UJp0WIphVkLmbLeKrox',
     'AMAZESMS_USER_ID'=>'719704'
     ";
     if($request->credentials){
     $credentials=$request->credentials;
     }

$configupdate="<?php

return [
    'SMS_VENDOR'=>'".$request->vendor."',

    'SENDER_ID'=>'".$request->sender_id."',

    ".$credentials."
];

";
        $myfile = fopen(config_path('sms.php'), "w") or die("Unable to open file!");
        fwrite($myfile, $configupdate);
        fclose($myfile);

        SMSConfiguration::query()->record()->forceDelete();
        $smsconfig=SMSConfiguration::create($request->validated());

        Artisan::call('config:clear');
        Artisan::call('config:cache');

        return back()->with('success','Record Update Successful Complete');
    }
}
