<?php
declare(strict_types=1);

namespace app\controllers\actions;

use Yii;
use yii\base\Action;
use yii\web\Response;

/**
 * Class LogOutAction
 * @package app\controllers\actions
 */
class LogOutAction extends Action
{
    /**
     * @return Response
     */
    public function run(): Response
    {
        Yii::$app->user->logout();

        return $this->controller->goHome();
    }
}