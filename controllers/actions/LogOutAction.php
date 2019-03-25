<?php

namespace app\controllers\actions;

use Yii;
use yii\base\Action;

class LogOutAction extends Action
{
    public function run()
    {
        Yii::$app->user->logout();

        return $this->controller->goHome();
    }
}