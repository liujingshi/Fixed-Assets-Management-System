<?php
namespace app\app\controller;

use think\Controller;
use app\app\model\Utils;
use app\app\model\Constant;
use app\app\model\Logging;
use app\common\model\Param;
use app\common\model\Category;

class Assetcategory extends Controller {

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
    public function selectCate() {
        if (Utils::userAlreadyLogin() && $this->powerTrue()) {
            $categorys = Category::getAll();
            $categorysByPage = Category::getByPage(Param::get("limit"), Param::get("page"));
            $result = [
                "code" => 0,
                "msg" => "",
                "count" => count($categorys),
                "data" => $categorysByPage
            ];
            return $result;
        } else {
            $this->error(Constant::PLEASELOGIN, Constant::LOGINPATH);
        } 
    }

    /**
     * 得到所有分类
     */
    public function categorysData() {
        if (Utils::userAlreadyLogin() && $this->powerTrue()) {
            return json_encode(Category::getAll());
        } else {
            $this->error(Constant::PLEASELOGIN, Constant::LOGINPATH);
        }
    }

    /**
     * 添加分类
     */
    public function insertCate() {
        if (Utils::userAlreadyLogin() && $this->powerTrue()) {
            $co = $this->checkOnlyAndNull();
            if ($co['code'] == 0) {
                return json_encode($co);
            }
            $commonId = Category::insert($this->getFields());
            Logging::insertCate($commonId);
            return json_encode(Utils::returnCode(1));
        } else {
            $this->error(Constant::PLEASELOGIN, Constant::LOGINPATH);
        }
    }

    /**
     * 修改分类
     */
    public function updateCate() {
        if (Utils::userAlreadyLogin() && $this->powerTrue()) {
            $co = $this->checkOnlyAndNull();
            if ($co['code'] == 0) {
                return json_encode($co);
            }
            $cate = new Category(Param::get("cateId"));
            $cate->update($this->getFields());
            $commonId = Param::get("cateId");
            Logging::updateCate($commonId);
            return json_encode(Utils::returnCode(1));
        } else {
            $this->error(Constant::PLEASELOGIN, Constant::LOGINPATH);
        }
    }

    /**
     * 批量删除分类
     */
    public function deleteCates() {
        if (Utils::userAlreadyLogin() && $this->powerTrue()) {
            $datas = json_decode(Param::get("data"), true);
            foreach ($datas as $data) {
                if ($data['cate_id'] != "") {
                    $cate = new Category($data['cate_id']);
                    $cate->delete();
                    $commonId = $data['cate_id'];
                    Logging::deleteCate($commonId);
                }
            }
            return json_encode(Utils::returnCode(1));
        } else {
            $this->error(Constant::PLEASELOGIN, Constant::LOGINPATH);
        }
    }

    /**
     * 删除分类
     */
    public function deleteCate() {
        if (Utils::userAlreadyLogin() && $this->powerTrue()) {
            $cateId = Param::get("cateId");
            $cate = new Category($cateId);
            $cate->delete();
            $commonId = $cateId;
            Logging::deleteCate($commonId);
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
            "cate_no" => Param::get("cateNo"),
            "cate_name" => Param::get("cateName")
        ];
        return $result;
    }

    /**
     * 检查唯一字段
     */
    private function checkOnlyAndNull() {
        $cateNo = Param::get("cateNo");
        $cateId = Param::get("cateId");
        if (Category::checkCate_no($cateNo)) {
            if ($cateId == "") {
                return Utils::returnMsg(0, "cateNoError");
            } else {
                $cate = new Category($cateId);
                if ($cate->getCate_no() != $cateNo) {
                    return Utils::returnMsg(0, "cateNoError");
                }
            }
            
        }
        if (Param::get("cateNo") == "" || Param::get("cateName") == "") {
            return Utils::returnMsg(0, "nullError");
        }
        return Utils::returnCode(1);
    }
    
}

    