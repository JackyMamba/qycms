<?php
/**
 * @author qingyu8@staff.weibo.com
 * @date 21/10/2017
 */
namespace backend\logic;

use yii\web\UploadedFile;

/**
 * Class Nested
 * 要求：数据list的每一行，含id、pid、pids字段
 * @package common\models
 */
class Upload {

    public static function img($name) {
        $file = UploadedFile::getInstanceByName($name);
        if(empty($file)){
            return null;
        }

        $sub = date('Ymd') . '/';
        $dir = $_SERVER['DOCUMENT_ROOT'] . '/upload/image/' . $sub;
        if (!file_exists($dir) && !mkdir($dir, 0777, true)) {
            return false;
        } else if (!is_writeable($dir)) {
            return false;
        }

        $fileName = time() . mt_rand(100000, 999999) . '.' . $file->extension;
        $file->saveAs($dir . $fileName);
        return $sub . $fileName;
    }
}
