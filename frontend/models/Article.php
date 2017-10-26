<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "qycms_article".
 * @property integer $id
 * @property string $name
 * @property integer $cid
 * @property string $summary
 * @property string $content
 * @property integer $status
 * @property integer $ctime
 * @property integer $mtime
 * @property integer $lang_id
 */
class Article extends \common\models\Article {


    public static function getHot($num = 5) {
        $data = self::find()->where([
            '=',
            'lang',
            Yii::$app->language
        ])->orderBy('hits DESC')->offset(0)->limit($num)->asArray()->all();
        return $data;
    }

    public static function getLatest($num = 5) {
        $data = self::find()->where([
            '=',
            'lang',
            Yii::$app->language
        ])->orderBy('mtime DESC')->offset(0)->limit($num)->asArray()->all();
        return $data;
    }
}
