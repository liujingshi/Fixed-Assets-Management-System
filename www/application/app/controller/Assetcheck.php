<?php
namespace app\app\controller;

use think\Controller;
use app\app\model\Utils;
use app\app\model\Constant;
use app\app\model\Logging;
use app\common\model\Param;
use app\common\model\Check;
use app\common\model\Check_content;
use app\common\model\Borrowlend;

class Assetcheck extends Controller {

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
    public function select() {
        if (Utils::userAlreadyLogin() && $this->powerTrue()) {
            $users = Check::getAll();
            $usersByPage = Check::getByPageText(Param::get("limit"), Param::get("page"));
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
     * table接口
     */
    public function selectcontent($id) {
        if (Utils::userAlreadyLogin() && $this->powerTrue()) {
            $users = Check_content::getAllc($id);
            $usersByPage = Check_content::getByPageTextc(Param::get("limit"), Param::get("page"), $id);
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
     * 添加
     */
    public function insert() {
        if (Utils::userAlreadyLogin() && $this->powerTrue()) {
            $co = $this->checkOnlyAndNull();
            if ($co['code'] == 0) {
                return json_encode($co);
            }
            $data = $this->getFields();
            $data['c_time'] = date("Y-m-d H:i:s");
            $commonId = Check::insert($data);
            if ($data['u_id'] > 0 && Param::get("checked")) {
                $assets = Borrowlend::getAllbyUId($data['u_id']);
                foreach ($assets as $asset) {
                    Check_content::insert([
                        "c_id" => $commonId,
                        "as_no" => $asset['as_no']
                    ]);
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
                if ($data['c_id'] != "") {
                    $obj = new Check($data['c_id']);
                    $obj->delete();
                }
            }
            return json_encode(Utils::returnCode(1));
        } else {
            $this->error(Constant::PLEASELOGIN, Constant::LOGINPATH);
        }
    }

    /**
     * 批量添加
     */
    public function inserts($id) {
        if (Utils::userAlreadyLogin() && $this->powerTrue()) {
            $datas = json_decode(Param::get("data"), true);
            foreach ($datas as $data) {
                Check_content::insert([
                    "c_id" => $id,
                    "as_no" => $data['as_no']
                ]);
            }
            return json_encode(Utils::returnCode(1));
        } else {
            $this->error(Constant::PLEASELOGIN, Constant::LOGINPATH);
        }
    }

    /**
     * 批量删除
     */
    public function deletecontents() {
        if (Utils::userAlreadyLogin() && $this->powerTrue()) {
            $datas = json_decode(Param::get("data"), true);
            foreach ($datas as $data) {
                if ($data['c_c_id'] != "") {
                    $obj = new Check_content($data['c_c_id']);
                    $obj->delete();
                }
            }
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
            "c_title" => Param::get("cTitle"),
            "u_id" => Param::get("uId"),
            "c_e_time" => Param::get("ceTime"),
        ];
        return $result;
    }

    /**
     * 检查唯一字段
     */
    private function checkOnlyAndNull() {
        if (Param::get("cTitle") == "" || Param::get("ceTime") == "") {
            return Utils::returnMsg(0, "nullError");
        }
        return Utils::returnCode(1);
    }
    
}

    