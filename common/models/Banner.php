<?php

namespace common\models;

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
 * @property string $lang
 */
class Banner extends \yii\db\ActiveRecord
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
            [['display_order'], 'integer'],
            [['pic', 'url', 'title', 'text'], 'string', 'max' => 255],
            [['pic', 'url'], 'required'],
            [['code'], 'string', 'max' => 2000],
            [['lang'], 'string', 'max' => 7],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'id'),
            'pic' => Yii::t('common', 'path'),
            'url' => Yii::t('common', 'url'),
            'title' => Yii::t('common', 'title'),
            'text' => Yii::t('common', 'text'),
            'code' => Yii::t('common', 'code'),
            'display_order' => Yii::t('common', '显示顺序'),
            'lang_id' => Yii::t('common', '语言'),
        ];
    }
}
