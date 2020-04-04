<?php
namespace app\common\model;

use think\Db;

class Position {

    public static $className = "position";
    public static $mainKey = "pos_id";
    private $mainKeyValue = "";

    public static function getAll() {
        return Db::name(self::$className)->select();
    }

    public static function getByPage($limit, $page) {
        return Db::name(self::$className)->limit(($page-1)*$limit, $limit)->select();
    }

    public static function checkPos_no($posNo) {
        return Db::name(self::$className)->where("pos_no", $posNo)->find();
    }

    public static function insert($dic) {
        Db::name(self::$className)->insert($dic);
    }

    public function __construct($mkl) {
        $this->mainKeyValue = $mkl;
    }

    public function select() {
       $res =  Db::name(Position::$className)->where(Position::$mainKey, $this->mainKeyValue)->select();
       try {
           return $res[0];
       } catch (Exception $e) {
           return [];
       }
    }

    public function delete() {
        Db::name(Position::$className)->delete($this->mainKeyValue);
    }

    public function update($dic) {
        Db::name(Position::$className)->where(Position::$mainKey, $this->mainKeyValue)->update($dic);
    }

    
    public function getPos_no() {
        $res = Db::name(Position::$className)->where(Position::$mainKey, $this->mainKeyValue)->select();
        try {
            return $res[0]["pos_no"];
        } catch (Exception $e) {
            return "";
        }
    }

    public function setPos_no($value) {
        Db::name(Position::$className)->where(Position::$mainKey, $this->mainKeyValue)->update(["pos_no" => $value]);
    }


    public function getPos_name() {
        $res = Db::name(Position::$className)->where(Position::$mainKey, $this->mainKeyValue)->select();
        try {
            return $res[0]["pos_name"];
        } catch (Exception $e) {
            return "";
        }
    }

    public function setPos_name($value) {
        Db::name(Position::$className)->where(Position::$mainKey, $this->mainKeyValue)->update(["pos_name" => $value]);
    }


    public function getPos_remark() {
        $res = Db::name(Position::$className)->where(Position::$mainKey, $this->mainKeyValue)->select();
        try {
            return $res[0]["pos_remark"];
        } catch (Exception $e) {
            return "";
        }
    }

    public function setPos_remark($value) {
        Db::name(Position::$className)->where(Position::$mainKey, $this->mainKeyValue)->update(["pos_remark" => $value]);
    }


}
