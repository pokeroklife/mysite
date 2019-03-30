<?php

namespace app\controllers;

use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;

class SiteController extends Controller
{
    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['index'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['admin', 'user'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions(): array
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
            'index' => [
                'class' => 'app\controllers\actions\IndexAction',
            ],
            'login' => [
                'class' => 'app\controllers\actions\LoginAction',
            ],
            'signup' => [
                'class' => 'app\controllers\actions\SignupAction',
            ],
            'passwordResetRequest' => [
                'class' => 'app\controllers\actions\RequestPasswordResetAction',
            ],
            'resetPassword' => [
                'class' => 'app\controllers\actions\ResetPasswordAction',
            ],
            'logout' => [
                'class' => 'app\controllers\actions\LogOutAction',
            ],
        ];
    }
}
