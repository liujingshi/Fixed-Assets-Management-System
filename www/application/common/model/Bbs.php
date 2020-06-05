<?php
namespace app\common\model;

use think\Db;

class Bbs {

    public static $className = "bbs";
    public static $mainKey = "bbs_id";
    public static $existKey = "bbs_exist";
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
       $res =  Db::name(Bbs::$className)->where(Bbs::$mainKey, $this->mainKeyValue)->select();
       try {
           return $res[0];
       } catch (Exception $e) {
           return [];
       }
    }

    public function delete() {
        Db::name(Bbs::$className)->where(Bbs::$mainKey, $this->mainKeyValue)->update([Bbs::$existKey => 0]);
    }

    public function update($dic) {
        Db::name(Bbs::$className)->where(Bbs::$mainKey, $this->mainKeyValue)->update($dic);
    }

    
    public function getU_id() {
        $res = Db::name(Bbs::$className)->where(Bbs::$mainKey, $this->mainKeyValue)->select();
        try {
            return $res[0]["u_id"];
        } catch (Exception $e) {
            return "";
        }
    }

    public function setU_id($value) {
        Db::name(Bbs::$className)->where(Bbs::$mainKey, $this->mainKeyValue)->update(["u_id" => $value]);
    }


    public function getUp_bbs_id() {
        $res = Db::name(Bbs::$className)->where(Bbs::$mainKey, $this->mainKeyValue)->select();
        try {
            return $res[0]["up_bbs_id"];
        } catch (Exception $e) {
            return "";
        }
    }

    public function setUp_bbs_id($value) {
        Db::name(Bbs::$className)->where(Bbs::$mainKey, $this->mainKeyValue)->update(["up_bbs_id" => $value]);
    }


    public function getBbs_text() {
        $res = Db::name(Bbs::$className)->where(Bbs::$mainKey, $this->mainKeyValue)->select();
        try {
            return $res[0]["bbs_text"];
        } catch (Exception $e) {
            return "";
        }
    }

    public function setBbs_text($value) {
        Db::name(Bbs::$className)->where(Bbs::$mainKey, $this->mainKeyValue)->update(["bbs_text" => $value]);
    }


    public function getBbs_time() {
        $res = Db::name(Bbs::$className)->where(Bbs::$mainKey, $this->mainKeyValue)->select();
        try {
            return $res[0]["bbs_time"];
        } catch (Exception $e) {
            return "";
        }
    }

    public function setBbs_time($value) {
        Db::name(Bbs::$className)->where(Bbs::$mainKey, $this->mainKeyValue)->update(["bbs_time" => $value]);
    }


    public function getBbs_exist() {
        $res = Db::name(Bbs::$className)->where(Bbs::$mainKey, $this->mainKeyValue)->select();
        try {
            return $res[0]["bbs_exist"];
        } catch (Exception $e) {
            return "";
        }
    }

    public function setBbs_exist($value) {
        Db::name(Bbs::$className)->where(Bbs::$mainKey, $this->mainKeyValue)->update(["bbs_exist" => $value]);
    }


}
