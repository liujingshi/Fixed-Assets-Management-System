<?php
namespace app\common\model;

use think\Db;

class Person {

    public static $className = "person";
    public static $mainKey = "p_id";
    private $mainKeyValue = "";

    public static function getAll() {
        return Db::name(self::$className)->select();
    }

    public static function getByPage($limit, $page) {
        return Db::name(self::$className)->limit(($page-1)*$limit, $limit)->select();
    }

    public static function insert($dic) {
        Db::name(self::$className)->insert($dic);
    }

    public function __construct($mkl) {
        $this->mainKeyValue = $mkl;
    }

    public function select() {
       $res =  Db::name(Person::$className)->where(Person::$mainKey, $this->mainKeyValue)->select();
       try {
           return $res[0];
       } catch (Exception $e) {
           return [];
       }
    }

    public function delete() {
        Db::name(Person::$className)->delete($this->mainKeyValue);
    }

    public function update($dic) {
        Db::name(Person::$className)->where(Person::$mainKey, $this->mainKeyValue)->update($dic);
    }

    
    public function getP_no() {
        $res = Db::name(Person::$className)->where(Person::$mainKey, $this->mainKeyValue)->select();
        try {
            return $res[0]["p_no"];
        } catch (Exception $e) {
            return "";
        }
    }

    public function setP_no($value) {
        Db::name(Person::$className)->where(Person::$mainKey, $this->mainKeyValue)->update(["p_no" => $value]);
    }


    public function getDep_id() {
        $res = Db::name(Person::$className)->where(Person::$mainKey, $this->mainKeyValue)->select();
        try {
            return $res[0]["dep_id"];
        } catch (Exception $e) {
            return "";
        }
    }

    public function setDep_id($value) {
        Db::name(Person::$className)->where(Person::$mainKey, $this->mainKeyValue)->update(["dep_id" => $value]);
    }


    public function getPos_id() {
        $res = Db::name(Person::$className)->where(Person::$mainKey, $this->mainKeyValue)->select();
        try {
            return $res[0]["pos_id"];
        } catch (Exception $e) {
            return "";
        }
    }

    public function setPos_id($value) {
        Db::name(Person::$className)->where(Person::$mainKey, $this->mainKeyValue)->update(["pos_id" => $value]);
    }


    public function getP_name() {
        $res = Db::name(Person::$className)->where(Person::$mainKey, $this->mainKeyValue)->select();
        try {
            return $res[0]["p_name"];
        } catch (Exception $e) {
            return "";
        }
    }

    public function setP_name($value) {
        Db::name(Person::$className)->where(Person::$mainKey, $this->mainKeyValue)->update(["p_name" => $value]);
    }


    public function getP_sex() {
        $res = Db::name(Person::$className)->where(Person::$mainKey, $this->mainKeyValue)->select();
        try {
            return $res[0]["p_sex"];
        } catch (Exception $e) {
            return "";
        }
    }

    public function setP_sex($value) {
        Db::name(Person::$className)->where(Person::$mainKey, $this->mainKeyValue)->update(["p_sex" => $value]);
    }


    public function getP_birthday() {
        $res = Db::name(Person::$className)->where(Person::$mainKey, $this->mainKeyValue)->select();
        try {
            return $res[0]["p_birthday"];
        } catch (Exception $e) {
            return "";
        }
    }

    public function setP_birthday($value) {
        Db::name(Person::$className)->where(Person::$mainKey, $this->mainKeyValue)->update(["p_birthday" => $value]);
    }


    public function getP_ic() {
        $res = Db::name(Person::$className)->where(Person::$mainKey, $this->mainKeyValue)->select();
        try {
            return $res[0]["p_ic"];
        } catch (Exception $e) {
            return "";
        }
    }

    public function setP_ic($value) {
        Db::name(Person::$className)->where(Person::$mainKey, $this->mainKeyValue)->update(["p_ic" => $value]);
    }


    public function getP_email() {
        $res = Db::name(Person::$className)->where(Person::$mainKey, $this->mainKeyValue)->select();
        try {
            return $res[0]["p_email"];
        } catch (Exception $e) {
            return "";
        }
    }

    public function setP_email($value) {
        Db::name(Person::$className)->where(Person::$mainKey, $this->mainKeyValue)->update(["p_email" => $value]);
    }


}
