<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Procate */

$this->title = '修改: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '产品分类', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '修改';
?>
<div class="procate-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
