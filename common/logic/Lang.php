<?php
/**
 * @author qingyu8@staff.weibo.com
 * @date 08/10/2017
 */

namespace common\logic;

use yii;
use yii\helpers\ArrayHelper;

class Lang {

    public static function items(){
        $res = [];
        foreach (Yii::$app->params['lang'] as $v) {
            $res[$v['code']] = $v['title_native'];
        }
        return $res;
    }
}
