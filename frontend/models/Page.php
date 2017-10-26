<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "qycms_page".
 *
 * @property integer $id
 * @property string $name
 * @property string $summary
 * @property string $content
 * @property integer $status
 * @property integer $ctime
 * @property integer $mtime
 * @property integer $lang_id
 */
class Page extends \common\models\Page
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'qycms_page';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content'], 'required'],
            [['content'], 'string'],
            [['status', 'ctime', 'mtime', 'lang_id'], 'integer'],
            [['name'], 'string', 'max' => 64],
            [['summary'], 'string', 'max' => 2000],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app/common', 'id'),
            'name' => Yii::t('app/common', '名称'),
            'summary' => Yii::t('app/common', '摘要'),
            'content' => Yii::t('app/common', '内容'),
            'status' => Yii::t('app/common', '状态 1发布 2编辑 3隐藏 4删除'),
            'ctime' => Yii::t('app/common', '创建时间'),
            'mtime' => Yii::t('app/common', '修改时间'),
            'lang_id' => Yii::t('app/common', '语言id'),
        ];
    }
}
