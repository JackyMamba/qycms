<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Procate */

$this->title = '添加';
$this->params['breadcrumbs'][] = ['label' => '产品分类', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="procate-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
