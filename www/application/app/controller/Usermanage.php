<?php
namespace app\app\controller;

use think\Controller;
use app\app\model\Utils;
use app\app\model\Constant;
use app\common\model\Param;
use app\common\model\User;
use app\common\model\User_power;

class Usermanage extends Controller {

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
        if ($power == "SVIP") {
            return true;
        }
        $this->error(Constant::POWERERROR);
        return false;
    }

    /**
     * table接口
     */
    public function selectU() {
        if (Utils::userAlreadyLogin() && $this->powerTrue()) {
            $users = User::getAll();
            $usersByPage = User::getByPageText(Param::get("limit"), Param::get("page"));
            $result = [
                "code" => 0,
                "msg" => "",
                "count" => count($users),
                "data" => $usersByPage
            ];
            return $result;
        } else {
            $this->error(Constant::PLEASELOGIN, Constant::LOGINPATH);
        } 
    }

    /**
     * 得到所有权限
     */
    public function powersData() {
        if (Utils::userAlreadyLogin() && $this->powerTrue()) {
            return json_encode(User_power::getAll());
        } else {
            $this->error(Constant::PLEASELOGIN, Constant::LOGINPATH);
        }
    }

    /**
     * 添加用户
     */
    public function insertU() {
        if (Utils::userAlreadyLogin() && $this->powerTrue()) {
            $co = $this->checkOnlyAndNull();
            if ($co['code'] == 0) {
                return json_encode($co);
            }
            User::insert($this->getFields());
            return json_encode(Utils::returnCode(1));
        } else {
            $this->error(Constant::PLEASELOGIN, Constant::LOGINPATH);
        }
    }

    /**
     * 修改用户
     */
    public function updateU() {
        if (Utils::userAlreadyLogin() && $this->powerTrue()) {
            $co = $this->checkOnlyAndNull();
            if ($co['code'] == 0) {
                return json_encode($co);
            }
            $u = new User(Param::get("uId"));
            $u->update($this->getFields());
            return json_encode(Utils::returnCode(1));
        } else {
            $this->error(Constant::PLEASELOGIN, Constant::LOGINPATH);
        }
    }

    /**
     * 批量删除用户
     */
    public function deleteUs() {
        if (Utils::userAlreadyLogin() && $this->powerTrue()) {
            $datas = json_decode(Param::get("data"), true);
            foreach ($datas as $data) {
                if ($data['u_id'] != "" && $data['u_id'] > 1) {
                    $p = new User($data['u_id']);
                    $p->delete();
                }
            }
            return json_encode(Utils::returnCode(1));
        } else {
            $this->error(Constant::PLEASELOGIN, Constant::LOGINPATH);
        }
    }

    /**
     * 删除用户
     */
    public function deleteU() {
        if (Utils::userAlreadyLogin() && $this->powerTrue()) {
            $uId = Param::get("uId");
            if ($uId != "" && $uId < 2) {
                return Utils::returnMsg(0, "uRootError");
            }
            $u = new User($uId);
            $u->delete();
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
            "p_id" => Param::get("pId"),
            "u_phone" => Param::get("uPhone"),
            "power_no" => Param::get("powerNo"),
            "u_head" => Param::get("uHead"),
            "u_money" => Param::get("uMoney")
        ];
        return $result;
    }

    /**
     * 检查唯一字段
     */
    private function checkOnlyAndNull() {
        $uPhone = Param::get("uPhone");
        $uId = Param::get("uId");
        if ($uId != "" && $uId < 2) {
            return Utils::returnMsg(0, "uRootError");
        }
        if (!preg_match("/^1[3456789]\d{9}$/", $uPhone)) {
            return Utils::returnMsg(0, "uPhoneError");
        }
        if (User::checkU_phone($uPhone)) {
            if ($uId == "") {
                return Utils::returnMsg(0, "uPhoneError");
            } else {
                $u = new User($uId);
                if ($u->getU_phone() != $uPhone) {
                    return Utils::returnMsg(0, "uPhoneError");
                }
            }
        }
        if (Param::get("uPhone") == "" || Param::get("pId") == "" || Param::get("powerNo") == "") {
            return Utils::returnMsg(0, "nullError");
        }
        return Utils::returnCode(1);
    }
    
}

    