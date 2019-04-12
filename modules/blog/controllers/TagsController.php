<?php
declare(strict_types=1);

namespace app\modules\blog\controllers;

use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class TagsController extends \yii\web\Controller
{
    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['delete', 'create'],
                'rules' => [
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
                    'delete' => ['post'],

                ],
            ],
        ];
    }

    public function actions(): array
    {
        $actions = parent::actions();
        $actions ['delete'] = ['class' => 'app\modules\blog\controllers\actions\tags\DeleteAction'];
        $actions ['create'] = ['class' => 'app\modules\blog\controllers\actions\tags\CreateAction'];

        return $actions;
    }
}
