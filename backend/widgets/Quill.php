<?php
/**
 * @author qingyu8@staff.weibo.com
 * @date 15/10/2017
 */
namespace backend\widgets;

use yii\base\Widget;

class Quill extends Widget {

    public $name;

    public $form_id;

    public $contents;

    public function run() {
        $view = $this->getView();
        QuillAsset::register($view);
        $view->registerJs('var hiddenInput = $("input[name=\'' . $this->name . '\']");
        var editor = new Quill("#editor", {
    modules: { toolbar: [
      ["bold", "italic"],
      ["link", "blockquote", "code-block", "image"],
      [{ list: "ordered" }, { list: "bullet" }]
    ] },
    placeholder: "请填写内容",
    theme: "snow"
    //,contents: JSON.parse(hiddenInput.val())
  });
  //editor.setContents(JSON.parse(hiddenInput.val()).ops);
  $("#editor").children().first().html(hiddenInput.val());
  $("#' . $this->form_id . '").submit(function(){
  //hiddenInput.val(JSON.stringify(editor.getContents()));
  hiddenInput.val($(\'#editor\').children().first().html());
  });');
        echo '
<!-- the editor container -->
<div id="editor">
</div>';
    }
}
