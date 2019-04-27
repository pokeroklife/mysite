<?php
declare(strict_types=1);

namespace app\modules\blog\controllers;

use app\modules\blog\controllers\actions\comment\DeleteAction;
use \yii\web\Controller;
use app\modules\blog\controllers\actions\comment\CreateAction;

/**
 * Class CommentController
 * @package app\modules\blog\controllers
 */
class CommentController extends Controller
{
    /**
     * @return array
     */
    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::class,
                'only' => ['delete', 'create'],
                'rules' => [
                    [
                        'actions' => ['create'],
                        'allow' => true,
                        'roles' => ['user'],
                    ],
                    [
                        'actions' => ['delete', 'create'],
                        'allow' => true,
                        'roles' => ['admin'],
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

    /**
     * @return array
     */
    public function actions(): array
    {
        $action = parent::actions();
        $action['delete'] = ['class' => DeleteAction::class];
        $action['create'] = ['class' => CreateAction::class];

        return $action;
    }
}