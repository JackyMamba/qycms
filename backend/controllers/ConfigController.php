<?php

namespace backend\controllers;

use yii;
use yii\helpers\ArrayHelper;
use backend\logic\Upload;

class ConfigController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $lang_code = Yii::$app->request->get('lang_code', 'zh-CN');
        $post = Yii::$app->request->post();
        $path = Yii::$app->basePath . '/../common/config/params-local.php';
        $config = require $path;
        if (!empty($post)) {
            unset($post['_csrf-backend']);
            $lang_code = ArrayHelper::remove($post, 'lang_code');
            $filepath = Upload::img('site_logo_file');
            if($filepath){
                $post['lang'][$lang_code]['site_logo'] = $filepath;
            }

            $config = ArrayHelper::merge($config, $post);
            file_put_contents($path, '<?php return ' . var_export($config, true) . ';');
        }
        return $this->render('index', [
            'config' => $config,
            'lang_code' => $lang_code,
        ]);
    }

}
