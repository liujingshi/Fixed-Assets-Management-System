<?php
namespace app\app\model;

use think\Session;
use app\app\model\Constant;
use app\common\model\Log;

class Logging {

    private static $systemCategoryName = "SYSTEM";
    private static $userTableName = "user";
    private static $departmentTableName = "department";
    private static $positionTableName = "position";
    private static $personTableName = "person";

    private static $assetCategoryName = "ASSET";
    private static $assetTableName = "asset";

    /**
     * 写入日志
     */
    private static function write($action, $category, $tableName, $commonId) {
        $uId = Session::get(Constant::USERID);
        $className = Constant::DBNAMESPACE . ucfirst($tableName);
        $data = [
            "log_category_no" => $category,
            "log_action_no" => $action,
            "u_id" => $uId,
            "log_datetime" => date("Y-m-d H:i:s"),
            "common_id" => $commonId,
            "table_name" => $tableName,
            "table_main_key" => $className::$mainKey
        ];
        Log::insert($data);
    }


    public static function insertU($commonId) {
        self::write("INSERTU", self::$systemCategoryName, self::$userTableName, $commonId);
    }
    public static function updateU($commonId) {
        self::write("UPDATEU", self::$systemCategoryName, self::$userTableName, $commonId);
    }
    public static function deleteU($commonId) {
        self::write("DELETEU", self::$systemCategoryName, self::$userTableName, $commonId);
    }


    public static function insertDep($commonId) {
        self::write("INSERTDEP", self::$systemCategoryName, self::$departmentTableName, $commonId);
    }
    public static function updateDep($commonId) {
        self::write("UPDATEDEP", self::$systemCategoryName, self::$departmentTableName, $commonId);
    }
    public static function deleteDep($commonId) {
        self::write("DELETEDEP", self::$systemCategoryName, self::$departmentTableName, $commonId);
    }


    public static function insertPos($commonId) {
        self::write("INSERTPOS", self::$systemCategoryName, self::$positionTableName, $commonId);
    }
    public static function updatePos($commonId) {
        self::write("UPDATEPOS", self::$systemCategoryName, self::$positionTableName, $commonId);
    }
    public static function deletePos($commonId) {
        self::write("DELETEPOS", self::$systemCategoryName, self::$positionTableName, $commonId);
    }


    public static function insertP($commonId) {
        self::write("INSERTP", self::$systemCategoryName, self::$personTableName, $commonId);
    }
    public static function updateP($commonId) {
        self::write("UPDATEP", self::$systemCategoryName, self::$personTableName, $commonId);
    }
    public static function deleteP($commonId) {
        self::write("DELETEP", self::$systemCategoryName, self::$personTableName, $commonId);
    }


    public static function insertAs($commonId) {
        self::write("INSERTAS", self::$assetCategoryName, self::$assetTableName, $commonId);
    }
    public static function updateAs($commonId) {
        self::write("UPDATEAS", self::$assetCategoryName, self::$assetTableName, $commonId);
    }
    public static function deleteAs($commonId) {
        self::write("DELETEAS", self::$assetCategoryName, self::$assetTableName, $commonId);
    }

}
