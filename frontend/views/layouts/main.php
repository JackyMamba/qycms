<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use frontend\models\Menu;
use yii\helpers\Url;


$menu = Menu::nestedItems();
$lang = Yii::$app->params['lang'];
$clang = Yii::$app->language;
$artcates = \frontend\models\Artcate::firstLevel();
$procates = \frontend\models\Procate::firstLevel();

$this->registerCss('
#main-content{margin-top:15px;}
#logo-container{max-width: 30%;}
#logo-container>img{width:100%; max-height: 100%; vertical-align: middle;}
#main-content img{max-width: 100%; height: auto;}
.ueditor-content img{}
@media only screen and (max-width: 600px) {
  #logo-container{max-width: 80%;}
  #lang_switch_div .select-wrapper input.select-dropdown {
    width: 80px;
  }
  #breadcrumbs_nav{height:auto;}
  #breadcrumbs_nav li{float:none;display:inline-block;}
}
.card-article{padding: 0.05rem 0.75rem;}
.card-article > p{line-height: 1rem;}
.footer-ul>li>a{display:block;padding:5px 0;}
');
AppAsset::register($this);
$this->registerJs('
  $(function(){
    $(".button-collapse").sideNav();
    $(".parallax").parallax();
    
    $(".dropdown-button").dropdown({ hover: true,belowOrigin:true });

	var minHeight = window.innerHeight - $("nav").css("height").slice(0,-2) - $("footer").css("height").slice(0,-2) - 30 + "px";
    $("#main-content").css("minHeight", minHeight);
    $("#lang_switch").material_select();
    $("#lang_switch").change(function(){location.href="/"+$(this).val();});
  });
');
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?=Yii::$app->language?>">
<head>
	<meta charset="<?=Yii::$app->charset?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <?=Html::csrfMetaTags()?>
	<title><?=Html::encode($this->title)?></title>
    <?php $this->head() ?>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body>
<?php $this->beginBody() ?>

<nav class="white" role="navigation">
	<div class="nav-wrapper container">
		<a id="logo-container" href="/" class="brand-logo"><img src="/upload/image/<?=$lang[$clang]['site_logo']?>"></a>
        <?php if (count(Yii::$app->params['lang']) > 1) { ?>
		<div class="input-field right" id="lang_switch_div">
			<img src="/images/<?=$lang[$clang]['image']?>.gif">
			<select id="lang_switch" style="color: blue;">
                <?php foreach ($lang as $k => $v) { ?>
					<option value="<?=$v['code']?>"<?=$clang == $k ? ' selected' : ''?>><?=$v['title_native']?></option>
                <?php } ?>
			</select>
		</div>
		<?php } ?>

        <?php if (Yii::$app->devicedetect->isMobile()) { ?>
			<ul id="nav-mobile" class="side-nav">
                <?php foreach ($menu['tree'] as $id => $v) { ?>
                    <?php if(empty($v)){?>
						<li><a href="<?=$menu['items'][$id]['url']?>"><?=$menu['items'][$id]['name']?></a></li>
                    <?php }else { ?>
						<li><a href="<?=$menu['items'][$id]['url']?>"><?=$menu['items'][$id]['name']?></a></li>
                        <?php foreach ($v as $id2 => $v2) { ?>
							<li style="line-height: 38px;height: 38px;"><a href="<?=$menu['items'][$id2]['url']?>">——<?=$menu['items'][$id2]['name']?></a></li>
                        <?php }?>
                    <?php }?>
                <?php } ?>
			</ul>
			<a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
        <?php } else { ?>
			<ul class="right hide-on-med-and-down">
                <?php foreach ($menu['tree'] as $id => $v) { ?>
                    <?php if(empty($v)){?>
						<li><a href="<?=$menu['items'][$id]['url']?>"><?=$menu['items'][$id]['name']?></a></li>
                    <?php }else { ?>
						<li><a class="dropdown-button" data-activates="dropdown-<?=$id?>" href="<?=$menu['items'][$id]['url']?>"><?=$menu['items'][$id]['name']?></a></li>
						<ul id="dropdown-<?=$id?>" class="dropdown-content">
                            <?php foreach ($v as $id2 => $v2) { ?>
								<li><a href="<?=$menu['items'][$id2]['url']?>"><?=$menu['items'][$id2]['name']?></a></li>
                            <?php }?>
						</ul>
                    <?php }?>
                <?php } ?>
			</ul>
        <?php } ?>
	</div>
</nav>

<?php if (!empty($this->params['breadcrumbs'])) { ?>
	<nav id="breadcrumbs_nav">
		<div class="container"><?=Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ])?></div>
	</nav>
<?php } ?>


<div id="main-content" class="container"><?=$content?></div>

<footer class="page-footer teal">
	<div class="container">
		<div class="row">
			<?php if(!empty($lang[$clang]['about_us_title'])){ ?>
			<div class="col l6 s12">
				<h5 class="white-text"><?=$lang[$clang]['about_us_title']?></h5>
				<p class="grey-text text-lighten-4"><?=$lang[$clang]['about_us_text']?></p>
			</div>
            <?php }?>
            <?php if(!empty($artcates)){?>
				<div class="col l3 s12">
					<h5 class="white-text"><?=Yii::t('app/article', 'Artcates')?></h5>
					<ul class="footer-ul">
                        <?php foreach ($artcates as $v){?>
							<li><a class="white-text" href="<?=Url::to(['articles/index','id'=>$v['id']])?>"><?=$v['name']?></a></li>
                        <?php }?>
					</ul>
				</div>
            <?php }?>
            <?php if(!empty($procates)){?>
				<div class="col l3 s12">
					<h5 class="white-text"><?=Yii::t('app/common', 'Procates')?></h5>
					<ul class="footer-ul">
                        <?php foreach ($procates as $v){?>
							<li><a class="white-text" href="<?=Url::to(['products/index','id'=>$v['id']])?>"><?=$v['name']?></a></li>
                        <?php }?>
					</ul>
				</div>
            <?php }?>
		</div>
	</div>
	<div class="footer-copyright">
		<div class="container">
			&#169; <?=date('Y')?> <a class="brown-text text-lighten-3" href="/"><?=$lang[$clang]['site_name']?></a>
		</div>
	</div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
