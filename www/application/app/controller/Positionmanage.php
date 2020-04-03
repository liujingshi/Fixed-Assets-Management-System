<?php
namespace app\app\controller;

use think\Controller;
use app\app\model\Utils;
use app\app\model\Constant;

class Positionmanage extends Controller {

    public function index() {
        if (Utils::userAlreadyLogin()) {
            return view();
        } else {
            $this->error(Constant::PLEASELOGIN, Constant::LOGINPATH);
        }
    }
    
}

    