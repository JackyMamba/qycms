<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\logic\Lang;
use backend\models\Menu;
use backend\models\Artcate;
use backend\logic\Nested;
use backend\models\Page;
use yii\helpers\Url;
use backend\models\Procate;

/* @var $this yii\web\View */
/* @var $model backend\models\Menu */
/* @var $form yii\widgets\ActiveForm */
$js = '$(document).ready(function () {
		var editPageUrl = "'. Url::to(['page/update', 'id'=>'1']) .'";
        $(".type").appendTo($("#form-tmp"));
		$(\'select[name="Menu[content_type]"]\').change(function () {
			$(".menu-form .type").appendTo($("#form-tmp"));
			$("#TYPE-"+$(this).val()).insertAfter($(this).parent());
        }).change();
        $(\'select[name="Menu[content][page]"]\').change(function(){
        	$("#type-page-edit").attr("href", editPageUrl.replace(/id=\d+/,"id="+$(this).val()));
        }).change();
    });';
$this->registerJs($js);
?>

<div class="menu-form" style="width: 60%;">

    <?php $form = ActiveForm::begin(); ?>
    <?=$form->field($model, 'name')->textInput(['maxlength' => true])?>

    <?=$form->field($model, 'pid')->dropDownList(Nested::options(Menu::find()->orderBy('display_order DESC')->asArray()->all(), $model->id))?>
    <?=$form->field($model, 'content_type')->dropDownList(Menu::CONTENT_TYPE)?>

	<div class="type" id="TYPE-URL">
		<?php $urlDefault = $model->isNewRecord ? ['value' => 'https://qingyu.me/'] : [] ?>
        <?=$form->field($model, 'content[url]')->textInput(array_merge([
            'maxlength' => true,
            'name' => 'Menu[content][url]',
        ], $urlDefault))->label('链接地址')?>
	</div>
	<div class="type" id="TYPE-ARTCATE">
        <?=$form->field($model, 'content[artcate]')->dropDownList(Nested::options(Artcate::find()->orderBy('display_order DESC')->asArray()->all(), null, false))->label('分类选择')?>
	</div>
	<div class="type" id="TYPE-PROCATE">
        <?=$form->field($model, 'content[procate]')->dropDownList(['根'] + Nested::options(Procate::find()->orderBy('display_order DESC')->asArray()->all(), null, false))->label('分类选择')?>
	</div>

	<div class="type" id="TYPE-PAGE" style="position: relative;">
        <?=$form->field($model, 'content[page]')->dropDownList(Page::options())->label('单页选择')?>
		<?=Html::a('编辑单页', '',['target'=>'_blank',
							   'id' => 'type-page-edit',
							   'class'=> 'btn btn-default',
							   'style'=>'position: absolute;  top: 40%;left: 102%;'])?>
	</div>

    <?php if (count(Yii::$app->params['lang']) > 1) {
        echo $form->field($model, 'lang')->dropDownList(Lang::items(), ['data-lang-switch' => $model->isNewRecord ? 'yes' : 'no']);
    } ?>

    <?=\backend\widgets\FooterBtn::widget(['btn_save_to_hide' => false])?>

    <?php ActiveForm::end(); ?>

</div>
<div id="form-tmp" style="display: none;"></div>
