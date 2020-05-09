<?php
namespace app\common\model;

use think\Db;

class Check_content {

    public static $className = "check_content";
    public static $mainKey = "c_c_id";
    public static $existKey = "c_c_exist";
    private $mainKeyValue = "";

    public static function getAll() {
        return Db::name(self::$className)->where(self::$existKey, 1)->order(self::$mainKey)->select();
    }

    public static function getAllc($cId) {
        return Db::name(self::$className)->where([
            self::$existKey => 1,
            "c_id" => $cId
        ])->order(self::$mainKey)->select();
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

    public static function getByPageTextc($limit, $page, $cId) {
        $limitS = ($page-1)*$limit;
        $sql  = "select * from fams_check_content c_c, fams_asset ass, fams_status sta, fams_category cate, fams_local local ";
        $sql .= "where c_c.as_no = ass.as_no and ass.sta_no = sta.sta_no and ass.as_local_id = local.local_id and ass.cate_id = cate.cate_id ";
        $sql .= "and c_c.c_c_exist = 1 and c_id = {$cId} ";
        $sql .= "order by c_c.c_c_id desc ";
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
       $res =  Db::name(Check_content::$className)->where(Check_content::$mainKey, $this->mainKeyValue)->select();
       try {
           return $res[0];
       } catch (Exception $e) {
           return [];
       }
    }

    public function delete() {
        Db::name(Check_content::$className)->where(Check_content::$mainKey, $this->mainKeyValue)->update([Check_content::$existKey => 0]);
    }

    public function update($dic) {
        Db::name(Check_content::$className)->where(Check_content::$mainKey, $this->mainKeyValue)->update($dic);
    }

    
    public function getC_id() {
        $res = Db::name(Check_content::$className)->where(Check_content::$mainKey, $this->mainKeyValue)->select();
        try {
            return $res[0]["c_id"];
        } catch (Exception $e) {
            return "";
        }
    }

    public function setC_id($value) {
        Db::name(Check_content::$className)->where(Check_content::$mainKey, $this->mainKeyValue)->update(["c_id" => $value]);
    }


    public function getAs_no() {
        $res = Db::name(Check_content::$className)->where(Check_content::$mainKey, $this->mainKeyValue)->select();
        try {
            return $res[0]["as_no"];
        } catch (Exception $e) {
            return "";
        }
    }

    public function setAs_no($value) {
        Db::name(Check_content::$className)->where(Check_content::$mainKey, $this->mainKeyValue)->update(["as_no" => $value]);
    }


    public function getC_c_image() {
        $res = Db::name(Check_content::$className)->where(Check_content::$mainKey, $this->mainKeyValue)->select();
        try {
            return $res[0]["c_c_image"];
        } catch (Exception $e) {
            return "";
        }
    }

    public function setC_c_image($value) {
        Db::name(Check_content::$className)->where(Check_content::$mainKey, $this->mainKeyValue)->update(["c_c_image" => $value]);
    }


    public function getC_c_exist() {
        $res = Db::name(Check_content::$className)->where(Check_content::$mainKey, $this->mainKeyValue)->select();
        try {
            return $res[0]["c_c_exist"];
        } catch (Exception $e) {
            return "";
        }
    }

    public function setC_c_exist($value) {
        Db::name(Check_content::$className)->where(Check_content::$mainKey, $this->mainKeyValue)->update(["c_c_exist" => $value]);
    }


}
