<?php

namespace backend\controllers;

use backend\logic\Nested;
use backend\logic\Upload;
use Yii;
use backend\models\Banner;
use yii\bootstrap\Html;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * BannerController implements the CRUD actions for Banner model.
 */
class BannerController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Banner models.
     * @return mixed
     */
    public function actionIndex()
    {
        $data = Banner::find()->orderBy('display_order DESC')->asArray()->all();

        return $this->render('index', [
            'data' => $data,
        ]);
    }

    public function actionOrder(){
        $ids = Yii::$app->request->post('ids');
        $order = array_reverse(explode(',', trim($ids, ', ')));
        foreach ($order as $k=>$id){
            Banner::updateAll(['display_order' => $k], 'id = '.$id);
        }
        var_dump($order);
    }

    /**
     * Displays a single Banner model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Banner model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Banner();

        $post = Yii::$app->request->post();

        if (Yii::$app->request->isPost) {
            $path = Upload::img(Html::getInputName($model, 'imageFile'));
            if ($path) {
                $post[$model->formName()]['pic'] = $path;
            }
        }

        if ($model->load($post) && $model->save()) {
            if ($post['save-then-new'] == 'yes') {
                return $this->render('create', [
                    'model' => new Banner(),
                ]);
            }
            return $this->redirect(['index', '#' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Banner model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $post = Yii::$app->request->post();

        if (Yii::$app->request->isPost) {
            $path = Upload::img(Html::getInputName($model, 'imageFile'));
            if ($path) {
                $post[$model->formName()]['pic'] = $path;
            }
        }

        if ($model->load($post) && $model->save()) {
            if ($post['save-then-new'] == 'yes') {
                return $this->render('create', [
                    'model' => new Banner(),
                ]);
            }
            return $this->redirect(['index', '#' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Banner model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Banner model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Banner the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Banner::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
