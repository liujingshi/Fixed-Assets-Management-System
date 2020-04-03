<?php
namespace app\app\model;

use think\Session;
use think\Cookie;
use app\app\model\Constant;

class Utils {

    public static function userAlreadyLogin() {
        if (Session::has(Constant::USERLOGINSTATUSSESSIONKEY) && Session::get(Constant::USERLOGINSTATUSSESSIONKEY) == Constant::USERLOGIN) {
            Cookie::set(Constant::USERLOGINSTATUSCOOKIEKEY, Constant::USERLOGIN, 300);
            return true;
        } else if (Cookie::has(Constant::USERLOGINSTATUSCOOKIEKEY) && Cookie::get(Constant::USERLOGINSTATUSCOOKIEKEY) == Constant::USERLOGIN) {
            Session::set(Constant::USERLOGINSTATUSSESSIONKEY, Constant::USERLOGIN);
            return true;
        } else {
            return false;
        }
    }

    public static function logout() {
        Cookie::set(Constant::USERLOGINSTATUSCOOKIEKEY, Constant::USERLOGOUT, -1);
        Session::set(Constant::USERLOGINSTATUSSESSIONKEY, Constant::USERLOGOUT);
    }

    public static function returnCode($code) {
        return [
            "code" => $code
        ];
    }

    public static function returnMsg($code, $msg) {
        return [
            "code" => $code,
            "msg" => $msg
        ];
    }

    public static function returnObj($code, $msg, $obj) {
        return [
            "code" => $code,
            "msg" => $msg,
            "obj" => $obj
        ];
    }

}
