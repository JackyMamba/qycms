<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use backend\widgets\DatetimepickerInput;
use common\logic\Lang;
use backend\models\Artcate;
use backend\logic\Nested;

/* @var $this yii\web\View */
/* @var $model backend\models\Artcate */
/* @var $lang_items array backend\models\Artcate */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="artcate-form">

    <?php $form = ActiveForm::begin([]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pid')->dropDownList(Nested::options(Artcate::find()->asArray()->all(), $model->id)) ?>

<!--    --><?//= $form->field($model, 'status')->textInput() ?>
<!--    --><?//= $form->field($model, 'ctime')->widget(DatetimepickerInput::className()) ?>

    <?php if (count(Yii::$app->params['lang']) > 1) {
        echo $form->field($model, 'lang')->dropDownList(Lang::items(), ['data-lang-switch' => $model->isNewRecord ? 'yes' : 'no']);
    } ?>

    <?=\backend\widgets\FooterBtn::widget()?>

    <?php ActiveForm::end(); ?>

</div>
