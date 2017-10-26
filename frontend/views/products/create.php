<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Procate */

$this->title = Yii::t('app/procate', 'Create Procate');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/procate', 'Procates'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="procate-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
