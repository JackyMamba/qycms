<?php

namespace backend\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "qycms_product".
 *
 * @property integer $id
 * @property string $name
 * @property integer $cid
 * @property string $pics
 * @property string $fields
 * @property string $content
 * @property integer $status
 * @property integer $ctime
 * @property integer $mtime
 * @property string $lang
 */
class Product extends \common\models\Product
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'qycms_product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            [
                'status',
                'default',
                'value' => self::STATUS_ACTIVE
            ],
        ]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'id',
            'name' => '名称',
            'cid' => '分类',
            'pics' => '产品图片',
            'fields' => '附加字段',
            'content' => '内容',
            'status' => '状态',
            'ctime' => '创建时间',
            'mtime' => '修改时间',
            'lang' => '语种',
        ];
    }
}
