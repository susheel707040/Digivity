<?php


namespace App\Helper;


class MobileNumberValidate
{
    public static function validate($mobileno)
    {
        $success="<i class='fa fa-check-circle pd-l-1 tx-success'></i>";
        $error="<i class='fa fa-times-circle tx-danger'></i>";
        if(is_numeric($mobileno)){
            return $mobileno."<span>$success</span>";
        }
        return $mobileno."<span>$error</span>";
    }
}
