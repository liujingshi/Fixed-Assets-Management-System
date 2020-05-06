<?php
namespace app\app\model;

use think\Session;
use think\Cookie;
use app\app\model\Constant;
use app\common\model\User;
use app\common\model\Person;

class Utils {

    /**
     * 判断用户是否已经登录
     */
    public static function userAlreadyLogin() {
        if (Session::has(Constant::USERLOGINSTATUS) && Session::get(Constant::USERLOGINSTATUS) == Constant::USERLOGIN) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 登出
     */
    public static function logout() {
        Session::set(Constant::USERLOGINSTATUS, Constant::USERLOGOUT);
    }

    /**
     * 获取已登录的用户信息
     */
    public static function getUserinfo() {
        $user = new User(Session::get(Constant::USERID));
        $pId = $user->getP_id();
        $uName = $user->getU_phone();
        if ($pId > 0) {
            $person = new Person($pId);
            $uName = $person->getP_name();
        }
        $userinfo = [
            "uId" => Session::get(Constant::USERID),
            "uName" => $uName,
            "uHead" => $user->getU_head(),
            "powerNo" => $user->getPower_no()
        ];
        return $userinfo;
    }

    /**
     * 生成二维码
     */
    public static function createQrcode($value) {
        vendor('phpqrcode');
        $errorCorrectionLevel = 'L';
        $matrixPointSize = 5;
        $filename = 'qrcode/'.$value.'.png';
        \QRcode::png($value, $filename, $errorCorrectionLevel, $matrixPointSize, 2);
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
