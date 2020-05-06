<?php
namespace app\common\model;

use think\Db;
use think\Session;
use app\app\model\Constant;

class Borrowlend {

    public static $className = "borrowlend";
    public static $mainKey = "bl_id";
    public static $existKey = "bl_exist";
    private $mainKeyValue = "";

    public static function getAll() {
        return Db::name(self::$className)->where(self::$existKey, 1)->order(self::$mainKey)->select();
    }

    public static function getAllMe() {
        return Db::name(self::$className)->where([
            self::$existKey => 1,
            "u_id" => Session::get(Constant::USERID)
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

    public static function getByPageText($limit, $page) {
        $limitS = ($page-1)*$limit;
        $uId = Session::get(Constant::USERID);
        $sql = "select * from fams_borrowlend bl, fams_asset ass, fams_status sta, fams_user u, fams_person p ";
        $sql .= "where bl.as_no = ass.as_no and bl.u_id = u.u_id and u.p_id = p.p_id and ass.sta_no = sta.sta_no and bl.bl_exist = 1 ";
        $sql .= "order by bl.b_time desc ";
        $sql .= "limit {$limitS}, {$limit}";
        return Db::query($sql);
    }

    public static function getByPageTextMe($limit, $page) {
        $limitS = ($page-1)*$limit;
        $uId = Session::get(Constant::USERID);
        $sql = "select * from fams_borrowlend bl, fams_asset ass, fams_status sta, fams_user u, fams_person p ";
        $sql .= "where bl.as_no = ass.as_no and bl.u_id = u.u_id and u.p_id = p.p_id and ass.sta_no = sta.sta_no and bl.bl_exist = 1 and bl.u_id = {$uId} ";
        $sql .= "order by bl.b_time desc ";
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
       $res =  Db::name(Borrowlend::$className)->where(Borrowlend::$mainKey, $this->mainKeyValue)->select();
       try {
           return $res[0];
       } catch (Exception $e) {
           return [];
       }
    }

    public function delete() {
        Db::name(Borrowlend::$className)->where(Borrowlend::$mainKey, $this->mainKeyValue)->update([Borrowlend::$existKey => 0]);
    }

    public function update($dic) {
        Db::name(Borrowlend::$className)->where(Borrowlend::$mainKey, $this->mainKeyValue)->update($dic);
    }

    
    public function getAs_no() {
        $res = Db::name(Borrowlend::$className)->where(Borrowlend::$mainKey, $this->mainKeyValue)->select();
        try {
            return $res[0]["as_no"];
        } catch (Exception $e) {
            return "";
        }
    }

    public function setAs_no($value) {
        Db::name(Borrowlend::$className)->where(Borrowlend::$mainKey, $this->mainKeyValue)->update(["as_no" => $value]);
    }


    public function getU_id() {
        $res = Db::name(Borrowlend::$className)->where(Borrowlend::$mainKey, $this->mainKeyValue)->select();
        try {
            return $res[0]["u_id"];
        } catch (Exception $e) {
            return "";
        }
    }

    public function setU_id($value) {
        Db::name(Borrowlend::$className)->where(Borrowlend::$mainKey, $this->mainKeyValue)->update(["u_id" => $value]);
    }


    public function getB_time() {
        $res = Db::name(Borrowlend::$className)->where(Borrowlend::$mainKey, $this->mainKeyValue)->select();
        try {
            return $res[0]["b_time"];
        } catch (Exception $e) {
            return "";
        }
    }

    public function setB_time($value) {
        Db::name(Borrowlend::$className)->where(Borrowlend::$mainKey, $this->mainKeyValue)->update(["b_time" => $value]);
    }


    public function getL_time() {
        $res = Db::name(Borrowlend::$className)->where(Borrowlend::$mainKey, $this->mainKeyValue)->select();
        try {
            return $res[0]["l_time"];
        } catch (Exception $e) {
            return "";
        }
    }

    public function setL_time($value) {
        Db::name(Borrowlend::$className)->where(Borrowlend::$mainKey, $this->mainKeyValue)->update(["l_time" => $value]);
    }


    public function getBl_exist() {
        $res = Db::name(Borrowlend::$className)->where(Borrowlend::$mainKey, $this->mainKeyValue)->select();
        try {
            return $res[0]["bl_exist"];
        } catch (Exception $e) {
            return "";
        }
    }

    public function setBl_exist($value) {
        Db::name(Borrowlend::$className)->where(Borrowlend::$mainKey, $this->mainKeyValue)->update(["bl_exist" => $value]);
    }


}
