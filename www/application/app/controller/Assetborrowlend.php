<?php
namespace app\app\controller;

use think\Controller;
use app\app\model\Utils;
use app\app\model\Constant;
use app\app\model\Logging;
use app\common\model\Param;
use app\common\model\Borrowlend;
use app\common\model\Asset;
use app\common\model\User;

class Assetborrowlend extends Controller {

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
        if ($power != "VISIT") {
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
            $userinfo = Utils::getUserinfo();
            $power = $userinfo['powerNo'];
            $dbData = Borrowlend::getAll();
            $dbDataByPage = Borrowlend::getByPageText(Param::get("limit"), Param::get("page"));
            if ($power == "USER") {
                $dbData = Borrowlend::getAllMe();
                $dbDataByPage = Borrowlend::getByPageTextMe(Param::get("limit"), Param::get("page"));
            }
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
     * 得到所有闲置资产
     */
    public function xzData() {
        if (Utils::userAlreadyLogin() && $this->powerTrue()) {
            return json_encode(Asset::getXZ());
        } else {
            $this->error(Constant::PLEASELOGIN, Constant::LOGINPATH);
        }
    }

    /**
     * 得到所有用户
     */
    public function usersData() {
        if (Utils::userAlreadyLogin() && $this->powerTrue()) {
            return json_encode(User::getAllText());
        } else {
            $this->error(Constant::PLEASELOGIN, Constant::LOGINPATH);
        }
    }


    /**
     * 添加
     */
    public function insert() {
        if (Utils::userAlreadyLogin() && $this->powerTrue()) {
            $co = $this->checkOnlyAndNull();
            if ($co['code'] == 0) {
                return json_encode($co);
            }
            $data = $this->getFields();
            $commonId = Borrowlend::insert($data);
            $userinfo = Utils::getUserinfo();
            $power = $userinfo['powerNo'];
            $obj = Asset::newByAs_no(Param::get("asNo"));
            if ($power == "USER") {
                $obj->update(["sta_no" => "SPZ"]);
            } else {
                $obj->update(["sta_no" => "ZY"]);
            }
            Logging::insertBL($commonId);
            return json_encode(Utils::returnCode(1));
        } else {
            $this->error(Constant::PLEASELOGIN, Constant::LOGINPATH);
        }
    }

    
    /**
     * 修改
     */
    public function update() {
        if (Utils::userAlreadyLogin() && $this->powerTrue()) {
            $userinfo = Utils::getUserinfo();
            $power = $userinfo['powerNo'];
            $objb = new Borrowlend(Param::get("blId"));
            $objb->update(["l_time" => date("Y-m-d H:i:s")]);
            $obj = Asset::newByAs_no(Param::get("asNo"));
            if ($power == "USER") {
                $obj->setSta_no("SPZ");
            } else {
                $obj->setSta_no("XZ");
                $objb->setBl_ok(1);
            }
            $commonId = Param::get("blId");
            Logging::updateBL($commonId);
            return json_encode(Utils::returnCode(1));
        } else {
            $this->error(Constant::PLEASELOGIN, Constant::LOGINPATH);
        }
    }

    /**
     * 批量修改
     */
    public function updates() {
        if (Utils::userAlreadyLogin() && $this->powerTrue()) {
            $datas = json_decode(Param::get("data"), true);
            $userinfo = Utils::getUserinfo();
            $power = $userinfo['powerNo'];
            foreach ($datas as $data) {
                if ($data['bl_id'] != "") {
                    $objb = new Borrowlend($data["bl_id"]);
                    $objb->update(["l_time" => date("Y-m-d H:i:s")]);
                    $obj = new Asset($data['as_id']);
                    if ($power == "USER") {
                        $obj->setSta_no("SPZ");
                    } else {
                        $obj->setSta_no("XZ");
                        $objb->setBl_ok(1);
                    }
                    $commonId = $data['bl_id'];
                    Logging::updateBL($commonId);
                }
            }
            return json_encode(Utils::returnCode(1));
        } else {
            $this->error(Constant::PLEASELOGIN, Constant::LOGINPATH);
        }
    }

    /**
     * 批量删除
     */
    public function deletes() {
        if (Utils::userAlreadyLogin() && $this->powerTrue()) {
            $datas = json_decode(Param::get("data"), true);
            foreach ($datas as $data) {
                if ($data['bl_id'] != "") {
                    $obj = new Borrowlend($data['bl_id']);
                    $obj->delete();
                    $commonId = $data['bl_id'];
                    Logging::deleteBL($commonId);
                }
            }
            return json_encode(Utils::returnCode(1));
        } else {
            $this->error(Constant::PLEASELOGIN, Constant::LOGINPATH);
        }
    }

    /**
     * 删除
     */
    public function delete() {
        if (Utils::userAlreadyLogin() && $this->powerTrue()) {
            $blId = Param::get("blId");
            $obj = new Borrowlend($blId);
            $obj->delete();
            $commonId = $blId;
            Logging::deleteBL($commonId);
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
            "u_id" => Param::get("uId"),
            "as_no" => Param::get("asNo"),
            "b_time" => Param::get("bTime")
        ];
        return $result;
    }

    /**
     * 检查唯一字段
     */
    private function checkOnlyAndNull() {
        if (Param::get("asNo") == "" || Param::get("uId") == "" || Param::get("bTime") == "") {
            return Utils::returnMsg(0, "nullError");
        }
        return Utils::returnCode(1);
    }
    
}

    