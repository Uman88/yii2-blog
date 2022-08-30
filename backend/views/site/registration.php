<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var common\models\Registration $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Регистрация';
//$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-signup">

    <div class="row">
        <div class="mt-5 offset-lg-3 col-lg-5">
            <h1><?= Html::encode($this->title) ?></h1>
            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'name')->textInput(['autofocus' => true])->input('name', ['placeholder' => 'Имя'])->label('') ?>
            <?= $form->field($model, 'email')->textInput()->input('email', ['placeholder' => 'Почта'])->label('') ?>
            <?= $form->field($model, 'password')->passwordInput()->input('password', ['placeholder' => 'Пароль'])->label('') ?>

            <div class="form-group">
                <?= Html::submitButton('Регистрация', ['class' => 'btn btn-primary']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>