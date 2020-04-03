<?php
namespace app\common\model;

use think\Db;

class User {

    public static $className = "user";
    public static $mainKey = "u_id";
    private $mainKeyValue = "";

    public static function getAll() {
        return Db::name(self::$className)->select();
    }

    public static function getByPage($limit, $page) {
        return Db::name(self::$className)->limit(($page-1)*$limit, $limit)->select();
    }

    public static function insert($dic) {
        Db::name(self::$className)->insert($dic);
    }

    public function __construct($mkl) {
        $this->mainKeyValue = $mkl;
    }

    public function select() {
       $res =  Db::name(User::$className)->where(User::$mainKey, $this->mainKeyValue)->select();
       try {
           return $res[0];
       } catch (Exception $e) {
           return [];
       }
    }

    public function delete() {
        Db::name(User::$className)->delete($this->mainKeyValue);
    }

    public function update($dic) {
        Db::name(User::$className)->where(User::$mainKey, $this->mainKeyValue)->update($dic);
    }

    
    public function getP_id() {
        $res = Db::name(User::$className)->where(User::$mainKey, $this->mainKeyValue)->select();
        try {
            return $res[0]["p_id"];
        } catch (Exception $e) {
            return "";
        }
    }

    public function setP_id($value) {
        Db::name(User::$className)->where(User::$mainKey, $this->mainKeyValue)->update(["p_id" => $value]);
    }


    public function getU_phone() {
        $res = Db::name(User::$className)->where(User::$mainKey, $this->mainKeyValue)->select();
        try {
            return $res[0]["u_phone"];
        } catch (Exception $e) {
            return "";
        }
    }

    public function setU_phone($value) {
        Db::name(User::$className)->where(User::$mainKey, $this->mainKeyValue)->update(["u_phone" => $value]);
    }


    public function getU_type() {
        $res = Db::name(User::$className)->where(User::$mainKey, $this->mainKeyValue)->select();
        try {
            return $res[0]["u_type"];
        } catch (Exception $e) {
            return "";
        }
    }

    public function setU_type($value) {
        Db::name(User::$className)->where(User::$mainKey, $this->mainKeyValue)->update(["u_type" => $value]);
    }


    public function getU_password() {
        $res = Db::name(User::$className)->where(User::$mainKey, $this->mainKeyValue)->select();
        try {
            return $res[0]["u_password"];
        } catch (Exception $e) {
            return "";
        }
    }

    public function setU_password($value) {
        Db::name(User::$className)->where(User::$mainKey, $this->mainKeyValue)->update(["u_password" => $value]);
    }


    public function getU_head() {
        $res = Db::name(User::$className)->where(User::$mainKey, $this->mainKeyValue)->select();
        try {
            return $res[0]["u_head"];
        } catch (Exception $e) {
            return "";
        }
    }

    public function setU_head($value) {
        Db::name(User::$className)->where(User::$mainKey, $this->mainKeyValue)->update(["u_head" => $value]);
    }


    public function getU_money() {
        $res = Db::name(User::$className)->where(User::$mainKey, $this->mainKeyValue)->select();
        try {
            return $res[0]["u_money"];
        } catch (Exception $e) {
            return "";
        }
    }

    public function setU_money($value) {
        Db::name(User::$className)->where(User::$mainKey, $this->mainKeyValue)->update(["u_money" => $value]);
    }


}
