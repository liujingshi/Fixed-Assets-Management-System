<?php
namespace app\common\model;

use think\Db;

class Log_category {

    public static $className = "log_category";
    public static $mainKey = "log_category_id";
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
       $res =  Db::name(Log_category::$className)->where(Log_category::$mainKey, $this->mainKeyValue)->select();
       try {
           return $res[0];
       } catch (Exception $e) {
           return [];
       }
    }

    public function delete() {
        Db::name(Log_category::$className)->delete($this->mainKeyValue);
    }

    public function update($dic) {
        Db::name(Log_category::$className)->where(Log_category::$mainKey, $this->mainKeyValue)->update($dic);
    }

    
    public function getLog_category_no() {
        $res = Db::name(Log_category::$className)->where(Log_category::$mainKey, $this->mainKeyValue)->select();
        try {
            return $res[0]["log_category_no"];
        } catch (Exception $e) {
            return "";
        }
    }

    public function setLog_category_no($value) {
        Db::name(Log_category::$className)->where(Log_category::$mainKey, $this->mainKeyValue)->update(["log_category_no" => $value]);
    }


    public function getLog_category_name() {
        $res = Db::name(Log_category::$className)->where(Log_category::$mainKey, $this->mainKeyValue)->select();
        try {
            return $res[0]["log_category_name"];
        } catch (Exception $e) {
            return "";
        }
    }

    public function setLog_category_name($value) {
        Db::name(Log_category::$className)->where(Log_category::$mainKey, $this->mainKeyValue)->update(["log_category_name" => $value]);
    }


}
