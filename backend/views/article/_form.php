<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\logic\Lang;
use backend\models\Artcate;
use backend\logic\Nested;
use backend\widgets\Quill;

/* @var $this yii\web\View */
/* @var $model backend\models\Article */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="article-form">

    <?php $form = ActiveForm::begin(); ?>

    <?=$form->field($model, 'name')->textInput(['maxlength' => true])?>

    <?=$form->field($model, 'cid')->dropDownList(Nested::options(Artcate::find()->asArray()->all(), null, false))?>

    <?=$form->field($model, 'summary')->textInput(['maxlength' => true, 'placeholder' => '留空则自动从<内容>字段获取'])?>

	<?php //=$form->field($model, 'content')->hiddenInput()?>
	<?php //=Quill::widget(['name' => Html::getInputName($model, 'content'), 'form_id' => $form->options['id']]);?>
    <?=$form->field($model, 'content')->widget('kucha\ueditor\UEditor', [
        'clientOptions' => []
    ]);?>

	<?php //=$form->field($model, 'status')->textInput()?>

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
