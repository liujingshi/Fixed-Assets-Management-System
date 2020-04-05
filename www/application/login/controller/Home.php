<?php
namespace app\login\controller;

use think\Controller;
use think\Session;
use app\common\model\Param;
use app\app\model\Constant;
use app\common\model\User;

class Home extends Controller
{
    public function index()
    {
        return view();
    }

    public function checkCaptcha() {
        $captcha = Param::get("captcha");
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

    public function login() {
        $phone = Param::get("phone");
        if (preg_match("/^1[34578]\d{9}$/", $phone)) {
            $uId = User::getU_idByU_phone($phone);
            if ($uId > 0) {
                Session::set(Constant::USERLOGINSTATUS, Constant::USERLOGIN);
                Session::set(Constant::USERID, $uId);
                $this->success("登陆成功", Constant::HOMEPATH);
            } else {
                $this->error("用户不存在", Constant::LOGINPATH);
            }
        } else {
            $this->error("手机号有误", Constant::LOGINPATH);
        }
    }
}
