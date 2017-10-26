<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Artcate */
/* @var $lang_items backend\models\Artcate */

$this->title = '新增分类';
$this->params['breadcrumbs'][] = ['label' => '文章分类', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="artcate-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
