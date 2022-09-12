<?php

use yii\helpers\Html;
use frontend\models\Post;
use yii\widgets\Breadcrumbs;

/** @var Post $model */
/** @var  frontend\models\Category $titleCategory */
/** @var frontend\controllers\PostController $getViewed */

Yii::$app->name = 'Yii2-Blog';

echo Breadcrumbs::widget([
    'homeLink' => [
        'label' => '',
        'url' => Yii::$app->homeUrl,
    ],
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]);

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => $titleCategory->title, 'url' => ['category/index', 'id' => $titleCategory->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-index">
    <div class="body-content">
        <div class="row">
            <h1><?= $model->title ?></h1>
            <h7>
                <i class="ri-user-3-line"></i> <?= $model['author']; ?>&nbsp;&nbsp;&nbsp;
                <?= Yii::$app->formatter->asDate($model['created_at'], 'php:Y-m-d H:i:s');?>&nbsp;&nbsp;&nbsp;
                <i class="ri-eye-line"></i> <?= $getViewed['viewed']; ?>
            </h7>
            <?= Html::img('/web/uploads/' . Post::getTitleImage($model->img_id)); ?>
            <div class="mt-3">
                <p><?= $model->content ?></p>

            </div>
        </div>
    </div>
</div>