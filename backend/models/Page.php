<?php

namespace backend\models;

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
 * @property string $lang
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
            'summary' => '摘要',
            'content' => '内容',
            'status' => '状态',
            'ctime' => '创建时间',
            'mtime' => '修改时间',
            'lang' => '语种',
        ];
    }

    public static function options(){
        $data = Page::find()->asArray()->all();
        $res = [];
        foreach ($data as $v){
            $res[$v['id']] = $v['name'];
        }
        return $res;
    }
}
