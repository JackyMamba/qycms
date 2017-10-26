<?php

namespace common\models;

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
class Article extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_EDIT = 2;
    const STATUS_HIDE = 3;
    const STATUS_DELETED = 4;
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
        return [
            [['cid', 'status', 'ctime', 'mtime', 'hits'], 'integer'],
            [['name', 'content'], 'required'],
            [['name'], 'string', 'max' => 64],
            [['summary'], 'string', 'max' => 2000],
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
            'name' => Yii::t('common', '名称'),
            'cid' => Yii::t('common', '分类id'),
            'summary' => Yii::t('common', '摘要'),
            'content' => Yii::t('common', '内容'),
            'status' => Yii::t('common', '状态'),
            'ctime' => Yii::t('common', '创建时间'),
            'mtime' => Yii::t('common', '修改时间'),
            'hits' => Yii::t('common', '浏览数'),
            'lang_id' => Yii::t('common', '语言'),
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
