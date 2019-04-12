<?php
declare(strict_types = 1);

namespace app\modules\blog\controllers;

use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

class CategoriesController extends Controller
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
        $actions ['index'] = ['class' => 'app\modules\blog\controllers\actions\categories\IndexAction'];
        $actions ['view'] = ['class' => 'app\modules\blog\controllers\actions\categories\ViewAction'];
        $actions ['delete'] = ['class' => 'app\modules\blog\controllers\actions\categories\DeleteAction'];
        $actions ['create'] = ['class' => 'app\modules\blog\controllers\actions\categories\CreateAction'];

        return $actions;
    }
}