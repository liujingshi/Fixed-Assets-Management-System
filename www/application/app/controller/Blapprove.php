<?php
namespace app\app\controller;

use think\Controller;
use app\app\model\Utils;
use app\app\model\Constant;
use app\app\model\Logging;
use app\common\model\Param;
use app\common\model\Asset;
use app\common\model\Borrowlend;

class Blapprove extends Controller {

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
        if ($power == "VIP" || $power == "SVIP") {
            return true;
        }
        $this->error(Constant::POWERERROR);
        return false;
    }

    /**
     * table接口
     */
    public function select() {
        if (Utils::userAlreadyLogin() && $this->powerTrue()) {
            $dbData = Asset::getAllSP();
            $dbDataByPage = Borrowlend::getByPageTextSP(Param::get("limit"), Param::get("page"));
            $result = [
                "code" => 0,
                "msg" => "",
                "count" => count($dbData),
                "data" => $dbDataByPage
            ];
            return $result;
        } else {
            $this->error(Constant::PLEASELOGIN, Constant::LOGINPATH);
        } 
    }

    /**
     * 通过
     */
    public function pass() {
        if (Utils::userAlreadyLogin() && $this->powerTrue()) {
            $obj = new Borrowlend(Param::get("bl_id"));
            $sta = "XZ";
            if ($obj->getL_time() == "0000-00-00 00:00:00") {
                $sta = "ZY";
            } else {
                $obj->setBl_ok(1);
            }
            $obj = Asset::newByAs_no($obj->getAs_no());
            $obj->setSta_no($sta);
            return json_encode(Utils::returnCode(1));
        } else {
            $this->error(Constant::PLEASELOGIN, Constant::LOGINPATH);
        } 
    }

    /**
     * 不通过
     */
    public function notpass() {
        if (Utils::userAlreadyLogin() && $this->powerTrue()) {
            $obj = new Borrowlend(Param::get("bl_id"));
            $sta = "ZY";
            if ($obj->getL_time() == "0000-00-00 00:00:00") {
                $sta = "XZ";
                $obj->setBl_ok(1);
            }
            $obj = Asset::newByAs_no($obj->getAs_no());
            $obj->setSta_no($sta);
            return json_encode(Utils::returnCode(1));
        } else {
            $this->error(Constant::PLEASELOGIN, Constant::LOGINPATH);
        } 
    }

    /**
     * 批量通过
     */
    public function passes() {
        if (Utils::userAlreadyLogin() && $this->powerTrue()) {
            $datas = json_decode(Param::get("data"), true);
            foreach ($datas as $data) {
                $obj = new Borrowlend($data['bl_id']);
                $sta = "XZ";
                if ($obj->getL_time() == "0000-00-00 00:00:00") {
                    $sta = "ZY";
                } else {
                    $obj->setBl_ok(1);
                }
                $obj = Asset::newByAs_no($obj->getAs_no());
                $obj->setSta_no($sta);
            }
            return json_encode(Utils::returnCode(1));
        } else {
            $this->error(Constant::PLEASELOGIN, Constant::LOGINPATH);
        } 
    }
    
    /**
     * 批量不通过
     */
    public function notpasses() {
        if (Utils::userAlreadyLogin() && $this->powerTrue()) {
            $datas = json_decode(Param::get("data"), true);
            foreach ($datas as $data) {
                $obj = new Borrowlend($data['bl_id']);
                $sta = "ZY";
                if ($obj->getL_time() == "0000-00-00 00:00:00") {
                    $sta = "XZ";
                    $obj->setBl_ok(1);
                }
                $obj = Asset::newByAs_no($obj->getAs_no());
                $obj->setSta_no($sta);
            }
            return json_encode(Utils::returnCode(1));
        } else {
            $this->error(Constant::PLEASELOGIN, Constant::LOGINPATH);
        } 
    }
    
}

    