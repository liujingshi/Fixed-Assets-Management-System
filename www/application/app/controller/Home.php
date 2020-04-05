<?php
namespace app\app\controller;

use think\Controller;
use app\app\model\Utils;
use app\app\model\Constant;

class Home extends Controller {

    public function index() {
        if (Utils::userAlreadyLogin() && $this->powerTrue()) {
            return view('index', Utils::getUserinfo());
        } else {
            $this->error(Constant::PLEASELOGIN, Constant::LOGINPATH);
        }
    }

    private function powerTrue() {
        $userinfo = Utils::getUserinfo();
        $power = $userinfo['powerNo'];
        if ($power == "VISIT") {
            $this->error(Constant::POWERERROR, Constant::LOGINPATH);
            return false;
        }
        return true;
    }

    public function logout() {
        Utils::logout();
        $this->success("登出成功", Constant::LOGINPATH);
    }
}

    