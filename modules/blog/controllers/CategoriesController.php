<?php
declare(strict_types = 1);

namespace app\modules\blog\controllers;

use app\modules\blog\controllers\actions\categories\CreateAction;
use app\modules\blog\controllers\actions\categories\DeleteAction;
use app\modules\blog\controllers\actions\categories\IndexAction;
use app\modules\blog\controllers\actions\categories\ViewAction;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

/**
 * Class CategoriesController
 * @package app\modules\blog\controllers
 */
class CategoriesController extends Controller
{
    /**
     * @return array
     */
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

    /**
     * @return array
     */
    public function actions(): array
    {
        $actions = parent::actions();
        $actions ['index'] = ['class' => IndexAction::class];
        $actions ['view'] = ['class' => ViewAction::class];
        $actions ['delete'] = ['class' => DeleteAction::class];
        $actions ['create'] = ['class' => CreateAction::class];

        return $actions;
    }
}