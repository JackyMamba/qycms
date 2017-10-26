<?php

namespace backend\models;

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
class Banner extends \common\models\Banner
{

    /**
     * @var \yii\web\UploadedFile
     */
    public $imageFile;
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
        return array_merge(parent::rules(), []);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'id',
            'pic' => '路径',
            'url' => '跳转地址',
            'title' => '标题文字',
            'text' => '副标题',
            'code' => '嵌入代码',
            'display_order' => '显示顺序',
            'lang' => '语种',
        ];
    }
}
