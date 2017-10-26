<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Procate */

$this->title = Yii::t('app/procate', 'Update {modelClass}: ', [
    'modelClass' => 'Procate',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/procate', 'Procates'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app/procate', 'Update');
?>
<div class="procate-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
