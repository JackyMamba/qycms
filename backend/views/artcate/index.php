<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Artcate;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '文章分类';
$this->params['breadcrumbs'][] = $this->title;

\backend\widgets\NestViewAsset::register($this);

$js = 'jQuery(document).ready(function ($){
			var sortableList = new $.JSortableList("#sortable", "asc" , "'.\yii\helpers\Url::to(['order']).'","","1");
		});';
$this->registerJs($js);
?>
<div class="artcate-index">
	<p>
        <?=Html::a('<i class="fa fa-fw fa-plus"></i>添加'.$this->title, ['create'], ['class' => 'btn btn-success'])?>
	</p>

	<table class="table table-striped">
		<thead>
		<tr>
			<th>排序</th>
			<th>名称</th>
			<th>状态</th>
			<th>修改时间</th>
			<th>语种</th>
			<th>操作</th>
		</tr>
		</thead>
		<tbody id="sortable">
        <?php $langs = Yii::$app->params['lang'];
        foreach ($data as $v) { ?>
		<tr level="<?=$v['nested_level']?>" sortable-group-id="<?=$v['pid']?>" item-id="<?=$v['id']?>" parents="<?=str_replace(',', ' ', $v['pids'])?>">
			<td><i class="fa fa-fw fa-arrows-v sortable-handler" style="cursor: move;"></i></td>
			<td><?=$v['name']?></td>
			<td><?=$v['status'] == Artcate::STATUS_ACTIVE ? '<span class="text-green">发布</span>' : ($v['status'] == Artcate::STATUS_EDIT ? '<span class="">编辑中</span>' : ($v['status'] == Artcate::STATUS_HIDE ? '<span class="text-muted">隐藏</span>' : ''))?></td>
			<td><?=date('Y-m-d H:i', $v['mtime'])?></td>
			<td><?='<img src="/images/' . $langs[$v['lang']]['image'] . '.gif">'?></td>
			<td class="action-btn-td"><?=Html::a('<i class="fa fa-pencil-square-o"></i>', [
                    'update',
                    'id' => $v['id']
                ], [
                    'class' => 'btn btn-sm btn-default modify-btn',
                    'aria-label' => '修改',
                ]) . Html::a($v['status'] == Artcate::STATUS_HIDE ? '<i class="fa fa-fw fa-toggle-off text-muted"></i>' : '<i class="fa fa-fw fa-toggle-on text-green"></i>', [
                    'hide',
                    'id' => $v['id']
                ], [
                    'class' => 'btn btn-sm btn-default hide-btn',
                    'aria-label' => '隐藏切换',
                    'data-pjax' => '0',
                ]) . Html::a('<span class="fa fa-trash"></span>', [
                    'delete',
                    'id' => $v['id']
                ], [
                    'title' => Yii::t('yii', 'Delete'),
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
