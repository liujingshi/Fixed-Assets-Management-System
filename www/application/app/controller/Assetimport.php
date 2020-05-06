<?php
namespace app\app\controller;

use think\Controller;
use app\app\model\Utils;
use app\app\model\Constant;
use app\app\model\Logging;
use app\common\model\Param;
use app\common\model\Asset;
use app\common\model\Status;
use app\common\model\Local;
use app\common\model\Category;

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
    public function select() {
        if (Utils::userAlreadyLogin() && $this->powerTrue()) {
            $dbData = Asset::getAll();
            $dbDataByPage = Asset::getByPageText(Param::get("limit"), Param::get("page"));
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
     * 得到所有地点
     */
    public function localsData() {
        if (Utils::userAlreadyLogin() && $this->powerTrue()) {
            return json_encode(Local::getAll());
        } else {
            $this->error(Constant::PLEASELOGIN, Constant::LOGINPATH);
        }
    }

    /**
     * 批量生成资产
     */
    public function inserts() {
        if (Utils::userAlreadyLogin() && $this->powerTrue()) {
            $num = Param::get("num");$cid = Category::getAll();
            $lid = Local::getAll();
            $cateid = 0;
            $localId = 0;
            if (count($cid) > 0) {
                $cateId = $cid[0]['cate_id'];
            }
            if (count($lid) > 0) {
                $localId = $lid[0]['local_id'];
            }
            for ($i = 0; $i < $num; $i++) {
                $no = $this->newNo();
                $data = [
                    "as_no" => $no,
                    "as_name" => "未命名资产",
                    "cate_id" => $cateId,
                    "as_price" => 0,
                    "as_import_time" => date("Y-m-d H:i:s"),
                    "as_local_id" => $localId,
                    "as_qrcode" => $no.".png"
                ];
                Utils::createQrcode($no);
                $commonId = Asset::insert($data);
                Logging::insertAs($commonId);
            }
            return json_encode(Utils::returnCode(1));
        } else {
            $this->error(Constant::PLEASELOGIN, Constant::LOGINPATH);
        }
    }

    /**
     * 添加资产
     */
    public function insert() {
        if (Utils::userAlreadyLogin() && $this->powerTrue()) {
            $co = $this->checkOnlyAndNull();
            if ($co['code'] == 0) {
                return json_encode($co);
            }
            $data = $this->getFields();
            $no = $this->newNo();
            $data['as_no'] = $no;
            $data['as_qrcode'] = $no.".png";
            Utils::createQrcode($no);
            $commonId = Asset::insert($data);
            Logging::insertAs($commonId);
            return json_encode(Utils::returnCode(1));
        } else {
            $this->error(Constant::PLEASELOGIN, Constant::LOGINPATH);
        }
    }

    private function seed()
    {
        list($msec, $sec) = explode(' ', microtime());
        return (float) $sec;
    }

    private function createNo() {
        // srand($this->seed());
        $no = "";
        $pattern = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLOMNOPQRSTUVWXYZ';
        $returnStr = '';
        for($i = 0; $i < rand(10,100); $i ++) {
            $returnStr .= $pattern[mt_rand(0, 61)];
        }
        $no = $returnStr . time();
        $returnStr = '';
        for($i = 0; $i < rand(10,100); $i ++) {
            $returnStr .= $pattern[mt_rand(0, 61)];
        }
        $no .= $returnStr;
        return strtoupper(md5($no));
    }

    private function newNo() {
        while (true) {
            $no = $this->createNo();
            if (!Asset::checkAs_no($no)) {
                break;
            }
        }
        return $no;
    }

    /**
     * 修改资产
     */
    public function update() {
        if (Utils::userAlreadyLogin() && $this->powerTrue()) {
            $co = $this->checkOnlyAndNull();
            if ($co['code'] == 0) {
                return json_encode($co);
            }
            $obj = new Asset(Param::get("asId"));
            $obj->update($this->getFields());
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
    public function deletes() {
        if (Utils::userAlreadyLogin() && $this->powerTrue()) {
            $datas = json_decode(Param::get("data"), true);
            foreach ($datas as $data) {
                if ($data['as_id'] != "") {
                    $obj = new Asset($data['as_id']);
                    $obj->delete();
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
    public function delete() {
        if (Utils::userAlreadyLogin() && $this->powerTrue()) {
            $asId = Param::get("asId");
            $obj = new Asset($asId);
            $obj->delete();
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
            "as_name" => Param::get("asName"),
            "cate_id" => Param::get("cateId"),
            "as_price" => Param::get("asPrice"),
            "as_import_time" => Param::get("asImportTime"),
            "as_local_id" => Param::get("asLocalId"),
            "as_image" => Param::get("asImage")
        ];
        return $result;
    }

    /**
     * 检查唯一字段
     */
    private function checkOnlyAndNull() {
        if (Param::get("asName") == "" || Param::get("cateId") == "" || Param::get("asImportTime") == "") {
            return Utils::returnMsg(0, "nullError");
        }
        return Utils::returnCode(1);
    }
    
}

    