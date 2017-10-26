<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use frontend\logic\Nested;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */


$firstLevel = Nested::getFirstLevel($ct);
$ancestors = Nested::getAncestors($ct, $id);
$siblings = Nested::getSiblings($ct, $id);
$children = Nested::getChildren($ct, $id);

if(empty($procate)){
    $this->title = Yii::t('app/product', 'Procates');
    $this->params['breadcrumbs'][] = $this->title;
}else{
    $this->title = $procate['name'];
    $this->params['breadcrumbs'][] = ['label' => Yii::t('app/product', 'Procates'), 'url' => ['index'],];
    foreach ($ancestors as $v){
        $this->params['breadcrumbs'][] = ['label' => $v['name'], 'url' => ['index', 'id'=>$v['id']]];
    }
    $this->params['breadcrumbs'][] = $procate['name'];
}
$this->registerCss('.chip{border-radius: 0;}');
$this->registerJs('
    $("#cate_switch_div > select").material_select();
    
    $("#cate_switch_div select").change(function(){location.href=$(this).val();});');
?>
<div class="procate-index">
	<div class="row">
		<div class="col l3 s12">
            <?php if (Yii::$app->devicedetect->isMobile()) { ?>
				<div class="input-field" id="cate_switch_div">
					<select style="color: blue;">
                        <?php if(empty($procate)){?>
							<option value="<?=Url::to(['index'])?>">全部</option>
                            <?php foreach ($firstLevel as $v){?>
								<option value="<?=Url::to(['index', 'id'=>$v['id']])?>"><?=$v['name']?></option>
                            <?php } ?>
                        <?php }else{ ?>
                            <?php foreach ($siblings as $v){?>
								<option value="<?=Url::to(['index', 'id'=>$v['id']])?>"<?=$procate['id'] == $v['id'] ? ' selected' : ''?>><?=$v['name']?></option>
                            <?php } ?>
                        <?php }?>
					</select>
				</div>
            <?php } else { ?>
				<div class="collection">
                    <?php if(empty($procate)){?>
                        <?php foreach ($firstLevel as $v){?>
							<a href="<?=Url::to(['index', 'id'=>$v['id']])?>" class="collection-item"><?=$v['name']?></a>
                        <?php } ?>
                    <?php }else{ ?>
                        <?php foreach ($siblings as $v){?>
							<a href="<?=Url::to(['index', 'id'=>$v['id']])?>" class="collection-item<?=$procate['id'] == $v['id'] ? ' active' : ''?>"><?=$v['name']?></a>
                        <?php } ?>
                    <?php }?>
				</div>
            <?php } ?>
		</div>
		<div class="col l9 s12">
            <?php if(!empty($children)){?>
				<div>
                    <?php foreach ($children as $v){?>
						<div class="chip">
							<a href="<?=Url::to(['index', 'id'=>$v['id']])?>" class="collection-item"><?=$v['name']?></a>
						</div>
                    <?php } ?>
				</div>
            <?php }?>

            <?php foreach ($items as $v){?>
				<div class="card card-product">
					<p>
						<a class="teal-text" href="<?=Url::to(['view', 'id'=>$v['id']])?>"><?=$v['name']?></a>
						<span class="secondary-content grey-text"><?=date('Y-m-d', $v['mtime'])?></span></p>
				</div>
            <?php }?>
		</div>
	</div>
</div>
