<?php

namespace backend\controllers;

use Yii;
use yii\web\Response;
use common\models\User;
use common\models\Login;
use common\models\Registration;

/**
 * Site controller
 */
class SiteController extends BehaviorsController
{
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Registration action
     *
     * @return string|Response
     */
    public function actionRegistration()
    {
        $model = new Registration();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            if ($user = $model->registration()) {
                if ($user->status === User::STATUS_ACTIVE) {
                    if (Yii::$app->getUser()->login($user)) {
                        return $this->goHome();
                    }
                }
            } else {
                Yii::$app->session->setFlash('error', 'Возникла ошибка при регистрации');
                Yii::error('Ошибка при регистрации');
                return $this->refresh();
            }
        }

        return $this->render('registration', ['model' => $model]);
    }

    /**
     * Login action.
     *
     * @return string|Response
     */
    public function actionLogin()
    {
        $model = new Login();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goHome();
        }

        return $this->render('login', ['model' => $model]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
