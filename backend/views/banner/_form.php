<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\logic\Lang;

/* @var $this yii\web\View */
/* @var $model backend\models\Banner */
/* @var $form yii\widgets\ActiveForm */
$name_pic = Html::getInputName($model, 'pic');
if (!empty($model->pic)) {
    $this->registerJs('$("<div><img style=\'width:300px;height:auto;\' src=\'/upload/image/' . $model->pic . '\'></div>").insertAfter(\'input[name="' . $name_pic . '"]\');');
}
?>

<script>

</script>
<div class="banner-form">

    <?php $form = ActiveForm::begin(); ?>

    <?=$form->field($model, 'pic')->hiddenInput()->label('Banner图')?>

    <?=$form->field($model, 'imageFile')->fileInput()->label($model->isNewRecord ? '图片上传' : '重新上传')?>

    <?=$form->field($model, 'url')->textInput(['maxlength' => true, 'placeholder' => '以http(s)://  或 /(站内链接) 开头'])?>

    <?=$form->field($model, 'title')->textInput(['maxlength' => true])?>

    <?=$form->field($model, 'text')->textInput(['maxlength' => true])?>

    <?=$form->field($model, 'code')->textInput(['maxlength' => true])?>

    <?php if (count(Yii::$app->params['lang']) > 1) {
        echo $form->field($model, 'lang')->dropDownList(Lang::items(), ['data-lang-switch' => $model->isNewRecord ? 'yes' : 'no']);
    } ?>

    <?=\backend\widgets\FooterBtn::widget(['btn_save_to_hide' => false])?>

    <?php ActiveForm::end(); ?>

</div>
