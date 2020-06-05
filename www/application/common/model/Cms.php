<?php
namespace app\common\model;

use think\Db;

class Cms {

    public static $className = "cms";
    public static $mainKey = "cms_id";
    public static $existKey = "cms_value";
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

    public static function get($key) {
        $res =  Db::name(self::$className)->where("cms_key", $key)->select();
        if (count($res) > 0) {
            return $res[0]['cms_value'];
        }
    }

    public static function insert($dic) {
        return Db::name(self::$className)->insertGetId($dic);
    }

    public function __construct($mkl) {
        $this->mainKeyValue = $mkl;
    }

    public function select() {
       $res =  Db::name(Cms::$className)->where(Cms::$mainKey, $this->mainKeyValue)->select();
       try {
           return $res[0];
       } catch (Exception $e) {
           return [];
       }
    }

    public function delete() {
        Db::name(Cms::$className)->where(Cms::$mainKey, $this->mainKeyValue)->update([Cms::$existKey => 0]);
    }

    public function update($dic) {
        Db::name(Cms::$className)->where(Cms::$mainKey, $this->mainKeyValue)->update($dic);
    }

    
    public function getCms_name() {
        $res = Db::name(Cms::$className)->where(Cms::$mainKey, $this->mainKeyValue)->select();
        try {
            return $res[0]["cms_name"];
        } catch (Exception $e) {
            return "";
        }
    }

    public function setCms_name($value) {
        Db::name(Cms::$className)->where(Cms::$mainKey, $this->mainKeyValue)->update(["cms_name" => $value]);
    }


    public function getCms_key() {
        $res = Db::name(Cms::$className)->where(Cms::$mainKey, $this->mainKeyValue)->select();
        try {
            return $res[0]["cms_key"];
        } catch (Exception $e) {
            return "";
        }
    }

    public function setCms_key($value) {
        Db::name(Cms::$className)->where(Cms::$mainKey, $this->mainKeyValue)->update(["cms_key" => $value]);
    }


    public function getCms_value() {
        $res = Db::name(Cms::$className)->where(Cms::$mainKey, $this->mainKeyValue)->select();
        try {
            return $res[0]["cms_value"];
        } catch (Exception $e) {
            return "";
        }
    }

    public function setCms_value($value) {
        Db::name(Cms::$className)->where(Cms::$mainKey, $this->mainKeyValue)->update(["cms_value" => $value]);
    }


}
