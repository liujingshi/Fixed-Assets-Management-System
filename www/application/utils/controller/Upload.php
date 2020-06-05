<?php
namespace app\utils\controller;

use think\Db;
use think\Request;
use app\common\model\Param;

header('Content-Type: text/html;charset=utf-8');
header('Access-Control-Allow-Origin:*'); // *代表允许任何网址请求
header('Access-Control-Allow-Methods:POST,GET,OPTIONS,DELETE'); // 允许请求的类型
header('Access-Control-Allow-Credentials: true'); // 设置是否允许发送 cookies
header('Access-Control-Allow-Headers: Content-Type,Content-Length,Accept-Encoding,X-Requested-with, Origin'); // 设置允许自定义请求头的字段

class Upload {

    public function image() {
        $path = $this->upload("image");
        return $path;
    }

    private function upload($type) {
        $file = request()->file($type);
        if ($file) {
            $info = $file->move(ROOT_PATH . 'public' . DS . $type);
            if ($info) {
                $path = $info->getSaveName();
                $path = str_replace("\\", "/", $path);
                return $path;
            } else {
                return 'error';
            }
        } else {
            return 'error';
        }
    }

    public function crop() {
        $img = Param::get("img");
        $x = Param::get("x");
        $y = Param::get("y");
        $width = Param::get("width");
        $height = Param::get("height");
        $path = ROOT_PATH . 'public' . DS . "image" . DS . $img;
        $src = imagecreatefromstring(file_get_contents($path));
        $new_image = imagecreatetruecolor($width, $height);
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $rand_name = md5(mt_rand() . time()) . "." . $ext;
        imagecopyresampled($new_image, $src, 0, 0, $x, $y, $width, $height, $width, $height);
        imagejpeg($new_image, ROOT_PATH . 'public' . DS . "image" . DS . "crop" . DS . $rand_name);
        imagedestroy($src);
        imagedestroy($new_image);
        return "/crop/" . $rand_name;
    }


}
