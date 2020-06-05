<?php
namespace app\app\model;

use think\Session;
use think\Cookie;
use app\app\model\Constant;
use app\common\model\User;
use app\common\model\Person;
use app\common\model\Cms;

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
    public static function createQrcode($value, $name) {
        vendor('phpqrcode');
        $errorCorrectionLevel = 'L';
        $matrixPointSize = 5;
        $filename = 'qrcode/'.$name.'.png';
        \QRcode::png($value, $filename, $errorCorrectionLevel, $matrixPointSize, 2);
    }

    /**
     * 创建随机AES秘钥
     */
    public static function createAESm() {
        $no = "";
        $pattern = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLOMNOPQRSTUVWXYZ';
        $returnStr = '';
        for($i = 0; $i < rand(10,100); $i ++) {
            $returnStr .= $pattern[mt_rand(0, 61)];
        }
        $no = $returnStr . time();
        $returnStr = '';
        for($i = 0; $i < rand(10,100); $i ++) {
            $returnStr .= $pattern[mt_rand(0, 61)];
        }
        $no .= $returnStr;
        return strtoupper(md5($no));
    }

    /**
     * AES加密
     */
    public static function aesEncode($data, $aesM){
        $method = 'AES-128-ECB';
        $options = 0;
        $iv = '';
        return openssl_encrypt($data, $method, $aesM, $options, $iv);
    }

    /**
     * AES解密
     */
    public static function aesDecode($data, $aesM){
        $method = 'AES-128-ECB';
        $options = 0;
        $iv = '';
        return openssl_decrypt($data, $method, $aesM, $options, $iv);
    }
    
    /**
     * RSA解密
     */
    public static function rsaDecode($data, $rsaPublicKey) {
        $search = [
			"-----BEGIN PUBLIC KEY-----",
			"-----END PUBLIC KEY-----",
			"\n",
			"\r",
			"\r\n"
		];
        $rsaPublicKey = str_replace($search, "", $rsaPublicKey);
        $publicKey = $search[0] . PHP_EOL . wordwrap($rsaPublicKey, 64, "\n", true) . PHP_EOL . $search[1];
        openssl_public_decrypt($data, $rst, $publicKey);
        return $rst;
    }

    /**
     * RSA加密
     */
    public static function rsaEncode($data, $rsaPrivateKey) {
        $search = [
            "-----BEGIN RSA PRIVATE KEY-----",
            "-----END RSA PRIVATE KEY-----",
            "\n",
            "\r",
            "\r\n"
        ];
        $rsaPrivateKey = str_replace($search, "", $rsaPrivateKey);
        $privateKey = $search[0] . PHP_EOL . wordwrap($rsaPrivateKey, 64, "\n", true) . PHP_EOL . $search[1];
        openssl_private_encrypt($data, $rst, $privateKey);
        return $rst;
    }

    /**
     * 二维码加密算法
     */
    public static function qrcodeEncode($data) {
        while (true) {
            $n = mt_rand(2, 40);
            if (Utils::isSS($n)) {
                break;
            }
        }
        for ($i = 0; $i < $n; $i++) {
            $aesM = Utils::createAESm();
        }
        $q2 = Utils::aesEncode($data, $aesM);
        $q1 = Utils::rsaEncode($aesM, Cms::get("privateKeyString"));
        $jsonData = [
            "n" => $n,
            "r1" => base64_encode($q1),
            "r2" => base64_encode($q2)
        ];
        $jsonString = json_encode($jsonData);
        $result = base64_encode($jsonString);
        return $result;    
    }

    /**
     * 二维码解密算法
     */
    public static function qrcodeDecode($data) {
        $jsonString = base64_decode($data);
        $jsonData = json_decode($jsonString);
        $result = "error";
        if (Utils::isSS($jsonData->n)) {
            $q1 = base64_decode($jsonData->r1);
            $q2 = base64_decode($jsonData->r2);
            $aesM = Utils::rsaDecode($q1, Cms::get("publicKeyString"));
            $result = Utils::aesDecode($q2, $aesM);
        }
        return $result;
    }

    /**
     * 是质数
     */
    public static function isSS($num) {
        for ($j = 2; $j < sqrt($num); $j++) {
            if ($num % $j == 0) {
                return false;
            }
        }
        return true;
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
