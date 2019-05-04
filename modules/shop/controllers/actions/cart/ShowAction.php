<?php
declare(strict_types=1);

namespace app\modules\shop\controllers\actions\cart;


use yii\base\Action;

class ShowAction extends Action
{
    public function run()
    {
        $session = \Yii::$app->session;
        $session->open();
        return $this->controller->render('cart', ['session' => $session]);
    }
}