<?php
declare(strict_types=1);

namespace app\modules\shop\controllers\actions\cart;


class ClearAction extends \yii\base\Action
{
    public function run()
    {
        $session = \Yii::$app->session;
        $session->open();
        $session->remove('cart');
        $session->remove('cart.qty');
        $session->remove('cart.sum');
        return $this->controller->render('cart', ['session' => $session]);
    }
}