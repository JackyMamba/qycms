<?php

namespace backend\controllers;

use backend\logic\Nested;
use Yii;
use backend\models\Procate;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProcateController implements the CRUD actions for Procate model.
 */
class ProcateController extends Controller
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
     * Lists all Procate models.
     * @return mixed
     */
    public function actionIndex()
    {

        $data = Nested::dataList(Procate::find()->orderBy('display_order DESC')->asArray()->all());

        return $this->render('index', [
            'data' => $data,
        ]);
    }

    public function actionOrder(){
        $ids = Yii::$app->request->post('ids');
        $order = array_reverse(explode(',', trim($ids, ', ')));
        foreach ($order as $k=>$id){
            Procate::updateAll(['display_order' => $k], 'id = '.$id);
        }
        var_dump($order);
    }

    /**
     * Displays a single Procate model.
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
     * Creates a new Procate model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Procate();

        $post = Yii::$app->request->post();
        if(!empty($post[$model->formName()])){
            $data = $post[$model->formName()];

            $post[$model->formName()]['pids'] = Nested::getPids(Procate::findOne($data['pid']));
            $post[$model->formName()]['ctime'] = $post[$model->formName()]['mtime'] = time();
            if ($post['save-to-hide'] == 'yes') {
                $post[$model->formName()]['status'] = Procate::STATUS_HIDE;
            }
        }
        if ($model->load($post) && $model->save()) {
            if ($post['save-then-new'] == 'yes') {
                return $this->render('create', [
                    'model' => new Procate(),
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
     * Updates an existing Procate model.
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
            $post[$model->formName()]['pids'] = Nested::getPids(Procate::findOne($data['pid']));
            $post[$model->formName()]['mtime'] = time();
            if ($post['save-to-hide'] == 'yes') {
                $post[$model->formName()]['status'] = Procate::STATUS_HIDE;
            }
        }
        if ($model->load($post) && $model->save()) {
            if ($post['save-then-new'] == 'yes') {
                return $this->render('create', [
                    'model' => new Procate(),
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
     * Deletes an existing Procate model.
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
        $model->status = $status == Procate::STATUS_HIDE ? Procate::STATUS_ACTIVE : Procate::STATUS_HIDE;
        $model->save();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Procate model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Procate the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Procate::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
