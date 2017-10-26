<?php

namespace frontend\models;

use common\logic\Nested;
use common\logic\Lang;
use Yii;
use yii\helpers\Url;

/**
 * This is the model class for table "qycms_menu".
 * @property integer $id
 * @property integer $pid
 * @property string $name
 * @property string $content_type
 * @property string $content
 * @property integer $ctime
 * @property integer $mtime
 * @property integer $lang_id
 */
class Menu extends \common\models\Menu {
    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'qycms_menu';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [
                [
                    'pid',
                    'ctime',
                    'mtime',
                    'lang_id'
                ],
                'integer'
            ],
            [
                [
                    'content',
                    'ctime',
                    'mtime'
                ],
                'required'
            ],
            [
                ['content'],
                'string'
            ],
            [
                ['name'],
                'string',
                'max' => 64
            ],
            [
                ['content_type'],
                'string',
                'max' => 32
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('common', 'id'),
            'pid' => Yii::t('common', '父菜单'),
            'name' => Yii::t('common', '名称'),
            'content_type' => Yii::t('common', '内容类型'),
            'content' => Yii::t('common', '内容'),
            'ctime' => Yii::t('common', '创建时间'),
            'mtime' => Yii::t('common', '修改时间'),
            'lang_id' => Yii::t('common', '语言id'),
        ];
    }

    public static function nestedItems() {
        $menu = Menu::find()->where(['=', 'lang', Yii::$app->language])->orderBy('display_order DESC')->asArray()->all();
        $menu = Nested::childrenWithTree($menu);
        foreach ($menu['items'] as $k => $v) {
            $menu['items'][$k]['content'] = json_decode($v['content'], true);
            $menu['items'][$k]['url'] = self::determineUrl($v['content_type'], $menu['items'][$k]['content']);
        }
        return $menu;
    }

    public static function determineUrl($type, $content) {
        switch ($type) {
            case 'URL':
                return $content['url'];
                break;
            case 'PAGE':
                return Url::to([
                    'page/view',
                    'id' => $content['page']
                ]);
                break;
            case 'ARTCATE':
                return Url::to([
                    'articles/index',
                    'id' => $content['artcate']
                ]);
                break;
            case 'PROCATE':
                $url = ['products/index',];
                !empty($content['procate']) && $url['id'] = $content['procate'];
                return Url::to($url);
                break;
            case 'ARTICLE':
                return Url::to([
                    'articles/view',
                    'id' => $content['article']
                ]);
                break;
            default:
                return '';
        }
    }
}
