<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Banner';
$this->params['breadcrumbs'][] = $this->title;
\backend\widgets\NestViewAsset::register($this);

$js = 'jQuery(document).ready(function ($){
			var sortableList = new $.JSortableList("#sortable", "asc" , "'.\yii\helpers\Url::to(['order']).'","","1");
		});';
$this->registerJs($js);
?>
<div class="banner-index">
	<p>
        <?=Html::a('<i class="fa fa-fw fa-plus"></i>添加'.$this->title, ['create'], ['class' => 'btn btn-success'])?>
	</p>
	<table class="table table-striped">
		<thead>
		<tr>
			<th>排序</th>
			<th>名称</th>
			<th>图片</th>
			<th>跳转地址</th>
			<th>语种</th>
			<th>操作</th>
		</tr>
		</thead>
		<tbody id="sortable">
        <?php $langs = Yii::$app->params['lang'];
        foreach ($data as $k => $v) { ?>
		<tr item-id="<?=$v['id']?>">
			<td><i class="fa fa-fw fa-arrows-v sortable-handler" style="cursor: move;"></i></td>
			<td><?=$v['title']?></td>
			<td><?='<img style="width:300px;max-height:100px;" src="/upload/image/' . $v['pic'] . '">'?></td>
			<td><?=$v['url']?></td>
			<td><?='<img src="/images/' . $langs[$v['lang']]['image'] . '.gif">'?></td>
			<td class="action-btn-td"><?=Html::a('<i class="fa fa-pencil-square-o"></i>', [
                    'update',
                    'id' => $v['id']
                ], [
                    'class' => 'btn btn-sm btn-default modify-btn',
                    'aria-label' => '修改',
                ]) . Html::a('<span class="fa fa-trash"></span>', [
                    'delete',
                    'id' => $v['id']
                ], [
                    'aria-label' => Yii::t('yii', 'Delete'),
                    'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                    'data-method' => 'post',
                    'data-pjax' => '0',
                    'class' => 'btn btn-sm btn-default',
                ]);?></td>
			</tr><?php } ?>
		</tbody>
	</table>
</div>
