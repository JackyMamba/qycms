<?php

namespace backend\controllers;

use Yii;
use backend\models\Product;
use backend\models\ProductSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
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
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();

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
     * Displays a single Product model.
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
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Product();

        $post = Yii::$app->request->post();
        if (!empty($post[$model->formName()])) {
            $post[$model->formName()]['ctime'] = $post[$model->formName()]['mtime'] = time();
            $post[$model->formName()]['pics'] = json_encode(explode(',', $post[$model->formName()]['pics']));

            if ($post['save-to-hide'] == 'yes') {
                $post[$model->formName()]['status'] = Product::STATUS_HIDE;
            }
        }
        if ($model->load($post) && $model->save()) {
            if ($post['save-then-new'] == 'yes') {
                return $this->render('create', [
                    'model' => new Product(),
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
     * Updates an existing Product model.
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
            $post[$model->formName()]['pics'] = json_encode(explode(',', $post[$model->formName()]['pics']));
            if ($post['save-to-hide'] == 'yes') {
                $post[$model->formName()]['status'] = Product::STATUS_HIDE;
            }
        }
        if ($model->load($post) && $model->save()) {
            if ($post['save-then-new'] == 'yes') {
                return $this->render('create', [
                    'model' => new Product(),
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
        $model->status = $status == Product::STATUS_HIDE ? Product::STATUS_ACTIVE : Product::STATUS_HIDE;
        $model->save();
        return $this->redirect(['index']);
    }

    /**
     * Deletes an existing Product model.
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
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
