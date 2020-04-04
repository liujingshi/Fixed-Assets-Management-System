<?php
namespace app\app\controller;

use think\Controller;
use app\app\model\Utils;
use app\app\model\Constant;
use app\common\model\Param;
use app\common\model\Person;

class Personmanage extends Controller {

    public function index() {
        if (Utils::userAlreadyLogin()) {
            return view();
        } else {
            $this->error(Constant::PLEASELOGIN, Constant::LOGINPATH);
        }
    }

    /**
     * table接口
     */
    public function selectP() {
        if (Utils::userAlreadyLogin()) {
            $persons = Person::getAll();
            $personsByPage = Person::getByPage(Param::get("limit"), Param::get("page"));
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
     * 添加部门
     */
    public function insertP() {
        if (Utils::userAlreadyLogin()) {
            $co = $this->checkOnlyAndNull();
            if ($co['code'] == 0) {
                return json_encode($co);
            }
            Person::insert($this->getFields());
            return json_encode(Utils::returnCode(1));
        } else {
            $this->error(Constant::PLEASELOGIN, Constant::LOGINPATH);
        }
    }

    /**
     * 修改部门
     */
    public function updateP() {
        if (Utils::userAlreadyLogin()) {
            $co = $this->checkOnlyAndNull();
            if ($co['code'] == 0) {
                return json_encode($co);
            }
            $dep = new Person(Param::get("pId"));
            $dep->update($this->getFields());
            return json_encode(Utils::returnCode(1));
        } else {
            $this->error(Constant::PLEASELOGIN, Constant::LOGINPATH);
        }
    }

    /**
     * 批量删除部门
     */
    public function deletePs() {
        if (Utils::userAlreadyLogin()) {
            $datas = json_decode(Param::get("data"), true);
            foreach ($datas as $data) {
                if ($data['p_id'] != "" && $data['p_id'] > 1) {
                    $p = new Person($data['p_id']);
                    $p->delete();
                }
            }
            return json_encode(Utils::returnCode(1));
        } else {
            $this->error(Constant::PLEASELOGIN, Constant::LOGINPATH);
        }
    }

    /**
     * 删除部门
     */
    public function deleteP() {
        if (Utils::userAlreadyLogin()) {
            $pId = Param::get("pId");
            if ($pId != "" && $pId < 2) {
                return Utils::returnMsg(0, "pRootError");
            }
            $p = new Person($pId);
            $p->delete();
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
            "p_name" => Param::get("pName"),
            "p_remark" => Param::get("pRemark")
        ];
        return $result;
    }

    /**
     * 检查唯一字段
     */
    private function checkOnlyAndNull() {
        $pNo = Param::get("pNo");
        $pId = Param::get("pId");
        if ($pId != "" && $pId < 2) {
            return Utils::returnMsg(0, "pRootError");
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
        if (Param::get("pNo") == "" || Param::get("pName") == "") {
            return Utils::returnMsg(0, "nullError");
        }
        return Utils::returnCode(1);
    }
    
}

    