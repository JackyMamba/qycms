<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "qycms_tag".
 *
 * @property integer $id
 * @property string $tag
 * @property string $type
 * @property integer $spec_id
 * @property string $lang
 */
class Tag extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'qycms_tag';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['spec_id'], 'integer'],
            [['tag'], 'string', 'max' => 64],
            [['type'], 'string', 'max' => 32],
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
            'tag' => Yii::t('common', '标签名'),
            'type' => Yii::t('common', '类型'),
            'spec_id' => Yii::t('common', '具体id'),
            'lang_id' => Yii::t('common', '语言'),
        ];
    }

    /**
     * @inheritdoc
     * @return TagQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TagQuery(get_called_class());
    }
}
