<?php

use yii\helpers\Html;
use frontend\logic\Nested;

/* @var $this yii\web\View */
/* @var $model frontend\models\Procate */

$ancestors = Nested::getAncestors($ct, $model->cid);
$cates = $ancestors;
$cates[] = $ct['items'][$model->cid];

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/product', 'Procates'), 'url' => ['index']];
foreach ($cates as $v){
    $this->params['breadcrumbs'][] = ['label' => $v['name'], 'url' => ['index', 'id'=>$v['id']]];
}
$this->params['breadcrumbs'][] = $this->title;
$this->registerJsFile('/js/ueditor.parse.js');
$this->registerJs('uParse(".procate-view", {
    rootPath: "../"
});');
?>
<h1><?=Html::encode($this->title)?></h1>
<div class="procate-view">
    <?=$model->content?>
</div>
