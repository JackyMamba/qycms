<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "qycms_lang".
 * @property integer $id
 * @property string $lang_code
 * @property string $title
 * @property string $title_native
 * @property string $sef
 * @property string $image
 * @property string $description
 * @property string $metakey
 * @property string $metadesc
 * @property string $sitename
 * @property integer $published
 * @property integer $ordering
 */
class Lang extends \yii\db\ActiveRecord {
    const PUBLISH_ON = 1;
    const PUBLISH_OFF = 0;

    private static $show = [];

    public static function show($only_published = true) {
        if (!isset(self::$show[intval($only_published)])) {
            $tmp = self::find()->asArray();
            if ($only_published) {
                $tmp->where(['published' => $only_published]);
            }
            $tmp = $tmp->orderBy('ordering')->all();
            $res = [];
            foreach ($tmp as $v) {
                $res[$v['id']] = $v;
            }
            self::$show[intval($only_published)] = $res;
        }
        return self::$show[intval($only_published)];
    }

    public static function items() {
        $tmp = self::find()->asArray()->where(['published' => self::PUBLISH_ON])->orderBy('ordering')->all();
        $res = [];
        foreach ($tmp as $v) {
            $res[$v['id']] = $v['title_native'];
        }
        return $res;
    }

    public static function id($lang_code) {
        return (new \yii\db\Query())->from('qycms_lang')->where(['=', 'lang_code', $lang_code])->scalar();
    }

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'qycms_lang';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [
                [
                    'lang_code',
                    'title',
                    'title_native',
                    'sef',
                    'image',
                    'description',
                    'metakey',
                    'metadesc'
                ],
                'required'
            ],
            [
                [
                    'metakey',
                    'metadesc'
                ],
                'string'
            ],
            [
                [
                    'published',
                    'ordering'
                ],
                'integer'
            ],
            [
                ['lang_code'],
                'string',
                'max' => 7
            ],
            [
                [
                    'title',
                    'title_native',
                    'sef',
                    'image'
                ],
                'string',
                'max' => 50
            ],
            [
                ['description'],
                'string',
                'max' => 512
            ],
            [
                ['sitename'],
                'string',
                'max' => 1024
            ],
            [
                ['sef'],
                'unique'
            ],
            [
                ['image'],
                'unique'
            ],
            [
                ['lang_code'],
                'unique'
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('common', 'ID'),
            'lang_code' => Yii::t('common', 'Lang Code'),
            'title' => Yii::t('common', 'Title'),
            'title_native' => Yii::t('common', 'Title Native'),
            'sef' => Yii::t('common', 'Sef'),
            'image' => Yii::t('common', 'Image'),
            'description' => Yii::t('common', 'Description'),
            'metakey' => Yii::t('common', 'Metakey'),
            'metadesc' => Yii::t('common', 'Metadesc'),
            'sitename' => Yii::t('common', 'Sitename'),
            'published' => Yii::t('common', 'Published'),
            'ordering' => Yii::t('common', 'Ordering'),
        ];
    }
}
