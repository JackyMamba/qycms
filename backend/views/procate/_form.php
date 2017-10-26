<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\logic\Lang;
use backend\models\Procate;
use backend\logic\Nested;

/* @var $this yii\web\View */
/* @var $model backend\models\Procate */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="procate-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pid')->dropDownList(Nested::options(Procate::find()->asArray()->all(), $model->id)) ?>

    <?php if (count(Yii::$app->params['lang']) > 1) {
        echo $form->field($model, 'lang')->dropDownList(Lang::items(), ['data-lang-switch' => $model->isNewRecord ? 'yes' : 'no']);
    } ?>

    <?=\backend\widgets\FooterBtn::widget()?>

    <?php ActiveForm::end(); ?>

</div>
