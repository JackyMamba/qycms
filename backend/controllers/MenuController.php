<?php

namespace backend\controllers;

use backend\logic\Nested;
use backend\models\Artcate;
use Yii;
use backend\models\Menu;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MenuController implements the CRUD actions for Menu model.
 */
class MenuController extends Controller
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
     * Lists all Menu models.
     * @return mixed
     */
    public function actionIndex()
    {
        $data = Nested::dataList(Menu::find()->orderBy('display_order DESC')->asArray()->all());

        return $this->render('index', [
            'data' => $data,
        ]);
    }

    public function actionOrder(){
        $ids = Yii::$app->request->post('ids');
        $order = array_reverse(explode(',', trim($ids, ', ')));
        foreach ($order as $k=>$id){
            Menu::updateAll(['display_order' => $k], 'id = '.$id);
        }
        var_dump($order);
    }

    /**
     * Displays a single Menu model.
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
     * Creates a new Menu model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Menu();

        $post = Yii::$app->request->post();
        if(!empty($post[$model->formName()])){
            $data = $post[$model->formName()];

            $post[$model->formName()]['pids'] = Nested::getPids(Menu::findOne($data['pid']));
            $post[$model->formName()]['ctime'] = $post[$model->formName()]['mtime'] = time();

            if($data['content_type'] == 'URL'){
                if(empty($data['content']['url'])){

                }
            }elseif ($data['content_type'] == 'ARTCATE'){

            }elseif ($data['content_type'] == 'PROCATE'){

            }else{

            }
            $post[$model->formName()]['content'] = json_encode($data['content']);
        }
        if ($model->load($post) && $model->save()) {
            if ($post['save-then-new'] == 'yes') {
                return $this->render('create', [
                    'model' => new Menu(),
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
     * Updates an existing Menu model.
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
            $post[$model->formName()]['pids'] = Nested::getPids(Menu::findOne($data['pid']));
            $post[$model->formName()]['mtime'] = time();

            if($data['content_type'] == 'URL'){
                if(empty($data['content']['url'])){

                }
            }elseif ($data['content_type'] == 'ARTCATE'){

            }elseif ($data['content_type'] == 'PROCATE'){

            }else{

            }
            $post[$model->formName()]['content'] = json_encode($data['content']);
        }

        $model->content = json_decode($model->content, true);
        if ($model->load($post) && $model->save()) {
            if ($post['save-then-new'] == 'yes') {
                return $this->render('create', [
                    'model' => new Menu(),
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
     * Deletes an existing Menu model.
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
     * Finds the Menu model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Menu the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Menu::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
