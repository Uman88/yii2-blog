<?php

namespace frontend\controllers;

use frontend\models\Post;
use yii\web\Controller;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $model = Post::getAllPostByActiveStatus();

        return $this->render('index', ['model' => $model]);
    }
}
