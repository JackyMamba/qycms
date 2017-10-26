<?php
/**
 * @author qingyu8@staff.weibo.com
 * @date 29/09/2017
 */
namespace backend\widgets;

use yii\widgets\InputWidget;
use yii\base\InvalidConfigException;
use yii\helpers\Html;

/**
 * MaskedInput generates a masked text input.
 *
 * MaskedInput is similar to [[Html::textInput()]] except that an input mask will be used to force users to enter
 * properly formatted data, such as phone numbers, social security numbers.
 *
 * To use MaskedInput, you must set the [[mask]] property. The following example
 * shows how to use MaskedInput to collect phone numbers:
 *
 * ```php
 * echo MaskedInput::widget([
 *     'name' => 'phone',
 *     'mask' => '999-999-9999',
 * ]);
 * ```
 *
 * You can also use this widget in an [[yii\widgets\ActiveForm|ActiveForm]] using the [[yii\widgets\ActiveField::widget()|widget()]]
 * method, for example like this:
 *
 * ```php
 * <?= $form->field($model, 'from_date')->widget(\yii\widgets\MaskedInput::className(), [
 *     'mask' => '999-999-9999',
 * ]) ?>
 * ```
 *
 * The masked text field is implemented based on the
 * [jQuery input masked plugin](https://github.com/RobinHerbots/jquery.inputmask).
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since 2.0
 */
class DatetimepickerInput extends InputWidget
{
    /**
     * The name of the jQuery plugin to use for this widget.
     */
    const PLUGIN_NAME = 'datetimepicker';

    /**
     * @var array the HTML attributes for the input tag.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $options = ['class' => 'form-control'];
    /**
     * @var string the type of the input tag. Currently only 'text' and 'tel' are supported.
     * @see https://github.com/RobinHerbots/jquery.inputmask
     * @since 2.0.6
     */
    public $type = 'text';

    /**
     * Initializes the widget.
     *
     * @throws InvalidConfigException if the "mask" property is not set.
     */
    public function init()
    {
        parent::init();
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        $this->registerClientScript();
        if ($this->hasModel()) {
            echo Html::activeInput($this->type, $this->model, $this->attribute, $this->options);
        } else {
            echo Html::input($this->type, $this->name, $this->value, $this->options);
        }
    }

    /**
     * Registers the needed client script and options.
     */
    public function registerClientScript()
    {
        $js = '';
        $view = $this->getView();
        $id = $this->options['id'];
        $js .= '$("#' . $id . '").' . self::PLUGIN_NAME . '({format: "Y-m-d H:i:s",lang:"ch"});';
        DatetimepickerInputAsset::register($view);
        $view->registerJs($js);
    }
}
