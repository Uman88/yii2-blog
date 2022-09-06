<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\models\Post;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Посты');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index mt-5">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Создать пост'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'author',
            [
                'attribute' => 'category_id',
                'format' => 'raw',
                'value' => function ($data) {
                    return $data->category->title;
                },
            ],
            [
                'attribute' => 'status',
                'format' => 'raw',
                'options' => ['style' => 'width: 50px;'],
                'contentOptions' => ['style' => 'text-align: center;'],
                'value' => function ($data) {
                    return !$data->status ? '<button class="btn btn-danger"><i class="ri-close-line"></i></button>' : '<button class="btn btn-success"><i class="ri-check-line"></button></i>';
                },
            ],
            [
                'attribute' => 'title',
                'options' => ['style' => 'width: 100%;'],
                'contentOptions' => ['style' => 'white-space: normal;'],
            ],
            [
                'label' => 'Изображение',
                'attribute' => 'img_id',
                'format' => 'raw',
                'value' => function ($data) {
                    return !Post::getTitleImage($data->img_id) ? Html::img('/web/images/no-image.png', ['width' => '100']) : Html::img('/web/uploads/' . Post::getTitleImage($data->img_id), ['width' => '150']);
                },
                'options' => ['style' => 'width: 150px;'],
            ],
            [
                'attribute' => 'created_at',
                'format' => ['date', 'dd.MM.yyyy'],
            ],
            [
                'attribute' => 'updated_at',
                'format' => ['date', 'dd.MM.yyyy'],
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Действия',
                'template' => '{view} {update} {delete}{link}',
            ],

        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
