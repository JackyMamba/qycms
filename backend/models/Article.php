<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "qycms_article".
 *
 * @property integer $id
 * @property string $name
 * @property integer $cid
 * @property string $summary
 * @property string $content
 * @property integer $status
 * @property integer $ctime
 * @property integer $mtime
 * @property string $lang
 */
class Article extends \common\models\Article
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'qycms_article';
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
            'summary' => '摘要',
            'content' => '内容',
            'status' => '状态',
            'ctime' => '创建时间',
            'mtime' => '修改时间',
            'lang' => '语种',
        ];
    }

    /**
     * @inheritdoc
     * @return ArticleQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ArticleQuery(get_called_class());
    }
}
