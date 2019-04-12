<?php
declare(strict_types=1);

namespace app\controllers\actions;

use Yii;
use yii\base\Action;
use yii\web\Response;

class LogOutAction extends Action
{
    public function run(): Response
    {
        Yii::$app->user->logout();

        return $this->controller->goHome();
    }
}