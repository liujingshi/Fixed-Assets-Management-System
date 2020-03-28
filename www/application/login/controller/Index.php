<?php
namespace app\login\controller;

use app\common\model\Rst;

class Index
{
    public function index()
    {
        return view();
    }

    public function checkCaptcha() {
        $captcha = Rst::get("captcha");
        if(!captcha_check($captcha)) {
            return [
                "code" => 0
            ];
        } else {
            return [
                "code" => 1
            ];
        }
    }
}
