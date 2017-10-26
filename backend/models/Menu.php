<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "qycms_menu".
 *
 * @property integer $id
 * @property integer $pid
 * @property string $name
 * @property string $content_type
 * @property string $content
 * @property integer $ctime
 * @property integer $mtime
 * @property string $lang
 */
class Menu extends \common\models\Menu
{
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
        return array_merge(parent::rules(), []);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'id',
            'pid' => '上级菜单',
            'pids' => '祖先id链',
            'name' => '名称',
            'content_type' => '内容类型',
            'content' => '内容',
            'ctime' => '创建时间',
            'mtime' => '修改时间',
            'lang' => '语种',
        ];
    }

}
