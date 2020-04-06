<?php
namespace app\common\model;

use think\Db;

class User_power {

    public static $className = "user_power";
    public static $mainKey = "power_id";
    private $mainKeyValue = "";

    public static function getAll() {
        return Db::name(self::$className)->order(self::$mainKey)->select();
    }

    public static function getByPage($limit, $page) {
        return Db::name(self::$className)->order(self::$mainKey)->page($page, $limit)->select();
    }

    public static function insert($dic) {
        return Db::name(self::$className)->insertGetId($dic);
    }

    public function __construct($mkl) {
        $this->mainKeyValue = $mkl;
    }

    public function select() {
       $res =  Db::name(User_power::$className)->where(User_power::$mainKey, $this->mainKeyValue)->select();
       try {
           return $res[0];
       } catch (Exception $e) {
           return [];
       }
    }

    public function delete() {
        Db::name(User_power::$className)->delete($this->mainKeyValue);
    }

    public function update($dic) {
        Db::name(User_power::$className)->where(User_power::$mainKey, $this->mainKeyValue)->update($dic);
    }

    
    public function getPower_no() {
        $res = Db::name(User_power::$className)->where(User_power::$mainKey, $this->mainKeyValue)->select();
        try {
            return $res[0]["power_no"];
        } catch (Exception $e) {
            return "";
        }
    }

    public function setPower_no($value) {
        Db::name(User_power::$className)->where(User_power::$mainKey, $this->mainKeyValue)->update(["power_no" => $value]);
    }


    public function getPower_name() {
        $res = Db::name(User_power::$className)->where(User_power::$mainKey, $this->mainKeyValue)->select();
        try {
            return $res[0]["power_name"];
        } catch (Exception $e) {
            return "";
        }
    }

    public function setPower_name($value) {
        Db::name(User_power::$className)->where(User_power::$mainKey, $this->mainKeyValue)->update(["power_name" => $value]);
    }


}
