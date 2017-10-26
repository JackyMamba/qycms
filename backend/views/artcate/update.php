<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Artcate */
/* @var $lang_items backend\models\Artcate */

$this->title = '修改 文章分类: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '文章分类', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '修改';
?>
<div class="artcate-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
