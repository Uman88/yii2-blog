<?php

namespace backend\controllers;

use yii\web\Controller;
use yii\filters\AccessControl;

/**
 * Behaviors Controller
 */
class BehaviorsController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'controllers' => ['site'],
                        'actions' => ['index', 'error'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'controllers' => ['site'],
                        'actions' => ['login', 'registration', 'error'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'controllers' => ['site'],
                        'actions' => ['logout', 'index'],
                        'verbs' => ['POST'],
                        'roles' => ['@']
                    ],
                    [
                        'controllers' => ['category'],
                        'actions' => ['index', 'create', 'update', 'view', 'delete', 'error'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'controllers' => ['post'],
                        'actions' => ['index', 'create', 'update', 'view', 'delete', 'delete-image', 'error'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ]
            ],
        ];
    }
}