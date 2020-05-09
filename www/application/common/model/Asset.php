<?php
namespace app\common\model;

use think\Db;

class Asset {

    public static $className = "asset";
    public static $mainKey = "as_id";
    public static $existKey = "as_exist";
    private $mainKeyValue = "";

    public static function getAll() {
        return Db::name(self::$className)->where(self::$existKey, 1)->order(self::$mainKey)->select();
    }

    public static function getAllWhitNotExist() {
        return Db::name(self::$className)->order(self::$mainKey)->select();
    }

    public static function getAllSP() {
        return Db::name(self::$className)->where([
            self::$existKey => 1,
            "sta_no" => "SPZ"
        ])->order(self::$mainKey)->select();
    }

    public static function getByPage($limit, $page) {
        return Db::name(self::$className)->where(self::$existKey, 1)->order(self::$mainKey)->page($page, $limit)->select();
    }

    public static function getByPageWhitNotExist($limit, $page) {
        return Db::name(self::$className)->order(self::$mainKey)->page($page, $limit)->select();
    }

    public static function getByPageText($limit, $page) {
        $limitS = ($page-1)*$limit;
        $sql = "select * from fams_asset ass, fams_status sta, fams_category cate, fams_local local ";
        $sql .= "where ass.sta_no = sta.sta_no and ass.as_local_id = local.local_id and ass.cate_id = cate.cate_id and ass.as_exist = 1 ";
        $sql .= "order by ass.as_import_time desc ";
        $sql .= "limit {$limitS}, {$limit}";
        return Db::query($sql);
    }

    public static function getXZ() {
        $sql = "select * from fams_asset ass, fams_status sta, fams_category cate, fams_local local ";
        $sql .= "where ass.sta_no = sta.sta_no and ass.as_local_id = local.local_id and ass.cate_id = cate.cate_id and ass.sta_no = 'XZ' and ass.as_exist = 1 ";
        $sql .= "order by ass.as_import_time desc";
        return Db::query($sql);
    }

    public static function checkAs_no($asNo) {
        return Db::name(self::$className)->where(["as_no" => $asNo, self::$existKey => 1])->find();
    }

    public static function newByAs_no($asNo) {
        $asset = Db::name(self::$className)->where(["as_no" => $asNo, self::$existKey => 1])->select();
        return new Asset($asset[0]['as_id']);
    }

    public static function chart($id) {
        switch ($id) {
            case 'xz':
                $sql  = "select cate.cate_name name, count(ass.as_no) value, sum(ass.as_price) price ";
                $sql .= "from fams_asset ass, fams_category cate ";
                $sql .= "where ass.cate_id = cate.cate_id ";
                $sql .= "and ass.sta_no = 'XZ' and ass.as_exist = 1 ";
                $sql .= "group by ass.cate_id";
                return Db::query($sql);
                break;
            case 'zy':
                $sql  = "select cate.cate_name name, count(ass.as_no) value, sum(ass.as_price) price ";
                $sql .= "from fams_asset ass, fams_category cate ";
                $sql .= "where ass.cate_id = cate.cate_id ";
                $sql .= "and ass.sta_no = 'ZY' and ass.as_exist = 1 ";
                $sql .= "group by ass.cate_id";
                return Db::query($sql);
                break;
            case 'zb':
                $sql  = "select sta.sta_name name, count(ass.sta_no) value, ass.sta_no no ";
                $sql .= "from fams_asset ass, fams_status sta ";
                $sql .= "where ass.sta_no = sta.sta_no ";
                $sql .= "and ass.as_exist = 1 ";
                $sql .= "group by ass.sta_no";
                return Db::query($sql);
                break;
            case 'catenum':
                $sql  = "select cate.cate_name name, count(ass.as_no) value ";
                $sql .= "from fams_asset ass, fams_category cate ";
                $sql .= "where ass.cate_id = cate.cate_id ";
                $sql .= "and ass.as_exist = 1 ";
                $sql .= "group by ass.cate_id";
                return Db::query($sql);
                break;
            case 'cateprice':
                $sql  = "select cate.cate_name name, sum(ass.as_price) value ";
                $sql .= "from fams_asset ass, fams_category cate ";
                $sql .= "where ass.cate_id = cate.cate_id ";
                $sql .= "and ass.as_exist = 1 ";
                $sql .= "group by ass.cate_id";
                return Db::query($sql);
                break;
            default:
                # code...
                break;
        }
    }

    public static function insert($dic) {
        return Db::name(self::$className)->insertGetId($dic);
    }

    public function __construct($mkl) {
        $this->mainKeyValue = $mkl;
    }

    public function select() {
       $res =  Db::name(Asset::$className)->where(Asset::$mainKey, $this->mainKeyValue)->select();
       try {
           return $res[0];
       } catch (Exception $e) {
           return [];
       }
    }

    public function delete() {
        Db::name(Asset::$className)->where(Asset::$mainKey, $this->mainKeyValue)->update([Asset::$existKey => 0]);
    }

    public function update($dic) {
        Db::name(Asset::$className)->where(Asset::$mainKey, $this->mainKeyValue)->update($dic);
    }

    
    public function getAs_no() {
        $res = Db::name(Asset::$className)->where(Asset::$mainKey, $this->mainKeyValue)->select();
        try {
            return $res[0]["as_no"];
        } catch (Exception $e) {
            return "";
        }
    }

    public function setAs_no($value) {
        Db::name(Asset::$className)->where(Asset::$mainKey, $this->mainKeyValue)->update(["as_no" => $value]);
    }


    public function getAs_name() {
        $res = Db::name(Asset::$className)->where(Asset::$mainKey, $this->mainKeyValue)->select();
        try {
            return $res[0]["as_name"];
        } catch (Exception $e) {
            return "";
        }
    }

    public function setAs_name($value) {
        Db::name(Asset::$className)->where(Asset::$mainKey, $this->mainKeyValue)->update(["as_name" => $value]);
    }


    public function getAs_price() {
        $res = Db::name(Asset::$className)->where(Asset::$mainKey, $this->mainKeyValue)->select();
        try {
            return $res[0]["as_price"];
        } catch (Exception $e) {
            return "";
        }
    }

    public function setAs_price($value) {
        Db::name(Asset::$className)->where(Asset::$mainKey, $this->mainKeyValue)->update(["as_price" => $value]);
    }


    public function getCate_id() {
        $res = Db::name(Asset::$className)->where(Asset::$mainKey, $this->mainKeyValue)->select();
        try {
            return $res[0]["cate_id"];
        } catch (Exception $e) {
            return "";
        }
    }

    public function setCate_id($value) {
        Db::name(Asset::$className)->where(Asset::$mainKey, $this->mainKeyValue)->update(["cate_id" => $value]);
    }


    public function getSta_no() {
        $res = Db::name(Asset::$className)->where(Asset::$mainKey, $this->mainKeyValue)->select();
        try {
            return $res[0]["sta_no"];
        } catch (Exception $e) {
            return "";
        }
    }

    public function setSta_no($value) {
        Db::name(Asset::$className)->where(Asset::$mainKey, $this->mainKeyValue)->update(["sta_no" => $value]);
    }


    public function getAs_import_time() {
        $res = Db::name(Asset::$className)->where(Asset::$mainKey, $this->mainKeyValue)->select();
        try {
            return $res[0]["as_import_time"];
        } catch (Exception $e) {
            return "";
        }
    }

    public function setAs_import_time($value) {
        Db::name(Asset::$className)->where(Asset::$mainKey, $this->mainKeyValue)->update(["as_import_time" => $value]);
    }


    public function getAs_image() {
        $res = Db::name(Asset::$className)->where(Asset::$mainKey, $this->mainKeyValue)->select();
        try {
            return $res[0]["as_image"];
        } catch (Exception $e) {
            return "";
        }
    }

    public function setAs_image($value) {
        Db::name(Asset::$className)->where(Asset::$mainKey, $this->mainKeyValue)->update(["as_image" => $value]);
    }


    public function getAs_local() {
        $res = Db::name(Asset::$className)->where(Asset::$mainKey, $this->mainKeyValue)->select();
        try {
            return $res[0]["as_local"];
        } catch (Exception $e) {
            return "";
        }
    }

    public function setAs_local($value) {
        Db::name(Asset::$className)->where(Asset::$mainKey, $this->mainKeyValue)->update(["as_local" => $value]);
    }


    public function getAs_qrcode() {
        $res = Db::name(Asset::$className)->where(Asset::$mainKey, $this->mainKeyValue)->select();
        try {
            return $res[0]["as_qrcode"];
        } catch (Exception $e) {
            return "";
        }
    }

    public function setAs_qrcode($value) {
        Db::name(Asset::$className)->where(Asset::$mainKey, $this->mainKeyValue)->update(["as_qrcode" => $value]);
    }


    public function getAs_exist() {
        $res = Db::name(Asset::$className)->where(Asset::$mainKey, $this->mainKeyValue)->select();
        try {
            return $res[0]["as_exist"];
        } catch (Exception $e) {
            return "";
        }
    }

    public function setAs_exist($value) {
        Db::name(Asset::$className)->where(Asset::$mainKey, $this->mainKeyValue)->update(["as_exist" => $value]);
    }


}
