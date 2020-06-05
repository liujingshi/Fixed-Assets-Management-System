<?php
namespace app\common\model;

use think\Db;

class Check_content_status {

    public static $className = "check_content_status";
    public static $mainKey = "c_c_sta_id";
    public static $existKey = "c_c_sta_name";
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
       $res =  Db::name(Check_content_status::$className)->where(Check_content_status::$mainKey, $this->mainKeyValue)->select();
       try {
           return $res[0];
       } catch (Exception $e) {
           return [];
       }
    }

    public function delete() {
        Db::name(Check_content_status::$className)->where(Check_content_status::$mainKey, $this->mainKeyValue)->update([Check_content_status::$existKey => 0]);
    }

    public function update($dic) {
        Db::name(Check_content_status::$className)->where(Check_content_status::$mainKey, $this->mainKeyValue)->update($dic);
    }

    
    public function getC_c_sta_no() {
        $res = Db::name(Check_content_status::$className)->where(Check_content_status::$mainKey, $this->mainKeyValue)->select();
        try {
            return $res[0]["c_c_sta_no"];
        } catch (Exception $e) {
            return "";
        }
    }

    public function setC_c_sta_no($value) {
        Db::name(Check_content_status::$className)->where(Check_content_status::$mainKey, $this->mainKeyValue)->update(["c_c_sta_no" => $value]);
    }


    public function getC_c_sta_name() {
        $res = Db::name(Check_content_status::$className)->where(Check_content_status::$mainKey, $this->mainKeyValue)->select();
        try {
            return $res[0]["c_c_sta_name"];
        } catch (Exception $e) {
            return "";
        }
    }

    public function setC_c_sta_name($value) {
        Db::name(Check_content_status::$className)->where(Check_content_status::$mainKey, $this->mainKeyValue)->update(["c_c_sta_name" => $value]);
    }


}
