<?php
namespace app\app\controller;

use think\Controller;
use app\app\model\Utils;
use app\app\model\Constant;
use app\app\model\Logging;
use app\common\model\Param;

class Checkapprove extends Controller {

    public function index() {
        if (Utils::userAlreadyLogin() && $this->powerTrue()) {
            return view('index', Utils::getUserinfo());
        } else {
            $this->error(Constant::PLEASELOGIN, Constant::LOGINPATH);
        }
    }

    private function powerTrue() {
        return true;
    }
    
}

    