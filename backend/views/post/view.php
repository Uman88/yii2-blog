<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\Post;

/* @var $this yii\web\View */
/* @var $model backend\models\Post */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Posts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="post-view mt-5">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Назад'), ['post/index'], ['class' => 'btn btn-secondary']) ?>
        <?= Html::a(Yii::t('app', 'Редактировать'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Удалить'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Вы уверены, что хотите удалить этот элемент?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'category_id',
                'format' => 'raw',
                'value' => $model->getTitleCategory(),
            ],
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => !$model->status ? '<button class="btn btn-danger"><i class="ri-close-line"></i></button>' : '<button class="btn btn-success"><i class="ri-check-line"></button></i>',
            ],
            'author',
            'title',
            'description',
            'content:ntext',
            [
                'label' => 'Изображение',
                'attribute' => 'img_id',
                'format' => 'raw',
                'value' => !Post::getTitleImage($model->img_id) ? Html::img('@web/images/no-image.png', ['width' => '200']) : Html::img('@web/uploads/' . Post::getTitleImage($model->img_id), ['width' => '200']),
            ],
            [
                'attribute' => 'created_at',
                'format' => ['date', 'dd.MM.yyyy'],
            ],
            [
                'attribute' => 'updated_at',
                'format' => ['date', 'dd.MM.yyyy'],
            ],
        ],
    ]) ?>

</div>
