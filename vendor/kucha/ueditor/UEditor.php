<?php

/**
 * @link https://github.com/BigKuCha/yii2-ueditor-widget
 * @link http://ueditor.baidu.com/website/index.html
 */
namespace kucha\ueditor;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\InputWidget;

class UEditor extends InputWidget
{
    //配置选项，参阅Ueditor官网文档(定制菜单等)
    public $clientOptions = [];

    //默认配置
    protected $_options;

    /**
     * @throws \yii\base\InvalidConfigException
     */
    public function init()
    {
        if (isset($this->options['id'])) {
            $this->id = $this->options['id'];
        } else {
            $this->id = $this->hasModel() ? Html::getInputId($this->model,
                $this->attribute) : $this->id;
        }
        $this->_options = [
            //'serverUrl' => Url::to(['site/upload']),
            'serverUrl' => '/zh-cn/site/upload',
            'initialFrameWidth' => '100%',
            'initialFrameHeight' => '300',
            'lang' => (strtolower(Yii::$app->language) == 'en-us') ? 'en' : 'zh-cn',
            'toolbars' => [
                [
                    'fullscreen',
                    'source',
                    '|',
                    'undo',
                    'redo',
                    '|',
                    'bold',
                    'italic',
                    'underline',
                    'fontborder',
                    'strikethrough',
                    'superscript',
                    'subscript',
                    'removeformat',
                    'autotypeset',
                    'blockquote',
                    'pasteplain',
                    '|',
                    'forecolor',
                    'backcolor',
                    'insertorderedlist',
                    'insertunorderedlist',
                    '|',
                    'rowspacingtop',
                    'rowspacingbottom',
                    'lineheight',
                    '|',
                    'customstyle',
                    'paragraph',
                    'fontfamily',
                    'fontsize',
                    '|',
                    'indent',
                    '|',
                    'justifyleft',
                    'justifycenter',
                    'justifyright',
                    'justifyjustify',
                    '|',
                    'link',
                    'unlink',
                    '|',
                    'imagenone',
                    'imageleft',
                    'imageright',
                    'imagecenter',
                    '|',
                    'simpleupload',
                    'insertimage',
                    'insertvideo',
                    'attachment',
                    'map',
                    'gmap',
                    'insertframe',
                    'template',
                    '|',
                    'horizontal',
                    'spechars',
                    '|',
                    'inserttable',
                    'deletetable',
                    'insertrow',
                    'deleterow',
                    'insertcol',
                    'deletecol',
                    'mergecells',
                    'mergeright',
                    'mergedown',
                    'splittocells',
                    'splittorows',
                    'splittocols',
                    '|',
                    'print',
                    'searchreplace'
                ]
            ],
        ];
        $this->clientOptions = ArrayHelper::merge($this->_options, $this->clientOptions);
        parent::init();
    }

    public function run()
    {
        $this->registerClientScript();
        if ($this->hasModel()) {
            $name = Html::getInputName($this->model, $this->attribute);
            $value = Html::getAttributeValue($this->model, $this->attribute);
            return '<script id="' . $this->id . '" name="' . $name . '" type="text/plain">'.$value.'</script>';
            //return Html::activeTextarea($this->model, $this->attribute, ['id' => $this->id]);
        } else {
            return Html::textarea($this->id, $this->value, ['id' => $this->id]);
        }
    }

    /**
     * 注册客户端脚本
     */
    protected function registerClientScript()
    {
        UEditorAsset::register($this->view);
        $clientOptions = Json::encode($this->clientOptions);
        $script = "var ueditor = UE.getEditor('" . $this->id . "', " . $clientOptions . ");";
        $this->view->registerJs($script);
    }
}
