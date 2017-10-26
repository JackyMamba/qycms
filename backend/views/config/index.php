<?php

use backend\widgets\DatetimepickerInputAsset;
use yii\helpers\Url;

/* @var $this yii\web\View */

DatetimepickerInputAsset::register($this);
$this->title = '全局配置';
$js = '$("input[name=site_maintain_time]").datetimepicker({format: "Y-m-d H:i:s",lang:"ch"});

$("#langSwitch").find("option[value=\'' . $lang_code . '\']").prop("selected", true);$("#langSwitch").change(function(){location.href = \''.Url::to(['index']).'&lang_code=\'+$(this).val();});
';
$this->registerJs($js);
?>

<form class="form-horizontal" method="post" enctype="multipart/form-data">
	<input name="_csrf-backend" type="hidden" id="_csrf" value="<?=Yii::$app->request->csrfToken?>">
	<div class="box-body">
		<div class="form-group">
			<label class="col-sm-2 control-label">站点维护</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" name="site_maintain_time" value="<?=$config['site_maintain_time']?>" placeholder="开始时间">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">按语言配置</label>
			<div class="col-sm-10">
				<select class="form-control" name="lang_code" id="langSwitch">
					<?php foreach ($config['lang'] as $k=>$v){?>
					<option value="<?=$v['code']?>"><?=$v['title_native']?></option>
                    <?php }?>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">站点名称</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" name="lang[<?=$lang_code?>][site_name]" value="<?=$config['lang'][$lang_code]['site_name']?>" placeholder="">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">站点Logo</label>
			<div class="col-sm-10">
				<img src="/upload/image/<?=$config['lang'][$lang_code]['site_logo']?>" style="width: 300px;height: auto;">
				<input type="hidden" name="lang[<?=$lang_code?>][site_logo]" value="<?=$config['lang'][$lang_code]['site_logo']?>" placeholder="">
				<input type="file" name="site_logo_file">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">首页#关于我们#标题</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" name="lang[<?=$lang_code?>][about_us_title]" value="<?=isset($config['lang'][$lang_code]['about_us_title'])?$config['lang'][$lang_code]['about_us_title']:''?>" placeholder="例:关于我们 (留空则不显示)">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">首页#关于我们#内容</label>
			<div class="col-sm-10">
				<textarea class="form-control" name="lang[<?=$lang_code?>][about_us_text]" placeholder="留空则不显示"><?=isset($config['lang'][$lang_code]['about_us_text'])?$config['lang'][$lang_code]['about_us_text']:''?></textarea>
			</div>
		</div>
		<div class="form-group hidden">
			<div class="col-sm-offset-2 col-sm-10">
				<div class="checkbox">
					<label>
						<input type="checkbox"> Remember me
					</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-2">
				<button type="submit" class="btn btn-success"><i class="fa fa-fw fa-check"></i>保存</button>
				<a href="<?=Url::to(['site/index'])?>" class="btn btn-default" style="margin-left: 5px;"><i class="fa fa-fw fa-close text-danger"></i>取消</a>
			</div>
		</div>
	</div>
</form>