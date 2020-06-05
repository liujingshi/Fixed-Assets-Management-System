<?php
namespace app\utils\controller;


use app\app\model\Utils;
use app\common\model\Param;


class Qrcode {

    public function encode() {
        return Utils::qrcodeEncode(Param::get("data"));
    }

    public function decode() {
        return Utils::qrcodeDecode(Param::get("data"));
    }

}
