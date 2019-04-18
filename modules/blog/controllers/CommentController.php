<?php
declare(strict_types=1);

namespace app\modules\blog\controllers;

use app\modules\blog\controllers\actions\comment\DeleteAction;
use \yii\web\Controller;
use app\modules\blog\controllers\actions\comment\CreateAction;

class CommentController extends Controller
{
    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::class,
                'only' => ['delete', 'create'],
                'rules' => [
                    [
                        'actions' => ['delete', 'create'],
                        'allow' => true,
                        'roles' => ['admin', 'user'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => \yii\filters\VerbFilter::class,
                'actions' => [
                    'create' => ['post'],
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function actions(): array
    {
        $action = parent::actions();
        $action['delete'] = ['class' => DeleteAction::class];
        $action['create'] = ['class' => CreateAction::class];

        return $action;
    }
}