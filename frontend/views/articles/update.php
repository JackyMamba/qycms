<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Artcate */

$this->title = Yii::t('app/article', 'Update {modelClass}: ', [
    'modelClass' => 'Artcate',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/article', 'Artcates'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app/article', 'Update');
?>
<div class="artcate-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
