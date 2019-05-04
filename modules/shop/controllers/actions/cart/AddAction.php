<?php
declare(strict_types=1);

namespace app\modules\shop\controllers\actions\cart;

use app\modules\shop\models\Cart;
use app\modules\shop\models\Products;

class AddAction extends \yii\base\Action
{
    /**
     * @param int $id
     * @return Products|bool
     */
    public function run(int $id)
    {
        if (empty($product = Products::findProduct($id))) {
            return false;
        }

        $session = \Yii::$app->session;
        $session->open();
        $cart = new Cart();
        $cart->addToCart($product);

        return $this->controller->render('cart', ['session' => $session]);


    }
}