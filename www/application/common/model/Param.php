<?php
namespace app\common\model;

use think\Request;

class Param {

    public static function get($key) {
        $request = Request::instance();
        $param = $request->param();
        if (array_key_exists($key, $param)) {
            return trim($param[$key]);
        } else {
            return "";
        }
    }

    public static function getAll() {
        $request = Request::instance();
        $param = $request->param();
        return $param;
    }

}