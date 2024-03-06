<?php
namespace App\Helper;

class SMSTemplate
{
    public $smstemplate = array();
    public $emailtemplate=array();

    public function __construct()
    {
        $this->smstemplate = [
            'school-verify'=>['--otp-- is the OTP for your School verify. Do not share the OTP with Anyone. Digi Shiksha never calls to verify it.'],
            'login-otp' => ['--otp-- is the OTP for your Account Login verify. Do not share the OTP with Anyone. Digi Shiksha never calls to verify it.'],
            'pwd-change'=>['Hi --name--, your password change successful complete'],
            '2fa-change'=>['Hi --name--, Your Account Two Factor Authentication Status --status-- Change Successfully Complete'],
            'resetpassword'=>['Save yourself from fraud: NEVER set a password suggested by anyone. One time password is {Otp}. Reset password link : {Link} (Do not forward this to anyone).']
        ];

        $this->emailtemplate=[
            'login-otp'=>['is the OTP for your Account Login verify. Do not share the OTP with Anyone. Digi Shiksha never calls to verify it.']
        ];
    }

    public static function getsmstemplate($key)
    {
        return (new static())->smstemplate[$key];
    }

    public static function getemailtemplate($key)
    {
        return (new static())->emailtemplate[$key];
    }

    /*
     * SMS Template Get
     */
    public static function getsmsbyid($key)
    {
        return \App\Models\MasterAdmin\Communication\SMSTemplate::query()->where(['sms_type'=>$key,'is_active'=>'1'])->first();
    }

}
