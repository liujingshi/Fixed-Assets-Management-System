<?php
namespace app\app\controller;

use think\Controller;
use app\app\model\Utils;
use app\app\model\Constant;
use app\common\model\Param;
use app\commom\model\Asset;
use app\common\model\Status;

class Assetimport extends Controller {

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
        if ($power == "SVIP" || $power == "VIP") {
            return true;
        }
        $this->error(Constant::POWERERROR);
        return false;
    }

    /**
     * table接口
     */
    public function selectAs() {
        if (Utils::userAlreadyLogin() && $this->powerTrue()) {
            $assets = Asset::getAll();
            $assetsByPage = Asset::getByPageText(Param::get("limit"), Param::get("page"));
            $result = [
                "code" => 0,
                "msg" => "",
                "count" => count($assets),
                "data" => $assetsByPage
            ];
            return $result;
        } else {
            $this->error(Constant::PLEASELOGIN, Constant::LOGINPATH);
        } 
    }

    /**
     * 得到所有状态
     */
    public function statusesData() {
        if (Utils::userAlreadyLogin() && $this->powerTrue()) {
            return json_encode(Status::getAll());
        } else {
            $this->error(Constant::PLEASELOGIN, Constant::LOGINPATH);
        }
    }

    /**
     * 批量添加资产
     */
    public function insertAses() {
        if (Utils::userAlreadyLogin() && $this->powerTrue()) {
            $num = Param::get("num");
            $commonId = Asset::insert($this->getFields());
            Logging::insertAs($commonId);
            return json_encode(Utils::returnCode(1));
        } else {
            $this->error(Constant::PLEASELOGIN, Constant::LOGINPATH);
        }
    }

    /**
     * 添加资产
     */
    public function insertAs() {
        if (Utils::userAlreadyLogin() && $this->powerTrue()) {
            $co = $this->checkOnlyAndNull();
            if ($co['code'] == 0) {
                return json_encode($co);
            }
            $commonId = Asset::insert($this->getFields());
            Logging::insertAs($commonId);
            return json_encode(Utils::returnCode(1));
        } else {
            $this->error(Constant::PLEASELOGIN, Constant::LOGINPATH);
        }
    }

    /**
     * 修改资产
     */
    public function updateAs() {
        if (Utils::userAlreadyLogin() && $this->powerTrue()) {
            $co = $this->checkOnlyAndNull();
            if ($co['code'] == 0) {
                return json_encode($co);
            }
            $u = new User(Param::get("asId"));
            $u->update($this->getFields());
            $commonId = Param::get("asId");
            Logging::updateAs($commonId);
            return json_encode(Utils::returnCode(1));
        } else {
            $this->error(Constant::PLEASELOGIN, Constant::LOGINPATH);
        }
    }

    /**
     * 批量删除资产
     */
    public function deleteAses() {
        if (Utils::userAlreadyLogin() && $this->powerTrue()) {
            $datas = json_decode(Param::get("data"), true);
            foreach ($datas as $data) {
                if ($data['as_id'] != "") {
                    $as = new User($data['as_id']);
                    $as->delete();
                    $commonId = $data['as_id'];
                    Logging::deleteAs($commonId);
                }
            }
            return json_encode(Utils::returnCode(1));
        } else {
            $this->error(Constant::PLEASELOGIN, Constant::LOGINPATH);
        }
    }

    /**
     * 删除资产
     */
    public function deleteAs() {
        if (Utils::userAlreadyLogin() && $this->powerTrue()) {
            $asId = Param::get("asId");
            $as = new User($asId);
            $as->delete();
            $commonId = $asId;
            Logging::deleteAs($commonId);
            return json_encode(Utils::returnCode(1));
        } else {
            $this->error(Constant::PLEASELOGIN, Constant::LOGINPATH);
        }
    }

    /**
     * 获取Request中的数据库字段
     */
    private function getFields() {
        $result = [
            "as_no" => Param::get("asNo"),
            "as_name" => Param::get("asName")
        ];
        return $result;
    }

    /**
     * 检查唯一字段
     */
    private function checkOnlyAndNull() {
        $asNo = Param::get("asNo");
        $asId = Param::get("asId");
        if (Asset::checkAs_no($asNo)) {
            if ($asId == "") {
                return Utils::returnMsg(0, "asNoError");
            } else {
                $as = new User($asId);
                if ($as->getU_phone() != $asNo) {
                    return Utils::returnMsg(0, "asNoError");
                }
            }
        }
        if (Param::get("asNo") == "" || Param::get("asName") == "" || Param::get("cateId") || Param::get("powerNo") == "") {
            return Utils::returnMsg(0, "nullError");
        }
        return Utils::returnCode(1);
    }
    
}

    