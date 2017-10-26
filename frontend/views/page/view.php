<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Page */

$this->title = $model->name;
$this->params['breadcrumbs'][] = $this->title;
$this->registerJsFile('/js/ueditor.parse.js');
$this->registerJs('uParse(".page-view", {
    rootPath: "../"
});');
?>
<div class="page-view ueditor-content">
	<?=$model->content?>
</div>
