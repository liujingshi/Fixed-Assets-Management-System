<?php
namespace app\common\model;

use think\Db;

class Log {

    public static $className = "log";
    public static $mainKey = "log_id";
    public static $existKey = "log_exist";
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

    public static function getByPageText($limit, $page, $category) {
        $limitS = ($page-1)*$limit;
        $sql = "select * from fams_log log, fams_log_category cate, fams_log_action act, fams_user u, fams_person p ";
        $sql .= "where log.log_category_no = '{$category}' and log.log_category_no = cate.log_category_no and log.log_action_no = act.log_action_no and log.u_id = u.u_id and u.p_id = p.p_id and log.log_exist = 1 ";
        $sql .= "order by log.log_datetime desc ";
        $sql .= "limit {$limitS}, {$limit}";
        return Db::query($sql);
    }

    public static function insert($dic) {
        return Db::name(self::$className)->insertGetId($dic);
    }

    public function __construct($mkl) {
        $this->mainKeyValue = $mkl;
    }

    public function select() {
       $res =  Db::name(Log::$className)->where(Log::$mainKey, $this->mainKeyValue)->select();
       try {
           return $res[0];
       } catch (Exception $e) {
           return [];
       }
    }

    public function delete() {
        Db::name(Log::$className)->where(Log::$mainKey, $this->mainKeyValue)->update([Log::$existKey => 0]);
    }

    public function update($dic) {
        Db::name(Log::$className)->where(Log::$mainKey, $this->mainKeyValue)->update($dic);
    }

    
    public function getLog_category_no() {
        $res = Db::name(Log::$className)->where(Log::$mainKey, $this->mainKeyValue)->select();
        try {
            return $res[0]["log_category_no"];
        } catch (Exception $e) {
            return "";
        }
    }

    public function setLog_category_no($value) {
        Db::name(Log::$className)->where(Log::$mainKey, $this->mainKeyValue)->update(["log_category_no" => $value]);
    }


    public function getLog_action_no() {
        $res = Db::name(Log::$className)->where(Log::$mainKey, $this->mainKeyValue)->select();
        try {
            return $res[0]["log_action_no"];
        } catch (Exception $e) {
            return "";
        }
    }

    public function setLog_action_no($value) {
        Db::name(Log::$className)->where(Log::$mainKey, $this->mainKeyValue)->update(["log_action_no" => $value]);
    }


    public function getU_id() {
        $res = Db::name(Log::$className)->where(Log::$mainKey, $this->mainKeyValue)->select();
        try {
            return $res[0]["u_id"];
        } catch (Exception $e) {
            return "";
        }
    }

    public function setU_id($value) {
        Db::name(Log::$className)->where(Log::$mainKey, $this->mainKeyValue)->update(["u_id" => $value]);
    }


    public function getCommon_id() {
        $res = Db::name(Log::$className)->where(Log::$mainKey, $this->mainKeyValue)->select();
        try {
            return $res[0]["common_id"];
        } catch (Exception $e) {
            return "";
        }
    }

    public function setCommon_id($value) {
        Db::name(Log::$className)->where(Log::$mainKey, $this->mainKeyValue)->update(["common_id" => $value]);
    }


    public function getTable_name() {
        $res = Db::name(Log::$className)->where(Log::$mainKey, $this->mainKeyValue)->select();
        try {
            return $res[0]["table_name"];
        } catch (Exception $e) {
            return "";
        }
    }

    public function setTable_name($value) {
        Db::name(Log::$className)->where(Log::$mainKey, $this->mainKeyValue)->update(["table_name" => $value]);
    }


    public function getTable_main_key() {
        $res = Db::name(Log::$className)->where(Log::$mainKey, $this->mainKeyValue)->select();
        try {
            return $res[0]["table_main_key"];
        } catch (Exception $e) {
            return "";
        }
    }

    public function setTable_main_key($value) {
        Db::name(Log::$className)->where(Log::$mainKey, $this->mainKeyValue)->update(["table_main_key" => $value]);
    }


    public function getLog_exist() {
        $res = Db::name(Log::$className)->where(Log::$mainKey, $this->mainKeyValue)->select();
        try {
            return $res[0]["log_exist"];
        } catch (Exception $e) {
            return "";
        }
    }

    public function setLog_exist($value) {
        Db::name(Log::$className)->where(Log::$mainKey, $this->mainKeyValue)->update(["log_exist" => $value]);
    }


}
