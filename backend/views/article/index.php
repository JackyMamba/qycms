<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Article;
use backend\models\Artcate;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '文章';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-index">
	<p>
        <?=Html::a('<i class="fa fa-fw fa-plus"></i>添加'.$this->title, ['create'], ['class' => 'btn btn-success'])?>
	</p>
    <?=GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
		'options' => ['class' => 'table-responsive'],
        'filterUrl' => $filterUrl,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'name',
            [
                'attribute' => 'cid',
                'content' => function($model, $key, $index, $column) {
                    $items = Artcate::items();
                    return $items[$model->cid]['name'];
                },
				'filter' => Artcate::options(),
            ],
            //'summary',
            [
                'attribute' => 'status',
                'content' => function($model, $key, $index, $column) {
                    switch ($model->status) {
                        case Article::STATUS_ACTIVE:
                            return '<span class="text-green">发布</span>';
                            break;
                        case Article::STATUS_EDIT:
                            return '<span class="">编辑中</span>';
                            break;
                        case Article::STATUS_HIDE:
                            return '<span class="text-muted">隐藏</span>';
                            break;
                        default:
                            return '';
                    }
                },
				'filter' => [
                    Article::STATUS_ACTIVE => '发布',
                    Article::STATUS_EDIT => '编辑中',
                    Article::STATUS_HIDE => '隐藏',
				],
            ],
            // 'ctime:datetime',
            [
                'attribute' => 'mtime',
                'content' => function($model, $key, $index, $column) {
                    return date('Y-m-d H:i', $model->mtime);
                },
				'filter' => false,
            ],
            [
                'attribute' => 'lang',
                'content' => function($model, $key, $index, $column) {
                    $langs = Yii::$app->params['lang'];
                    return '<img src="/images/' . $langs[$model->lang]['image'] . '.gif">';
                },
				'filter' => \common\logic\Lang::items(),
            ],

            [
                'class' => 'yii\grid\ActionColumn',
				'header' => '操作',
                'contentOptions' => ['class' => 'action-btn-td'],
                'buttons' => [
                    'update' => function($url, $model, $key) {
                        $options = [
                            'class' => 'btn btn-sm btn-default modify-btn',
                            'aria-label' => '修改',
                        ];
                        return Html::a('<i class="fa fa-pencil-square-o"></i>', $url, $options);
                    },
                    'hide' => function($url, $model, $key) {
                        $options = [
                            'class' => 'btn btn-sm btn-default hide-btn',
                            'aria-label' => '隐藏切换',
                            'data-pjax' => '0',
                        ];
                        return Html::a($model->status == Article::STATUS_HIDE ? '<i class="fa fa-fw fa-toggle-off text-muted"></i>' : '<i class="fa fa-fw fa-toggle-on text-green"></i>', $url, $options);
                    },
                    'delete' => function($url, $model, $key) {
                        $options = [
                            'class' => 'btn btn-sm btn-default',
                            'aria-label' => Yii::t('yii', 'Delete'),
                            'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                            'data-method' => 'post',
                            'data-pjax' => '0',
                        ];
                        return Html::a('<span class="fa fa-trash"></span>', $url, $options);
                    },
                ],
                'template' => ' {update} {hide} {delete}',
            ],
        ],
    ]);?>
</div>
