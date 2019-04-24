<?php
declare(strict_types=1);

namespace app\modules\shop\controllers;

use app\modules\shop\controllers\actions\products\UpdateAction;
use app\modules\shop\controllers\actions\products\CreateAction;
use app\modules\shop\controllers\actions\products\DeleteAction;
use app\modules\shop\controllers\actions\products\IndexAction;
use app\modules\shop\controllers\actions\products\ViewAction;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;

/**
 * Class ProductsController
 * @package app\modules\shop\controllers
 */
class ProductsController extends Controller
{
    /**
     * @return array
     */
    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['index', 'view', 'delete', 'create', 'update'],
                'rules' => [

                    [
                        'actions' => ['delete', 'create', 'update', 'view', 'index'],
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
        $actions ['update'] = ['class' => UpdateAction::class];
        $actions ['create'] = ['class' => CreateAction::class];
        $actions ['delete'] = ['class' => DeleteAction::class];
        $actions ['view'] = ['class' => ViewAction::class];
        return $actions;
    }
}
