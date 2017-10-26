<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\Procate;
use frontend\models\Product;

/**
 * ProductsController implements the CRUD actions for Procate model.
 */
class ProductsController extends Controller {
    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex($id = null) {
        $ct = Procate::nestedItems();

        if ($id) {
            $procate = $ct['items'][$id];
            //var_dump($procate);exit;
            if (empty($procate) || $procate['status'] != Procate::STATUS_ACTIVE) {
                throw new NotFoundHttpException(Yii::t('yii', 'Page not found.'));
            }
            $items = Product::find()->where(['=', 'cid', $id])->andWhere(['=', 'status', Product::STATUS_ACTIVE])->andWhere(['=', 'lang', Yii::$app->language])->asArray()->offset(0)->limit(20)->all();
        } else {
            $procate = [];
            $items = Product::find()->where(['=', 'status', Product::STATUS_ACTIVE])->andWhere(['=', 'lang', Yii::$app->language])->asArray()->offset(0)->limit(20)->all();
        }

        return $this->render('index', [
            'ct' => $ct,
            'id' => $id,
            'procate' => $procate,
            'items' => $items,
        ]);
    }

    public function actionView($id) {
        $product = $this->findOne($id);

        $ct = Procate::nestedItems();
        return $this->render('view', [
            'model' => $product,
            'ct' => $ct,
        ]);
    }

    protected function findModel($id) {
        $model = Procate::findOne($id);
        if ($model == null || $model->status != Procate::STATUS_ACTIVE) {
            throw new NotFoundHttpException(Yii::t('yii', 'Page not found.'));
        }
        return $model;
    }

    protected function findOne($id) {
        $model = Product::findOne($id);
        if ($model == null || $model->status != Product::STATUS_ACTIVE) {
            throw new NotFoundHttpException(Yii::t('yii', 'Page not found.'));
        }
        return $model;
    }
}
