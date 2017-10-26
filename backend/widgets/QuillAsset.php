<?php
/**
 * @author qingyu8@staff.weibo.com
 * @date 29/09/2017
 */

namespace backend\widgets;

use yii\web\AssetBundle;

class QuillAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $js = [
        'js/quill.min.js',
    ];
    public $css = [
        'css/quill.snow.css',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
