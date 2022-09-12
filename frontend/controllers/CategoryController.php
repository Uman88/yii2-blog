<?php

namespace frontend\controllers;

use frontend\models\Category;
use frontend\models\Post;
use yii\web\Controller;

/**
 * Category controller
 */
class CategoryController extends Controller
{
    /**
     * Main index page
     *
     * @param $id
     * @return string
     */
    public function actionIndex($id)
    {
        $model = Post::getAllPostByIdCategory($id);
        $titleCategory = Category::getTitleCategoryByIdForBreadCrumbs($id);

        return $this->render('index', ['model' => $model, 'titleCategory' => $titleCategory]);
    }
}