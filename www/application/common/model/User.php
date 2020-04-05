<?php
namespace app\common\model;

use think\Db;

class User {

    public static $className = "user";
    public static $mainKey = "u_id";
    private $mainKeyValue = "";

    public static function getAll() {
        return Db::name(self::$className)->order(self::$mainKey)->select();
    }

    public static function getAllText() {
        $sql = "select * from fams_user u, fams_user_power power, fams_person p ";
        $sql .= "where u.power_no = power.power_no and u.p_id = p.p_id ";
        $sql .= "order by u.u_id";
        return Db::query($sql);
    }

    public static function getByPage($limit, $page) {
        return Db::name(self::$className)->order(self::$mainKey)->page($page, $limit)->select();
    }

    public static function getByPageText($limit, $page) {
        $limitS = ($page-1)*$limit;
        $sql = "select * from fams_user u, fams_user_power power, fams_person p ";
        $sql .= "where u.power_no = power.power_no and u.p_id = p.p_id ";
        $sql .= "order by u.u_id ";
        $sql .= "limit {$limitS}, {$limit}";
        return Db::query($sql);
    }

    public static function checkU_phone($uPhone) {
        return Db::name(self::$className)->where("u_phone", $uPhone)->find();
    }

    public static function getU_idByU_phone($uPhone) {
        $rst = Db::name(self::$className)->where("u_phone", $uPhone)->select();
        if (count($rst) > 0) {
            return $rst[0]['u_id'];
        } else {
            return 0;
        }
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


    public function getU_openid() {
        $res = Db::name(User::$className)->where(User::$mainKey, $this->mainKeyValue)->select();
        try {
            return $res[0]["u_openid"];
        } catch (Exception $e) {
            return "";
        }
    }

    public function setU_openid($value) {
        Db::name(User::$className)->where(User::$mainKey, $this->mainKeyValue)->update(["u_openid" => $value]);
    }


    public function getPower_no() {
        $res = Db::name(User::$className)->where(User::$mainKey, $this->mainKeyValue)->select();
        try {
            return $res[0]["power_no"];
        } catch (Exception $e) {
            return "";
        }
    }

    public function setPower_no($value) {
        Db::name(User::$className)->where(User::$mainKey, $this->mainKeyValue)->update(["power_no" => $value]);
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
