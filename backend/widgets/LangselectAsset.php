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
class LangselectAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $js = [
        'js/js.cookie.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
