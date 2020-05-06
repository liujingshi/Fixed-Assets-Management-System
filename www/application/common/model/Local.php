<?php
namespace app\common\model;

use think\Db;

class Local {

    public static $className = "local";
    public static $mainKey = "local_id";
    public static $existKey = "local_exist";
    private $mainKeyValue = "";

    public static function getAll() {
        return Db::name(self::$className)->where(self::$existKey, 1)->order(self::$mainKey)->select();
    }

    public static function getAllWhitNotExist() {
        return Db::name(self::$className)->order(self::$mainKey)->select();
    }

    public static function getByPage($limit, $page) {
        return Db::name(self::$className)->where(self::$existKey, 1)->order(self::$mainKey)->page($page, $limit)->select();
    }

    public static function getByPageWhitNotExist($limit, $page) {
        return Db::name(self::$className)->order(self::$mainKey)->page($page, $limit)->select();
    }

    public static function insert($dic) {
        return Db::name(self::$className)->insertGetId($dic);
    }

    public function __construct($mkl) {
        $this->mainKeyValue = $mkl;
    }

    public function select() {
       $res =  Db::name(Local::$className)->where(Local::$mainKey, $this->mainKeyValue)->select();
       try {
           return $res[0];
       } catch (Exception $e) {
           return [];
       }
    }

    public function delete() {
        Db::name(Local::$className)->where(Local::$mainKey, $this->mainKeyValue)->update([Local::$existKey => 0]);
    }

    public function update($dic) {
        Db::name(Local::$className)->where(Local::$mainKey, $this->mainKeyValue)->update($dic);
    }

    
    public function getLocal_name() {
        $res = Db::name(Local::$className)->where(Local::$mainKey, $this->mainKeyValue)->select();
        try {
            return $res[0]["local_name"];
        } catch (Exception $e) {
            return "";
        }
    }

    public function setLocal_name($value) {
        Db::name(Local::$className)->where(Local::$mainKey, $this->mainKeyValue)->update(["local_name" => $value]);
    }


    public function getLocal_data() {
        $res = Db::name(Local::$className)->where(Local::$mainKey, $this->mainKeyValue)->select();
        try {
            return $res[0]["local_data"];
        } catch (Exception $e) {
            return "";
        }
    }

    public function setLocal_data($value) {
        Db::name(Local::$className)->where(Local::$mainKey, $this->mainKeyValue)->update(["local_data" => $value]);
    }


    public function getLocal_exist() {
        $res = Db::name(Local::$className)->where(Local::$mainKey, $this->mainKeyValue)->select();
        try {
            return $res[0]["local_exist"];
        } catch (Exception $e) {
            return "";
        }
    }

    public function setLocal_exist($value) {
        Db::name(Local::$className)->where(Local::$mainKey, $this->mainKeyValue)->update(["local_exist" => $value]);
    }


}
