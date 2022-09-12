<?php

namespace frontend\controllers;

use frontend\models\Post;
use yii\data\Pagination;
use yii\web\Controller;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * Displays homepage
     *
     * @return string
     */
    public function actionIndex()
    {
        $query = Post::find()->where(['status' => \backend\models\Post::STATUS_ACTIVE]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 10]);
        $model = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('index', ['model' => $model, 'pages' => $pages]);
    }
}
