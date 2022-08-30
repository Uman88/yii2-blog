<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var common\models\Login $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Авторизация';
?>
<div class="site-login">
    <div class="mt-5 offset-lg-3 col-lg-5">
        <h1><?= Html::encode($this->title) ?></h1>
        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

        <?= $form->field($model, 'email')->textInput(['autofocus' => true])->input('email', ['placeholder' => 'Почта'])->label('') ?>
        <?= $form->field($model, 'password')->passwordInput()->input('password', ['placeholder' => 'Пароль'])->label('') ?>
        <?= $form->field($model, 'rememberMe')->checkbox()->label('Запомнить меня') ?>

        <div class="form-group">
            <?= Html::submitButton('Войти', ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
