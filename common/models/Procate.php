<?php

namespace common\models;

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
class Procate extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_EDIT = 2;
    const STATUS_HIDE = 3;
    const STATUS_DELETED = 4;

    private static $items = [];

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
        return [
            [['pid', 'status', 'display_order', 'ctime', 'mtime'], 'integer'],
            ['name', 'required'],
            [['name'], 'string', 'max' => 64],
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
            'name' => Yii::t('common', '名称'),
            'pid' => Yii::t('common', '父分类id'),
            'pids' => Yii::t('common', '祖先id链,逗号分隔'),
            'status' => Yii::t('common', '状态 0编辑 1发布 2隐藏'),
            'display_order' => Yii::t('common', '显示顺序'),
            'ctime' => Yii::t('common', '创建时间'),
            'mtime' => Yii::t('common', '修改时间'),
            'lang_id' => Yii::t('common', '语言'),
        ];
    }

    public static function items(){
        if(empty(self::$items)){
            $data = self::find()->asArray()->all();
            $res = [];
            foreach ($data as $v){
                $res[$v['id']] = $v;
            }
            self::$items = $res;
        }
        return self::$items;
    }
}
