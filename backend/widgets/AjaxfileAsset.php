<?php
/**
 * @author qingyu8@staff.weibo.com
 * @date 29/09/2017
 */

namespace backend\widgets;

use yii\web\AssetBundle;

/**
 * The asset bundle for the [[DatetimepickerInput]] widget.
 *
 * Includes client assets of [jQuery input mask plugin](https://github.com/RobinHerbots/jquery.inputmask).
 *
 */
class AjaxfileAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $js = [
        'js/jquery.ajaxfileupload.js',
    ];
    public $css = [
//        'css/jquery-ui.css',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
