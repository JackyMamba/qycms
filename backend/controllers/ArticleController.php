<?php

namespace backend\controllers;

use backend\models\Artcate;
use backend\models\ArticleQuery;
use backend\models\ArticleSearch;
use Yii;
use backend\models\Article;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ArticleController implements the CRUD actions for Article model.
 */
class ArticleController extends Controller
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
     * Lists all Article models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ArticleSearch();
        $params = Yii::$app->request->queryParams;
        $pre_params = empty($_COOKIE[$params['r']]) ? [] : json_decode($_COOKIE[$params['r']], true);
        $params = array_merge($pre_params, $params);
        setcookie($params['r'], json_encode($params), time() + 7200);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $searchModel->search($params),
            'filterUrl' => Yii::$app->request->getScriptUrl() . '?' . http_build_query($params),
        ]);
    }

    /**
     * Displays a single Article model.
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
     * Creates a new Article model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Article();

        $post = Yii::$app->request->post();
        if(!empty($post[$model->formName()])){
            $post[$model->formName()]['ctime'] = $post[$model->formName()]['mtime'] = time();
            if ($post['save-to-hide'] == 'yes') {
                $post[$model->formName()]['status'] = Article::STATUS_HIDE;
            }
        }
        if ($model->load($post) && $model->save()) {
            if ($post['save-then-new'] == 'yes') {
                return $this->render('create', [
                    'model' => new Article(),
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
     * Updates an existing Article model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $post = Yii::$app->request->post();
        if(!empty($post[$model->formName()])){
            $post[$model->formName()]['mtime'] = time();
            if ($post['save-to-hide'] == 'yes') {
                $post[$model->formName()]['status'] = Article::STATUS_HIDE;
            }
        }
        if ($model->load($post) && $model->save()) {
            if ($post['save-then-new'] == 'yes') {
                return $this->render('create', [
                    'model' => new Article(),
                ]);
            }
            return $this->redirect(['index', '#' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionHide(){
        $id = Yii::$app->request->get('id');
        $model = $this->findModel($id);
        $status = $model->status;
        $model->status = $status == Article::STATUS_HIDE ? Article::STATUS_ACTIVE : Article::STATUS_HIDE;
        $model->save();
        return $this->redirect(['index']);
    }

    /**
     * Deletes an existing Article model.
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
     * Finds the Article model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Article the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Article::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
