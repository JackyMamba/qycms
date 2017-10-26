<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "qycms_menu".
 *
 * @property integer $id
 * @property integer $pid
 * @property string $pids
 * @property string $name
 * @property string $content_type
 * @property string $content
 * @property integer $ctime
 * @property integer $mtime
 * @property string $lang
 */
class Menu extends \yii\db\ActiveRecord
{
    const CONTENT_TYPE = [
        'URL'=>'外部链接',
        'ARTCATE'=>'文章分类',
        //'ARTICLE'=>'文章',
        'PROCATE'=>'产品分类',
        //'PRODUCT'=>'产品',
        'PAGE'=>'单页',
    ];
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'qycms_menu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pid', 'ctime', 'mtime'], 'integer'],
            [['name', 'content', 'ctime', 'mtime'], 'required'],
            [['content'], 'string'],
            [['name'], 'string', 'max' => 64],
            [['content_type'], 'string', 'max' => 32],
            [['pids'], 'string', 'max' => 32],
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
            'pid' => Yii::t('common', '父菜单'),
            'pids' => Yii::t('common', '祖先id链'),
            'name' => Yii::t('common', '名称'),
            'content_type' => Yii::t('common', '内容类型'),
            'content' => Yii::t('common', '内容'),
            'ctime' => Yii::t('common', '创建时间'),
            'mtime' => Yii::t('common', '修改时间'),
            'lang_id' => Yii::t('common', '语言'),
        ];
    }

}
