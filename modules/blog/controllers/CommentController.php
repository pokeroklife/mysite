<?php
declare(strict_types=1);

namespace app\modules\blog\controllers;

use \yii\web\Controller;

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
        $action['delete'] = ['class' => 'app\modules\blog\controllers\actions\comment\DeleteAction'];
        $action['create'] = ['class' => 'app\modules\blog\controllers\actions\comment\CreateAction'];

        return $action;
    }
}