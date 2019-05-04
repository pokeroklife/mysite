<?php
declare(strict_types=1);

namespace app\modules\shop\controllers;


use app\modules\shop\controllers\actions\cart\AddAction;
use app\modules\shop\controllers\actions\cart\ClearAction;
use app\modules\shop\controllers\actions\cart\DelAction;
use app\modules\shop\controllers\actions\cart\ShowAction;
use yii\filters\AccessControl;
use yii\web\Controller;

class CartController extends Controller
{
    public function behaviors(): array
    {


        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['add'],
                'rules' => [

                    [
                        'actions' => ['add'],
                        'allow' => true,
                        'roles' => ['admin', 'user'],
                    ],
                ],
            ],

        ];
    }

    /**
     * @return array
     */
    public function actions(): array
    {
        $this->layout = false;
        $actions = parent::actions();
        $actions ['add'] = ['class' => AddAction::class];
        $actions ['clear'] = ['class' => ClearAction::class];
        $actions ['del'] = ['class' => DelAction::class];
        $actions ['show'] = ['class' => ShowAction::class];

        return $actions;
    }
}