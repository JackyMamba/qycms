<?php

namespace frontend\models;

use Yii;
use frontend\logic\Nested;

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
 * @property integer $lang_id
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
        return [
            [['pid', 'status', 'display_order', 'ctime', 'mtime', 'lang_id'], 'integer'],
            [['name'], 'string', 'max' => 64],
            [['pids'], 'string', 'max' => 32],
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
            'pid' => Yii::t('app\common', '父分类id'),
            'pids' => Yii::t('app\common', '祖先id链,逗号分隔'),
            'status' => Yii::t('app\common', '状态 0编辑 1发布 2隐藏'),
            'display_order' => Yii::t('app\common', '显示顺序'),
            'ctime' => Yii::t('app\common', '创建时间'),
            'mtime' => Yii::t('app\common', '修改时间'),
            'lang_id' => Yii::t('app\common', '语言id'),
        ];
    }

    public static function firstLevel(){
        $data = self::find()->where(['=', 'pid', 0])->andWhere(['=', 'status', self::STATUS_ACTIVE])->andWhere(['=', 'lang', Yii::$app->language])->orderBy('display_order DESC')->asArray()->all();
        return $data;
    }

    public static function nestedItems() {
        $data = self::find()->where(['=', 'status', self::STATUS_ACTIVE])->andWhere(['=', 'lang', Yii::$app->language])->orderBy('display_order DESC')->asArray()->all();
        $data = Nested::childrenWithTree($data);
        foreach ($data['items'] as $k => $v) {
        }
        return $data;
    }
}
