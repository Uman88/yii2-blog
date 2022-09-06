<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Post;
use backend\models\Category;

/* @var $this yii\web\View */
/* @var $model backend\models\Post */
/* @var $form yii\bootstrap5\ActiveForm */

/**
 * Get name author post/article
 */
$model->author = Yii::$app->user->identity->name;
?>

<div class="post-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?php
    $category = new Category();
    $category = $category->getAllCategory();
    $items = ArrayHelper::map($category, 'id', 'title');
    $params = [
        'prompt' => 'Выберите категорию...'
    ];
    echo $form->field($model, 'category_id')->textInput()->dropDownList($items, $params);

    $items = [
        Post::STATUS_ACTIVE => Post::$status[1],
        Post::STATUS_INACTIVE => Post::$status[0],
    ];
    $params = [
        'prompt' => 'Выберите статус...'
    ];
    echo $form->field($model, 'status')->textInput()->dropDownList($items, $params);
    ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'author')->textInput() ?>

    <?= Html::img('@web/uploads/' . Post::getTitleImage($model->img_id), ['width' => '200']); ?>

    <?php if ($model->img_id) : ?>
        <?= Html::a('<i class="ri-delete-bin-2-line remixicon-delete-image-edit"></i>', ['delete-image', 'id' => $model->img_id],
            [
                'data' => [
                    'confirm' => Yii::t('app', 'Вы уверены, что хотите удалить изображение?'),
                    'method' => 'post',
                ],
            ]
        ) ?>
    <?php endif; ?>

    <?= $form->field($model, 'image')->textInput()->fileInput() ?>
    <div class="form-group mt-3">
        <?= Html::submitButton(Yii::t('app', 'Сохранить'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
