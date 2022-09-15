<?php

use yii\helpers\Html;
use yii\helpers\Url;
use frontend\models\Post;
use yii\widgets\LinkPager;

/** @var yii\web\View $this */
/** @var frontend\models\Post $model */
/** @var frontend\models\Post $pages */



Yii::$app->name = 'Yii2-Blog';
$this->title = 'Blog';
?>
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
<div class="mt-5">
    <?= LinkPager::widget([
        'pagination' => $pages,
        //Css option for container
        'options' => ['class' => 'pagination'],
        //Значение первого варианта
        //'firstPageLabel' => 'First',
        //Значение последней опции
        //'lastPageLabel' => 'Last',
        //Предыдущее значение параметра
        'prevPageLabel' => 'Назад',
        //Значение следующего параметра
        'nextPageLabel' => 'Вперед',
        //Текущее значение активной опции
        'activePageCssClass' => 'active',
        //Максимальное количество разрешенных опций
        'maxButtonCount' => 7,

        //Css для каждого параметра. Ссылки
        'linkOptions' => ['class' => 'page-link'],
        //'disabledPageCssClass' => 'disabled',

        //Настройка класса CSS для навигации по ссылке
        'prevPageCssClass' => 'page-item',
        'nextPageCssClass' => 'page-item',
        'firstPageCssClass' => 'p-first',
        'lastPageCssClass' => 'p-last',
    ]);
    ?>
</div>
