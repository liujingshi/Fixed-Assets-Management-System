<?php
namespace app\common\model;

use think\Db;

class Repair {

    public static $className = "repair";
    public static $mainKey = "rep_id";
    public static $existKey = "rep_exist";
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
       $res =  Db::name(Repair::$className)->where(Repair::$mainKey, $this->mainKeyValue)->select();
       try {
           return $res[0];
       } catch (Exception $e) {
           return [];
       }
    }

    public function delete() {
        Db::name(Repair::$className)->where(Repair::$mainKey, $this->mainKeyValue)->update([Repair::$existKey => 0]);
    }

    public function update($dic) {
        Db::name(Repair::$className)->where(Repair::$mainKey, $this->mainKeyValue)->update($dic);
    }

    
    public function getAs_no() {
        $res = Db::name(Repair::$className)->where(Repair::$mainKey, $this->mainKeyValue)->select();
        try {
            return $res[0]["as_no"];
        } catch (Exception $e) {
            return "";
        }
    }

    public function setAs_no($value) {
        Db::name(Repair::$className)->where(Repair::$mainKey, $this->mainKeyValue)->update(["as_no" => $value]);
    }


    public function getRep_price() {
        $res = Db::name(Repair::$className)->where(Repair::$mainKey, $this->mainKeyValue)->select();
        try {
            return $res[0]["rep_price"];
        } catch (Exception $e) {
            return "";
        }
    }

    public function setRep_price($value) {
        Db::name(Repair::$className)->where(Repair::$mainKey, $this->mainKeyValue)->update(["rep_price" => $value]);
    }


    public function getRep_time() {
        $res = Db::name(Repair::$className)->where(Repair::$mainKey, $this->mainKeyValue)->select();
        try {
            return $res[0]["rep_time"];
        } catch (Exception $e) {
            return "";
        }
    }

    public function setRep_time($value) {
        Db::name(Repair::$className)->where(Repair::$mainKey, $this->mainKeyValue)->update(["rep_time" => $value]);
    }


    public function getRep_exist() {
        $res = Db::name(Repair::$className)->where(Repair::$mainKey, $this->mainKeyValue)->select();
        try {
            return $res[0]["rep_exist"];
        } catch (Exception $e) {
            return "";
        }
    }

    public function setRep_exist($value) {
        Db::name(Repair::$className)->where(Repair::$mainKey, $this->mainKeyValue)->update(["rep_exist" => $value]);
    }


}
