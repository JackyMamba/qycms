<?php
use yii\helpers\Html;
use yii\widgets\Spaceless;

/* @var $this \yii\web\View */
/* @var $content string */


backend\assets\AppAsset::register($this);

dmstr\web\AdminLteAsset::register($this);

\backend\widgets\LangselectAsset::register($this);
$this->registerJs('var langSwitch = $("select[data-lang-switch=yes]");
if(langSwitch.length >= 1){
var lang_id = Cookies.get("switch_lang_id");
if(lang_id){langSwitch.find("option[value=\'"+lang_id+"\']").prop("selected", true);}
langSwitch.change(function(){Cookies.set(\'switch_lang_id\', $(this).val(), { expires: 2 });});
}');


$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?=Yii::$app->language?>">
<head>
	<meta charset="<?=Yii::$app->charset?>"/>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <?=Html::csrfMetaTags()?>
	<title><?=Html::encode($this->title)?></title>
    <?php $this->head() ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<?php Spaceless::begin(); ?>
<?php $this->beginBody() ?>
<div class="wrapper">

    <?=$this->render('header.php', ['directoryAsset' => $directoryAsset])?>

    <?=$this->render('left.php', ['directoryAsset' => $directoryAsset])?>

    <?=$this->render('content.php', [
            'content' => $content,
            'directoryAsset' => $directoryAsset
        ])?>

</div>

<?php $this->endBody() ?>
<?php Spaceless::end(); ?>
</body>
</html>
<?php $this->endPage() ?>
