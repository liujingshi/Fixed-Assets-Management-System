<?php
namespace app\common\model;

use think\Db;

class Category {

    public static $className = "category";
    public static $mainKey = "cate_id";
    public static $existKey = "cate_exist";
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
       $res =  Db::name(Category::$className)->where(Category::$mainKey, $this->mainKeyValue)->select();
       try {
           return $res[0];
       } catch (Exception $e) {
           return [];
       }
    }

    public function delete() {
        Db::name(Category::$className)->where(Category::$mainKey, $this->mainKeyValue)->update([Category::$existKey => 0]);
    }

    public function update($dic) {
        Db::name(Category::$className)->where(Category::$mainKey, $this->mainKeyValue)->update($dic);
    }

    
    public function getCate_no() {
        $res = Db::name(Category::$className)->where(Category::$mainKey, $this->mainKeyValue)->select();
        try {
            return $res[0]["cate_no"];
        } catch (Exception $e) {
            return "";
        }
    }

    public function setCate_no($value) {
        Db::name(Category::$className)->where(Category::$mainKey, $this->mainKeyValue)->update(["cate_no" => $value]);
    }


    public function getCate_name() {
        $res = Db::name(Category::$className)->where(Category::$mainKey, $this->mainKeyValue)->select();
        try {
            return $res[0]["cate_name"];
        } catch (Exception $e) {
            return "";
        }
    }

    public function setCate_name($value) {
        Db::name(Category::$className)->where(Category::$mainKey, $this->mainKeyValue)->update(["cate_name" => $value]);
    }


    public function getCate_exist() {
        $res = Db::name(Category::$className)->where(Category::$mainKey, $this->mainKeyValue)->select();
        try {
            return $res[0]["cate_exist"];
        } catch (Exception $e) {
            return "";
        }
    }

    public function setCate_exist($value) {
        Db::name(Category::$className)->where(Category::$mainKey, $this->mainKeyValue)->update(["cate_exist" => $value]);
    }


}
