<?php
namespace app\common\model;

use think\Db;

class Department {

    public static $className = "department";
    public static $mainKey = "dep_id";
    private $mainKeyValue = "";

    public static function getAll() {
        return Db::name(self::$className)->select();
    }

    public static function getByPage($limit, $page) {
        return Db::name(self::$className)->limit(($page-1)*$limit, $limit)->select();
    }

    public static function getByUp_dep_id($upDepId) {
        return Db::name(self::$className)->where("up_dep_id", $upDepId)->select();
    }

    public static function checkDep_no($depNo) {
        return Db::name(self::$className)->where("dep_no", $depNo)->find();
    }

    public static function insert($dic) {
        Db::name(self::$className)->insert($dic);
    }

    public function __construct($mkl) {
        $this->mainKeyValue = $mkl;
    }

    public function select() {
       $res =  Db::name(Department::$className)->where(Department::$mainKey, $this->mainKeyValue)->select();
       try {
           return $res[0];
       } catch (Exception $e) {
           return [];
       }
    }

    public function delete() {
        Db::name(Department::$className)->delete($this->mainKeyValue);
    }

    public function update($dic) {
        Db::name(Department::$className)->where(Department::$mainKey, $this->mainKeyValue)->update($dic);
    }

    
    public function getDep_no() {
        $res = Db::name(Department::$className)->where(Department::$mainKey, $this->mainKeyValue)->select();
        try {
            return $res[0]["dep_no"];
        } catch (Exception $e) {
            return "";
        }
    }

    public function setDep_no($value) {
        Db::name(Department::$className)->where(Department::$mainKey, $this->mainKeyValue)->update(["dep_no" => $value]);
    }


    public function getDep_name() {
        $res = Db::name(Department::$className)->where(Department::$mainKey, $this->mainKeyValue)->select();
        try {
            return $res[0]["dep_name"];
        } catch (Exception $e) {
            return "";
        }
    }

    public function setDep_name($value) {
        Db::name(Department::$className)->where(Department::$mainKey, $this->mainKeyValue)->update(["dep_name" => $value]);
    }


    public function getUp_dep_id() {
        $res = Db::name(Department::$className)->where(Department::$mainKey, $this->mainKeyValue)->select();
        try {
            return $res[0]["up_dep_id"];
        } catch (Exception $e) {
            return "";
        }
    }

    public function setUp_dep_id($value) {
        Db::name(Department::$className)->where(Department::$mainKey, $this->mainKeyValue)->update(["up_dep_id" => $value]);
    }


    public function getDep_remark() {
        $res = Db::name(Department::$className)->where(Department::$mainKey, $this->mainKeyValue)->select();
        try {
            return $res[0]["dep_remark"];
        } catch (Exception $e) {
            return "";
        }
    }

    public function setDep_remark($value) {
        Db::name(Department::$className)->where(Department::$mainKey, $this->mainKeyValue)->update(["dep_remark" => $value]);
    }

}
