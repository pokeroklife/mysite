<?php

namespace app\modules\news\controllers;

use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\web\Controller;

class NewsController extends Controller
{


    public function actions():array
    {
        $actions = parent::actions();
        $actions ['index'] = ['class' => 'app\modules\news\controllers\actions\IndexAction'];
        $actions ['editor'] = ['class' => 'app\modules\news\controllers\actions\CreateNewsAction'];
        return $actions;
    }

}
