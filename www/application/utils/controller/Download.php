<?php
namespace app\utils\controller;

use app\common\model\Param;

class Download {

    public function qrcode() {
        $datas = json_decode(Param::get("data"), true);
        $files = [];
        foreach ($datas as $data) {
            $files[] = 'qrcode/'.$data['as_qrcode'];
        }
        $path = $this->createZip($files);
        return $path;
    }

    private function createZip($files) {
        $filename = "download/".md5(time()).".zip";
        $zip = new \ZipArchive();
        $zip->open($filename, \ZIPARCHIVE::CREATE);
        foreach($files as $file){  
            $zip->addFile($file, basename($file)); 
        }  
        $zip->close();
        return '\/'.$filename;
    }

    private function list_dir($dir){
        $result = array();
        if (is_dir($dir)) {
            $file_dir = scandir($dir);
            foreach($file_dir as $file) {
                if ($file == '.' || $file == '..') {
                    continue;
                } elseif (is_dir($dir.$file)) {
                    $result = array_merge($result, list_dir($dir.$file.'/'));
                } else {
                    array_push($result, $dir.$file);
                }
            }
        }
        return $result;
    }

}
