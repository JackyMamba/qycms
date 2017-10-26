<?php

namespace frontend\models;

use Yii;

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
 * @property integer $lang_id
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
        return [
            [['cid', 'status', 'ctime', 'mtime', 'lang_id'], 'integer'],
            [['content'], 'required'],
            [['content'], 'string'],
            [['name'], 'string', 'max' => 64],
            [['pics', 'fields'], 'string', 'max' => 2000],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app\common', 'id'),
            'name' => Yii::t('app\common', '名称'),
            'cid' => Yii::t('app\common', '分类id'),
            'pics' => Yii::t('app\common', '图片,json格式'),
            'fields' => Yii::t('app\common', '附件字段,json格式'),
            'content' => Yii::t('app\common', '内容'),
            'status' => Yii::t('app\common', '状态 0编辑 1发布 2隐藏'),
            'ctime' => Yii::t('app\common', '创建时间'),
            'mtime' => Yii::t('app\common', '修改时间'),
            'lang_id' => Yii::t('app\common', '语言id'),
        ];
    }
}
