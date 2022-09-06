<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Категории');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index mt-5">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Содать категорию'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'header' => '#',
                'options' => ['style' => 'width: 30px;'],
            ],
            'title',
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Действия',
                'options' => ['style' => 'width: 90px;'],
                'contentOptions' => ['style' => 'text-align: center;'],
                'template' => '{view} {update} {delete}{link}',
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
