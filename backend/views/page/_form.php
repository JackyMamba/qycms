<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\logic\Lang;

/* @var $this yii\web\View */
/* @var $model backend\models\Page */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="page-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'summary')->textInput(['maxlength' => true, 'placeholder' => '留空则自动从<内容>字段获取']) ?>
    <?=$form->field($model, 'content')->widget('kucha\ueditor\UEditor', ['clientOptions' => ['initialFrameHeight' => '300',]]);?>

    <?php if (count(Yii::$app->params['lang']) > 1) {
        echo $form->field($model, 'lang')->dropDownList(Lang::items(), ['data-lang-switch' => $model->isNewRecord ? 'yes' : 'no']);
    } ?>

    <?=\backend\widgets\FooterBtn::widget()?>

    <?php ActiveForm::end(); ?>

</div>
<?php
$summaryName = Html::getInputName($model, 'summary');
$this->registerJs('
$("button.save,button.save-then-new,button.save-to-hide").click(function(){
	var summaryInput = $("input[name=\'' . $summaryName . '\']");
	if(!summaryInput.val()){
		summaryInput.val(ueditor.getContentTxt().substr(0,100).trim());
	}
});
');
?>