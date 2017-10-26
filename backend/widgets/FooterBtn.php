<?php
/**
 * @author qingyu8@staff.weibo.com
 * @date 21/10/2017
 */
namespace backend\widgets;

use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Url;

class FooterBtn extends Widget {

    public $btn_save = true;

    public $btn_save_then_new = true;

    public $btn_save_to_hide = true;

    public $btn_cancel = true;

    public function run() {
        $this->getView()->registerJs('
        var saveThenNew = $(".save-then-new");
        if(saveThenNew.length > 0){
        saveThenNew.click(function(){
            $("input[name=save-then-new]").val("yes");
        });}
        var saveToHide = $(".save-to-hide");
        if(saveToHide.length > 0){
        saveToHide.click(function(){
            $("input[name=save-to-hide]").val("yes");
        });}');
        $btns = '<div class="form-group footer-btns-div">';
        $this->btn_save && $btns .= Html::submitButton('<i class="fa fa-fw fa-check"></i>保存', ['class' => 'btn btn-success save']);
        $this->btn_save_then_new && $btns .= '<input type="hidden" name="save-then-new" value="no">' . Html::submitButton('<i class="fa fa-fw fa-plus text-success"></i>保存并新建', ['class' => 'btn btn-default save-then-new']);
        $this->btn_save_to_hide && $btns .= '<input type="hidden" name="save-to-hide" value="no">' . Html::submitButton('<i class="fa fa-fw fa-file-text-o text-success"></i>存为草稿', ['class' => 'btn btn-default save-to-hide']);
        $this->btn_cancel && $btns .= '<a href="' . Url::to(["index"]) . '" class="btn btn-default"><i class="fa fa-fw fa-close text-danger"></i>取消</a>';
        $btns .= '</div>';
        echo $btns;
    }
}