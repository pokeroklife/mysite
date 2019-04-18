<?php
declare(strict_types=1);

namespace app\controllers;

use app\controllers\actions\IndexAction;
use app\controllers\actions\LoginAction;
use app\controllers\actions\LogOutAction;
use app\controllers\actions\RequestPasswordResetAction;
use app\controllers\actions\ResetPasswordAction;
use app\controllers\actions\SignupAction;
use yii\captcha\CaptchaAction;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\ErrorAction;

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
                'class' => ErrorAction::class,
            ],
            'captcha' => [
                'class' => CaptchaAction::class,
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
            'index' => [
                'class' => IndexAction::class,
            ],
            'login' => [
                'class' => LoginAction::class,
            ],
            'signup' => [
                'class' => SignupAction::class,
            ],
            'passwordResetRequest' => [
                'class' => RequestPasswordResetAction::class,
            ],
            'resetPassword' => [
                'class' => ResetPasswordAction::class,
            ],
            'logout' => [
                'class' => LogOutAction::class,
            ],
        ];
    }
}
