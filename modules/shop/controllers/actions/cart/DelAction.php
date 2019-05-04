<?php
declare(strict_types=1);

namespace app\modules\shop\controllers\actions\cart;


use app\modules\shop\models\Cart;
use yii\base\Action;

class DelAction extends Action
{
    public function run(int $id)
    {
        $session = \Yii::$app->session;
        $session->open();
        $cart = new Cart();
        $cart->recalc($id);
        return $this->controller->render('cart', ['session' => $session]);

    }
}