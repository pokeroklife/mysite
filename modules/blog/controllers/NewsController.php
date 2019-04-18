<?php
declare(strict_types = 1);

namespace app\modules\blog\controllers;

use app\modules\blog\controllers\actions\news\CreateAction;
use app\modules\blog\controllers\actions\news\DeleteAction;
use app\modules\blog\controllers\actions\news\IndexAction;
use app\modules\blog\controllers\actions\news\UpdateAction;
use app\modules\blog\controllers\actions\news\ViewAction;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

class NewsController extends Controller
{
    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['index', 'view', 'delete', 'create'],
                'rules' => [
                    [
                        'actions' => ['index', 'view'],
                        'allow' => true,
                        'roles' => ['admin', 'user'],
                    ],
                    [
                        'actions' => ['delete', 'create'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'index' => ['get'],
                    'delete' => ['post'],
                    'view' => ['get'],
                ],
            ],
        ];
    }

    public function actions(): array
    {
        $actions = parent::actions();
        $actions ['index'] = ['class' => IndexAction::class];
        $actions ['view'] = ['class' => ViewAction::class];
        $actions ['delete'] = ['class' => DeleteAction::class];
        $actions ['create'] = ['class' => CreateAction::class];
        $actions ['update'] = ['class' => UpdateAction::class];

        return $actions;
    }
}