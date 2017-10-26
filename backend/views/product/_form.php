<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\logic\Lang;
use backend\logic\Nested;
use backend\models\Procate;

/* @var $this yii\web\View */
/* @var $model backend\models\Product */
/* @var $form yii\widgets\ActiveForm */
\backend\widgets\AjaxfileAsset::register($this);
$upload_url = \yii\helpers\Url::to(['site/upload']);
empty($model->pics) && $model->pics = '[]';
$picsName = Html::getInputName($model, 'pics');
$this->registerJs('
var pics = ' . $model->pics . ';
var picsWrapper = $("#product-pic-wrapper");
var picTemplate = $("#pic-template");
$("input[type=file]").ajaxfileupload({
  action: "' . $upload_url . '",
  params: {
    "_csrf-backend": "' . Yii::$app->request->getCsrfToken() . '"
  },
  onComplete: function(res) {
    console.log(res);
    if(res.errno==0){
    	pics.push(res.filepath);
    	renderPics();
    }
  },
  onCancel: function() {
    console.log("no file selected");
  }
});
renderPics();
function renderPics(){
console.log(pics);
picsWrapper.empty();
pics.forEach(function(v,i){
picTemplate.children().first().clone().appendTo(picsWrapper).find(".product-pic").attr("src","/upload/image/"+v);
});
$(\'input[name="'.$picsName.'"]\').val(pics.join(","));
}
');
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?=$form->field($model, 'name')->textInput(['maxlength' => true])?>

    <?=$form->field($model, 'cid')->dropDownList(Nested::options(Procate::find()->asArray()->all(), null, false))?>

    <?=$form->field($model, 'pics')->hiddenInput()?>
	<div id="product-pic-wrapper"></div>
	<input type="file" id="pic-file" name="pic_file">

	<?php //echo $form->field($model, 'fields')->textInput(['maxlength' => true])?>

    <?=$form->field($model, 'content')->widget('kucha\ueditor\UEditor', ['clientOptions' => ['initialFrameHeight' => '300',]]);?>

    <?php if (count(Yii::$app->params['lang']) > 1) {
        echo $form->field($model, 'lang')->dropDownList(Lang::items(), ['data-lang-switch' => $model->isNewRecord ? 'yes' : 'no']);
    } ?>

	<?=\backend\widgets\FooterBtn::widget()?>

	<?php ActiveForm::end(); ?>

</div>
<div id="pic-template"><div style="display: inline-block;"><img class="product-pic" src="" style="width: 80px;max-height: 100%;"></div></div>