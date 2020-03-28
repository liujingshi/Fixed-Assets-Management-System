<?php
namespace app\common\model;

use think\Request;

class Rst {

    public static function get($key) {
        $request = Request::instance();
        $param = $request->param();
        try {
            return $param[$key];
        } catch (Exception $e) {
            return "";
        }
    }

}