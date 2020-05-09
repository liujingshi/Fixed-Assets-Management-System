<?php
namespace app\app\controller;

use think\Controller;
use app\app\model\Utils;
use app\app\model\Constant;
use app\common\model\Param;
use app\common\model\Asset;

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

    public function getMyUserInfo() {
        if (Utils::userAlreadyLogin() && $this->powerTrue()) {
            $userinfo = Utils::getUserinfo();
            return json_encode($userinfo);
        } else {
            $this->error(Constant::PLEASELOGIN, Constant::LOGINPATH);
        }
    }

    public function chart($id) {
        if (Utils::userAlreadyLogin() && $this->powerTrue()) {
            return json_encode(Asset::chart($id));
        } else {
            $this->error(Constant::PLEASELOGIN, Constant::LOGINPATH);
        }
    }

    public function topnum() {
        if (Utils::userAlreadyLogin() && $this->powerTrue()) {
            return json_encode([
                "spz" => count(Asset::getAllSP())
            ]);
        } else {
            $this->error(Constant::PLEASELOGIN, Constant::LOGINPATH);
        }
    }

}

    