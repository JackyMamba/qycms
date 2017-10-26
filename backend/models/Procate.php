<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "qycms_procate".
 *
 * @property integer $id
 * @property string $name
 * @property integer $pid
 * @property string $pids
 * @property integer $status
 * @property integer $display_order
 * @property integer $ctime
 * @property integer $mtime
 * @property string $lang
 */
class Procate extends \common\models\Procate
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'qycms_procate';
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
            'pid' => '父分类',
            'pids' => '祖先id链,逗号分隔',
            'status' => '状态 0编辑 1发布 2隐藏',
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
