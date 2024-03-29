<?php
namespace app\app\controller;

use think\Controller;
use app\app\model\Utils;
use app\app\model\Constant;
use app\app\model\Logging;
use app\common\model\Department;
use app\common\model\Param;

class Departmentmanage extends Controller {

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
     * 部门JSON数据接口
     * 用于前端treeview显示
     */
    public function departmentsJsonData() {
        if (Utils::userAlreadyLogin() && $this->powerTrue()) {
            return $this->getDepartmentsJsonData(1);
        } else {
            $this->error(Constant::PLEASELOGIN, Constant::LOGINPATH);
        }
    }

    /**
     * 得到部门的JSON数据
     * 按照treeview数据存储
     * {$upDepId} => 最上级的id，填1
     */
    private function getDepartmentsJsonData($upDepId) {
        $result = [];
        $departments = Department::getByUp_dep_id($upDepId);
        foreach ($departments as $department) {
            $result[] = [
                "obj" => $department,
                "text" => $department["dep_name"],
                "children" => $this->getDepartmentsJsonData($department["dep_id"])
            ];
        }
        return $result;
    }

    /**
     * 得到所有部门
     */
    public function departmentsData() {
        if (Utils::userAlreadyLogin() && $this->powerTrue()) {
            return json_encode(Department::getAll());
        } else {
            $this->error(Constant::PLEASELOGIN, Constant::LOGINPATH);
        }
    }

    /**
     * 检查唯一字段
     */
    private function checkOnlyAndNull() {
        $upDepId = Param::get("upDepId");
        $depNo = Param::get("depNo");
        $depId = Param::get("depId");
        if ($depId != "" && $depId < 3) {
            return Utils::returnMsg(0, "depRootError");
        }
        if ($upDepId < 2 || $upDepId == $depId) {
            return Utils::returnMsg(0, "upDepIdError");
        }
        if (Department::checkDep_no($depNo)) {
            if ($depId == "") {
                return Utils::returnMsg(0, "depNoError");
            } else {
                $dep = new Department($depId);
                if ($dep->getDep_no() != $depNo) {
                    return Utils::returnMsg(0, "depNoError");
                }
            }
            
        }
        if (Param::get("depNo") == "" || Param::get("depName") == "" || Param::get("upDepId") == "") {
            return Utils::returnMsg(0, "nullError");
        }
        return Utils::returnCode(1);
    }

    /**
     * 获取Request中的数据库字段
     */
    private function getFields() {
        $result = [
            "dep_no" => Param::get("depNo"),
            "dep_name" => Param::get("depName"),
            "up_dep_id" => Param::get("upDepId"),
            "dep_remark" => Param::get("depRemark")
        ];
        return $result;
    }

    /**
     * 添加部门
     */
    public function insertDep() {
        if (Utils::userAlreadyLogin() && $this->powerTrue()) {
            $co = $this->checkOnlyAndNull();
            if ($co['code'] == 0) {
                return json_encode($co);
            }
            $commonId = Department::insert($this->getFields());
            Logging::insertDep($commonId);
            return json_encode(Utils::returnCode(1));
        } else {
            $this->error(Constant::PLEASELOGIN, Constant::LOGINPATH);
        }
    }

    /**
     * 更新部门
     */
    public function updateDep() {
        if (Utils::userAlreadyLogin() && $this->powerTrue()) {
            $co = $this->checkOnlyAndNull();
            if ($co['code'] == 0) {
                return json_encode($co);
            }
            $dep = new Department(Param::get("depId"));
            $commonId = Param::get("depId");
            Logging::updateDep($commonId);
            $dep->update($this->getFields());
            return json_encode(Utils::returnCode(1));
        } else {
            $this->error(Constant::PLEASELOGIN, Constant::LOGINPATH);
        }
    }

    /**
     * 删除部门
     */
    public function deleteDep() {
        if (Utils::userAlreadyLogin() && $this->powerTrue()) {
            $depId = Param::get("depId");
            if ($depId != "" && $depId < 3) {
                return Utils::returnMsg(0, "depRootError");
            }
            $dep = new Department($depId);
            $dep->delete();
            $commonId = $depId;
            Logging::deleteDep($commonId);
            $this->deleteDepSon($depId);
            return json_encode(Utils::returnCode(1));
        } else {
            $this->error(Constant::PLEASELOGIN, Constant::LOGINPATH);
        }
    }

    /**
     * 递归删除所有子部门
     */
    private function deleteDepSon($upDepId) {
        $deps = Department::getByUp_dep_id($upDepId);
        foreach ($deps as $dep) {
            $d = new Department($dep['dep_id']);
            $d->delete();
            $commonId = $dep['dep_id'];
            Logging::deleteDep($commonId);
            $this->deleteDepSon($dep['dep_id']);
        }
    }
    
}

    