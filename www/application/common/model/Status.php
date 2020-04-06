<?php
namespace app\common\model;

use think\Db;

class Status {

    public static $className = "status";
    public static $mainKey = "sta_id";
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
       $res =  Db::name(Status::$className)->where(Status::$mainKey, $this->mainKeyValue)->select();
       try {
           return $res[0];
       } catch (Exception $e) {
           return [];
       }
    }

    public function delete() {
        Db::name(Status::$className)->delete($this->mainKeyValue);
    }

    public function update($dic) {
        Db::name(Status::$className)->where(Status::$mainKey, $this->mainKeyValue)->update($dic);
    }

    
    public function getSta_no() {
        $res = Db::name(Status::$className)->where(Status::$mainKey, $this->mainKeyValue)->select();
        try {
            return $res[0]["sta_no"];
        } catch (Exception $e) {
            return "";
        }
    }

    public function setSta_no($value) {
        Db::name(Status::$className)->where(Status::$mainKey, $this->mainKeyValue)->update(["sta_no" => $value]);
    }


    public function getSta_name() {
        $res = Db::name(Status::$className)->where(Status::$mainKey, $this->mainKeyValue)->select();
        try {
            return $res[0]["sta_name"];
        } catch (Exception $e) {
            return "";
        }
    }

    public function setSta_name($value) {
        Db::name(Status::$className)->where(Status::$mainKey, $this->mainKeyValue)->update(["sta_name" => $value]);
    }


}
