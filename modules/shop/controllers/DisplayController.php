<?php
declare(strict_types=1);

namespace app\modules\shop\controllers;

use app\modules\shop\controllers\actions\display\IndexAction;
use app\modules\shop\controllers\actions\display\ViewAction;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

/**
 * Class DisplayController
 * @package app\modules\shop\controllers
 */
class DisplayController extends Controller
{
    /**
     * @return array
     */
    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['index', 'view'],
                'rules' => [

                    [
                        'actions' => ['view', 'index'],
                        'allow' => true,
                        'roles' => ['admin', 'user'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'index' => ['get'],
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
        return $actions;
    }
}