<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "qycms_artcate".
 *
 * @property integer $id
 * @property string $name
 * @property integer $pid
 * @property integer $status
 * @property integer $ctime
 * @property integer $mtime
 * @property string $lang
 */
class Artcate extends \common\models\Artcate
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'qycms_artcate';
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
            [
                'display_order',
                'default',
                'value' => 0
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
            'pid' => '上级分类',
            'pids' => '祖先id链',
            'status' => '状态',
            'display_order' => '显示顺序',
            'ctime' => '创建时间',
            'mtime' => '修改时间',
            'lang' => '语种',
        ];
    }

    public static function options(){
        $data = self::find()->asArray()->all();
        $res = [];
        foreach ($data as $v){
            $res[$v['id']] = $v['name'];
        }
        return $res;
    }
    
}
