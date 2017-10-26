<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "qycms_banner".
 *
 * @property integer $id
 * @property string $pic
 * @property string $url
 * @property string $title
 * @property string $text
 * @property string $code
 * @property integer $display_order
 * @property integer $lang_id
 */
class Banner extends \common\models\Banner
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'qycms_banner';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['display_order', 'lang_id'], 'integer'],
            [['pic', 'url', 'title', 'text'], 'string', 'max' => 255],
            [['code'], 'string', 'max' => 2000],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app/common', 'id'),
            'pic' => Yii::t('app/common', 'path'),
            'url' => Yii::t('app/common', 'url'),
            'title' => Yii::t('app/common', 'title'),
            'text' => Yii::t('app/common', 'text'),
            'code' => Yii::t('app/common', 'code'),
            'display_order' => Yii::t('app/common', '显示顺序'),
            'lang_id' => Yii::t('app/common', '语言id'),
        ];
    }
}
