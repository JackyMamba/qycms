<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle {
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        //        'css/site.css',
        //'css/materialize.font.css', append into materialize.min.css by qingyu
        [
            'css/materialize.min.css',
            'media' => 'screen,projection'
        ],
        [
            'css/style.css',
            'media' => 'screen,projection'
        ],
    ];
    public $js = [
        'js/materialize.min.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
//        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
    ];
}
