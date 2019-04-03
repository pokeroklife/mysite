<?php

namespace app\modules\news\controllers;


use yii\web\Controller;

class NewsController extends Controller
{
    public $layout = 'newsLayout';

    public function actions(): array
    {
        $actions = parent::actions();
        $actions ['index'] = ['class' => 'app\modules\news\controllers\actions\IndexAction'];
        $actions ['editor'] = ['class' => 'app\modules\news\controllers\actions\CreateNewsAction'];
        $actions ['view'] = ['class' => 'app\modules\news\controllers\actions\ViewNewsAction'];
        return $actions;
    }

}
