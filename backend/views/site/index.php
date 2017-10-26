<?php

use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = '青鱼CMS 后台';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>恭喜!</h1>

        <p class="lead">您已成功拥有青鱼CMS应用.</p>

        <p><a class="btn btn-lg btn-success" href="<?=Url::to(['config/index'])?>">Get started</a></p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>简单可靠</h2>

                <p>青鱼CMS 基于简单、强大、优雅的Yii框架实现，提供CMS的核心模块，运营人员可凭直觉轻松丰富您的站点。<br>分类、文章管理、产品管理、单页面管理、菜单配置……<br>一切都是那么自然、简单！</p>

                <p><a class="btn btn-default" href="<?=Url::to(['config/index'])?>">全局配置 &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>分类嵌套</h2>

                <p>青鱼CMS 支持无限嵌套的分类，并支持分类的嵌套排序，无疑支持了您的产品、文档的组织和展示需求。</p>

                <p><a class="btn btn-default" href="<?=Url::to(['procate/index'])?>">文章分类 &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>多语种 & SEO</h2>

                <p>青鱼CMS 设计之初，就注重多语种、SEO优化。<br>只要在站点创立之初，配置多语种信息，即可在编辑内容时选择语种。<br>您将得到一个内容井然的多语种站点！</p>

                <p><a class="btn btn-default" href="<?=Url::to(['config/index'])?>">全局配置 &raquo;</a></p>
            </div>
        </div>

    </div>
</div>
