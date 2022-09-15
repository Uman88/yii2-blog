<?php

use yii\helpers\Html;
use yii\helpers\Url;
use frontend\models\Post;
use yii\widgets\Breadcrumbs;

/** @var yii\web\View $this */
/** @var frontend\models\Post $model */
/** @var  frontend\models\Category $titleCategory */

Yii::$app->name = 'Yii2-Blog';

$this->title = $titleCategory['title'];

echo Breadcrumbs::widget([
    'homeLink' => [
        'label' => '',
        'url' => Yii::$app->homeUrl,
    ],
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]);

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        <?php foreach ($model as $post) : ?>
            <div class="col">
                <div class="card shadow-sm">
                    <?= !Post::getTitleImage($post->img_id) ? Html::img('/web/images/no-image.png', ['height' => '225']) : Html::img('/web/uploads/' . Post::getTitleImage($post->img_id), ['height' => '225']); ?>
                    <div class="card-body">
                        <p class="card-text"><?= Post::truncationString($post->title); ?></p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <i class="ri-user-3-line"></i> <?= $post->author ?>&nbsp;&nbsp;&nbsp;
                                <i class="ri-eye-line"></i> <?= $post->viewed; ?>
                            </div>
                            <a class="btn btn-dark"
                               href="<?= Url::to(['post/view', 'id' => $post->id]) ?>">Подробнее</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>