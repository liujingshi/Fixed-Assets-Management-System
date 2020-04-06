<?php
namespace app\common\model;

use think\Db;

class Log_action {

    public static $className = "log_action";
    public static $mainKey = "log_action_id";
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
       $res =  Db::name(Log_action::$className)->where(Log_action::$mainKey, $this->mainKeyValue)->select();
       try {
           return $res[0];
       } catch (Exception $e) {
           return [];
       }
    }

    public function delete() {
        Db::name(Log_action::$className)->delete($this->mainKeyValue);
    }

    public function update($dic) {
        Db::name(Log_action::$className)->where(Log_action::$mainKey, $this->mainKeyValue)->update($dic);
    }

    
    public function getLog_action_no() {
        $res = Db::name(Log_action::$className)->where(Log_action::$mainKey, $this->mainKeyValue)->select();
        try {
            return $res[0]["log_action_no"];
        } catch (Exception $e) {
            return "";
        }
    }

    public function setLog_action_no($value) {
        Db::name(Log_action::$className)->where(Log_action::$mainKey, $this->mainKeyValue)->update(["log_action_no" => $value]);
    }


    public function getLog_action_name() {
        $res = Db::name(Log_action::$className)->where(Log_action::$mainKey, $this->mainKeyValue)->select();
        try {
            return $res[0]["log_action_name"];
        } catch (Exception $e) {
            return "";
        }
    }

    public function setLog_action_name($value) {
        Db::name(Log_action::$className)->where(Log_action::$mainKey, $this->mainKeyValue)->update(["log_action_name" => $value]);
    }


}
