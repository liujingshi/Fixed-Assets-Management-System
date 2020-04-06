<?php
namespace app\common\model;

use think\Db;

class Person {

    public static $className = "person";
    public static $mainKey = "p_id";
    public static $existKey = "p_exist";
    private $mainKeyValue = "";

    public static function getAll() {
        return Db::name(self::$className)->where(self::$existKey, 1)->order(self::$mainKey)->select();
    }

    public static function getAllWhitNotExist() {
        return Db::name(self::$className)->order(self::$mainKey)->select();
    }

    public static function getAllText() {
        $sql = "select * from fams_person p, fams_department dep, fams_position pos ";
        $sql .= "where p.dep_id = dep.dep_id and p.pos_id = pos.pos_id and p.p_exist = 1 ";
        $sql .= "order by p.p_id";
        return Db::query($sql);
    }

    public static function getByPage($limit, $page) {
        return Db::name(self::$className)->where(self::$existKey, 1)->order(self::$mainKey)->page($page, $limit)->select();
    }

    public static function getByPageText($limit, $page) {
        $limitS = ($page-1)*$limit;
        $sql = "select * from fams_person p, fams_department dep, fams_position pos ";
        $sql .= "where p.dep_id = dep.dep_id and p.pos_id = pos.pos_id and p.p_exist = 1 ";
        $sql .= "order by p.p_id ";
        $sql .= "limit {$limitS}, {$limit}";
        return Db::query($sql);
    }

    public static function checkP_no($pNo) {
        return Db::name(self::$className)->where(["p_no" => $pNo, self::$existKey => 1])->find();
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
       $res =  Db::name(Person::$className)->where(Person::$mainKey, $this->mainKeyValue)->select();
       try {
           return $res[0];
       } catch (Exception $e) {
           return [];
       }
    }

    public function delete() {
        Db::name(Person::$className)->where(Person::$mainKey, $this->mainKeyValue)->update([Person::$existKey => 0]);
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


    public function getP_exist() {
        $res = Db::name(Person::$className)->where(Person::$mainKey, $this->mainKeyValue)->select();
        try {
            return $res[0]["p_exist"];
        } catch (Exception $e) {
            return "";
        }
    }

    public function setP_exist($value) {
        Db::name(Person::$className)->where(Person::$mainKey, $this->mainKeyValue)->update(["p_exist" => $value]);
    }


}
