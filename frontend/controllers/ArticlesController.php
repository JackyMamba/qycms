<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\Artcate;
use frontend\models\Article;
use frontend\logic\Nested;

/**
 * ArticlesController implements the CRUD actions for Artcate model.
 */
class ArticlesController extends Controller {
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
        $ct = Artcate::nestedItems();

        if ($id) {
            $artcate = $ct['items'][$id];
            //var_dump($artcate);exit;
            if (empty($artcate) || $artcate['status'] != Artcate::STATUS_ACTIVE) {
                throw new NotFoundHttpException(Yii::t('yii', 'Page not found.'));
            }
            $items = Article::find()->where(['=', 'cid', $id])->andWhere(['=', 'status', Article::STATUS_ACTIVE])->andWhere(['=', 'lang', Yii::$app->language])->asArray()->offset(0)->limit(20)->all();
        } else {
            $artcate = [];
            $items = Article::find()->where(['=', 'status', Article::STATUS_ACTIVE])->andWhere(['=', 'lang', Yii::$app->language])->asArray()->offset(0)->limit(20)->all();
        }

        return $this->render('index', [
            'ct' => $ct,
            'id' => $id,
            'artcate' => $artcate,
            'items' => $items,
        ]);
    }

    public function actionView($id) {
        $article = $this->findOne($id);

        $ct = Artcate::nestedItems();
        return $this->render('view', [
            'model' => $article,
            'ct' => $ct,
        ]);
    }

    protected function findModel($id) {
        $model = Artcate::findOne($id);
        if ($model == null || $model->status != Artcate::STATUS_ACTIVE) {
            throw new NotFoundHttpException(Yii::t('yii', 'Page not found.'));
        }
        return $model;
    }

    protected function findOne($id) {
        $model = Article::findOne($id);
        if ($model == null || $model->status != Article::STATUS_ACTIVE) {
            throw new NotFoundHttpException(Yii::t('yii', 'Page not found.'));
        }
        return $model;
    }
}
