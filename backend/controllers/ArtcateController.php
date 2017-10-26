<?php

namespace backend\controllers;

use backend\logic\Nested;
use backend\models\Article;
use Yii;
use backend\models\Artcate;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Lang;

/**
 * ArtcateController implements the CRUD actions for Artcate model.
 */
class ArtcateController extends Controller
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
     * Lists all Artcate models.
     * @return mixed
     */
    public function actionIndex()
    {
        $data = Nested::dataList(Artcate::find()->orderBy('display_order DESC')->asArray()->all());

        return $this->render('index', [
            'data' => $data,
        ]);
    }

    public function actionOrder(){
        $ids = Yii::$app->request->post('ids');
        $order = array_reverse(explode(',', trim($ids, ', ')));
        foreach ($order as $k=>$id){
            Artcate::updateAll(['display_order' => $k], 'id = '.$id);
        }
        var_dump($order);
    }

    /**
     * Displays a single Artcate model.
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
     * Creates a new Artcate model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Artcate();

        $post = Yii::$app->request->post();
        if(!empty($post[$model->formName()])){
            $data = $post[$model->formName()];

            $post[$model->formName()]['pids'] = Nested::getPids(Artcate::findOne($data['pid']));
            $post[$model->formName()]['ctime'] = $post[$model->formName()]['mtime'] = time();
            if ($post['save-to-hide'] == 'yes') {
                $post[$model->formName()]['status'] = Artcate::STATUS_HIDE;
            }
        }
        if ($model->load($post) && $model->save()) {
            if ($post['save-then-new'] == 'yes') {
                return $this->render('create', [
                    'model' => new Artcate(),
                ]);
            }
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Artcate model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $post = Yii::$app->request->post();
        if(!empty($post[$model->formName()])){
            $data = $post[$model->formName()];
            $post[$model->formName()]['pids'] = Nested::getPids(Artcate::findOne($data['pid']));
            $post[$model->formName()]['mtime'] = time();
            if ($post['save-to-hide'] == 'yes') {
                $post[$model->formName()]['status'] = Artcate::STATUS_HIDE;
            }
        }
        if ($model->load($post) && $model->save()) {
            if ($post['save-then-new'] == 'yes') {
                return $this->render('create', [
                    'model' => new Artcate(),
                ]);
            }
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Artcate model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionHide(){
        $id = Yii::$app->request->get('id');
        $model = $this->findModel($id);
        $status = $model->status;
        $model->status = $status == Artcate::STATUS_HIDE ? Artcate::STATUS_ACTIVE : Artcate::STATUS_HIDE;
        $model->save();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Artcate model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Artcate the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Artcate::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
