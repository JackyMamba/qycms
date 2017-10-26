<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '菜单';
$this->params['breadcrumbs'][] = $this->title;
\backend\widgets\NestViewAsset::register($this);

$js = 'jQuery(document).ready(function ($){
			var sortableList = new $.JSortableList("#sortable", "asc" , "'.\yii\helpers\Url::to(['order']).'","","1");
		});';
$this->registerJs($js);
?>
<div class="menu-index">
	<p>
        <?=Html::a('<i class="fa fa-fw fa-plus"></i>添加'.$this->title, ['create'], ['class' => 'btn btn-success'])?>
	</p>
	<div class="table-responsive">
		<table class="table table-striped">
			<thead>
			<tr>
				<th>排序</th>
				<th>名称</th>
				<th>内容类型</th>
				<th>内容</th>
				<th>修改时间</th>
				<th>语种</th>
				<th>操作</th>
			</tr>
			</thead>
			<tbody id="sortable">
            <?php $langs = Yii::$app->params['lang'];
            foreach ($data as $code => $v) { ?>
			<tr level="<?=$v['nested_level']?>" sortable-group-id="<?=$v['pid']?>" item-id="<?=$v['id']?>" parents="<?=str_replace(',', ' ', $v['pids'])?>">
				<td><i class="fa fa-fw fa-arrows-v sortable-handler" style="cursor: move;"></i></td>
				<td><?=$v['name']?></td>
				<td><?= \backend\models\Menu::CONTENT_TYPE[$v['content_type']];?></td>
				<td><?=$v['content']?></td>
				<td><?=date('Y-m-d H:i', $v['mtime'])?></td>
				<td><?='<img src="/images/' . $langs[$v['lang']]['image'] . '.gif">'?></td>
				<td class="action-btn-td"><?=Html::a('<i class="fa fa-fw fa-pencil-square-o"></i>', [
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
</div>
