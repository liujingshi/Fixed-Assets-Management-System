<?php
namespace app\app\controller;

use think\Controller;
use app\app\model\Utils;
use app\app\model\Constant;
use app\app\model\Logging;
use app\common\model\Param;
use app\common\model\Person;

class Personmanage extends Controller {

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
    public function selectP() {
        if (Utils::userAlreadyLogin() && $this->powerTrue()) {
            $persons = Person::getAll();
            $personsByPage = Person::getByPageText(Param::get("limit"), Param::get("page"));
            $result = [
                "code" => 0,
                "msg" => "",
                "count" => count($persons),
                "data" => $personsByPage
            ];
            return $result;
        } else {
            $this->error(Constant::PLEASELOGIN, Constant::LOGINPATH);
        } 
    }

    /**
     * 得到所有人员
     */
    public function personsData() {
        if (Utils::userAlreadyLogin() && $this->powerTrue()) {
            return json_encode(Person::getAll());
        } else {
            $this->error(Constant::PLEASELOGIN, Constant::LOGINPATH);
        }
    }

    /**
     * 添加人员
     */
    public function insertP() {
        if (Utils::userAlreadyLogin() && $this->powerTrue()) {
            $co = $this->checkOnlyAndNull();
            if ($co['code'] == 0) {
                return json_encode($co);
            }
            $commonId = Person::insert($this->getFields());
            Logging::insertP($commonId);
            return json_encode(Utils::returnCode(1));
        } else {
            $this->error(Constant::PLEASELOGIN, Constant::LOGINPATH);
        }
    }

    /**
     * 修改人员
     */
    public function updateP() {
        if (Utils::userAlreadyLogin() && $this->powerTrue()) {
            $co = $this->checkOnlyAndNull();
            if ($co['code'] == 0) {
                return json_encode($co);
            }
            $p = new Person(Param::get("pId"));
            $p->update($this->getFields());
            $commonId = Param::get("pId");
            Logging::updateP($commonId);
            return json_encode(Utils::returnCode(1));
        } else {
            $this->error(Constant::PLEASELOGIN, Constant::LOGINPATH);
        }
    }

    /**
     * 批量删除人员
     */
    public function deletePs() {
        if (Utils::userAlreadyLogin() && $this->powerTrue()) {
            $datas = json_decode(Param::get("data"), true);
            foreach ($datas as $data) {
                if ($data['p_id'] != "" && $data['p_id'] > 1) {
                    $p = new Person($data['p_id']);
                    $p->delete();
                    $commonId = $data['p_id'];
                    Logging::deleteP($commonId);
                }
            }
            return json_encode(Utils::returnCode(1));
        } else {
            $this->error(Constant::PLEASELOGIN, Constant::LOGINPATH);
        }
    }

    /**
     * 删除人员
     */
    public function deleteP() {
        if (Utils::userAlreadyLogin() && $this->powerTrue()) {
            $pId = Param::get("pId");
            if ($pId != "" && $pId < 2) {
                return Utils::returnMsg(0, "pRootError");
            }
            $p = new Person($pId);
            $p->delete();
            $commonId = $pId;
            Logging::deleteP($commonId);
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
            "p_no" => Param::get("pNo"),
            "dep_id" => Param::get("depId"),
            "pos_id" => Param::get("posId"),
            "p_name" => Param::get("pName"),
            "p_sex" => Param::get("pSex"),
            "p_email" => Param::get("pEmail"),
            "p_ic" => Param::get("pIc")
        ];
        return $result;
    }

    /**
     * 检查唯一字段
     */
    private function checkOnlyAndNull() {
        $pNo = Param::get("pNo");
        $pId = Param::get("pId");
        if ($pId != "" && $pId < 3) {
            return Utils::returnMsg(0, "pRootError");
        }
        if (Param::get("depId") < 2) {
            return Utils::returnMsg(0, "pUpDepIdError");
        }
        if (Person::checkP_no($pNo)) {
            if ($pId == "") {
                return Utils::returnMsg(0, "pNoError");
            } else {
                $p = new Person($pId);
                if ($p->getP_no() != $pNo) {
                    return Utils::returnMsg(0, "pNoError");
                }
            }
            
        }
        if (Param::get("pNo") == "" || Param::get("pName") == "" || Param::get("depId") == "" || Param::get("posId") == "") {
            return Utils::returnMsg(0, "nullError");
        }
        return Utils::returnCode(1);
    }
    
}

    