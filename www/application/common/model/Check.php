<?php
namespace app\common\model;

use think\Db;

class Check {

    public static $className = "check";
    public static $mainKey = "c_id";
    public static $existKey = "c_exist";
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

    public static function getByPageText($limit, $page) {
        $limitS = ($page-1)*$limit;
        $rst = [];
        $sql  = "select * from fams_check c, fams_check_status c_sta ";
        $sql .= "where c.c_sta_no = c_sta.c_sta_no ";
        $sql .= "and c.c_exist = 1 and c.u_id = 0 ";
        $sql .= "order by c.c_time desc ";
        $sql .= "limit {$limitS}, {$limit}";
        $rst = array_merge($rst, Db::query($sql));
        $sql  = "select * from fams_check c, fams_check_status c_sta, fams_user u, fams_person p ";
        $sql .= "where c.c_sta_no = c_sta.c_sta_no and c.u_id = u.u_id and u.p_id = p.p_id ";
        $sql .= "and c.c_exist = 1 ";
        $sql .= "order by c.c_time desc ";
        $sql .= "limit {$limitS}, {$limit}";
        $rst = array_merge($rst, Db::query($sql));
        return $rst;
    }

    public static function insert($dic) {
        return Db::name(self::$className)->insertGetId($dic);
    }

    public function __construct($mkl) {
        $this->mainKeyValue = $mkl;
    }

    public function select() {
       $res =  Db::name(Check::$className)->where(Check::$mainKey, $this->mainKeyValue)->select();
       try {
           return $res[0];
       } catch (Exception $e) {
           return [];
       }
    }

    public function delete() {
        Db::name(Check::$className)->where(Check::$mainKey, $this->mainKeyValue)->update([Check::$existKey => 0]);
    }

    public function update($dic) {
        Db::name(Check::$className)->where(Check::$mainKey, $this->mainKeyValue)->update($dic);
    }

    
    public function getC_title() {
        $res = Db::name(Check::$className)->where(Check::$mainKey, $this->mainKeyValue)->select();
        try {
            return $res[0]["c_title"];
        } catch (Exception $e) {
            return "";
        }
    }

    public function setC_title($value) {
        Db::name(Check::$className)->where(Check::$mainKey, $this->mainKeyValue)->update(["c_title" => $value]);
    }


    public function getU_id() {
        $res = Db::name(Check::$className)->where(Check::$mainKey, $this->mainKeyValue)->select();
        try {
            return $res[0]["u_id"];
        } catch (Exception $e) {
            return "";
        }
    }

    public function setU_id($value) {
        Db::name(Check::$className)->where(Check::$mainKey, $this->mainKeyValue)->update(["u_id" => $value]);
    }


    public function getC_time() {
        $res = Db::name(Check::$className)->where(Check::$mainKey, $this->mainKeyValue)->select();
        try {
            return $res[0]["c_time"];
        } catch (Exception $e) {
            return "";
        }
    }

    public function setC_time($value) {
        Db::name(Check::$className)->where(Check::$mainKey, $this->mainKeyValue)->update(["c_time" => $value]);
    }


    public function getC_e_time() {
        $res = Db::name(Check::$className)->where(Check::$mainKey, $this->mainKeyValue)->select();
        try {
            return $res[0]["c_e_time"];
        } catch (Exception $e) {
            return "";
        }
    }

    public function setC_e_time($value) {
        Db::name(Check::$className)->where(Check::$mainKey, $this->mainKeyValue)->update(["c_e_time" => $value]);
    }


    public function getC_sta_no() {
        $res = Db::name(Check::$className)->where(Check::$mainKey, $this->mainKeyValue)->select();
        try {
            return $res[0]["c_sta_no"];
        } catch (Exception $e) {
            return "";
        }
    }

    public function setC_sta_no($value) {
        Db::name(Check::$className)->where(Check::$mainKey, $this->mainKeyValue)->update(["c_sta_no" => $value]);
    }


    public function getC_exist() {
        $res = Db::name(Check::$className)->where(Check::$mainKey, $this->mainKeyValue)->select();
        try {
            return $res[0]["c_exist"];
        } catch (Exception $e) {
            return "";
        }
    }

    public function setC_exist($value) {
        Db::name(Check::$className)->where(Check::$mainKey, $this->mainKeyValue)->update(["c_exist" => $value]);
    }


}
