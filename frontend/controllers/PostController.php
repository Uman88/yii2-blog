<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Category;
use frontend\models\Post;
use yii\helpers\VarDumper;
use yii\web\Controller;

/**
 * Post controller
 */
class PostController extends Controller
{
    /**
     * Get id for display page view, as well as get id for breadcrumbs and get vieweds
     *
     * @param $id
     * @return string
     */
    public function actionView($id)
    {
        $model = Post::getOnePost($id);
        $modelPost = Post::getTitleCategory($id);
        $titleCategory = Category::getTitleCategoryByIdForBreadCrumbs($modelPost['category_id']);
        Post::setViewed($id);
        $getViewed = Post::getViewed($id);

        return $this->render('view', ['model' => $model, 'titleCategory' => $titleCategory,'getViewed'=>$getViewed]);
    }

}